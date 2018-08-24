@extends('layouts.base')

@section('css')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Edit Data Ibu</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					@foreach($data as $datas)
					<form class="form-horizontal" method="post" action="{{ route('anak.update', $datas->id_anak) }}">
						@csrf
						<input name="_method" type="hidden" value="PATCH" />
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_ibu">Nama Anak</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-child"></i></span>
										<input type="text" class="form-control" placeholder="Nama Ibu" name="nama_anak" value="{{ $datas->nama_anak }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_anak">Nama Orang Tua</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
										<select class="form-control" name="id_ibu" style="width: 100%;">
											<option selected="selected" value="{{ $datas->id_ibu }}">{{ $datas->nama_ibu }} - {{ $datas->nama_suami }}</option>
											<option value="">-- Orang Tua --</option>
											@foreach($data2 as $data2s)
												<option value="{{ $data2s->id_ibu }}">{{ $data2s->nama_ibu }} - {{ $data2s->nama_suami }}</option>
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
										<span class="input-group-addon"><i class="fa fa-home"></i></span>
										<input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lhr" value="{{ $datas->tempat_lhr }}" required>
									</div>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Lahir" name="tgl_lhr" value="{{ $datas->tgl_lhr }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group form-inline">
							<div class="row">
								<label class="col-md-4 control-label" for="alamat2">Berat dan Tinggi Badan</label>
								<div class="input-group col-md-8">
									<div class="input-group" style="padding-right: 6px;">
										<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
										<input type="text" class="form-control" placeholder="Berat Badan" name="bb_lahir" required value="{{ $datas->bb_lahir }}">
										<span class="input-group-addon">gr</span>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-long-arrow-up"></i></span>
										<input type="text" class="form-control" placeholder="Tinggi Badan" name="tb_lahir" required value="{{ $datas->tb_lahir }}">
										<span class="input-group-addon">cm</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_anak">Jenis Kelamin</label>
								<div class="input-group col-md-8">
									<div class="form-check-inline">
										<label class="form-check-label" style="padding: 6px 10px 0px 0px;">
											<input type="radio" name="jenis_kelamin" class="form-check-input minimal" value="Laki-Laki" checked="
											@if ($datas->jenis_kelamin == 'Laki-Laki')
												checked;
											@endif"> Laki-Laki
										</label>
										<label class="form-check-label">
											<input type="radio" name="jenis_kelamin" class="form-check-input minimal" value="Perempuan" checked="
											@if ($datas->jenis_kelamin == 'Perempuan')
												checked;
											@endif"> Perempuan
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
										<span class="input-group-addon"><i class="fa fa-list-ol"></i></span>
										<input type="number" class="form-control" placeholder="Anak Ke-" name="anak_ke" value="{{ $datas->anak_ke }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group form-inline">
							<div class="row">
								<label class="col-md-4 control-label" for="alamat2">Bersalin</label>
								<div class="input-group col-md-8">
									<div class="input-group" style="padding-right: 6px;">
										<span class="input-group-addon"><i class="fa fa-hotel"></i></span>
										<input type="text" class="form-control" placeholder="Persalinan" name="jenis_persalinan" value="{{ $datas->jenis_persalinan }}" required>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
										<input type="text" class="form-control" placeholder="Tempat Bersalin" name="tempat_persalinan" value="{{ $datas->tempat_persalinan }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="nama_anak">Dokter/Bidan</label>
								<div class="input-group col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-md"></i></span>
										<input type="text" class="form-control" placeholder="Anak Ke-" name="dokter" value="{{ $datas->dokter }}" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 control-label" for="name"></label>
								<div class="input-group col-md-8">
									<button type="submit" class="btn btn-primary" style="margin-right: 6px;">Update</button>
									<a href="{{ route('anak.index') }}" class="btn btn-danger">Batal</a>
								</div>
							</div>
						</div>
					</form>
					@endforeach
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