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
<div class="row">
	<div class="col-md-12">
		<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	        	<li class="active"><a href="#activity" data-toggle="tab">Masukkan Data Kader</a></li>
	        	<li><a href="#choose" data-toggle="tab">Pilih Kader</a></li>
	        </ul>
	        <div class="tab-content">
	        	<div class="active tab-pane" id="activity">
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
													<span class="input-group-addon"><i class="fa fa-venus fa-fw"></i></span>
													<input type="text" class="form-control" placeholder="Nama Ibu" name="nama_ibu" required>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label" for="nama_suami">Nama Suami</label>
											<div class="input-group col-md-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-mars fa-fw"></i></span>
													<input type="text" class="form-control" placeholder="Nama Suami" name="nama_suami" required>
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
													<input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" required>
												</div>
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar fa-fw"></i>
													</div>
													<input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Lahir" name="tgl_lahir" required autocomplete="off">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group form-inline">
										<div class="row">
											<label class="col-md-4 control-label" for="alamat">Alamat</label>
											<div class="input-group col-md-8">
												<div class="input-group" style="padding-right: 6px;">
													<span class="input-group-addon"><i class="fa fa-address-card fa-fw"></i></span>
													<input type="text" class="form-control" placeholder="Alamat" value="Sumberejo 1" name="alamat" required>
												</div>
												<div class="input-group col-xs-2" style="padding-right: 6px;">
													<span class="input-group-addon"><i class="fa fa-circle-o-notch fa-fw"></i></span>
													<input type="number" class="form-control" placeholder="Rt" name="rt" required>
												</div>
												<div class="input-group col-xs-2">
													<span class="input-group-addon"><i class="fa fa-circle-o-notch fa-fw"></i></span>
													<input type="number" class="form-control" placeholder="Rw" name="rw" value="1" required>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group form-inline">
										<div class="row">
											<label class="col-md-4 control-label" for="alamat2"></label>
											<div class="input-group col-md-8">
												<div class="input-group" style="padding-right: 6px;">
													<span class="input-group-addon"><i class="fa fa-circle-o-notch fa-fw"></i></span>
													<input type="text" class="form-control" placeholder="Kelurahan" value="Sumberejo" name="kelurahan" required>
												</div>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-circle-o-notch fa-fw"></i></span>
													<input type="text" class="form-control" placeholder="Kecamatan" value="Pakal" name="kecamatan" required>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label" for="notelp">Nomor Telpon</label>
											<div class="input-group col-md-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-phone-square fa-fw"></i></span>
													<input type="number" class="form-control" placeholder="Nomor Telpon" name="No_tlp">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label" for="agama">Agama</label>
											<div class="input-group col-md-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user-secret fa-fw"></i></span>
													<select class="form-control" name="agama" style="width: 100%;" required>
														<option selected="selected" value="">-- Agama --</option>
														<option value="0">Islam</option>
														<option value="1">Kristen</option>
														<option value="2">Katolik</option>
														<option value="3">Hindu</option>
														<option value="4">Buddha</option>
														<option value="5">Kong Hu Cu</option>
													</select>
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
													<input type="number" class="form-control" placeholder="NIK" name="NIK" required>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label" for="no KK">Nomor KK</label>
											<div class="input-group col-md-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></span>
													<input type="number" class="form-control" placeholder="Nomor KK" name="No_KK" required>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label" for="No_BPJS">Nomor BPJS <small>(bila ada)</small></label>
											<div class="input-group col-md-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></span>
													<input type="number" class="form-control" placeholder="Nomor BPJS (bila ada)" name="No_BPJS">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label" for="gakin">Status Gakin</label>
											<div class="input-group col-md-8">
												<div class="form-check-inline">
													<label class="form-check-label" style="padding: 6px 10px 0px 0px;">
														<input type="radio" name="gakin" class="form-check-input minimal" value="0" required> Non Gakin
													</label>
													<label class="form-check-label">
														<input type="radio" name="gakin" class="form-check-input minimal" value="1" required> Gakin
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label" for="nama_anak">Jabatan Sebagai Kader</label>
											<div class="input-group col-md-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
													<select class="form-control" name="jabatan" style="width: 100%;" required>
														<option selected="selected" value="0">-- Jabatan --</option>
														<option value="1">Ketua</option>
														<option value="2">Sekretaris</option>
														<option value="3">Bendahara</option>
														<option value="4">Anggota</option>
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
												<a href="{{ route('kader.index') }}" class="btn btn-danger">Batal</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-3"></div>
						</div>
					</div>
	        		<!-- /.tab-pane -->
	        	</div>
	        	<div class="tab-pane" id="choose">
	    			<div class="container">
						<div class="row">
							<div class="col-md-9">
								<form class="form-horizontal" method="post" action="{{ route('kaderStore1') }}">
									@csrf
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label" for="id">Nama Ibu</label>
											<div class="input-group col-md-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-venus-mars fa-fw"></i></span>
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
											<label class="col-md-4 control-label" for="jabatan">Jabatan Sebagai Kader</label>
											<div class="input-group col-md-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
													<select class="form-control" name="jabatan" style="width: 100%;">
														<option selected="selected" value="">-- Jabatan --</option>
														<option value="1">Ketua</option>
														<option value="2">Sekretaris</option>
														<option value="3">Bendahara</option>
														<option value="4">Anggota</option>
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
	        	<!-- /.tab-pane -->
	        </div>
	        <!-- /.tab-content -->
	    </div>
	    <!-- /.nav-tabs-custom -->
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