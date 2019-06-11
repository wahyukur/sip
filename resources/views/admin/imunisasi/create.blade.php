@extends('layouts.base')

@section('css')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('bower_components/select2/dist/css/select2.min.css') !!}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{!! asset('plugins/iCheck/all.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('dist/css/AdminLTE.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Imunisai
    <small>pemberian imunisasi anak</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Imunisasi</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="panel panel-default">
	<div class="panel-heading">Masukkan Data Imunisasi</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="post" action="{{ route('imunisasi.store') }}">
						@csrf
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id_anak">Nama Anak</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child"></i></span>
										<select class="form-control select2" name="id_anak" style="width: 100%;" required>
											<option selected="selected" value="">-- Nama Anak --</option>
											@foreach($data as $datas)
												<option value="{{ $datas->id_anak }}">{{ $datas->nama_anak }} - {{ $datas->nama_ibu }} & {{ $datas->nama_suami }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id_j_imun">Nama Imunisasi</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child"></i></span>
										<select class="form-control select2" name="id_j_imun" style="width: 100%;" required>
											<option selected="selected" value="">-- Nama Imunisasi --</option>
											@foreach($data2 as $datas2)
												<option value="{{ $datas2->id_j_imun }}">{{ $datas2->nama_imun }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div> -->
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id_j_imun">Nama Imunisasi</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child"></i></span>
										<select class="form-control select2" name="id_j_imun[]" multiple="multiple" data-placeholder="Nama Imunisasi" style="max-width: 100%">
					                        @foreach($data2 as $datas2)
												<option value="{{ $datas2->id_j_imun }}">{{ $datas2->nama_imun }}</option>
											@endforeach
						                </select>
									</div>
									<p style="color: grey">Note : Dapat isi lebih dari satu</p>
								</div>
							</div>
						</div>
						<div class="form-group form-inline">
							<div class="row">
								<label class="col-md-4 control-label" for="tgl_imun">Tanggal Imunisasi</label>
								<div class="input-group col-md-8">
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Imunisasi" name="tgl_imun" required autocomplete="off">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="booster">Booster</label>
								<div class="input-group col-md-8">
									<div class="form-check-inline">
										<label class="form-check-label" style="padding: 6px 10px 0px 0px;">
											<input type="radio" name="booster" class="form-check-input minimal" value="Ya" required> Ya
										</label>
										<label class="form-check-label">
											<input type="radio" name="booster" class="form-check-input minimal" value="Tidak" required> Tidak
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="ket_imun">Keterangan</label>
								<div class="input-group col-md-8">
									<textarea class="form-control" rows="4" id="keterangan" name="ket_imun"></textarea>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
									<a href="{{ route('imunisasi.index') }}" class="btn btn-danger">Batal</a>
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