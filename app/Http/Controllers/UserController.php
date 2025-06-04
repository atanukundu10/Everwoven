<?php

namespace App\Http\Controllers;

header('Cache-control: no-Catch, no-store');

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function home(): View
    {
        $firstname = session()->get('session_firstname');
        $all_products = DB::table('products')->get();
        $data = [
            'all_products' => $all_products,
        ];
        if (isset($firstname)) {
            $data['firstname'] = $firstname;
        }
        return view('home')->with($data);
    }
    public function login(): View
    {
        return view('login');
    }
    public function admin_signin(): View
    {
        return view('admin-actions.admin-page');
    }
    public function signin(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{5,16}$/',
            ],
        ]);
        $email = $req->input('email');
        $password = $req->input('password');
        $admin = DB::table('admin')->where('email', $email)->first();
        if ($admin) {
            if ($admin->password === $password) {
                $req->session()->put('session_admin_id', $admin->admin_id);
                $req->session()->put('session_admin_name', $admin->name);
                return redirect('/admin-signin');
            } else {
                return redirect('/signin')->with('message', 'Incorrect admin password');
            }
        }
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            if ($user->password === $password) {
                if ($user->status === 'unblocked') {
                    $req->session()->put('session_id', $user->user_id);
                    $req->session()->put('session_firstname', $user->firstname);
                    return redirect('/');
                } else {
                    return redirect('/login')->with('message', 'Unable to login, please contact Everwoven');
                }
            } else {
                return redirect('/login')->with('message', 'Incorrect password');
            }
        }
        return redirect('/login')->with('message', 'User not found');
    }
    public function signup(): View
    {
        return view('signup');
    }
    public function submit(Request $req)
    {
        $req->validate(
            [
                'firstname' => "required|regex:/^[A-Za-z ]{3,30}$/",
                'middlename' => "nullable|regex:/^[A-Za-z ]{3,30}$/",
                'lastname' => "required|regex:/^[A-Za-z ]{3,30}$/",
                'age' => "required|integer|between:18,75",
                'email' => 'required|email',
                'phone' => "required|regex:/^[9876][0-9]{9}$/",
                'gender' => "required|in:male,female,other",
                'password' => "required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{5,16}$/",
                'confirm_password' => "required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{5,16}$/",
            ]
        );
        $firstname = $req->input('firstname');
        $middlename = $req->input('middlename');
        $lastname = $req->input('lastname');
        $gender = $req->input('gender');
        $age = $req->input('age');
        $email = $req->input('email');
        $phone = $req->input('phone');
        $password = $req->input('password');
        $confirm_password = $req->input('confirm_password');
        $user_type = 'user';
        $status = 'unblocked';
        if ($req->has('terms_check')) {
            if ($password === $confirm_password) {
                $submit_data = [
                    'firstname'   => $firstname,
                    'middlename'  => $middlename,
                    'lastname'    => $lastname,
                    'gender'      => $gender,
                    'age'         => $age,
                    'email'       => $email,
                    'phone'       => $phone,
                    'password'    => $confirm_password,
                    'user_type'   => $user_type,
                    'status'      => $status
                ];
                DB::table('users')->insert($submit_data);
                return redirect('/login');
            } else {
                return redirect()->back()->with('message', 'Both Passwords Should be Same');
            }
        } else {
            return redirect()->back()->with('message', 'You must agree to the terms and conditions to proceed.');
        }
    }
    public function logout(Request $req)
    {
        $req->session()->flush();
        $req->session()->forget('session_id');
        $req->session()->forget('session_firstname');
        return redirect('/');
    }
    public function display(): View
    {
        $session_id = session()->get('session_id');
        $display_data = DB::table('users')->where('user_id', $session_id)->get();
        return view('user-actions.display')->with(['user' => $display_data->first()]);
    }
    public function edit(): View
    {
        $session_id = session()->get('session_id');
        $display_data = DB::table('users')->where('user_id', $session_id)->first();
        return view('user-actions.edit')->with(['user' => $display_data]);
    }
    public function save_changes(Request $req)
    {
        $req->validate([
            'user_id'    => 'required|exists:users,user_id',
            'firstname'  => 'required|regex:/^[A-Za-z ]{3,30}$/',
            'middlename' => 'nullable|regex:/^[A-Za-z ]{3,30}$/',
            'lastname'   => 'required|regex:/^[A-Za-z ]{3,30}$/',
            'age'        => 'required|integer|between:18,75',
            'email'      => 'required|email',
            'phone'      => 'required|regex:/^[9876][0-9]{9}$/',
            'gender'     => 'required|in:male,female,other',
        ]);
        $user_id    = $req->input('user_id');
        $firstname  = $req->input('firstname');
        $middlename = $req->input('middlename');
        $lastname   = $req->input('lastname');
        $gender     = $req->input('gender');
        $age        = $req->input('age');
        $email      = $req->input('email');
        $phone      = $req->input('phone');
        $submit_data = [
            'firstname'  => $firstname,
            'middlename' => $middlename,
            'lastname'   => $lastname,
            'gender'     => $gender,
            'age'        => $age,
            'email'      => $email,
            'phone'      => $phone,
        ];
        DB::table('users')->where('user_id', $user_id)->update($submit_data);
        $display_data = DB::table('users')->where('user_id', $req->input('user_id'))->first();
        return redirect('/display')->with(['user' => $display_data]);
    }
    public function changepassword(): View
    {
        return view('user-actions.change-password');
    }
    public function change_password(Request $req)
    {
        $change_password_id = $req->session()->get('session_id');
        $req->validate([
            'old_password'     => 'required',
            'new_password'     => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{5,16}$/',
            'confirm_password' => 'required|same:new_password',
        ]);
        $old_password = $req->input('old_password');
        $new_password = $req->input('new_password');
        $confirm_password = $req->input('confirm_password');
        $password_data = DB::table('users')->where('user_id', $change_password_id)->get()->first();
        $db_password = $password_data->password;
        if ($db_password == $old_password) {
            if ($old_password != $new_password) {
                if ($new_password == $confirm_password) {
                    DB::table('users')->where('user_id', $change_password_id)->update(['password' => $confirm_password]);
                    return redirect('/display')->with('message', 'Password Changed Successfully');
                } else {
                    return redirect('/changepassword')->with('message', 'New Password Should Match Confirm Password');
                }
            } else {
                return redirect('/changepassword')->with('message', 'New Password and Old Password Are Same');
            }
        } else {
            return redirect('/changepassword')->with('message', 'Please Enter Correct Password');
        }
    }
    public function add_cart_items($product_id)
    {
        $chosen_products = session()->get('chosen_products', []);
        if (isset($chosen_products[$product_id])) {
            $chosen_products[$product_id]++;
        } else {
            $chosen_products[$product_id] = 1;
        }
        session()->put('chosen_products', $chosen_products);
        return redirect()->back();
    }
    public function cart_details()
    {
        $chosen_products = session()->get('chosen_products', []);
        $product_ids = array_keys($chosen_products);
        $products = DB::table('products')
            ->whereIn('product_id', $product_ids)
            ->get();
        return view('user-actions.cart', [
            'selected_products' => $products,
            'quantities' => $chosen_products
        ]);
    }
    public function checkout(): View
    {
        $chosen_products = session()->get('chosen_products', []);
        $product_ids = array_keys($chosen_products);
        $products = DB::table('products')
            ->whereIn('product_id', $product_ids)
            ->get();
        foreach ($products as $product) {
            $product->quantity = $chosen_products[$product->product_id] ?? 0;
        }
        return view('user-actions.checkout', [
            'selected_products' => $products
        ]);
    }
}
