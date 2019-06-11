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
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Login Gagal!</h4>
        </div>
    @endif
    <div class="login-box-body">
        <p class="login-box-msg" style="font-size: 30px">Masuk</p>
        <form action="{{ route('postlogin') }}" aria-label="{{ __('Login') }}" method="post">
            @csrf
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
            <p style="text-align: center;">- Atau -</p>
            <a href="{{ route('resetPassword') }}">Lupa Password ?</a><br>
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