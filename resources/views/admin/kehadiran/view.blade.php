@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Kehadiran
    <small>peserta yang tidak hadir kegiatan rutin</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kehadiran</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="margin-right: 40px"><a href="{{ route('kehadiran.create') }}" class="btn btn-sm btn-primary"><span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Tambah Data</a> | Kehadiran Peserta</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;">Nama Balita</th>
                            <th style="text-align: center;">Jenis Kelamin</th>
                            <th style="text-align: center;">Umur</th>
                            <th style="text-align: center;">Alasan</th>
                            <th style="text-align: center;">Tgl Kunjungan</th>
                            <th style="text-align: center;">Keterangan</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $datas->nama_anak }}</td>
                            <td>
                                @if ($datas->jenis_kelamin == 0)
                                    Laki-Laki
                                @else
                                    Perempuan
                                @endif
                            </td>
                            <td>
                                @php
                                $date = date("Y-m-d");
                                $timeStart = strtotime("$datas->tgl_lhr");
                                $timeEnd = strtotime("$date");
                                // Menambah bulan ini + semua bulan pada tahun sebelumnya
                                $numBulan = (date("Y",$timeEnd)-date("Y",$timeStart))*12;
                                // menghitung selisih bulan
                                $numBulan += date("m",$timeEnd)-date("m",$timeStart);

                                echo $numBulan;
                                @endphp
                                Bulan
                            </td>
                            <td>{{ $datas->alasan }}</td>
                            <td>{{ $datas->tgl_kunjungan }}</td>
                            <td>
                                @if ($datas->ket_hadir == null)
                                    Tidak Ada
                                @else
                                    {{ $datas->ket_hadir }}
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('kehadiran.destroy', $datas->id_kehadiran) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="btn-group">
                                        <a href="{{ route('kehadiran.edit', $datas->id_kehadiran) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
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
                            <th style="text-align: center;">Nama Balita</th>
                            <th style="text-align: center;">Jenis Kelamin</th>
                            <th style="text-align: center;">Umur</th>
                            <th style="text-align: center;">Alasan</th>
                            <th style="text-align: center;">Tgl Kunjungan</th>
                            <th style="text-align: center;">Keterangan</th>
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