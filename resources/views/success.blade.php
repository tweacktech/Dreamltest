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

          <div class="col-lg-12 p-5">
           <center>  <img width="20%" src="{{asset('goood.webp')}}">
          <h2 class="fw-bold btn-Success py-4">Payment Successfull</h2>
          <a href="/" class="btn btn-primary"> continue Shopping </a>
          <a href="/" class="btn btn-success"> View orders </a>
            </center>
          
          </div>




        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

@endsection