@extends('layouts.base')

@section('css')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{!! asset('plugins/iCheck/all.css') !!}">
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('bower_components/select2/dist/css/select2.min.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('dist/css/AdminLTE.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Anak
    <small>kelola data anak</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Data Anak</li>
</ol>
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Masukkan Data Anak</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="post" action="{{ route('anak.store') }}">
						@csrf
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_anak">Nama Anak</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child fa-fw" aria-hidden="true"></i></span>
										<input type="text" class="form-control" placeholder="Nama Anak" name="nama_anak" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_anak">Nama Orang Tua</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-venus-mars fa-fw"></i></span>
										<select class="form-control select2" name="id_ibu" style="width: 100%;" required>
											<option selected="selected" value="">-- Orang Tua --</option>
											@foreach($data as $datas)
												<option value="{{ $datas->id }}">{{ $datas->nama_ibu }} - {{ $datas->nama_suami }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group form-inline">
							<div class="row">
								<label class="col-md-4 control-label" for="ttl">Tempat, Tanggal Lahir</label>
								<div class="input-group col-md-8">
									<div class="input-group" style="padding-right: 6px;">
										<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
										<input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lhr" required>
									</div>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar fa-fw"></i>
										</div>
										<input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Lahir" name="tgl_lhr" required autocomplete="off">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group form-inline">
							<div class="row">
								<label class="col-md-4 control-label" for="alamat2">Berat dan Tinggi Badan</label>
								<div class="input-group col-md-8">
									<div class="input-group" style="padding-right: 6px;">
										<span class="input-group-addon"><i class="fa fa-balance-scale fa-fw"></i></span>
										<input type="text" class="form-control" placeholder="Berat Badan Lahir" name="bb_lahir" required>
										<span class="input-group-addon">Kg</span>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-long-arrow-up fa-fw"></i></span>
										<input type="text" class="form-control" placeholder="Tinggi Badan Lahir" name="tb_lahir" required>
										<span class="input-group-addon">cm</span>
									</div>
									<br/>
									<p style="color: grey">Note : Gunakan (.) sebagai pengganti (,)</p>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_anak">Jenis Kelamin</label>
								<div class="input-group col-md-8">
									<div class="form-check-inline">
										<label class="form-check-label" style="padding: 6px 10px 0px 0px;">
											<input type="radio" name="jenis_kelamin" class="form-check-input minimal" value="0" required> Laki-Laki
										</label>
										<label class="form-check-label">
											<input type="radio" name="jenis_kelamin" class="form-check-input minimal" value="1" required> Perempuan
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_anak">Anak Ke-</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-list-ol fa-fw"></i></span>
										<input type="number" class="form-control" placeholder="Anak Ke-" name="anak_ke" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group form-inline">
							<div class="row">
								<label class="col-md-4 control-label" for="alamat2">Bersalin</label>
								<div class="input-group col-md-8">
									<div class="input-group" style="padding-right: 6px;">
										<span class="input-group-addon"><i class="fa fa-hotel fa-fw"></i></span>
										<input type="text" class="form-control" placeholder="Jenis Persalinan" name="jenis_persalinan" required>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-hospital-o fa-fw"></i></span>
										<input type="text" class="form-control" placeholder="Tempat Bersalin" name="tempat_persalinan" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_anak">Dokter/Bidan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-md fa-fw"></i></span>
										<input type="text" class="form-control" placeholder="Dokter/Bidan Pembantu" name="dokter" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nik">NIK</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></span>
										<input type="number" class="form-control" placeholder="NIK" name="NIK_anak">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="BPJS_anak">Nomor BPJS <small>(bila ada)</small></label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></span>
										<input type="number" class="form-control" placeholder="Nomor BPJS (bila ada)" name="BPJS_anak">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
									<a href="{{ route('anak.index') }}" class="btn btn-danger">Batal</a>
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