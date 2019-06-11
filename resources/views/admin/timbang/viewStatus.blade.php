@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Status Gizi Anak
    <small>data gizi buruk dan gizi lebih anak</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Status Gizi Anak</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
        <li><a href="#tab_2-2" data-toggle="tab">Data Status Gizi</a></li>
        <li class="active"><a href="#tab_1-1" data-toggle="tab">Status Gizi Bulan Ini</a></li>
        <li class="pull-left header"><h4>Status Gizi Anak</h4></li>
    </ul>
    <!-- Bulan INI -->
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1-1">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Nama Anak</th>
                                        <th style="text-align: center;">Umur</th>
                                        <th style="text-align: center;">BB/TB</th>
                                        <th style="text-align: center;">Tanggal Timbang</th>
                                        <th style="text-align: center;">Status Gizi</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($data as $datas)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $datas->nama_anak }}</td>
                                        <td>{{ $datas->umur }} Bulan</td>
                                        <td>
                                            {{ $datas->berat_badan }} Kg/{{ $datas->tinggi_badan }} cm
                                        </td>
                                        <td>{{ $datas->tgl_timbang }}</td>
                                        <td>{{ $datas->status_gizi }}</td>
                                        <td style="text-align: center;">
                                            <div class="btn-group">
                                                @if($datas->status_gizi == 'BB Sangat Kurang')
                                                    @if($datas->gibur_klinis == null or $datas->st_gizi_bbtb == null or $datas->penanganan == null or $datas->penyebab_utama == null or $datas->alasan_gibur == null or $datas->tindakan == null)
                                                        <a href="{{ route('statusgizi.edit', $datas->id_timbang) }}" class=" btn btn-sm btn-success" data-toggle="tooltip" title="Lengkapi data"><span class="glyphicon glyphicon-pencil"></span></a>
                                                    @else
                                                        <a href="{{ route('statusgizi.edit', $datas->id_timbang) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                                    @endif
                                                    <a href="{{ route('statusgizi.show', $datas->id_timbang) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-info-sign"></span></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Nama Anak</th>
                                        <th style="text-align: center;">Umur</th>
                                        <th style="text-align: center;">BB/TB</th>
                                        <th style="text-align: center;">Tanggal Timbang</th>
                                        <th style="text-align: center;">Status Gizi</th>
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
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2-2">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Anak</th>
                                        <th>Umur</th>
                                        <th>BB/TB</th>
                                        <th>Tanggal Timbang</th>
                                        <th>Status Gizi</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($data2 as $datas2)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $datas2->nama_anak }}</td>
                                        <td>{{ $datas2->umur }} Bulan</td>
                                        <td>
                                            {{ $datas2->berat_badan }} Kg/{{ $datas2->tinggi_badan }} cm
                                        </td>
                                        <td>{{ $datas2->tgl_timbang }}</td>
                                        <td>{{ $datas2->status_gizi }}</td>
                                        <td>{{ $datas2->ket_timbang }}</td>
                                        <td>
                                            <a href="{{ route('statusgizi.show', $datas2->id_timbang) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-info-sign"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Anak</th>
                                        <th>Umur</th>
                                        <th>BB/TB</th>
                                        <th>Tanggal Timbang</th>
                                        <th>Status Gizi</th>
                                        <th>Keterangan</th>
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
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
@endsection

@section('java')
<!-- DataTables -->
<script src="{!! asset('bower_components/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}"></script>
<script type="text/javascript">
    $(function () {
        $('#example1').DataTable();
        $('#example2').DataTable();
    })
</script>
@endsection