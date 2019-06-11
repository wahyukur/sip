@extends('layouts.base')

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('bower_components/select2/dist/css/select2.min.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('dist/css/AdminLTE.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Pengguna Aplikasi
    <small>kelola data pengguna</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Pengguna Aplikasi</li>
</ol>
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Tambah Data User</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="POST" action="{{ route('pengguna.store') }}">
						@csrf
						<!-- <input name="_method" type="hidden" value="PATCH" /> -->
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id">Nama Ibu</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
										<select class="form-control select2" name="id" style="width: 100%;" required>
											<option selected="selected" value="">-- Nama Ibu --</option>
											@foreach($data as $datas)
												<option value="{{ $datas->id }}">{{ $datas->nama_ibu }} - {{ $datas->nama_suami }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="email">Email</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
										<input type="text" class="form-control" placeholder="Email" name="email" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="level">Level</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
										<select class="form-control" name="level" style="width: 100%;">
											<option selected="selected" value="">-- Level --</option>
											<option value="0">User Ibu</option>
											<option value="1">Admin</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
									<a href="{{ route('pengguna.index') }}" class="btn btn-danger">Batal</a>
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
<!-- Select2 -->
<script src="{!! asset('bower_components/select2/dist/js/select2.full.min.js') !!}"></script>
<script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2()
	})
</script>
@endsection