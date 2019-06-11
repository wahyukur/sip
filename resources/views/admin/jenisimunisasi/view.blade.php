@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Jenis Imunisasi
    <small>kelola data jenis imunisasi</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Jenis Imunisasi</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="margin-right: 40px"><a href="{{ route('jenisimunisasi.create') }}" class="btn btn-sm btn-primary"><span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Tambah Data</a> | Jenis Imunisasi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row" style="margin: 5px;">
                    @if(count($data) >= 1)
                        @foreach($data as $datas)
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ $datas->nama_imun }}</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        Umur : {{ $datas->umur }} Bulan
                                        <div class="pull-right">
                                            <form action="{{ route('jenisimunisasi.destroy', $datas->id_j_imun) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <div class="btn-group">
                                                    <a href="{{ route('jenisimunisasi.edit', $datas->id_j_imun) }}" class=" btn btn-sm btn-default" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                                    <button class="btn btn-sm btn-default" type="submit" onclick="return confirm('Yakin ingin menghapus data?')" data-toggle="tooltip" title="Hapus"><span class="glyphicon glyphicon-trash"></span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <h4 style="text-align: center;">Data Kosong</h4>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    @endif
                </div>
                <!-- <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;text-align: center;">#</th>
                            <th style="width: 35%;text-align: center;">Nama Imunisasi</th>
                            <th style="width: 35%;text-align: center;">Umur</th>
                            <th style="width: 25%;text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $datas->nama_imun }}</td>
                            <td>{{ $datas->umur }} Bulan</td>
                            <td>
                                <form action="{{ route('jenisimunisasi.destroy', $datas->id_j_imun) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="btn-group">
                                        <a href="{{ route('jenisimunisasi.edit', $datas->id_j_imun) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')" data-toggle="tooltip" title="Hapus"><span class="glyphicon glyphicon-trash"></span></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Imunisasi</th>
                            <th>Umur</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table> -->
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