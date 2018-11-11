@extends('layouts.base')

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('bower_components/select2/dist/css/select2.min.css') !!}">
<!-- Image Picker -->
<link rel="stylesheet" href="{!! asset('bower_components/image-picker/image-picker/image-picker.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('dist/css/AdminLTE.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Kegiatan Posyandu
    <small>kelola data kegiatan posyandu</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kegiatan</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="panel panel-default">
	<div class="panel-heading">Masukkan Data Kegiatan</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="post" action="{{ route('kegiatan.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id_agenda">Nama Kegiatan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child"></i></span>
										<select class="form-control select2" name="id_agenda" style="width: 100%;" required>
											<option selected="selected" value="">-- Nama Kegiatan --</option>
											@foreach($data as $datas)
												<option value="{{ $datas->id_agenda }}">{{ $datas->kegiatan }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id_tamu">Nama Tamu</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
										<select class="form-control select2" name="id_tamu" style="width: 100%;" required>
											<option selected="selected" value="">-- Nama Tamu --</option>
											@foreach($data2 as $datas2)
												<option value="{{ $datas2->id_tamu }}">{{ $datas2->nama_tamu }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id_ukm">Nama UKM</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
										<select class="form-control select2" name="id_ukm" style="width: 100%;" required>
											<option selected="selected" value="">-- Nama UKM --</option>
											@foreach($data5 as $datas5)
												<option value="{{ $datas5->id_ukm }}">{{ $datas5->nama_ukm }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id_pkk">Nama Ketua PKK</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
										<select class="form-control select2" name="id_pkk" style="width: 100%;" required>
											<option selected="selected" value="">-- Nama Ketua PKK --</option>
											@foreach($data4 as $datas4)
												<option value="{{ $datas4->id_pkk }}">{{ $datas4->nama_ketua }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="gambar_kegiatan1">Gambar Kegiatan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<div class="row">
											<div class="col-md-6">
												<img src="{!! asset('dist/img/placehold.jpg') !!}" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												<input type="file" id="inputgambar" class="form-control validate" name="gambar_kegiatan1">
											</div>
											<div class="col-md-6">
												<img src="{!! asset('dist/img/placehold.jpg') !!}" id="showgambar1" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												<input type="file" id="inputgambar1" class="form-control validate" name="gambar_kegiatan2">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="pmt1">Gambar PMT</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<div class="row">
											<div class="col-md-6">
												<img src="{!! asset('dist/img/placehold.jpg') !!}" id="showgambar2" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												<input type="file" id="inputgambar2" class="form-control validate" name="pmt1">
											</div>
											<div class="col-md-6">
												<img src="{!! asset('dist/img/placehold.jpg') !!}" id="showgambar3" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												<input type="file" id="inputgambar3" class="form-control validate" name="pmt2">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="gambar_kegiatan1">Gambar Kegiatan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<div class="row">
											<div class="col-md-6">
												<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal">Pilih Gambar</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
									<a href="{{ route('kegiatan.index') }}" class="btn btn-danger">Batal</a>
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

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-2">
						<ul class="nav nav-pills nav-stacked">
						    <li class="active"><a data-toggle="pill" href="#home">Pilh Gambar</a></li>
						    <li><a data-toggle="pill" href="#menu1">Upload</a></li>
						</ul>
					</div>
					<div class="col-sm-10">
						<div class="row">
							<div class="col-md-9">
								<div class="input-group" style="width: 300px">
					                <input type="text" class="form-control" name="x" placeholder="Search image...">
					                <span class="input-group-btn">
					                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
					                </span>
					            </div>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
							</div>
						</div>
						<!-- tab content -->
						<div class="tab-content">
							<div id="home" class="tab-pane fade in active">
								<div class="row">
									<div class="col-md-12" style="padding-top: 20px">
										@foreach($data3 as $datas3)
										<select class="image-picker show-labels show-html" data-limit="2" multiple="multiple">
										  	<option data-img-src="{!! asset('$datas3->image') !!}" value="{{ $datas3->id }}">{{ $datas3->title }}-{{ $datas3->image }}</option>
										</select>
										@endforeach
									</div>
								</div>
							</div>
							<div id="menu1" class="tab-pane fade">
								<h3>Menu 1</h3>
								<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('java')
<!-- Select2 -->
<script src="{!! asset('bower_components/select2/dist/js/select2.full.min.js') !!}"></script>
<!-- Image Picker -->
<script src="{!! asset('bower_components/image-picker/image-picker/image-picker.js') !!}"></script>
<script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2();
		$("select").imagepicker();
	})
</script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#showgambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputgambar").change(function () {
        readURL(this);
    });
</script>
<script type="text/javascript">
	function readURL1(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#showgambar1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputgambar1").change(function () {
        readURL1(this);
    });
</script>
<script type="text/javascript">
	function readURL2(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#showgambar2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputgambar2").change(function () {
        readURL2(this);
    });
</script>
<script type="text/javascript">
	function readURL3(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#showgambar3').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputgambar3").change(function () {
        readURL3(this);
    });
</script>
@endsection