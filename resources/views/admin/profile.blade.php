@extends('layouts.base')

@section('breadcrumb')
<h1>
    Profile
    <small></small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Profile</li>
</ol>
@endsection

@section('css')

@endsection

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ $message }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">Edit Profile</div>
    <div class="panel-body">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <form class="form-horizontal" method="post" action="{{ route('postProfile') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-4 control-label" for="email">Email</label>
                                <div class="input-group col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" placeholder="Email" name="email" required value="{{Auth::user()->email}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-4 control-label" for="oldPassword">Password Lama</label>
                                <div class="input-group col-md-8">
                                    <div class="input-group" style="">
                                        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" placeholder="Password Lama" name="oldPassword" id="oldPassword">

                                        <span class="input-group-addon show-password"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span class="input-group-addon hide-password" style="display: none;"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                    </div>
                                    @if ($message = Session::get('pwdLama'))
                                        <div>
                                            <p style="color: red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $message }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-4 control-label" for="newPassword">Password Baru</label>
                                <div class="input-group col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" placeholder="Password Baru" name="newPassword" id="newPassword">
                                        
                                        <span class="input-group-addon show-password"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span class="input-group-addon hide-password" style="display: none;"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                    </div>
                                    @if ($message = Session::get('pwdBaru'))
                                        <div>
                                            <p style="color: red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $message }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-4 control-label" for="confirmPassword">Konfirmasi Password</label>
                                <div class="input-group col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" placeholder="Konfirmasi Password" name="confirmPassword" id="confirmPassword">
                                        
                                        <span class="input-group-addon show-password"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span class="input-group-addon hide-password" style="display: none;"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                    </div>
                                    @if ($message = Session::get('pwdConf'))
                                        <div>
                                            <p style="color: red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $message }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-4 control-label" for="name"></label>
                                <div class="input-group col-md-8">
                                    <button type="submit" class="btn btn-primary" style="margin-right: 6px;">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('java')
<script>
    $(document).ready(function() {
        $(".show-password, .hide-password").on('click', function() {
            var passwordId = $(this).parents('div:first').find('input').attr('id');
            if ($(this).hasClass('show-password')) {
                $("#" + passwordId).attr("type", "text");
                $(this).parent().find(".show-password").hide();
                $(this).parent().find(".hide-password").show();
            } else {
                $("#" + passwordId).attr("type", "password");
                $(this).parent().find(".hide-password").hide();
                $(this).parent().find(".show-password").show();
            }
        });
    });
</script>
@endsection