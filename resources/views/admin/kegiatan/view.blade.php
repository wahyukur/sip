@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
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

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="margin-right: 40px"><a href="{{ route('kegiatan.create') }}" class="btn btn-sm btn-primary"><span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Tambah Data</a> | Kegiatan Posyandu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;">Nama Kegiatan</th>
                            <th style="text-align: center;">Nama Tamu</th>
                            <th style="text-align: center;">Tanggal</th>
                            <th style="text-align: center;">Waktu</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $datas->kegiatan }}</td>
                            <td>{{ $datas->nama_tamu }}</td>
                            <td>
                                @php
                                    $date = date("d-m-Y", strtotime($datas->start))
                                @endphp
                                {{ $date }}
                            </td>
                            <td>
                                @php
                                    $date = date("H:i", strtotime($datas->start))
                                @endphp
                                {{ $date }} WIB
                            </td>
                            <td>
                                <form action="{{ route('kegiatan.destroy', $datas->id_kegiatan) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="btn-group">
                                        <a href="{{ route('kegiatan.edit', $datas->id_kegiatan) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>

                                        <a href="{{ route('kegiatan.show', $datas->id_kegiatan) }}" class=" btn btn-sm btn-success" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-info-sign"></span></a>

                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')" data-toggle="tooltip" title="Hapus"><span class="glyphicon glyphicon-trash"></span></button>
                                    </div>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;">Nama Kegiatan</th>
                            <th style="text-align: center;">Nama Tamu</th>
                            <th style="text-align: center;">Tanggal</th>
                            <th style="text-align: center;">Waktu</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
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