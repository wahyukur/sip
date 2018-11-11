@extends('layouts.main')

@section('css')

@endsection

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
    <div class="login-box-body">
        <p class="login-box-msg" style="font-size: 30px">Masuk</p>
        <form action="{{ route('postlogin') }}" aria-label="{{ __('Login') }}" method="post">
            @csrf
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8"></div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <div class="social-auth-links">
            <p style="text-align: center;">- OR -</p>
            <a href="#">Lupa Password ?</a><br>
        </div>
        <!-- /.social-auth-links -->
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection

@section('java')
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
@endsection