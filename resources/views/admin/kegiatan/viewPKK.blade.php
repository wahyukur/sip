@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    PKK
    <small>mengetahui ibu PKK</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">PKK</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Masukkan Data PKK</h3>
            </div>
            <div class="box-body">
                <form method="post" action="{{ route('storePKK') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_ketua">Nama Ketua : </label>
                        <input type="text" class="form-control" name="nama_ketua" required>
                    </div>
                    <div class="form-group">
                        <label for="notelp_ketua">Nomor Telpon : </label>
                        <input type="number" class="form-control" name="notelp_ketua">
                    </div>
                    <div class="form-group">
                        <label for="alamat_ketua">Alamat : </label>
                        <textarea class="form-control" rows="4" name="alamat_ketua"></textarea>
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
                <h3 class="box-title">PKK</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;">Nama UKM</th>
                            <th style="text-align: center;">No. Telp</th>
                            <th style="text-align: center;">Alamat</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $datas->nama_ketua }}</td>
                            <td>{{ $datas->notelp_ketua }}</td>
                            <td>{{ $datas->alamat_ketua }}</td>
                            <td>
                                <form action="{{ route('deletePKK', $datas->id_pkk) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="btn-group">
                                        <a href="{{ route('editPKK', $datas->id_pkk) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                        <button class="btn btn-sm btn-danger" type="submit" data-toggle="tooltip" title="Hapus"><span class="glyphicon glyphicon-trash"></span></button>
                                    </div>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;">Nama UKM</th>
                            <th style="text-align: center;">No. Telp</th>
                            <th style="text-align: center;">Alamat</th>
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