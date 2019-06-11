@extends('layouts.base')

@section('css')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
<!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{!! asset('plugins/iCheck/all.css') !!}">
<!-- Select2 -->
  <link rel="stylesheet" href="{!! asset('bower_components/select2/dist/css/select2.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Jenis Imunisasi
    <small>kelola data jenis imunisasi</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Jenis Imunisasi</li>
</ol>
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Masukkan Data Jenis Imunisasi</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="post" action="{{ route('jenisimunisasi.store') }}">
						@csrf
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_imun">Nama Imunisasi</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-eyedropper" aria-hidden="true"></i></span>
										<input type="text" class="form-control" placeholder="Nama Imunisasi" name="nama_imun" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="umur">Umur</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
										<input type="number" class="form-control" placeholder="Umur" name="umur" required>
										<span class="input-group-addon"> Bulan</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
									<a href="{{ route('jenisimunisasi.index') }}" class="btn btn-danger">Batal</a>
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
<!-- Select2 -->
<script src="{!! asset('bower_components/select2/dist/js/select2.full.min.js') !!}"></script>
<!-- iCheck 1.0.1 -->
<script src="{!! asset('plugins/iCheck/icheck.min.js') !!}"></script>
<script>
	$(function () {
		// Date Picker
		$('#datepicker').datepicker({
			format: 'yyyy/mm/dd',
			autoclose: true
		})
		//Initialize Select2 Elements
		$('.select2').select2()
		//iCheck for checkbox and radio inputs
		$('input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass   : 'iradio_minimal-blue'
		})
	})
</script>
@endsection