@extends('layouts.app')

@section('content')

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Checkout</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>{{Auth()->User()->name}}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-12">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">
                <table>  </table>
            </div>
          </div>
          
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Unit Price</th>
                      <th>Total Price</th>
                      <th>Quantities</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $totalprice=0; @endphp
                    @foreach($carts as $cart)
                    <tr>

                      <td><img width="120p%" class="rounded" alt="Cinque Terre"  src="assets/img/team/{{DB::table('products')->where('id',$cart->product_id)->pluck('image')->first();}}"> </td>
                      <td>{{ DB::table('products')->where('id',$cart->product_id)->pluck('name')->first(); }}</td>
                      <td>${{DB::table('products')->where('id',$cart->product_id)->pluck('price')->first()}}</td>
                      <td>${{$Total=DB::table('products')->where('id',$cart->product_id)->pluck('price')->first()  * $cart->quantity;  }}</td>
                      <td>{{$cart->quantity}}</td>
                      <td><div style=" display: flex; align-items: center;" class="quantity-container"> 
                        @php $totalprice+=$Total; @endphp

           <form action="{{ route('cart.add') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{$cart->product_id}}">
            
            <input type="hidden" class="btn btn-primary" name="quantity" value="1" min="1">

            <button type="submit" class="btn ls"><i class="btn btn-success">Add +</i></button>
        </form>
        
    <input type="number" class="btn btn-primary " name="quantity" value="{{$cart->quantity ?? 1}}" min="1">
     <form action="{{ route('cart.remove') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{$cart->product_id}}">
            
            <input type="hidden" class="btn btn-primary" name="quantity" value="1" min="1">

            <button type="submit" class="btn ls"><i class="btn btn-danger">- Remove</i></button>
        </form>
</div>


        </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
    <form id="paymentForm">

  <div class="form-group">

    <input type="hidden" id="email-address" value="{{Auth()->User()->email}}" required />
  </div>

  <div class="form-group">

    <input type="hidden" id="amount" value="{{$totalprice}}" required />

  </div>

  <div class="form-submit">

   @if($totalprice!=0) <button type="submit" class="btn btn-info" style="float: right;" onclick="payWithPaystack()"> CheckOut ${{$totalprice}} </button>
   @endif

  </div>

</form>
                 
              </div>
        </div>

      </div>
    </div>
    </section><!-- End Portfolio Details Section -->


 <script src="https://js.paystack.co/v1/inline.js"></script>

    <script>

      const paymentForm = document.getElementById('paymentForm');

paymentForm.addEventListener("submit", payWithPaystack, false);


function payWithPaystack(e) {

  e.preventDefault();


  let handler = PaystackPop.setup({

    key: 'pk_test_7ce279d181176a0c0af488855daf72c19ca5ff8e', // Replace with your public key

    email: document.getElementById("email-address").value,

    amount: document.getElementById("amount").value * 100,

    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

    // label: "Optional string that replaces customer email"

    onClose: function(){

      alert('Window closed.');

    },

    callback: function(response){


      let message = response.reference;

                    window.location.href = "/verify-order-payment/" + message;

    }

  });


  handler.openIframe();

}


    </script>
@endsection