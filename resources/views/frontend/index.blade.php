@extends('frontend.layouts.master')

@section('content')
<!-- Slider Section -->
<div class="mb-5">
    <div class="bg-img-hero" style="background-color: #CCCCCC">
        <div class="container min-height-420 max-height-420 overflow-hidden">
            <div class="js-slick-carousel u-slick" data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start mb-3 mb-md-4 offset-xl-3 pl-2 pb-1">
                @forelse($sliders as $key=>$slider)
                <div class="js-slide bg-img-hero-center" data-animation-delay="0">
                    <div class="row min-height-420 max-height-420 py-7 py-md-0">
                        <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                            <h1 class="font-size-44 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                {!! $slider->description ?? '' !!}
                            </h1>
                            <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">{{ $slider->heading ?? '' }}
                            </h6>
                            <!-- <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                <span class="font-size-13">FROM</span>
                                <div class="font-size-50 font-weight-bold text-lh-45">
                                    <sup class="">$</sup>749<sup class="">99</sup>
                                </div>
                            </div> -->
                            <a href="javascript:void(0)" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                Start Buying
                            </a>
                        </div>
                        <div class="col-xl-5 col-6  d-flex align-items-center max-height-420" data-scs-animation-in="zoomInhref" data-scs-animation-delay="500">
                            <img class="img-fluid" style="max-height: 420px" src="{{ $slider->images ? asset($slider->images->getUrl()) : '' }}" alt="{{ $slider->heading ?? 'Slider Image'}}">
                        </div>
                    </div>
                </div>
                @empty
                <div class="js-slide bg-img-hero-center" data-animation-delay="0">
                    <div class="row min-height-420 py-7 py-md-0">
                        <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                            <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                THE NEW <span class="d-block font-size-55">STANDARD</span>
                            </h1>
                            <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">UNDER FAVORABLE SMARTWATCHES
                            </h6>
                            <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                <span class="font-size-13">FROM</span>
                                <div class="font-size-50 font-weight-bold text-lh-45">
                                    <sup class="">$</sup>749<sup class="">99</sup>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                Start Buying
                            </a>
                        </div>
                        <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="zoomInhref" data-scs-animation-delay="500">
                            <img class="img-fluid" src="{{ asset('assets/frontend/img/416X420/img1.png') }}" alt="Image Description">
                        </div>
                    </div>
                </div>
                <div class="js-slide bg-img-hero-center" data-animation-delay="0">
                    <div class="row min-height-420 py-7 py-md-0">
                        <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                            <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                THE NEW <span class="d-block font-size-55">STANDARD</span>
                            </h1>
                            <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">UNDER FAVORABLE SMARTWATCHES
                            </h6>
                            <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                <span class="font-size-13">FROM</span>
                                <div class="font-size-50 font-weight-bold text-lh-45">
                                    <sup class="">$</sup>749<sup class="">99</sup>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                Start Buying
                            </a>
                        </div>
                        <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="fadeInUp" data-scs-animation-delay="500">
                            <img class="img-fluid" src="{{ asset('assets/frontend/img/416X420/img2.png') }}" alt="Image Description">
                        </div>
                    </div>
                </div>
                <div class="js-slide bg-img-hero-center" data-animation-delay="0">
                    <div class="row min-height-420 py-7 py-md-0">
                        <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">
                            <h1 class="font-size-64 text-lh-57 font-weight-light" data-scs-animation-in="fadeInUp">
                                THE NEW <span class="d-block font-size-55">STANDARD</span>
                            </h1>
                            <h6 class="font-size-15 font-weight-bold mb-3" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">UNDER FAVORABLE SMARTWATCHES
                            </h6>
                            <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                <span class="font-size-13">FROM</span>
                                <div class="font-size-50 font-weight-bold text-lh-45">
                                    <sup class="">$</sup>749<sup class="">99</sup>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-15" data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                Start Buying
                            </a>
                        </div>
                        <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="fadeInRight" data-scs-animation-delay="500">
                            <img class="img-fluid" src="{{ asset('assets/frontend/img/416X420/img3.png') }}" alt="Image Description">
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- End Slider Section -->
<div class="container">

    <!-- Categories Carousel -->
    <div class="mb-5">
        <div class="position-relative">
            <div class="js-slick-carousel u-slick u-slick--gutters-0 position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1" data-arrows-classes="d-none d-xl-block u-slick__arrow-normal u-slick__arrow-centered--y rounded-circle text-black font-size-30 z-index-2" data-arrow-left-classes="fa fa-angle-left u-slick__arrow-inner--left left-n16" data-arrow-right-classes="fa fa-angle-right u-slick__arrow-inner--right right-n20" data-pagi-classes="d-xl-none text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1" data-slides-show="10" data-slides-scroll="1" data-responsive='[{
                    "breakpoint": 1400,
                    "settings": {
                    "slidesToShow": 8
                    }
                }, {
                    "breakpoint": 1200,
                    "settings": {
                        "slidesToShow": 6
                    }
                }, {
                    "breakpoint": 992,
                    "settings": {
                    "slidesToShow": 5
                    }
                }, {
                    "breakpoint": 768,
                    "settings": {
                    "slidesToShow": 3
                    }
                }, {
                    "breakpoint": 554,
                    "settings": {
                    "slidesToShow": 2
                    }
                }]'>

                @forelse(config('categories') as $category)
                <div class="js-slide">
                    <a href="{{ count($category['sub_category']) > 0 ? route('categories', $category['slug']) : route('product-list', ['categorySlug' => $category['slug']])  }}" class="d-block text-center bg-on-hover width-122 mx-auto">
                        <div class="bg pt-4 rounded-circle-top width-122 height-75">
                            @if(isset($category['photo']))
                            <img src="{{ asset($category['photo']) }}" alt="{{ $category['name'] }}">
                            @else
                            <i class="ec ec-laptop font-size-40"></i>
                            @endif
                        </div>
                        <div class="bg-white px-2 pt-2 width-122">
                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">{{ $category['name'] }}</h6>
                        </div>
                    </a>
                </div>
                @empty
                <div class="js-slide">
                    <a href="javascript:void()" class="d-block text-center bg-on-hover width-122 mx-auto">
                        <div class="bg pt-4 rounded-circle-top width-122 height-75">
                            <i class="ec ec-laptop font-size-40"></i>
                        </div>
                        <div class="bg-white px-2 pt-2 width-122">
                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                        </div>
                    </a>
                </div>
                <div class="js-slide">
                    <a href="javascript:void()" class="d-block text-center bg-on-hover width-122 mx-auto">
                        <div class="bg pt-4 rounded-circle-top width-122 height-75">
                            <i class="ec ec-laptop font-size-40"></i>
                        </div>
                        <div class="bg-white px-2 pt-2 width-122">
                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                        </div>
                    </a>
                </div>
                <div class="js-slide">
                    <a href="javascript:void()" class="d-block text-center bg-on-hover width-122 mx-auto">
                        <div class="bg pt-4 rounded-circle-top width-122 height-75">
                            <i class="ec ec-laptop font-size-40"></i>
                        </div>
                        <div class="bg-white px-2 pt-2 width-122">
                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                        </div>
                    </a>
                </div>
                <div class="js-slide">
                    <a href="javascript:void()" class="d-block text-center bg-on-hover width-122 mx-auto">
                        <div class="bg pt-4 rounded-circle-top width-122 height-75">
                            <i class="ec ec-laptop font-size-40"></i>
                        </div>
                        <div class="bg-white px-2 pt-2 width-122">
                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                        </div>
                    </a>
                </div>
                <div class="js-slide">
                    <a href="javascript:void()" class="d-block text-center bg-on-hover width-122 mx-auto">
                        <div class="bg pt-4 rounded-circle-top width-122 height-75">
                            <i class="ec ec-laptop font-size-40"></i>
                        </div>
                        <div class="bg-white px-2 pt-2 width-122">
                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                        </div>
                    </a>
                </div>
                <div class="js-slide">
                    <a href="javascript:void()" class="d-block text-center bg-on-hover width-122 mx-auto">
                        <div class="bg pt-4 rounded-circle-top width-122 height-75">
                            <i class="ec ec-laptop font-size-40"></i>
                        </div>
                        <div class="bg-white px-2 pt-2 width-122">
                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                        </div>
                    </a>
                </div>
                <div class="js-slide">
                    <a href="javascript:void()" class="d-block text-center bg-on-hover width-122 mx-auto">
                        <div class="bg pt-4 rounded-circle-top width-122 height-75">
                            <i class="ec ec-laptop font-size-40"></i>
                        </div>
                        <div class="bg-white px-2 pt-2 width-122">
                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                        </div>
                    </a>
                </div>
                <div class="js-slide">
                    <a href="javascript:void()" class="d-block text-center bg-on-hover width-122 mx-auto">
                        <div class="bg pt-4 rounded-circle-top width-122 height-75">
                            <i class="ec ec-laptop font-size-40"></i>
                        </div>
                        <div class="bg-white px-2 pt-2 width-122">
                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">Accessories</h6>
                        </div>
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- End Categories Carousel -->
</div>
<div class="container">
    <!-- Trending products -->
    @forelse($parent_categories as $key=>$parent)
    <div class="mb-6">
        <div class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{$parent->name}}</h3>
            <a class="d-block text-gray-16" href="{{ count($parent['childrenCategory']) > 0 ? route('categories', $parent['slug']) : route('product-list', ['categorySlug' => $parent['slug']])  }}">Go to <strong>{{$parent->name}}</strong> products <i class="ec ec-arrow-right-categproes"></i></a>
        </div>
        <div class="js-slick-carousel u-slick overflow-hidden u-slick-overflow-visble pt-3 pb-6 px-1" data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4" data-slides-show="7" data-slides-scroll="1" data-responsive='[{
                          "breakpoint": 1400,
                          "settings": {
                            "slidesToShow": 5
                          }
                        }, {
                            "breakpoint": 1200,
                            "settings": {
                              "slidesToShow": 3
                            }
                        }, {
                          "breakpoint": 992,
                          "settings": {
                            "slidesToShow": 3
                          }
                        }, {
                          "breakpoint": 768,
                          "settings": {
                            "slidesToShow": 2
                          }
                        }, {
                          "breakpoint": 554,
                          "settings": {
                            "slidesToShow": 2
                          }
                        }]'>
            @forelse($parent->childrenCategory as $child)
            @foreach($child->products as $item)
            <div class="js-slide products-group">
                <div class="product-item">
                    <div class="product-item__outer h-100">
                        <div class="product-item__inner px-wd-4 p-2 p-md-3">
                            <div class="product-item__body pb-xl-2">
                                <div class="mb-2"><a href="{{ count($child['childrenCategory']) > 0 ? route('categories', $child['slug']) : route('product-list', ['categorySlug' => $child['slug']])  }}" class="font-size-12 text-gray-5">{{$child->name}}</a></div>
                                <h5 class="mb-1 product-item__title"><a href="{{ route('product-details',[ 'productSlug' => $item->slug]) }}" class="text-blue font-weight-bold">{{$item->name}}</a></h5>
                                <div class="mb-2">
                                    <a href="{{ route('product-details',[ 'productSlug' => $item->slug]) }}" class="d-block text-center"><img class="img-fluid" src="{{ $item->photo ? $item->photo->getUrl() : asset('assets/frontend/img/212X200/img1.jpg') }}" alt="Image Description"></a>
                                </div>
                                <div class="flex-center-between mb-1">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">TK. {{$item->price}}</div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="javascript:void(0)" class="btn-add-cart btn-primary transition-3d-hover addToCart" data-id="{{ $item->id }}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item__footer">
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <!-- <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @empty
            @foreach($parent->products as $product)
            <div class="js-slide products-group">
                <div class="product-item">
                    <div class="product-item__outer h-100">
                        <div class="product-item__inner px-wd-4 p-2 p-md-3">
                            <div class="product-item__body pb-xl-2">
                                <div class="mb-2"><a href="{{ count($parent['childrenCategory']) > 0 ? route('categories', $parent['slug']) : route('product-list', ['categorySlug' => $parent['slug']])  }}" class="font-size-12 text-gray-5">{{$parent->name}}</a></div>
                                <h5 class="mb-1 product-item__title"><a href="{{ route('product-details',[ 'productSlug' => $product->slug]) }}" class="text-blue font-weight-bold">{{$product->name}}</a></h5>
                                <div class="mb-2">
                                    <a href="{{ route('product-details',[ 'productSlug' => $product->slug]) }}" class="d-block text-center"><img class="img-fluid" src="{{ $product->photo ? $product->photo->getUrl() : asset('assets/frontend/img/212X200/img1.jpg') }}" alt="Image Description"></a>
                                </div>
                                <div class="flex-center-between mb-1">
                                    <div class="prodcut-price">
                                        <div class="text-gray-100">TK. {{$product->price}}</div>
                                    </div>
                                    <div class="d-none d-xl-block prodcut-add-cart">
                                        <a href="javascript:void(0)" class="btn-add-cart btn-primary transition-3d-hover addToCart" data-id="{{$product->id}}"><i class="ec ec-add-to-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item__footer">
                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                    <!-- <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
    @empty
    <p>No Product found.</p>
    @endforelse
    <!-- End Trending products -->
</div>

@endsection

@section('scripts')
@include('frontend.cart_ajax')
@endsection