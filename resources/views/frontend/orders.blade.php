@extends('frontend.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
            <div class="mb-6 border border-width-2 border-color-3 borders-radius-6">
                @include('frontend.includes.my_account_sidebar')
            </div>
        </div>
        <div class="col-xl-9 col-wd-9gdot5">
            <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">My Orders</h3>
            </div>
            @foreach($user->orders as $order)
            <div class="my-order-card-wrapper pt-3 pb-2">
                <div class="my-order-card__meta">
                    <p>
                        Your Order ID:
                        <em>#{{ $order->order_no }}</em> ({{count($order->orderDetails)}} items) (TK. {{ $order->total_amount }})
                    </p>
                </div>
                <div class="status mb-5">
                    <span class="text-uppercase border border-success text-success p-2">{{ $order->status }}</span>

                    <a class="text-uppercase border border-info text-info p-2 mb-5" href="{{route('track-order')}}">Track My Order</a>

                </div>

                <div class="my-order-card__content">
                    <div class="row">
                        @foreach($order->orderDetails as $item)
                        <div class="col-3 ">
                            <a href="{{ route('product-details',[ 'productSlug' => $item->product->slug]) }}" class="text-dark">
                                <div class="my-account-book">
                                    <figure class="my-account-book__img">
                                        <img src="{{ asset('assets/frontend/img/212X200/img1.jpg') }}" alt="{{ $item->product->name }}" />
                                    </figure>
                                    <p class="text-center">{{ $item->product->name }} (Tk. {{ $item->total_price }})</p>

                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection