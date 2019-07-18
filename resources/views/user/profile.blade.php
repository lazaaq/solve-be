@extends('layouts.app')
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Profile info -->
    <!-- User thumbnail -->
    <div class="thumbnail">
        @if($data->picture == 'avatar.png')
        <img class="img-circle" src="{{asset('img/avatar.png')}}" alt="Avatar" title="Change the avatar" width="100" height="50" style="padding-top:15px;">
        @else
        <img class="img-circle" src="{{route('user.picture',$data->id)}}" alt="Avatar" title="Change the avatar" width="100" height="50" style="padding-top:15px;">
        @endif
        <div class="caption text-center">
            <h6 class="text-semibold no-margin">{{$data->name}} <small class="display-block">{{ucfirst($data->roles[0]['name'])}}</small></h6> 
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
            <form action="{{route('user.updateProfil',$data->id)}}" method="post" enctype="multipart/form-data" files=true>
                @method('PUT')
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" value="{{$data->name}}" class="form-control">
                            @if ($errors->has('name'))
                            <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('name') }}</strong>
                            </label>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>Username</label>
                            <input type="text" name="username" value="{{$data->username}}" class="form-control">
                            @if ($errors->has('username'))
                            <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('username') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" value="{{$data->email}}" class="form-control">
                            @if ($errors->has('email'))
                            <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('email') }}</strong>
                            </label>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="display-block">Upload profile image</label>
                            <input type="file" name="picture" class="file-styled">
                            @if ($errors->has('picture'))
                            <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('picture') }}</strong>
                            </label>
                            @endif
                            <span class="help-block">Accepted formats: png, jpg, jpeg. Max file size 2Mb</span>
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
            <form action="{{route('user.updatePassword',$data->id)}}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>New password</label>
                            <input type="password" name="password" placeholder="Enter new password" class="form-control">
                            @if ($errors->has('password'))
                            <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i>{{ $errors->first('password') }}</strong>
                            </label>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label>Repeat password</label>
                            <input type="password" name="password_confirmation" placeholder="Repeat new password" class="form-control">
                            @if ($errors->has('password_confirmation'))
                            <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i>{{ $errors->first('password_confirmation') }}</strong>
                            </label>
                            @endif
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