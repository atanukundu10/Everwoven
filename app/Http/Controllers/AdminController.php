<?php

namespace App\Http\Controllers;

header('Cache-control: no-Catch, no-store');

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin_logout(Request $req)
    {
        $req->session()->flush();
        $req->session()->forget('session_admin_id');
        $req->session()->forget('session_admin_name');
        return redirect('/');
    }

    public function admin_display(): View|RedirectResponse
    {
        if (!session()->has('session_admin_id')) {
            return redirect('/');
        }
        $all_users = DB::table('users')->get();
        return view('admin-actions.admin-display')->with(['allInfo' => $all_users]);
    }

    public function admin_show_sellers(): View|RedirectResponse
    {
        if (!session()->has('session_admin_id')) {
            return redirect('/');
        }
        $all_sellers = DB::table('sellers')->get();
        return view('admin-actions.admin-show-sellers')->with(['all_sellers' => $all_sellers]);
    }

    public function admin_approve_seller(): View|RedirectResponse
    {
        if (!session()->has('session_admin_id')) {
            return redirect('/');
        }
        $all_pending_sellers = DB::table('seller_waiting_approval')->get();
        return view('admin-actions.admin-approve-seller')->with(['all_pending_sellers' => $all_pending_sellers]);
    }
    public function admin_show_all_items()
    {
        $all_products = DB::table('products')
            ->join('sellers', 'products.seller_id', '=', 'sellers.seller_id')
            ->select('products.*', 'sellers.fullname as seller_name')
            ->get();
        return view('admin-actions.admin-show-all-items')->with(['all_products' => $all_products]);
    }

    public function admin_approved_seller($seller_id)
    {
        $unapproved_seller_data = DB::table('seller_waiting_approval')->where('seller_id', $seller_id)->first();
        $user_type = 'seller';
        $status = 'unblocked';
        $submit_data = [
            'fullname' => $unapproved_seller_data->fullname,
            'email' => $unapproved_seller_data->email,
            'gstin' => $unapproved_seller_data->gstin,
            'password' => $unapproved_seller_data->password,
            'user_type' => $user_type,
            'status' => $status
        ];
        $approved_seller_data = DB::table('sellers')->insert($submit_data);
        if ($approved_seller_data) {
            DB::table('seller_waiting_approval')->where('seller_id', $seller_id)->delete();
            return redirect('/admin-approve-seller');
        }
    }

    public function admin_rejected_seller($seller_id)
    {
        $rejected_seller_data = DB::table('seller_waiting_approval')->where('seller_id', $seller_id)->delete();
        if ($rejected_seller_data) {
            return redirect('/admin-approve-seller');
        }
    }

    public function admin_delete_user($delete_id)
    {
        if (!session()->has('session_admin_id')) {
            return redirect('/');
        }
        $user_delete_id = $delete_id;
        DB::table('users')->where('user_id', $user_delete_id)->delete();
        return redirect('/admin-display');
    }
    public function admin_block_user($block_id)
    {
        if (!session()->has('session_admin_id')) {
            return redirect('/');
        }
        $user_block_id = $block_id;
        DB::table('users')->where('user_id', $user_block_id)->update(['status' => 'blocked']);
        if (session()->has('session_user_id')) {
            session()->flush();
            session()->forget('session_admin_id');
            session()->forget('session_admin_name');
            return redirect('/');
        }
        return redirect('/admin-display');
    }
    public function admin_unblock_user($unblock_id)
    {
        if (!session()->has('session_admin_id')) {
            return redirect('/');
        }
        $user_unblock_id = $unblock_id;
        DB::table('users')->where('user_id', $user_unblock_id)->update(['status' => 'unblocked']);
        return redirect('/admin-display');
    }
    public function admin_delete_seller($delete_id)
    {
        if (!session()->has('session_admin_id')) {
            return redirect('/');
        }
        $seller_delete_id = $delete_id;
        DB::table('sellers')->where('seller_id', $seller_delete_id)->delete();
        return redirect('/admin-show-sellers');
    }
    public function admin_block_seller($block_id)
    {
        if (!session()->has('session_admin_id')) {
            return redirect('/');
        }
        $seller_block_id = $block_id;
        DB::table('sellers')->where('seller_id', $seller_block_id)->update(['status' => 'blocked']);
        if (session()->has('session_seller_id')) {
            session()->flush();
            session()->forget('session_seller_id');
            session()->forget('session_seller_fullname');
            return redirect('/');
        }
        return redirect('/admin-show-sellers');
    }
    public function admin_unblock_seller($unblock_id)
    {
        if (!session()->has('session_admin_id')) {
            return redirect('/');
        }
        $seller_unblock_id = $unblock_id;
        DB::table('sellers')->where('seller_id', $seller_unblock_id)->update(['status' => 'unblocked']);
        return redirect('/admin-show-sellers');
    }
}
