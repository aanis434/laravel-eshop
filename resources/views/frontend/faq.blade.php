@extends('frontend.layouts.master')

@section('content')

<div class="container">
    <div class="mb-12 text-center mt-5">
        <h1>Frequently Asked Questions</h1>
        <!-- <p class="text-gray-44">This Agreement was last modified on 18th february 2019</p> -->
    </div>
    @forelse($faqs as $key => $faq)
    <div class="border-bottom border-color-1 mb-8 rounded-0">
        <h3 class="section-title mb-0 pb-2 font-size-25">{{$faq[$key]->category->category}}</h3>
    </div>
    <!-- Basics Accordion -->
    <div id="basicsAccordion" class="mb-12">
        <!-- Card -->
        @forelse($faq as $key=>$item)
        <div class="card mb-3 border-top-0 border-left-0 border-right-0 border-color-1 rounded-0">
            <div class="card-header card-collapse bg-transparent-on-hover border-0" id="basicsHeadingOne">
                <h5 class="mb-0">
                    <button type="button" class="px-0 btn btn-link btn-block d-flex justify-content-between card-btn py-3 font-size-25 border-0" data-toggle="collapse" data-target="#basicsCollapse_{{$key}}" aria-expanded="true" aria-controls="basicsCollapseOner">
                        {{$item->question}}

                        <span class="card-btn-arrow">
                            <i class="fas fa-chevron-down text-gray-90 font-size-18"></i>
                        </span>
                    </button>
                </h5>
            </div>
            <div id="basicsCollapse_{{$key}}" class="collapse" aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion">
                <div class="card-body pl-0 pb-8">
                    <p class="mb-0"> {{$item->answer}}</p>
                </div>
            </div>
        </div>
        @empty
        <p>No Questions found!</p>
        @endforelse
        <!-- End Card -->
    </div>
    @empty
    <p>No Faqs Found! Try Again later.</p>
    @endforelse
    <!-- End Basics Accordion -->
</div>
@endsection