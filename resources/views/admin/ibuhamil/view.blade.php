@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
@endsection

@section('breadcrumb')
<h1>
    Data Ibu Hamil
    <small>kelola data ibu hamil</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Data Ibu Hamil</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
        <li><a href="#tab_3-2" data-toggle="tab">Data Ibu Hamil Melahirkan</a></li>
        <li><a href="#tab_2-2" data-toggle="tab">Data Ibu Hamil Meninggal</a></li>
        <li class="active"><a href="#tab_1-1" data-toggle="tab">Data Ibu Hamil</a></li>
        <li class="pull-left header"><a href="{{ route('ibuhamil.create') }}" class="btn btn-primary"><span><i class="fa fa-plus-square" aria-hidden="true"></i></span> Tambah Data</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1-1">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 7%; text-align: center;">#</th>
                                        <th style="width: 18%; text-align: center;">Nama Bumil</th>
                                        <th style="width: 18%; text-align: center;">Nama Suami</th>
                                        <th style="width: 8%; text-align: center;">Usia</th>
                                        <th style="width: 20%; text-align: center;">Alamat</th>
                                        <th style="width: 10%; text-align: center;">Usia Kehamilan</th>
                                        <th style="width: 7%; text-align: center;">LiLa</th>
                                        <th style="width: 12%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($data as $datas)
                                    <tr>
                                        <td>
                                            <div class="btn-group-vertical">
                                                <button data-id="{{ $datas->id_bumil }}" class="AddMelahirkan btn btn-xs btn-success" type="button" title="Melahirkan" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-collapse-up"></span></button>

                                                <button data-id="{{ $datas->id_bumil }}" class="AddMeninggal btn btn-xs btn-danger" type="button" title="Meninggal" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-collapse-down"></span></button>
                                            </div>
                                            <b><?php echo " | "; ?></b>
                                            <b>{{ $no++ }}</b>
                                        </td>
                                        <td>{{ $datas->nama_bumil }}</td>
                                        <td>{{ $datas->nama_suami }}</td>
                                        <td>{{ $datas->umur }} Tahun</td>
                                        <td>{{ $datas->alamat }}</td>
                                        <td>{{ $datas->usia_kehamilan }} Minggu</td>
                                        <td>{{ $datas->lila }} cm</td>
                                        <td style="text-align: center;">
                                            <form action="{{ route('ibuhamil.destroy', $datas->id_bumil) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <div class="btn-group">
                                                    <a href="{{ route('ibuhamil.edit', $datas->id_bumil) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>

                                                    <a href="{{ route('ibuhamil.show', $datas->id_bumil) }}" class=" btn btn-sm btn-success" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-info-sign"></span></a>

                                                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')" data-toggle="tooltip" title="Hapus"><span class="glyphicon glyphicon-trash"></span></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 7%; text-align: center;">#</th>
                                        <th style="width: 18%; text-align: center;">Nama Bumil</th>
                                        <th style="width: 18%; text-align: center;">Nama Suami</th>
                                        <th style="width: 8%; text-align: center;">Usia</th>
                                        <th style="width: 20%; text-align: center;">Alamat</th>
                                        <th style="width: 10%; text-align: center;">Usia Kehamilan</th>
                                        <th style="width: 7%; text-align: center;">LiLa</th>
                                        <th style="width: 12%; text-align: center;">Aksi</th>
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
                            <table id="example2" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;">#</th>
                                        <th style="width: 20%; text-align: center;">Nama Bumil</th>
                                        <th style="width: 20%; text-align: center;">Nama Suami</th>
                                        <th style="width: 10%; text-align: center;">Usia saat meninggal</th>
                                        <th style="width: 30%; text-align: center;">Tempat Meninggal</th>
                                        <th style="width: 15%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($data2 as $datas2)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $datas2->nama_bumil }}</td>
                                        <td>{{ $datas2->nama_suami }}</td>
                                        <td>{{ $datas2->umur_meninggal }} Tahun</td>
                                        <td>{{ $datas2->tempat_meninggal }}</td>
                                        <td style="text-align: center;">
                                            <form action="{{ route('ibuhamil.destroy', $datas2->id_bumil) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <div class="btn-group">
                                                    <a href="{{ route('ibuhamil.edit', $datas2->id_bumil) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>

                                                    <a href="{{ route('ibuhamil.show', $datas2->id_bumil) }}" class=" btn btn-sm btn-success" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-info-sign"></span></a>

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
                                        <th style="width: 20%; text-align: center;">Nama Bumil</th>
                                        <th style="width: 20%; text-align: center;">Nama Suami</th>
                                        <th style="width: 10%; text-align: center;">Usia saat meninggal</th>
                                        <th style="width: 30%; text-align: center;">Tempat Meninggal</th>
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
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3-2">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example3" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;">#</th>
                                        <th style="width: 20%; text-align: center;">Nama Bumil</th>
                                        <th style="width: 20%; text-align: center;">Nama Bayi</th>
                                        <th style="width: 10%; text-align: center;">Tanggal Melahirkan</th>
                                        <th style="width: 15%; text-align: center;">Jenis Persalinan</th>
                                        <th style="width: 15%; text-align: center;">Penolong</th>
                                        <th style="width: 15%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($data3 as $datas3)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $datas3->nama_bumil }}</td>
                                        <td>{{ $datas3->nama_anak }}</td>
                                        <td>{{ $datas3->tgl_melahirkan }}</td>
                                        <td>{{ $datas3->jenis_persalinan }}</td>
                                        <td>{{ $datas3->dokter }}</td>
                                        <td style="text-align: center;">
                                            <form action="{{ route('ibuhamil.destroy', $datas3->id_bumil) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <div class="btn-group">
                                                    <a href="{{ route('ibuhamil.edit', $datas3->id_bumil) }}" class=" btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>

                                                    <a href="{{ route('ibuhamil.show', $datas3->id_bumil) }}" class=" btn btn-sm btn-success" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-info-sign"></span></a>

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
                                        <th style="width: 20%; text-align: center;">Nama Bumil</th>
                                        <th style="width: 20%; text-align: center;">Nama Bayi</th>
                                        <th style="width: 10%; text-align: center;">Tanggal Melahirkan</th>
                                        <th style="width: 15%; text-align: center;">Jenis Persalinan</th>
                                        <th style="width: 15%; text-align: center;">Penolong</th>
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
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->

<!-- Modal -->
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Masukkan Data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-11">
                        <form class="form-horizontal" method="post" action="{{ route('bumil_meninggal') }}">
                            @csrf
                            <input id="bookId" name="idbumil" type="hidden" value="PATCH" />
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="nama_bumil">Umur Meninggal</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>
                                            <input type="number" class="form-control" placeholder="Umur Meninggal" name="umur_meninggal" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="nama_bumil">Tempat Meninggal</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                            <input type="text" class="form-control" placeholder="Tempat Meninggal" name="tempat_meninggal" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="name"></label>
                                    <div class="input-group col-md-8">
                                        <button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Masukkan Data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-11">
                        <form class="form-horizontal" method="post" action="{{ route('bumil_melahirkan') }}">
                            @csrf
                            <input id="bookId" name="idbumil" type="hidden" value="PATCH" />
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="nama_bumil">Umur Melahirkan</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>
                                            <input type="number" class="form-control" placeholder="Umur Melahirkan" name="umur_melahirkan" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="tgl_melahirkan">Tanggal Melahirkan</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Melahirkan" name="tgl_melahirkan" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="alamat2">BB dan TB Anak</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                            <input type="text" class="form-control" placeholder="Berat Badan" name="bb_anak" required>
                                            <span class="input-group-addon">Kg</span>
                                            <input type="number" class="form-control" placeholder="Tinggi Badan" name="tb_anak" required>
                                            <span class="input-group-addon">cm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="anak_ke">Anak Ke-</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-list-ol"></i></span>
                                            <input type="number" class="form-control" placeholder="Anak Ke-" name="anak_ke" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="jenis_persalinan">Jenis Persalinan</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hotel"></i></span>
                                            <select class="form-control" name="jenis_persalinan" style="width: 100%;">
                                                <option selected="selected" value="">-- Jenis Persalinan --</option>
                                                <option value="Spontan">Persalinan Spontan</option>
                                                <option value="Caesar">Persalinan Caesar</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="tempat_persalinan">Tempat Bersalin</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
                                            <input type="text" class="form-control" placeholder="Tempat Bersalin" name="tempat_persalinan" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="dokter">Dokter/Bidan</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                            <input type="text" class="form-control" placeholder="Nama Dokter/Bidan" name="dokter" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="nama_anak">Nama Bayi</label>
                                    <div class="input-group col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" placeholder="Nama Anak" name="nama_anak" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-4 control-label" for="name"></label>
                                    <div class="input-group col-md-8">
                                        <button type="submit" class="btn btn-primary" style="margin-right: 6px;">Simpan</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('java')
<!-- DataTables -->
<script src="{!! asset('bower_components/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}"></script>
<!-- bootstrap datepicker -->
<script src="{!! asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>
<script type="text/javascript">
    $(function () {
        $('#example1').DataTable();
        $('#example2').DataTable();
        $('#example3').DataTable();
        $('#datepicker').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true
        })
    })
    $(document).on("click", ".AddMeninggal", function () {
        var idbumil = $(this).data('id');
        $(".modal-body #bookId").val( idbumil );
    });
    $(document).on("click", ".AddMelahirkan", function () {
        var idbumil = $(this).data('id');
        $(".modal-body #bookId").val( idbumil );
    });
</script>
@endsection