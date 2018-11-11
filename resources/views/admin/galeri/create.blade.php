@extends('layouts.base')

@section('css')

@endsection

@section('breadcrumb')
<h1>
    Galeri Posyandu
    <small>foto kegiatan posyandu</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Galeri</li>
</ol>
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Masukkan Foto</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<form class="form-horizontal" method="post" action="{{ route('storeImage') }}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="album_id" value="{{ $data->id_album }}">
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="title">Judul</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></span>
										<input type="text" class="form-control" placeholder="Judul Gambar" name="title" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="keterangan">Keterangan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></span>
										<input type="text" class="form-control" placeholder="Keterangan" name="description" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="image">Gambar</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<img src="{!! asset('dist/img/placehold.jpg') !!}" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;" />
										<input type="file" id="inputgambar" class="form-control validate" name="image" required multiple>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
									<a onclick="goBack()" class="btn btn-danger">Batal</a>
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
    function goBack() {
	    window.history.back();
	}
</script>
@endsection