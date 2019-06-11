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
    Status Gizi Anak
    <small>data gizi buruk dan gizi lebih anak</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Status Gizi Anak</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-3">
		<!-- Profile Image -->
		<div class="box box-primary">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="{!! asset('dist/img/avatar2.png') !!}" alt="User profile picture">
				<h3 class="profile-username text-center">{{ $data->nama_anak }}</h3>
				<p class="text-muted text-center">
					@php
                        $date = date("d-m-Y", strtotime($data->tgl_timbang))
                    @endphp
					Tanggal Timbang : {{ $date }}
				</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Berat Badan</b> <a class="pull-right">{{ $data->berat_badan }} Kg</a>
					</li>
					<li class="list-group-item">
						<b>Tinggi Badan</b> <a class="pull-right">{{ $data->tinggi_badan }} cm</a>
					</li>
				</ul>
				<a href="{{ route('statusgizi.index') }}" class="btn btn-primary btn-block"><b>Kembali</b></a>
			</div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

    <div class="col-md-9">
    	<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            	<li class="active"><a href="#detail" data-toggle="tab">Masukkan Data</a></li>
            </ul>
            <div class="tab-content">
            	<div class="tab-pane active" id="detail">
            		<div class="row">
						<div class="col-md-9">
							<form class="form-horizontal" method="post" action="{{ route('statusgizi.update', $data->id_timbang) }}">
								@csrf
								<input name="_method" type="hidden" value="PATCH" />
								<div class="form-group">
									<div class="row">
										<label class="col-md-4 control-label" for="gibur_klinis">Gizi Buruk Klinik</label>
										<div class="input-group col-md-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
												<select class="form-control" name="gibur_klinis">
													@if($data->gibur_klinis == null)
														<option selected="selected" value="">--Pilih --</option>
													@else
														<option selected="selected" value="{{ $data->gibur_klinis }}">{{ $data->gibur_klinis }}</option>
														<option value="">--Pilih --</option>
													@endif
								                    <option value="MRS">MRS</option>
								                    <option value="KWS">KWS</option>
								                    <option value="MRS-KWS">MRS-KWS</option>
								                 </select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<label class="col-md-4 control-label" for="st_gizi_bbtb">Status Gizi (BB/TB)</label>
										<div class="input-group col-md-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
												<select class="form-control" name="st_gizi_bbtb">
													@if($data->st_gizi_bbtb == null)
														<option selected="selected" value="">--Pilih --</option>
													@else
														<option selected="selected" value="{{ $data->st_gizi_bbtb }}">{{ $data->st_gizi_bbtb }}</option>
														<option value="">--Pilih --</option>
													@endif
								                    <option value="Sangat Kurus">Sangat Kurus</option>
								                    <option value="Kurus">Kurus</option>
								                    <option value="Normal">Normal</option>
								                 </select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<label class="col-md-4 control-label" for="penanganan">Penanganan</label>
										<div class="input-group col-md-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
												<select class="form-control" id="dbType" name="penanganan">
													@if($data->penanganan == null)
														<option selected="selected" value="">--Pilih --</option>
													@else
														<option selected="selected" value="{{ $data->penanganan }}">{{ $data->penanganan }}</option>
														<option value="">--Pilih --</option>
													@endif
													<option value="PMT-FORMULA PUSKESMAS">PMT-FORMULA PUSKESMAS</option>
								                    <option value="other">Lainnya</option>
								                </select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group" id="otherServer">
									<div class="row">
										<label class="col-md-4 control-label" for="penanganan"></label>
										<div class="input-group col-md-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
												<input type="text" class="form-control" placeholder="Penanganan" name="penanganan1">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<label class="col-md-4 control-label" for="penyebab_utama">Penyebab Utama</label>
										<div class="input-group col-md-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
												<select class="form-control" id="penyebabType" name="penyebab_utama">
													@if($data->penyebab_utama == null)
														<option selected="selected" value="">--Pilih --</option>
													@else
														<option selected="selected" value="{{ $data->penyebab_utama }}">{{ $data->penyebab_utama }}</option>
														<option value="">--Pilih --</option>
													@endif
													<option value="BBLR (BB<=2500 gram)">BBLR (BB<=2500 gram)</option>
													<option value="SAKIT">SAKIT</option>
								                    <option value="KEMISKINAN">KEMISKINAN</option>
								                    <option value="PENGETAHUAN">PENGETAHUAN</option>
								                    <option value="other">Lainnya</option>
								                </select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group" id="otherPenyebab">
									<div class="row">
										<label class="col-md-4 control-label" for="penyebab_utama1"></label>
										<div class="input-group col-md-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
												<input type="text" class="form-control" placeholder="Penyebab Utama" name="penyebab_utama1">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<label class="col-md-4 control-label" for="alasan_gibur">Alasan Gibur</label>
										<div class="input-group col-md-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
												@if($data->alasan_gibur == null)
													<input type="text" class="form-control" placeholder="Alasan Gibur" name="alasan_gibur">
												@else
													<input type="text" class="form-control" placeholder="Alasan Gibur" name="alasan_gibur" value="{{ $data->alasan_gibur }}">
												@endif
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<label class="col-md-4 control-label" for="tindakan">Hasil Tindakan</label>
										<div class="input-group col-md-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
												<select class="form-control" name="tindakan">
													@if($data->tindakan == null)
														<option selected="selected" value="">--Pilih --</option>
													@else
														<option selected="selected" value="{{ $data->tindakan }}">{{ $data->tindakan }}</option>
														<option value="">--Pilih --</option>
													@endif
													<option value="DO">DO</option>
								                    <option value="S">S</option>
								                    <option value="M">M</option>
								                    <option value="PUSK">PUSK</option>
								                    <option value="RS">RS</option>
								                </select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<label class="col-md-4 control-label"></label>
										<div class="input-group col-md-8">
											<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
											<a href="{{ route('statusgizi.index') }}" class="btn btn-danger">Batal</a>
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
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
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
<!-- Page script -->
<script>
	$(function () {
		// Date Picker
		$('#datepicker').datepicker({
			format: 'yyyy/mm/dd',
			autoclose: true
		})
		//Initialize Select2 Elements
		$('.select2').select2()
	})
</script>
<script type="text/javascript">
	$(document).ready(function () {
		toggleFields();
		$("#dbType").change(function () {
			toggleFields();
		});
	});
	function toggleFields() {
		if ($("#dbType").val() === "other")
			$("#otherServer").show();
		else
			$("#otherServer").hide();
	}
</script>
<script type="text/javascript">
	$(document).ready(function () {
		toggleFields1();
		$("#penyebabType").change(function () {
			toggleFields1();
		});
	});
	function toggleFields1() {
		if ($("#penyebabType").val() === "other")
			$("#otherPenyebab").show();
		else
			$("#otherPenyebab").hide();
	}
</script>
@endsection