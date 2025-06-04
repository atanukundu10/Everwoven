<?php

namespace App\Http\Controllers;

header('Cache-control: no-Catch, no-store');

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SellerController extends Controller
{

    public function seller_portal(): View
    {
        return view('seller-actions.seller-portal');
    }

    public function seller_login(): View
    {
        return view('seller-actions.seller-login');
    }

    public function seller_signin(Request $req)
    {
        $email = $req->input('email');
        $password = $req->input('password');
        $seller_login_data = DB::table('sellers')->where('email', $email)->first();
        if ($seller_login_data) {
            if ($seller_login_data->password == $password) {
                if ($seller_login_data->status == 'unblocked') {
                    session()->put('session_seller_id', $seller_login_data->seller_id);
                    session()->put('session_seller_fullname', $seller_login_data->fullname);
                    return redirect('/seller-home');
                } else {
                    return redirect('/seller-login')->with('message', 'Unable to login, please contact Everwoven');
                }
            } else {
                return redirect('/seller-login')->with('message', 'Incorrect Password');
            }
        } else {
            return redirect('/seller-login')->with('message', 'Email Does not Exist');
        }
    }

    public function seller_home(): View
    {
        return view('seller-actions.seller-home');
    }

    public function seller_signup(): View
    {
        return view('seller-actions.seller-signup');
    }

    public function seller_submit(Request $req)
    {
        $req->validate([
            'fullname' => 'required|regex:/^[A-Za-z ]{3,30}$/',
            'email' => 'required|email',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{5,16}$/',
            'gstin' => 'required'
        ]);

        $fullname = $req->input('fullname');
        $email = $req->input('email');
        $password = $req->input('password');
        $gstin = $req->input('gstin');

        $submit_data = [
            'fullname' => $fullname,
            'email' => $email,
            'gstin' => $gstin,
            'password' => $password
        ];
        DB::table('seller_waiting_approval')->insert($submit_data);
        return redirect('/seller-login')->with('message', 'Please wait until your request is processed');
    }

    public function add_product(): View
    {
        return view('seller-actions.add-product');
    }

    public function product_submit(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'quantity' => 'required|integer|min:1',
            'category' => 'required|string'
        ]);
        $name = $req->input('name');
        $description = $req->input('description');
        $price = $req->input('price');
        $file = $req->file('image');
        $fileName = $file->getClientOriginalName();
        $uploadLocation = "./product-images";
        $file->move($uploadLocation, $fileName);
        $quantity = $req->input('quantity');
        $categoty = $req->input('category');
        $seller_id = $req->session()->get('session_seller_id');
        $submit_product = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $uploadLocation . '/' . $fileName,
            'quantity' => $quantity,
            'category' => $categoty,
            'seller_id' => $seller_id
        ];
        DB::table('products')->insert($submit_product);
        return redirect('/seller-home');
    }

    public function seller_view_products(): View
    {
        $seller_id = session()->get('session_seller_id');
        $all_products = DB::table('products')->where('seller_id', $seller_id)->get();
        return view('seller-actions.seller-view-products')->with(['all_products' => $all_products]);
    }

    public function seller_logout(Request $req)
    {
        $req->session()->flush();
        $req->session()->forget('session_seller_id');
        $req->session()->forget('session_seller_fullname');
        return redirect('/');
    }
}
