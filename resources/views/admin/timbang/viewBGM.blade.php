@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Timbang Anak
    <small>penimbangan anak</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Timbang Anak</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
        <li><a href="#tab_2-2" data-toggle="tab">Data BGM/2T</a></li>
        <li class="active"><a href="#tab_1-1" data-toggle="tab">BGM/2T Bulan Ini</a></li>
        <li class="pull-left header"><h4>Hasil Timbang Anak</h4></li>
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
                                        <th>#</th>
                                        <th>Nama Anak</th>
                                        <th>Umur</th>
                                        <th>BB/TB</th>
                                        <th>Tanggal Timbang</th>
                                        <th>Status Gizi</th>
                                        <th>Keterangan</th>
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
                                        <td>{{ $datas->ket_timbang }}</td>
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