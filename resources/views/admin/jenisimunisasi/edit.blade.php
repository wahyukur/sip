@extends('layouts.base')

@section('css')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
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
	<div class="panel-heading">Edit Data Jenis Imunisasi</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					@foreach($data as $datas)
					<form class="form-horizontal" method="post" action="{{ route('jenisimunisasi.update', $datas->id_j_imun) }}">
						@csrf
						<input name="_method" type="hidden" value="PATCH" />
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_imun">Nama Imunisasi</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-eyedropper" aria-hidden="true"></i></span>
										<input type="text" class="form-control" placeholder="Nama Imunisasi" name="nama_imun" value="{{ $datas->nama_imun }}" required>
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
										<input type="number" class="form-control" placeholder="Umur" name="umur" value="{{ $datas->umur }}" required>
										<span class="input-group-addon"> Bulan</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Update</button>
									<a href="{{ route('jenisimunisasi.index') }}" class="btn btn-danger">Batal</a>
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