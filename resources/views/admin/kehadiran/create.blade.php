@extends('layouts.base')

@section('css')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('bower_components/select2/dist/css/select2.min.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('dist/css/AdminLTE.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Kehadiran
    <small>kehadiran peserta posyandu</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kehadiran</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="panel panel-default">
	<div class="panel-heading">Masukkan Data Kehadiran</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="post" action="{{ route('kehadiran.store') }}">
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
												<option value="{{ $datas->id_anak }}">{{ $datas->nama_anak }} | {{ $datas->nama_ibu }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id_kegiatan">Nama Kegiatan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-check-circle-o"></i></span>
										<select class="form-control select2" name="id_kegiatan" style="width: 100%;" required>
											<option selected="selected" value="">-- Nama Kegiatan --</option>
											@foreach($data2 as $datas2)
												<option value="{{ $datas2->id_kegiatan }}">{{ $datas2->kegiatan }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="form-group form-inline">
							<div class="row">
								<label class="col-md-4 control-label" for="alamat2">Berat dan Tinggi Badan</label>
								<div class="input-group col-md-8">
									<div class="input-group" style="padding-right: 6px;">
										<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
										<input type="text" class="form-control" placeholder="Berat Badan" name="berat_badan" required>
										<span class="input-group-addon">Kg</span>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-long-arrow-up"></i></span>
										<input type="text" class="form-control" placeholder="Tinggi Badan" name="tinggi_badan" required>
										<span class="input-group-addon">cm</span>
									</div>
									<br/>
									<p style="color: grey">Note : Gunakan (.) sebagai pengganti (,)</p>
								</div>
							</div>
						</div> -->
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="alasan">Alasan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-check-circle-o"></i></span>
										<select class="form-control" name="alasan" style="width: 100%;" required>
											<option selected="selected" value="">-- Alasan Tidak Hadir --</option>
											<option value="Ketiduran">Ketiduran</option>
											<option value="Pergi">Pergi</option>
											<option value="Sakit">Sakit</option>
											<option value="Lupa">Lupa</option>
											<option value="other">DLL</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="tgl_kunjungan">Tanggal Kunjungan</label>
								<div class="input-group col-md-8">
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control" id="datepicker" placeholder="Tanggal Kunjungan" name="tgl_kunjungan" required autocomplete="off">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="ket_hadir">Keterangan</label>
								<div class="input-group col-md-8">
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-pencil"></i>
										</div>
										<textarea class="form-control" rows="3" placeholder="Enter ..." name="ket_hadir"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
									<a href="{{ route('kehadiran.index') }}" class="btn btn-danger">Batal</a>
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
<script>
	$(function () {
		// Date Picker
		$('#datepicker').datepicker({
			format: 'yyyy/mm/dd',
			autoclose: true
		})
		//Initialize Select2 Elements
		$('.select2').select2();
		$("select").imagepicker();
	})
</script>
@endsection