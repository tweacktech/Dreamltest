@extends('layouts.app')

@section('content')

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Payments</h2>
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
                      <th>Id</th>
                      <th>Name</th>
                      <th>Order Id</th>
                      <th>Reference Id</th>
                      <th>Total Price</th>
                      <!-- <th>Quantities</th>
                      <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                   
                    @foreach($payments as $payments)
                    <tr>

                      <td> </td>
                      <td>{{ DB::table('users')->where('email',$payments->email)->pluck('name')->first(); }}</td>
                      <td>{{$payments->order_id }}</td>
                      <td>{{$payments->reference  }}</td>
                      <td>${{$payments->total_price  }}</td>
                      <!-- <td>{{$payments->status}}</td> -->
                      <td> </td>
       
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
   
                 
              </div>
        </div>

      </div>
    </div>
    </section><!-- End Portfolio Details Section -->

@endsection