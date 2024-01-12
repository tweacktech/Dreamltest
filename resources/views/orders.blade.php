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
                      <th>uniq_id</th>
                      <th>Total Price</th>
                      <!-- <th>Status</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    @foreach($orders as $orders)
                    <tr>

                      <td> </td>
                      <td>{{ DB::table('users')->where('id',$orders->user_id)->pluck('name')->first(); }}</td>
                      <td>{{$orders->uniq_id}}</td>
                      <td>${{$orders->total_price}}</td>
                      <!-- <td></td> -->
                      <td> <a href="/orderlist/{{$orders->uniq_id}}">View items </a></td>
       
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