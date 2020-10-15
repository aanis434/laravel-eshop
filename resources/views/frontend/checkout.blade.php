@extends('frontend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="mb-5">
        <h1 class="text-center">Checkout</h1>
    </div>
    <form method="POST" class="js-validate" novalidate="novalidate" action='{{ route("place-order") }}'>
        @csrf
        <div class="row">
            <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                <div class="pl-lg-3 ">
                    <div class="bg-gray-1 rounded-lg">
                        <!-- Order Summary -->
                        <div class="p-4 mb-4 checkout-table">
                            <!-- Title -->
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Order Summary</h3>
                            </div>
                            <!-- End Title -->

                            <!-- Product Content -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(Cart::content() as $row)
                                    <tr class="cart_item">
                                        <td>{{ $row->name }} &nbsp;<strong class="product-quantity">× {{ $row->qty }}</strong></td>
                                        <td>{{ $row->subtotal }}</td>
                                    </tr>
                                    @empty
                                    <tr class="cart_item">
                                        <td colspan="2" class="text-center">No item found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <!--  <tr>
                                        <th>Subtotal</th>
                                        <td>$1,785.00</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td>Flat rate $300.00</td>
                                    </tr> -->
                                    <tr>
                                        <th>Total</th>
                                        <td><strong>{{ Cart::subtotal() }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- End Product Content -->
                            <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                <!-- Basics Accordion -->
                                <div id="basicsAccordion1">
                                    <!-- Card -->
                                    <!--  <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingOne">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="stylishRadio1" name="stylishRadio" checked>
                                                <label class="custom-control-label form-label" for="stylishRadio1"
                                                    data-toggle="collapse"
                                                    data-target="#basicsCollapseOnee"
                                                    aria-expanded="true"
                                                    aria-controls="basicsCollapseOnee">
                                                    Direct bank transfer
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseOnee" class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                            aria-labelledby="basicsHeadingOne"
                                            data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End Card -->

                                    <!-- Card -->
                                    <!--    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingTwo">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="secondStylishRadio1" name="stylishRadio">
                                                <label class="custom-control-label form-label" for="secondStylishRadio1"
                                                    data-toggle="collapse"
                                                    data-target="#basicsCollapseTwo"
                                                    aria-expanded="false"
                                                    aria-controls="basicsCollapseTwo">
                                                    Check payments
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseTwo" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                            aria-labelledby="basicsHeadingTwo"
                                            data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End Card -->

                                    <!-- Card -->
                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingThree">
                                            <div class="custom-control custom-radio">
                                                <input name="payment_type" value="Cash On" type="radio" class="custom-control-input" id="thirdstylishRadio1" checked>
                                                <label class="custom-control-label form-label" for="thirdstylishRadio1" data-toggle="collapse" data-target="#basicsCollapseThree" aria-expanded="false" aria-controls="basicsCollapseThree">
                                                    Cash on delivery
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseThree" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter" aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                Pay with cash upon delivery.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->

                                    <!-- Card -->
                                    <!--  <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingFour">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="FourstylishRadio1" name="stylishRadio">
                                                <label class="custom-control-label form-label" for="FourstylishRadio1"
                                                    data-toggle="collapse"
                                                    data-target="#basicsCollapseFour"
                                                    aria-expanded="false"
                                                    aria-controls="basicsCollapseFour">
                                                    PayPal <a href="#" class="text-blue">What is PayPal?</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseFour" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                            aria-labelledby="basicsHeadingFour"
                                            data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End Card -->
                                </div>
                                <!-- End Basics Accordion -->
                            </div>
                            <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place order</button>
                        </div>
                        <!-- End Order Summary -->
                    </div>
                </div>
            </div>

            <div class="col-lg-7 order-lg-1">
                <div class="pb-7 mb-7">
                    <!-- Title -->
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-25">Billing Address</h3>
                    </div>
                    <!-- End Title -->
                    @php
                    $user = Auth::user();
                    @endphp

                    <!-- Billing Form -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Full name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="name" value="{{ $user ? $user->name : '' }}" placeholder="Full Name" aria-label="Jack" required="" data-msg="" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="w-100"></div>


                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Phone
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="phone" value="{{ isset($user->customer->phone) ? $user->customer->phone : '' }}" placeholder="Phone Number" aria-label="+1 (062) 109-9222" data-msg="" data-error-class="u-has-error" data-success-class="u-has-success">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Alternative Phone
                                </label>
                                <input type="text" class="form-control" name="alternative_phone" value="" placeholder="Alternative Phone Number" aria-label="+1 (062) 109-9222" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                                @error('alternative_phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="w-100"></div>

                        <div class="col-md-12">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Address
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <textarea class="form-control p-5" rows="4" name="address" placeholder="Billing Address for delivery.">{{ isset($user->customer->address) ? $user->customer->address : '' }}</textarea>
                                </div>
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- End Input -->
                        </div>

                    </div>
                    <!-- End Billing Form -->

                    <!-- Accordion -->
                    @unless (Auth::check())
                    <div id="shopCartAccordion2" class="accordion rounded mb-6">
                        <!-- Card -->
                        <div class="card border-0">
                            <div id="shopCartHeadingThree" class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="checkbox" class="custom-control-input" id="createAnaccount" name="create_account" value="1" checked>
                                <label class="custom-control-label form-label" for="createAnaccount" data-toggle="collapse" data-target="#shopCartThree" aria-expanded="true" aria-controls="shopCartThree">
                                    Create an account?
                                </label> <br> &nbsp;

                                @error('create_account')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div id="shopCartThree" class="collapse show" aria-labelledby="shopCartHeadingThree" data-parent="#shopCartAccordion2" style="">
                                <!-- Form Group -->
                                <div class="js-form-message py-5">
                                    <label class="form-label">
                                        Email Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email Address" aria-label="jackwayley@gmail.com" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="js-form-message form-group mb-6">
                                    <label class="form-label" for="signinSrPasswordExample1">
                                        Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" name="password" class="form-control" name="password" id="signinSrPasswordExample1" placeholder="********" aria-label="********" required data-msg="Enter password." data-error-class="u-has-error" data-success-class="u-has-success">
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- End Form Group -->
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    @endunless
                    <!-- End Accordion -->
                    <!-- Title -->
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-25">Shipping Address</h3>
                    </div>
                    <!-- End Title -->
                    <!-- Accordion -->
                    <div id="shopCartAccordion3" class="accordion rounded mb-5">
                        <!-- Card -->
                        <div class="card border-0">
                            <div id="shopCartHeadingFour" class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="checkbox" class="custom-control-input" id="shippingdiffrentAddress" name="different_shipping_address" value="0">
                                <label class="custom-control-label form-label" for="shippingdiffrentAddress" data-toggle="collapse" data-target="#shopCartfour" aria-expanded="false" aria-controls="shopCartfour">
                                    Ship to a different address?
                                </label> <br> &nbsp;
                                @error('different_shipping_address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div id="shopCartfour" class="collapse mt-5" aria-labelledby="shopCartHeadingFour" data-parent="#shopCartAccordion3" style="">
                                <!-- Shipping Form -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Input -->
                                        <div class="js-form-message mb-6">
                                            <label class="form-label">
                                                Full name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="shipping_name" placeholder="full Name" aria-label="Jack" required="" data-msg="Please enter your full name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                            @error('shipping_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="w-100"></div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-6">
                                            <label class="form-label">
                                                Phone
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="shipping_phone" placeholder="Phone Number" aria-label="+1 (062) 109-9222" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                                            @error('shipping_phone')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-6">
                                            <label class="form-label">
                                                Alternative Phone
                                            </label>
                                            <input type="text" class="form-control" placeholder="Alternative Phone Number" name="shipping_alternative_phone" aria-label="+1 (062) 109-9222" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                                            @error('shipping_alternative_phone')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="w-100"></div>

                                    <div class="col-md-12">
                                        <!-- Input -->
                                        <div class="js-form-message mb-6">
                                            <label class="form-label">
                                                Address
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <textarea class="form-control p-5" rows="4" name="shipping_address" placeholder="Shipping Address for delivery."></textarea>
                                            </div>
                                            @error('shipping_address')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- End Input -->
                                    </div>
                                </div>
                                <!-- End Shipping Form -->
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- End Accordion -->
                    <!-- Input -->
                    <div class="js-form-message mb-6">
                        <label class="form-label">
                            Order notes (optional)
                        </label>

                        <div class="input-group">
                            <textarea name="notes" class="form-control p-5" rows="4" name="text" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                        @error('notes')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- End Input -->
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).on('change', '#createAnaccount', function() {
        if ($(this).is(':checked')) {
            $('#createAnaccount').val(1);
        } else {
            $('#createAnaccount').val(0);
        }
    });

    $(document).on('change', '#shippingdiffrentAddress', function() {
        if ($(this).is(':checked')) {
            $('#shippingdiffrentAddress').val(1);
        } else {
            $('#shippingdiffrentAddress').val(0);
        }
    });
</script>
@endsection