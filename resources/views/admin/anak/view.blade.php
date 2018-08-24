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

<a href="{{ route('anak.create') }}" class="btn btn-primary"><span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Tambah Data</a>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Anak</h3><br>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Anak</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $datas->nama_anak }}</td>
                            <td>{{ $datas->tempat_lhr }}</td>
                            <td>{{ $datas->tgl_lhr }}</td>
                            <td>
                                <form action="{{ route('anak.destroy', $datas->id_anak) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('anak.edit', $datas->id_anak) }}" class=" btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Anak</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
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