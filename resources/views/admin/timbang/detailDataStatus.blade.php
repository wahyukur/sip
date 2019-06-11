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
				<p class="text-muted text-center">{{ $data->tgl_timbang }}</p>
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
            	<li class="active"><a href="#detail" data-toggle="tab">Detail Data</a></li>
            </ul>
            <div class="tab-content">
            	<div class="tab-pane active" id="detail">
            		<div class="row">
            			<div class="col-md-3"></div>
            			<div class="col-md-6">
            				<div class="table-responsive">
							  	<table class="table">
							  		<!-- <tr>
						        		<th>Kasus</th>
						        		<th> : </th>
						        		<td>
						        			@if($data->kasus != null)
						        				@if ($data->kasus == 1)
		                                            Baru
		                                        @else
		                                            Lama
		                                        @endif
						        			@else
						        				Kosong
						        			@endif
						        		</td>
						      		</tr> -->
						      		<tr>
						        		<th>Gizi Buruk Klinis</th>
						        		<th> : </th>
						        		<td>
						        			@if($data->gibur_klinis != null)
						        				{{$data->gibur_klinis}}
						        			@else
						        				Kosong
						        			@endif
						        		</td>
						      		</tr>
						      		<tr>
						      			<th>Status Gizi (BB/TB)</th>
						      			<th> : </th>
						        		<td>
						        			@if($data->st_gizi_bbtb != null)
						        				{{$data->st_gizi_bbtb}}
						        			@else
						        				Kosong
						        			@endif
						        		</td>
						      		</tr>
						      		<tr>
						      			<th>Berat dan Tinggi Badan</th>
						      			<th> : </th>
						        		<td>
						        			@if($data->penanganan != null)
						        				{{$data->penanganan}}
						        			@else
						        				Kosong
						        			@endif
						        		</td>
						      		</tr>
						      		<tr>
						      			<th>Penyebab Utama</th>
						      			<th> : </th>
						        		<td>
						        			@if($data->penyebab_utama != null)
						        				{{$data->penyebab_utama}}
						        			@else
						        				Kosong
						        			@endif
						        		</td>
						      		</tr>
						      		<tr>
						      			<th>Alasan Gibur</th>
						      			<th> : </th>
						        		<td>
						        			@if($data->alasan_gibur != null)
						        				{{$data->alasan_gibur}}
						        			@else
						        				Kosong
						        			@endif
						        		</td>
						      		</tr>
						      		<tr>
						      			<th>Hasil Tindakan</th>
						      			<th> : </th>
						        		<td>
						        			@if($data->tindakan != null)
						        				{{$data->tindakan}}
						        			@else
						        				Kosong
						        			@endif
						        		</td>
						      		</tr>
							  	</table>
							</div>
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
@endsection