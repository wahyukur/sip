@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Anak
    <small>kelola data anak</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Data Anak</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="margin-right: 40px"><a href="{{ route('anak.create') }}" class="btn btn-sm btn-primary"><span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Tambah Data</a> | Data Anak</h3>
                <div class="btn-group pull-right">
                    <a href="{{ route('printAnak') }}" class=" btn btn-sm bg-maroon" target="_blank"><span class="glyphicon glyphicon-print"></span> PDF</a>
                    <a href="#" class=" btn btn-sm btn-success"><span><i class="fa fa-file-excel-o" aria-hidden="true"></i></span> Excel</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center;">#</th>
                            <th style="width: 20%; text-align: center;">Nama Anak</th>
                            <th style="width: 35%; text-align: center;">Orang Tua</th>
                            <th style="width: 15%; text-align: center;">Jenis Kelamin</th>
                            <th style="width: 10%; text-align: center;">Tgl Lahir</th>
                            <th style="width: 15%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $datas->nama_anak }}</td>
                            <td>{{ $datas->nama_ibu }} & {{ $datas->nama_suami }}</td>
                            <td>{{ $datas->jenis_kelamin }}</td>
                            <td>{{ $datas->tgl_lhr }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('anak.destroy', $datas->id_anak) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="btn-group">
                                        <a href="{{ route('anak.edit', $datas->id_anak) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>

                                        <a href="{{ route('anak.show', $datas->id_anak) }}" class=" btn btn-sm btn-success" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-info-sign"></span></a>

                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')" data-toggle="tooltip" title="Hapus"><span class="glyphicon glyphicon-trash"></span></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 5%; text-align: center;">#</th>
                            <th style="width: 20%; text-align: center;">Nama Anak</th>
                            <th style="width: 35%; text-align: center;">Orang Tua</th>
                            <th style="width: 15%; text-align: center;">Jenis Kelamin</th>
                            <th style="width: 10%; text-align: center;">Tgl Lahir</th>
                            <th style="width: 15%; text-align: center;">Aksi</th>
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