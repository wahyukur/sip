@extends('layouts.base')

@section('css')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{!! asset('plugins/iCheck/all.css') !!}">
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('bower_components/select2/dist/css/select2.min.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('dist/css/AdminLTE.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Timbang Anak
    <small>penimbangan anak</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Timbang Anak</li>
</ol>
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Edit Data Kegiatan</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="post" action="{{ route('kegiatan.update', $data5->id_kegiatan) }}" enctype="multipart/form-data">
						@csrf
						<input name="_method" type="hidden" value="PATCH" />
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="id_agenda">Nama Kegiatan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child"></i></span>
										<select class="form-control select2" name="id_agenda" style="width: 100%;" required>
											<option selected="selected" value="{{ $data5->id_agenda }}">{{ $data5->kegiatan }}</option>
											<option value="">-- Nama Kegiatan --</option>
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
											<option selected="selected" value="{{ $data5->id_tamu }}">{{ $data5->nama_tamu }}</option>
											<option value="">-- Nama Tamu --</option>
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
											<option selected="selected" value="{{ $data5->id_ukm }}">{{ $data5->nama_ukm }}</option>
											<option value="">-- Nama UKM --</option>
											@foreach($data3 as $datas3)
												<option value="{{ $datas3->id_ukm }}">{{ $datas3->nama_ukm }}</option>
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
											<option selected="selected" value="{{ $data5->id_pkk }}">{{ $data5->nama_ketua }}</option>
											<option value="">-- Nama Ketua PKK --</option>
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
												@if($data5->gambar_kegiatan1 == null)
												<img src="{!! asset('dist/img/placehold.jpg') !!}" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												@else
												<img src="{{ asset($data5->gambar_kegiatan1) }}" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												@endif
												<input type="file" id="inputgambar" class="form-control validate" name="gambar_kegiatan1">
											</div>
											<div class="col-md-6">
												@if($data5->gambar_kegiatan2 == null)
												<img src="{!! asset('dist/img/placehold.jpg') !!}" id="showgambar1" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												@else
												<img src="{{ asset($data5->gambar_kegiatan2) }}" id="showgambar1" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												@endif
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
												@if($data5->pmt1 == null)
												<img src="{!! asset('dist/img/placehold.jpg') !!}" id="showgambar2" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												@else
												<img src="{{ asset($data5->pmt1) }}" id="showgambar2" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												@endif
												<input type="file" id="inputgambar2" class="form-control validate" name="pmt1">
											</div>
											<div class="col-md-6">
												@if($data5->pmt2 == null)
												<img src="{!! asset('dist/img/placehold.jpg') !!}" id="showgambar3" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												@else
												<img src="{{ asset($data5->pmt2) }}" id="showgambar3" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
												@endif
												<input type="file" id="inputgambar3" class="form-control validate" name="pmt2">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
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
@endsection

@section('java')
<!-- Select2 -->
<script src="{!! asset('bower_components/select2/dist/js/select2.full.min.js') !!}"></script>
<script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2()
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