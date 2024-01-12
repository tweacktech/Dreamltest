@extends('layouts.header')

@section('content')
    <div class="d-flex justify-content-center p-lg-5">


        <div class="p-5 shadow text-center">
            <h2 class="fw-bold">Payment Successfull</h2>

            <div class="py-5">
                <a href="/order" class=" btn btn-primary btn-lg">View Orders</a>
                <!-- <a href="/all_products" class=" btn btn-primary btn-lg ">Continue Shopping</a> -->
            </div>
        </div>

    </div>
@endsection
