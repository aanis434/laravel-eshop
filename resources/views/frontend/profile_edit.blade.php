@extends('frontend.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
            <div class="mb-6 border border-width-2 border-color-3 borders-radius-6">
                @include('frontend.includes.my_account_sidebar')
            </div>
        </div>
        <div class="col-xl-7 col-wd-9gdot5">
            <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">My Account</h3>
            </div>
            <p class="text-gray-90 mb-4">Update Personal Information</p>

            <!--  -->
            <!-- End Title -->
            <form class="js-validate" novalidate="novalidate" method="POST" action='{{ route("my-account-profile-update",[$user->id]) }}'>
                @csrf
                <!-- Form Group -->
                <div class="js-form-message form-group">
                    <label class="form-label" for="signinSrEmailExample3">Full Name
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="name" id="signinSrEmailExample3" placeholder="Full Name" aria-label="Full Name" data-msg="Please enter a valid credentials." data-error-class="u-has-error" data-success-class="u-has-success" value="{{ $user->name }}">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <!-- <div class="js-form-message form-group">
                    <label class="form-label" for="signinSrEmailExample3">Phone Number
                        <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control" name="phone" id="signinSrEmailExample3" placeholder="Phone Number" aria-label="Phone Number" data-msg="Please enter a valid credentials." data-error-class="u-has-error" data-success-class="u-has-success" value="{{ $user->phone }}">
                    @error('phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="js-form-message form-group">
                    <label class="form-label" for="signinSrEmailExample3">Email address
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="email" id="signinSrEmailExample3" placeholder="Email address" aria-label="Username or Email address" data-msg="Please enter a valid credentials." data-error-class="u-has-error" data-success-class="u-has-success" value="{{ $user->email }}">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div> -->
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="js-form-message form-group">
                    <label class="form-label" for="signinSrPasswordExample2">Address <span class="text-danger">*</span></label>
                    <textarea name="address" id="" class="form-control" cols="30" rows="3">{{ $user->address }}</textarea>
                    @error('address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <!-- End Form Group -->

                <!-- Checkbox -->

                <!-- End Checkbox -->

                <!-- Button -->
                <div class="mb-1">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary-dark-w px-5">Update</button>
                    </div>
                    <div class="mb-2">
                        <!-- <a class="text-blue" href="#">Lost your password?</a> -->
                    </div>
                </div>
                <!-- End Button -->
            </form>
        </div>
    </div>
</div>
@endsection