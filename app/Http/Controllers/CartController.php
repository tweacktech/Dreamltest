<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\Products;
 // use App\Models\Payment;
use App\Models\Cart;
use App\Models\OrderItem;
use Auth;
use App\Notifications\Payment;
use App\Notifications\Order;
use Illuminate\Support\Facades\Notification;

use DB;
class CartController extends Controller
{
    //


public function addToCart(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1); // Default to 1 if quantity is not provided

    $product = Products::find($productId);

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }
    $cart = DB::table('carts')->where('product_id', $productId)->first();

    // Check if the product is already in the cart
    $existingItem = $cart;

    if ($existingItem) {
        // If the product is already in the cart, update the quantity
         DB::table('carts')->where('product_id', $productId)->update([
            'quantity' => $existingItem->quantity + $quantity,
        ]);
    } else {
        // If the product is not in the cart, create a new cart item

        DB::table('carts')->insert([
            'product_id' => $productId,
            'user_id'=>Auth()->user()->id,
            'quantity' => $quantity,
        ]);
    }

    return redirect()->back()->with('success', 'Product added to cart.');
}


public function removeFromCart(Request $request)
{
     $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);

    $product = Products::find($productId);

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    $cart = DB::table('carts')->where('product_id', $productId)->first();

    // Check if the product is already in the cart
    $existingItem = $cart;

    if ($cart) {
        if ($cart->quantity ==1) {
           $cart = DB::table('carts')->where('product_id', $productId)->delete();

             return redirect()->back()->with('success', 'Product added to cart.');
        }
        // If the product is already in the cart, update the quantity
         DB::table('carts')->where('product_id', $productId)->update([
            'quantity' => $cart->quantity - $quantity,
        ]);
    }
    

    return redirect()->back()->with('success', 'Product added to cart.');
}


public function paymentSuccess()
{
  return view('success');

}




public function OrderPayment($reference)
  {
    session_start();
    $curl = curl_init();
    $key = 'sk_test_3ec7e1532a394a9e974953b930e50cc61690c325';
    curl_setopt_array($curl, array(

      CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",

      CURLOPT_RETURNTRANSFER => true,

      CURLOPT_ENCODING => "",

      CURLOPT_MAXREDIRS => 10,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,

      CURLOPT_TIMEOUT => 30,

      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

      CURLOPT_CUSTOMREQUEST => "GET",

      CURLOPT_HTTPHEADER => array(

        "Authorization: Bearer $key",
        "Cache-Control: no-cache",

      ),

    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $ma = json_decode($response);
  $amount=$ma->data->amount;
    if ($ma->status == true) {
      $user = Auth::user();
      if (Auth::user()) {
        $carts  = DB::table('carts')->where('user_id', $user->id)
          ->join('products', 'products.id', 'carts.product_id')->select('*', 'carts.id as id')
          ->get();
        if (count($carts) <= 0) {
        } else {
          $total = 0;
          foreach ($carts as $cart) {
            $total += $cart->price * $cart->quantity;
          };

            $data = [
              'uniq_id' => 'Orders' . time(),
              'total_price' => $total,
              // 'reference' => $reference,
              'user_id' => Auth::user()->id,
              'address' => "jos",
            ];

            $order_id = DB::table('orders')->insert([
              'uniq_id' => 'Orders' . time(),
              'total_price' => $total,
              // 'reference' => $reference,
              'user_id' => Auth::user()->id,
              'address' => "jos",
              'created_at'=>now(),
              'updated_at'=>now(),
            ]);

            $order = DB::table('orders')->where('id', $order_id)->first();
            foreach ($carts as $cart) {
              // $price = DB::table('products')->where('id', $cart->product_id)->first();
              $order_cart_item = new OrderItem();
              $order_cart_item->uniq_id = $order->uniq_id;
              $order_cart_item->user_id = $cart->user_id;
              $order_cart_item->product_id = $cart->product_id;
              $order_cart_item->quantity = $cart->quantity;
              $order_cart_item->price = $cart->price;
              $order_cart_item->save();
              Cart::where('id', $cart->id)->where('user_id', $user->id)->delete();
            }

            $Payment=DB::table('payments')
            ->insert([
             'order_id' => $order->uniq_id,
              'email' => Auth::user()->email,
              'total_price' => $amount,
              'reference' => $reference,
              'status' => "1",
              'created_at'=>now(),
              'updated_at'=>now(),]);

            $email=Auth()->User()->email;
            $name=Auth()->User()->name;
            $order=$order->uniq_id;
               // Notification::route('mail', $email)->notify(new Payment($name));
            // Alert('success', 'payment success');
               // $email->notify(new Payment($name));
                Notification::route('mail', $email)->notify(new Payment($name))->delay(now()->addSeconds(1));
                Notification::route('mail', $email)->notify(new Order($name,$order))->delay(now()->addSeconds(2));

            return redirect('/paymentSuccess');
          } 
        
              // Alert('warning', 'payment not successfull');
      } else {
        // Alert('warning', 'payment not successfull');

        return redirect()->back();
      }
    }
  }

}
