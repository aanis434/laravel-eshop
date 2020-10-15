@extends('layouts.admin')
@section('content')


<form method="POST" action="{{ route("admin.settings.store") }}" enctype="multipart/form-data">
    @csrf

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-5">

                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Site Information</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Website Name </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Your Name" value="{{ $settings['name'] ?? '' }}">
                        </div>
                        <div class="box-body">
                            <div class="col-md-6">
                                <label for="resume">Logo</label>
                                <input type="file" name="logo" id="logo" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <a href="{{ asset('/storage/personal_photo/'.config('settings.photo')) }}" target="_blank"> <img src="{{ asset( $settings['logo'] ?? '' ) }}" width="60px" /> </a>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

            </div>

            <div class="col-md-5">
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Social Media</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="url" name="facebook" id="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}" placeholder="Facebook Profile Link">
                        </div>
                        <div class="form-group">
                            <label for="linkedin">Linkedin</label>
                            <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ $settings['linkedin'] ?? '' }}" placeholder="Enter Linkedin Profile Url">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="url" name="twitter" id="twitter" class="form-control" value="{{ $settings['twitter'] ?? '' }}" placeholder="Enter twitter Profile Url">
                        </div>
                        <div class="form-group">
                            <label for="google">Gamil</label>
                            <input type="url" name="gmail" id="gmail" class="form-control" value="{{ $settings['gmail'] ?? '' }}" placeholder="Enter gmail account">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>


                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contacts</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $settings['phone'] ?? '' }}" placeholder="Enter Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="alternative_phone">Alternative Phone</label>
                            <input type="text" name="alternative_phone" id="alternative_phone" class="form-control" value="{{ $settings['alternative_phone'] ?? '' }}" placeholder="Enter Alternative Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $settings['email'] ?? '' }}" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $settings['address'] ?? '' }}" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ $settings['city'] ?? '' }}" placeholder="Enter City">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" class="form-control" value="{{ $settings['country'] ?? '' }}" placeholder="Enter country">
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

            </div>

            <input type="submit" value="Save" class="btn btn-danger ml-3 mb-5">
        </div>
    </div>
</form>
@stop