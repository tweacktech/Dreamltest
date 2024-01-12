@extends('layouts.app')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <ol>
            <li><a href="index1.html">Home</a></li>
            @guest
            <li>Checkout</li>
            @endguest
            <li>{{Auth()->User()->name ?? ''}}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="/assets/img/team/{{$product->image}}" alt="">
                </div>

                <div class="swiper-slide">
                   <img src="/assets/img/team/{{$product->image}}" alt="">
                </div>

                <div class="swiper-slide">
                   <img src="/assets/img/team/{{$product->image}}" alt="">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="portfolio-info">
              <h3>Name : {{$product->name}}</h3>
              <ul>
                <li><strong>Price</strong>: ${{$product->price}}</li>
                <li><strong>Client</strong>: ASU Company</li>
                
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>Descriptions</h2>
              <p>
                {{$product->description}}
              </p>
            </div>
            <div class="portfolio-details-slider swiper pt-5">
              <h2>Action</h2>
            <div style=" display: flex; align-items: center;" class="quantity-container"> 

           <form action="{{ route('cart.add') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            
            <input type="hidden" class="btn btn-primary" name="quantity" value="1" min="1">

            <button type="submit" class="btn ls"><i class="btn btn-success">Add +</i></button>
        </form>
        
    <input type="number" class="btn btn-primary " name="quantity" value="{{$quantity ?? 1}}" min="1">
     <form action="{{ route('cart.remove') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            
            <input type="hidden" class="btn btn-primary" name="quantity" value="1" min="1">

            <button type="submit" class="btn ls"><i class="btn btn-danger">- Remove</i></button>
        </form>
</div>

            </div>
          </div>


        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

@endsection