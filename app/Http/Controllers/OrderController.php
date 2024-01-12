<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class OrderController extends Controller
{
     public function orders()
    {
        $user=Auth()->User();
       if ($user) {
           $orders=DB::table('orders')->where('user_id',$user->id)->get();
           return view('orders',compact('orders'));
       }
       return redirect()->back()->with('error','no user');
    }



    public function orderlist($uniq_id)
    {
         $user=Auth()->User();
       if ($user) {     
           $orders=DB::table('order_items')->where('uniq_id',$uniq_id)->where('user_id',$user->id)->get();
           return view('orderlist',compact('orders'));
       }
       return redirect()->back()->with('error','no user');
        
    }
}
