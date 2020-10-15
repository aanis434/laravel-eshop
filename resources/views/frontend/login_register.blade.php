@extends('frontend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <h1 class="text-center">My Account</h1>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="my-4 my-xl-8">
        <div class="row">
            <div class="col-md-5 ml-xl-auto mr-md-auto mr-xl-0 mb-8 mb-md-0">
                <!-- Title -->
                <div class="border-bottom border-color-1 mb-6">
                    <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Login</h3>
                </div>
                <p class="text-gray-90 mb-4">Welcome back! Sign in to your account.</p>
                <!-- End Title -->
                <form class="js-validate" novalidate="novalidate" method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="signinSrEmailExample3">Phone Number or Email address
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="email" id="signinSrEmailExample3" placeholder="Phone Number or Email address" aria-label="Username or Email address" data-msg="Please enter a valid credentials." data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="signinSrPasswordExample2">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="signinSrPasswordExample2" placeholder="Password" aria-label="Password" data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Checkbox -->

                    <!-- End Checkbox -->

                    <!-- Button -->
                    <div class="mb-1">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary-dark-w px-5">Login</button>
                        </div>
                        <div class="mb-2">
                            <!-- <a class="text-blue" href="#">Lost your password?</a> -->
                        </div>
                    </div>
                    <!-- End Button -->
                </form>
            </div>
            <div class="col-md-1 d-none d-md-block">
                <div class="flex-content-center h-100">
                    <div class="width-1 bg-1 h-100"></div>
                    <div class="width-50 height-50 border border-color-1 rounded-circle flex-content-center font-italic bg-white position-absolute">or</div>
                </div>
            </div>
            <div class="col-md-5 ml-md-auto ml-xl-0 mr-xl-auto">
                <!-- Title -->
                <div class="border-bottom border-color-1 mb-6">
                    <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Register</h3>
                </div>
                <p class="text-gray-90 mb-4">Create new account today to reap the benefits of a personalized shopping experience.</p>
                <!-- End Title -->
                <!-- Form Group -->
                <form class="js-validate" novalidate="novalidate" method="POST" action="{{ route('my-account-register') }}">
                    @csrf
                    <div class="js-form-message form-group mb-5">
                        <label class="form-label" for="RegisterSrEmailExample3">Full Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="name" id="RegisterSrEmailExample3" placeholder="Full name" aria-label="Email address" data-msg="Please enter a full name." data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="js-form-message form-group mb-5">
                        <label class="form-label" for="RegisterSrEmailExample3">Email address
                            <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control" name="email" id="RegisterSrEmailExample3" placeholder="Email address or Phone number" aria-label="Email address" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="js-form-message form-group mb-5">
                        <label class="form-label" for="RegisterSrEmailExample3">Phone Number
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="phone" id="RegisterSrEmailExample3" placeholder="Phone number" aria-label="Email address" data-msg="Please enter a phone number." data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="js-form-message form-group">
                        <label class="form-label" for="signinSrPasswordExample2">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="signinSrPasswordExample2" placeholder="Password" aria-label="Password" data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                    <!-- Button -->
                    <div class="mb-6">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary-dark-w px-5">Register</button>
                        </div>
                    </div>
                    <!-- End Button -->
                </form>
                <h3 class="font-size-18 mb-3">Sign up today and you will be able to :</h3>
                <ul class="list-group list-group-borderless">
                    <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Speed your way through checkout</li>
                    <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Track your orders easily</li>
                    <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Keep a record of all your purchases</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection