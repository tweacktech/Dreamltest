<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['details','welcome']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product=DB::table('products')->get();
        return view('home',compact('product'));
    }

 public function welcome()
    {
        $product=DB::table('products')->get();
        return view('welcome',compact('product'));
    }

     public function details($id)
    {   $product=DB::table('products')->where(DB::raw('md5(id)'),$id)->first();
    if ($product) {
        return view('details',compact('product'));
    }
        return redirect()->back()->with('error', 'Product not found.');
    }

     public function checkouts()
    {   
    if ($user=Auth()->User()->id) {
        $sum=0;
        $product=DB::table('carts')
       ->join('products','products.id','carts.product_id')
       ->where('carts.user_id',$user)->get();
        $carts=DB::table('carts')->where('user_id',$user)->get();
        foreach ($product as $key ) {
            // code...
             $sum+=$key->quantity*$key->price;

        }


        return view('checkout',compact('carts','product','sum'));
    }
        return redirect()->back()->with('error', 'Product not found.');
    }



    public function checkout()
{
    $user = Auth()->user();

    if ($user) {
        $sum = 0;
$carts=DB::table('carts')->where('user_id',$user)->get();
        $products = DB::table('carts')
            ->join('products', 'products.id', 'carts.product_id')
            ->where('carts.user_id', $user->id)
            ->get();

        // Loop through the products to calculate the total sum
        foreach ($products as $product) {
            $sum += $product->quantity * $product->price;
        }

        $carts = DB::table('carts')->where('user_id', $user->id)->get();

        return view('checkout', compact('carts', 'products', 'sum'));
    }

    return redirect()->back()->with('error', 'User not authenticated.');
}

}
