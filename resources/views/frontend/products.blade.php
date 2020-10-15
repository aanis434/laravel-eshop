@extends('frontend.layouts.master')
@section('content')
<div class="container mt-4">
    <div class="row mb-8">
        <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
            @include('frontend.includes.sidebar_categories')
        </div>
        <div class="col-xl-9 col-wd-9gdot5">
            <!-- Shop-control-bar Title -->
            <div class="flex-center-between mb-3">
                <h3 class="font-size-25 mb-0">{{ $products[0]->category_name ?? 'Related Products' }}</h3>
                <!-- <p class="font-size-14 text-gray-90 mb-0">Showing 1–25 of 56 results</p> -->
            </div>
            <!-- End shop-control-bar Title -->
            <!-- Shop-control-bar -->
            <!-- End Shop-control-bar -->
            <!-- Shop Body -->
            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters">
                        @if(isset($products))
                        @forelse ($products as $product)
                        <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2">
                                            <!-- <a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a> -->
                                        </div>
                                        <h5 class="mb-1 product-item__title"><a href="{{ route('product-details',[ 'productSlug' => $product->slug]) }}" class="text-blue font-weight-bold">{{ $product->name }}</a></h5>
                                        <div class="mb-2">
                                            <a href="{{ route('product-details',['productSlug' => $product->slug]) }}" class="d-block text-center"><img class="img-fluid" src="{{ $product->photo ? $product->photo->getUrl() : asset('assets/frontend/img/212X200/img1.jpg') }}" alt="Image Description"></a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">{{ $product->price }}</div>
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                <a href="javascript:void(0)" class="btn-add-cart btn-primary transition-3d-hover addToCart" id="" data-id="{{ $product->id }}"><i class="ec ec-add-to-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <!-- <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a> -->
                                            <!-- <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @empty
                        <p>No Products Found!</p>
                        @endforelse
                        @else
                        <p>No Products Found!</p>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- End Tab Content -->
            <!-- End Shop Body -->
            <!-- Shop Pagination -->
            <!-- <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                <div class="text-center text-md-left mb-3 mb-md-0">Showing 1–25 of 56 results</div>
                <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                    <li class="page-item"><a class="page-link current" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
            </nav> -->
            <!-- End Shop Pagination -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('frontend.cart_ajax')
@endsection