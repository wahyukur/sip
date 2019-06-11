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
            {{ $message }}
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $message }}
        </div>
    @endif
    <div class="login-box-body">
        <p class="login-box-msg" style="font-size: 30px">Reset Password</p>
        <form method="post" action="{{ route('postReset') }}">
            @csrf
            <div class="form-group has-feedback">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4" style="padding-top: 5px">
                    <a href="{{ route('login') }}">
                        <i class="fa fa-arrow-circle-o-left fa-lg" style="margin-right: 5px"></i> Kembali
                    </a>
                </div>
                <div class="col-xs-4"></div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Kirim</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection

@section('java')

@endsection