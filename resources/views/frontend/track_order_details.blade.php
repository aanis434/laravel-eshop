@extends('frontend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="mx-xl-10">
        <div class="mb-6 text-center">
            <h1 class="">Your Order Details</h1>
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <p class="text-gray-90 px-xl-10">Your order is <strong>{{ $order->status ?? 'not found' }}</strong>.</p>
        </div>
        <div class="my-4">
            @if(!empty($order))
            <div class="my-order-card-wrapper pt-3 pb-2">
                <div class="my-order-card__meta">
                    <p>
                        Your Order ID:
                        <em>#{{ $order->order_no }}</em> ({{count($order->orderDetails)}} items) (TK. {{ $order->total_amount }})
                    </p>
                </div>
                <div class="status mb-5">
                    <span class="text-uppercase border border-success text-success p-2">{{ $order->status }}</span>

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
            @else
            <div class="text-center mb-10">
                <p>Order no is not correct! Please provide a correct order no.</p>
                <a href="{{ route('track-order') }}" class="btn btn-info">Track Again</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection