@extends('frontend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="mx-xl-10">
        <div class="mb-6 text-center">
            <h1 class="mb-6">Track your Order</h1>
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <p class="text-gray-90 px-xl-10">To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your order status with details.</p>
        </div>
        <div class="my-4 my-xl-8">
            <form class="js-validate" novalidate="novalidate" method="POST" action="{{ route('track-order-details') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <!-- Form Group -->
                        <div class="js-form-message form-group">
                            <label class="form-label" for="orderid">Order ID
                            </label>
                            <input type="text" class="form-control" name="order_no" id="orderid" placeholder="Enter Your order no." aria-label="Enter Your order no.">
                            @error('order_no')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- End Form Group -->
                    </div>
                    <!-- Button -->
                    <div class="col-md-12 mb-1">
                        <label for=""></label>
                        <button type="submit" class="form-control btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">Track</button>
                    </div>
                    <!-- End Button -->

                </div>
            </form>
        </div>
    </div>
</div>
@endsection