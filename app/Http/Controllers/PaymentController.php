<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class PaymentController extends Controller
{
    public function payments()
    {
        $user=Auth()->User();
       if ($user) {
           $payments=DB::table('payments')->where('email',$user->email)->get();
           return view('payments',compact('payments'));
       }
       return redirect()->back()->with('error','no user');
    }
}
