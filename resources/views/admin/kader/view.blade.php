@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Kader Posyandu
    <small>kelola data kader</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Data Kader Posyandu</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="margin-right: 40px"><a href="{{ route('kader.create') }}" class="btn btn-sm btn-primary"><span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Tambah Data</a> | Data Kader Posyandu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%;text-align: center;">#</th>
                            <th style="width: 15%;text-align: center;">Nama Kader</th>
                            <th style="width: 15%;text-align: center;">Tempat/Tgl Lahir</th>
                            <th style="width: 23%;text-align: center;">Alamat</th>
                            <th style="width: 15%;text-align: center;">Jabatan</th>
                            <th style="width: 14%;text-align: center;">No. Telp</th>
                            <th style="width: 13%;text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $datas->nama_ibu }}</td>
                            <td>{{ $datas->tempat_lahir }}, {{ $datas->tgl_lahir }}</td>
                            <td>{{ $datas->alamat }} Rt {{ $datas->rt }}/Rw {{ $datas->rw }}</td>
                            <td>
                                @if($datas->jabatan == 0)
                                    Ibu Posyandu
                                @elseif($datas->jabatan == 1)
                                    Ketua
                                @elseif($datas->jabatan == 2)
                                    Sekretaris
                                @elseif($datas->jabatan == 3)
                                    Bendahara
                                @elseif($datas->jabatan == 4)
                                    Anggota
                                @else
                                    Ibu Posyandu
                                @endif
                            </td>
                            <td>{{ $datas->No_tlp }}</td>
                            <td>
                                <form action="{{ route('kader.destroy', $datas->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="btn-group">
                                        <a href="{{ route('kader.edit', $datas->id) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>

                                        <a href="{{ route('kader.show', $datas->id) }}" class=" btn btn-sm btn-success" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-info-sign"></span></a>

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
                            <th style="width: 15%;text-align: center;">Nama Kader</th>
                            <th style="width: 15%;text-align: center;">Tempat/Tgl Lahir</th>
                            <th style="width: 23%;text-align: center;">Alamat</th>
                            <th style="width: 15%;text-align: center;">Jabatan</th>
                            <th style="width: 14%;text-align: center;">No. Telp</th>
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