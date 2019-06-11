@extends('layouts.main')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('login') }}">
            <div class="media">
                <div class="media-left">
                    <img src="{!! asset('dist/img/logo.png') !!}" class="media-object" style="width:75px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Sistem Informasi</h4>
                    <p>Posyandu Mandiri</p>
                </div>
            </div>
        </a>
    </div>
    <!-- /.login-logo -->
    @if ($errors->has('email'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Email Salah!</h4>
            <p>{{ $errors->first('email') }}</p>
        </div>
    @endif
    @if ($errors->has('password'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Password Salah!</h4>
            <p>{{ $errors->first('password') }}</p>
        </div>
    @endif
    <div class="login-box-body">
        <p class="login-box-msg" style="font-size: 30px">{{ __('Reset Password') }}</p>
        <form method="post" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
            @csrf
            <div class="form-group has-feedback">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ $email ?? old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <label for="password">{{ __('Password') }}</label>

                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <label for="password-confirm">Konfirmasi Password</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4" style="padding-top: 5px">
                    <a href="{{ route('login') }}">
                        <i class="fa fa-arrow-circle-o-left fa-lg" style="margin-right: 5px"></i> Login
                    </a>
                </div>
                <div class="col-xs-4"></div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Reset Password') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
