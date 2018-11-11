@extends('layouts.base')

@section('css')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Kader Posyandu
    <small>kelola data kader</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Data Kader Posyandu</li>
</ol>
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Masukkan Data Kader</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="post" action="{{ route('kader.store') }}">
						@csrf
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_ibu">Nama Kader</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-venus"></i></span>
										<input type="text" class="form-control" placeholder="Nama Kader" name="nama_kader" required>
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
										<input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_anak">Jabatan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<select class="form-control" name="jabatan" style="width: 100%;">
											<option selected="selected" value="">-- Jabatan --</option>
											<option value="Ketua">Ketua</option>
											<option value="Sekretaris">Sekretaris</option>
											<option value="Bendahara">Bendahara</option>
											<option value="Anggota">Anggota</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="notelp">Nomor Telpon</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
										<input type="number" class="form-control" placeholder="Nomor Telpon" name="no_telp" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
									<a href="{{ route('kader.index') }}" class="btn btn-danger">Batal</a>
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