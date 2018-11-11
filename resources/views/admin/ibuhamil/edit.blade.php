@extends('layouts.base')

@section('css')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Ibu Hamil
    <small>kelola data ibu hamil</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Data Ibu Hamil</li>
</ol>
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Edit Data Ibu</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					@foreach($data as $datas)
					<form class="form-horizontal" method="post" action="{{ route('ibuhamil.update', $datas->id_bumil) }}">
						@csrf
						<input name="_method" type="hidden" value="PATCH" />
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_bumil">Nama Ibu Hamil</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-venus"></i></span>
										<input type="text" class="form-control" placeholder="Nama Ibu Hamil" name="nama_bumil" value="{{ $datas->nama_bumil }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_suami">Nama Suami</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-mars"></i></span>
										<input type="text" class="form-control" placeholder="Nama Suami" name="nama_suami" value="{{ $datas->nama_suami }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="umur">Umur</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>
										<input type="number" class="form-control" placeholder="Umur" name="umur" value="{{ $datas->umur }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="alamat">Alamat</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-home"></i></span>
										<input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{ $datas->alamat }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group form-inline">
							<div class="row">
								<label class="col-md-4 control-label" for="bb">Berat Badan Sebelum dan Sesudah Hamil</label>
								<div class="input-group col-md-8">
									<div class="input-group" style="padding-right: 6px;">
										<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
										<input type="number" class="form-control" placeholder="Berat Badan Sebelum" name="bb_sebelum_hamil" value="{{ $datas->bb_sebelum_hamil }}" required>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
										<input type="number" class="form-control" placeholder="Berat Badan Sesudah" name="bb_sekarang" value="{{ $datas->bb_sekarang }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="tb_bumil">Tinggi Badan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-list-ol"></i></span>
										<input type="number" class="form-control" placeholder="Tinggi Badan" name="tb_bumil" value="{{ $datas->tb_bumil }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="hamil_ke">Hamil Ke</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child"></i></span>
										<input type="number" class="form-control" placeholder="Hamil Ke" name="hamil_ke" value="{{ $datas->hamil_ke }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="usia_kehamilan">Usia Kehamilan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input type="number" class="form-control" placeholder="Usia Kehamilan" name="usia_kehamilan" value="{{ $datas->usia_kehamilan }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="penyakit_penyerta">Penyakit Penyerta</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-thermometer-empty"></i></span>
										<input type="text" class="form-control" placeholder="Penyakit Penyerta" name="penyakit_penyerta" value="{{ $datas->penyakit_penyerta }}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="lila">Lila (Lingkar Lengan Atas)</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-list-ol"></i></span>
										<input type="number" class="form-control" placeholder="Lingkar Lengan Atas" name="lila" value="{{ $datas->lila }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="periksa_kehamilan">Periksa Kehamilan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
										<input type="text" class="form-control" placeholder="Periksa Kehamilan" name="periksa_kehamilan" value="{{ $datas->periksa_kehamilan }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Update</button>
									<a href="{{ route('ibuhamil.index') }}" class="btn btn-danger">Batal</a>
								</div>
							</div>
						</div>
					</form>
					@endforeach
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('java')
<!-- bootstrap datepicker -->
<script src="{!! asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>
<!-- Page script -->
<script>
	$(function () {
		// Date Picker
		$('#datepicker').datepicker({
			format: 'yyyy/mm/dd',
			autoclose: true
		})
	})
</script>
@endsection