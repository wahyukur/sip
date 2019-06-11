@extends('layouts.base')

@section('css')

@endsection

@section('breadcrumb')
<h1>
    Laporan
    <small>melihat dan mencetak laporan</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laporan</li>
</ol>
@endsection

@section('content')
@include('notification')
<div class="panel panel-default">
	<div class="panel-heading">Masukkan Data Laporan Yang Akan Di Cetak</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="post" action="{{ route('laporan.store') }}">
						@csrf
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="form">Cetak File</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child"></i></span>
										<select class="form-control select2" name="form" style="width: 100%;" required>
											<option selected="selected" value="">-- Pilihan Cetak --</option>
											<option value="form1">Form 1 - Laporan Bulanan Pelayanan Gizi</option>
											<option value="form2">Form 2 - Data Balita Tidak Hadir</option>
											<option value="form3">Form 3 - Balita Gizi Buruk</option>
											<option value="form4">Form 4 - Balita 2T dan BGM</option>
											<option value="form5">Form 5 - Balita Gizi Lebih</option>
											<option value="form6">Form 6 - Pemberian Vitamin A</option>
											<option value="form7">Form 7 - Dokumentasi Kegiatan</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="tahun">Tahun</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-o"></i></span>
										<select class="form-control select2" name="tahun" style="width: 100%;" required>
											<option selected="selected" value="">-- Pilih Tahun --</option>
											@foreach($get_bln as $datas)
												<option value="{{ $datas->year }}">{{ $datas->year }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="bulan">Bulan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-home"></i></span>
										<select class="form-control select2" name="bulan" style="width: 100%;" required>
											<option selected="selected" value="">-- Pilih Bulan --</option>
											@foreach($data as $datas)
												@php
												$F = date("F", strtotime($datas->start))
												@endphp
												<option value="{{ $F }}">{{ $F }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Submit</button>
									<!-- <a href="{{ route('form1') }}" target="_blank" class="btn btn-danger">Form 1</a>
									<a href="{{ route('form2') }}" target="_blank" class="btn btn-danger">Form 2</a>
									<a href="{{ route('form3') }}" target="_blank" class="btn btn-danger">Form 3</a>
									<a href="{{ route('form4') }}" target="_blank" class="btn btn-danger">Form 4</a>
									<a href="{{ route('form5') }}" target="_blank" class="btn btn-danger">Form 5</a>
									<a href="{{ route('form6') }}" target="_blank" class="btn btn-danger">Form 6</a>
									<a href="{{ route('form7') }}" target="_blank" class="btn btn-danger">Form 7</a> -->
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

@endsection