@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Galeri Posyandu
    <small>album foto kegiatan posyandu</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Galeri</li>
    <li class="active">Album</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Buat Album</h3>
            </div>
            <div class="box-body">
                <form method="post" action="{{ route('albumStore') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_album">Nama Album : </label>
                        <input type="text" class="form-control" name="nama_album" required>
                    </div>
                    <div class="form-group">
                        <label for="ket_album">Keterangan : </label>
                        <textarea class="form-control" rows="4" name="ket_album"></textarea>
                    </div>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Album Foto Posyandu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row" style="margin: 5px;">
                    @foreach($data as $datas)
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a href="{{ route('albumDetail', $datas->id_album) }}">
                            <img src="{!! asset('dist/img/folder-icon.png') !!}" alt="Icon Folder" style="width: 100px; height: 100px;" title="{{ $datas->nama_album }}">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection

@section('java')
<!-- DataTables -->
<script src="{!! asset('bower_components/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}"></script>
<script type="text/javascript">
    $(function () {
        $('#example1').DataTable()
    })
</script>
@endsection