@extends('frontend.layouts.master')

@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="/">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ $product ? route('categories', $product->categories[0]['slug']) : 'javascript:void(0)' }}">{{ $product->categories[0]['name'] ?? '' }}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ $product ? route('categories', $product->slug) : 'javascript:void(0)'}}">{{ $product->name ?? '' }}</a></li>
                        <!-- <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Ultra Wireless S50 Headphones S50 with Bluetooth</li> -->
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="row">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-8 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->
                    @include('frontend.includes.sidebar_categories')
                    <!-- End List -->
                </div>
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                <!-- Single Product Body -->
                @if(!empty($product))
                <div class="mb-xl-14 mb-6">
                    <div class="row">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2" data-infinite="true" data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle" data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4" data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4" data-nav-for="#sliderSyncingThumb">
                                , <div class="js-slide">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img1.jpg') }}" alt="Image Description">
                                </div>
                                <div class="js-slide">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img2.jpg') }}" alt="Image Description">
                                </div>
                                <div class="js-slide">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img3.jpg') }}" alt="Image Description">
                                </div>
                                <div class="js-slide">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img4.jpg') }}" alt="Image Description">
                                </div>
                                <div class="js-slide">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img5.jpg') }}" alt="Image Description">
                                </div>
                            </div>

                            <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--gutters-1 u-slick--transform-off" data-infinite="true" data-slides-show="5" data-is-thumbs="true" data-nav-for="#sliderSyncingNav">
                                <div class="js-slide" style="cursor: pointer;">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img1.jpg') }}" alt="Image Description">
                                </div>
                                <div class="js-slide" style="cursor: pointer;">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img2.jpg') }}" alt="Image Description">
                                </div>
                                <div class="js-slide" style="cursor: pointer;">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img3.jpg') }}" alt="Image Description">
                                </div>
                                <div class="js-slide" style="cursor: pointer;">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img4.jpg') }}" alt="Image Description">
                                </div>
                                <div class="js-slide" style="cursor: pointer;">
                                    <img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/720X660/img5.jpg') }}" alt="Image Description">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 mb-md-6 mb-lg-0">
                            <div class="mb-2">
                                <div class="border-bottom mb-3 pb-md-1 pb-3">
                                    <a href="#" class="font-size-12 text-gray-5 mb-2 d-inline-block">{{ $product->categories[0]['name'] ?? '' }}</a>
                                    <h2 class="font-size-25 text-lh-1dot2">{{ $product->name ?? '' }}</h2>
                                    <div class="mb-2">
                                        <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                            <div class="text-warning mr-2">
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                            <span class="text-secondary font-size-13">(3 customer reviews)</span>
                                        </a>
                                    </div>
                                    <div class="d-md-flex align-items-center">
                                        <a href="#" class="max-width-150 ml-n2 mb-2 mb-md-0 d-block"><img class="img-fluid" src="{{ ($product && $product->photo) ? $product->photo->getUrl() : asset('assets/frontend/img/200X60/img1.png') }}" alt="Image Description"></a>
                                        <!-- <div class="ml-md-3 text-gray-9 font-size-14">Availability: <span class="text-green font-weight-bold">26 in stock</span></div> -->
                                    </div>
                                </div>
                                <div class="flex-horizontal-center flex-wrap mb-4">
                                    <!--  <a href="#" class="text-gray-6 font-size-13 mr-2"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            <a href="#" class="text-gray-6 font-size-13 ml-2"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a> -->
                                </div>
                                <div class="mb-2">
                                    <ul class="font-size-14 pl-3 ml-1 text-gray-110">
                                        <!-- <li>4.5 inch HD Touch Screen (1280 x 720)</li>
                                                <li>Android 4.4 KitKat OS</li>
                                                <li>1.4 GHz Quad Core™ Processor</li>
                                                <li>20 MP Electro and 28 megapixel CMOS rear camera</li> -->
                                    </ul>
                                </div>
                                <p>{!! Str::limit($product->description, 150) ?? 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.' !!}</p>
                                <p><strong>SKU</strong>: FW511948218</p>
                                <div class="mb-4">
                                    <div class="d-flex align-items-baseline">
                                        <ins class="font-size-36 text-decoration-none">{{ $product->price ?? '' }}</ins>
                                        <del class="font-size-20 ml-2 text-gray-6">$2,299.00</del>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-end mb-3">
                                    <!--  <div class="max-width-150 mb-4 mb-md-0">
                                                <h6 class="font-size-14">Quantity</h6>
                                                <div class="border rounded-pill py-2 px-3 border-color-1">
                                                    <div class="js-quantity row align-items-center">
                                                        <div class="col">
                                                            <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="1">
                                                        </div>
                                                        <div class="col-auto pr-1">
                                                            <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                                <small class="fas fa-minus btn-icon__inner"></small>
                                                            </a>
                                                            <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                                <small class="fas fa-plus btn-icon__inner"></small>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                    <div class="ml-md-3">
                                        <a href="javascript:void(0)" class="btn px-5 btn-primary-dark transition-3d-hover addToCart" id="" data-id="{{ $product->id ?? '' }}"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <p>No Product found!</p>
                @endif
                <!-- End Single Product Body -->
            </div>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@endsection

@section('scripts')
@include('frontend.cart_ajax')
@endsection