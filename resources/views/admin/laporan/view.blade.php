@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Buku Tamu
    <small>data tamu yang berkunjung</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Buku Tamu</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="margin-right: 40px"><a href="{{ route('bukutamu.create') }}" class="btn btn-sm btn-primary"><span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Tambah Data</a> | Buku Tamu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">Nama Tamu</th>
                            <th style="width: 20%;">Alamat</th>
                            <th style="width: 20%;">Jabatan</th>
                            <th style="width: 23%;">Keperluan</th>
                            <th style="width: 12%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $datas->nama_tamu }}</td>
                            <td>{{ $datas->alamat }}</td>
                            <td>{{ $datas->jabatan }}</td>
                            <td>{{ $datas->keperluan }}</td>
                            <td>
                                <form action="{{ route('bukutamu.destroy', $datas->id_tamu) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('bukutamu.edit', $datas->id_tamu) }}" class=" btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Tamu</th>
                            <th>Alamat</th>
                            <th>Jabatan</th>
                            <th>Keperluan</th>
                            <th>Aksi</th>
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