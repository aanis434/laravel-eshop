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
                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">My Account</h3>
            </div>
            <table class="table table-striped" cellspacing="0">
                <tbody id="">
                    @php
                    $user = Auth::user();
                    @endphp
                    <tr>
                        <th>Full Name</th>
                        <td>{{ $user ? $user->name : '' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user ? $user->email : '' }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $user ? $user->phone : '' }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user->customer ? $user->customer->address : '' }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{ route('my-account-profile-edit', Auth::user()->id ) }}" type="button" class="btn btn-primary-dark-w mt-5 ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto">Change Personal Information</a>
            </div>
        </div>
    </div>
</div>
@endsection