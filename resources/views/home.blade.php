@extends('layouts.app')

@section('content')
<section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
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
<!-- ======= Team Section ======= -->
    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">  

        <div class="row">
          @foreach($product as $product)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="member-img">
               <a href="{{route('details',['id'=>md5($product->id)])}}">
                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt=""></a>
                <div class="social">

                  <a href=""><button type="submit" class="btn"><i class="bi bi-heart"></i></button></a>
                  <a href="{{route('details',['id'=>md5($product->id)])}}"><i class="bi bi-eye"></i></a>
          <form action="{{ route('cart.add') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            
            <input type="hidden" name="quantity" value="1" min="1">

            <button type="submit" class="btn"><i class="bi bi-cart"></i></button>
        </form>
                </div>
              </div>
              <div class="member-info">
                <h4>Name : {{$product->name}}</h4>
                <h3>Price :{{$product->price}} </h3>
                <span>Descriptions : </span>
              </div>
            </div>
          </div>
          @endforeach

       
        </div>

      </div>
    </section><!-- End Team Section -->
         

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

@endsection
