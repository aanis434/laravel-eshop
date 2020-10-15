@extends('frontend.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
            @include('frontend.includes.sidebar_categories')
        </div>
        <div class="col-xl-9 col-wd-9gdot5">
            <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{ $categories[0]['name'] }}</h3>
            </div>
            <ul class="row list-unstyled products-group no-gutters mb-6">
                @forelse ($categories[0]['childrenRecursive'] as $child)
                <li class="col-6 col-md-2gdot4 product-item">
                    <div class="product-item__outer h-100 w-100">
                        <div class="product-item__inner px-xl-4 p-3">
                            <div class="product-item__body pb-xl-2">
                                <div class="mb-2">
                                    <a href="{{ count($child['childrenRecursive']) > 0 ? route('categories', $child['slug']) : route('product-list', ['categorySlug' => $child['slug']])  }}" class="d-block text-center"><img class="img-fluid" src="{{ $child->photo ? assets($child->photo->getUrl()) : asset('assets/frontend/img/300X300/img8.jpg') }}" alt="Image Description"></a>
                                </div>
                                <h5 class="text-center mb-1 product-item__title"><a href="{{ count($child['childrenRecursive']) > 0 ? route('categories', $child['slug']) : route('product-list', ['categorySlug' => $child['slug']])  }}" class="font-size-15 text-gray-90">{{ $child['name']}}</a></h5>
                            </div>
                        </div>
                    </div>
                </li>
                @empty
                <p>No Sub Categories Found</p>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection