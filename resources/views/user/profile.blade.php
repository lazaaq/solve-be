@extends('layouts.app')
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Profile info -->
    <!-- User thumbnail -->
    <div class="thumbnail">
        <img class="img-circle" width="10%" src="{{asset('img/kabuto.jpg')}}" alt="" style="padding-top:15px">
        <div class="caption text-center">
            <h6 class="text-semibold no-margin">Hanna Dorman <small class="display-block">{{ucfirst($data->roles[0]['name'])}}</small></h6> 
        </div>
    </div>
    <!-- /user thumbnail -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Profile information</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <form action="#">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" value="{{$data->name}}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Username</label>
                            <input type="text" value="{{$data->username}}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="text" value="{{$data->email}}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="display-block">Upload profile image</label>
                            <input type="file" class="file-styled">
                            <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /profile info -->

    <!-- Account settings -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Account settings</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <form action="#">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>New password</label>
                            <input type="password" placeholder="Enter new password" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Repeat password</label>
                            <input type="password" placeholder="Repeat new password" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /account settings -->
</div>
<!-- /content area -->
@endsection