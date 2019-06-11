@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Ibu
    <small>kelola data ibu</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Data Ibu</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="margin-right: 40px"><a href="{{ route('ibu.create') }}" class="btn btn-sm btn-primary"><span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Tambah Data</a> | Data Ibu</h3>
                <a href="{{ route('exportIbu') }}" class="btn btn-sm btn-success pull-right" target="_blank"><span><i class="fa fa-file-excel-o" aria-hidden="true"></i> </span> Export Excel</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;text-align: center;">#</th>
                            <th style="width: 15%;text-align: center;">Nama Ibu</th>
                            <th style="width: 15%;text-align: center;">Nama Suami</th>
                            <th style="width: 20%;text-align: center;">Alamat</th>
                            <th style="width: 20%;text-align: center;">No. BPJS</th>
                            <th style="width: 12%;text-align: center;">Status Gakin</th>
                            <th style="width: 13%;text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $datas->nama_ibu }}</td>
                            <td>{{ $datas->nama_suami }}</td>
                            <td>{{ $datas->alamat }} Rt {{ $datas->rt }}/Rw {{ $datas->rw }}</td>
                            <td>
                                @if ($datas->No_BPJS == null)
                                    <p style="text-align: center; color: #9ca4af;">Tidak Ada</p>
                                @else
                                    {{ $datas->No_BPJS }}
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @if ($datas->gakin == 0)
                                    Non Gakin
                                @else
                                    Gakin
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('ibu.destroy', $datas->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="btn-group">
                                        <a href="{{ route('ibu.edit', $datas->id) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>

                                        <a href="{{ route('ibu.show', $datas->id) }}" class=" btn btn-sm btn-success" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-info-sign"></span></a>

                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')" data-toggle="tooltip" title="Hapus"><span class="glyphicon glyphicon-trash"></span></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 5%;text-align: center;">#</th>
                            <th style="width: 15%;text-align: center;">Nama Ibu</th>
                            <th style="width: 15%;text-align: center;">Nama Suami</th>
                            <th style="width: 20%;text-align: center;">Alamat</th>
                            <th style="width: 20%;text-align: center;">No. BPJS</th>
                            <th style="width: 12%;text-align: center;">Status Gakin</th>
                            <th style="width: 13%;text-align: center;">Aksi</th>
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