@extends('layouts.base')

@section('css')
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{!! asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') !!}">
<!-- bootstrap datetimepicker -->
<script src="{!! asset('bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') !!}"></script>
@endsection

@section('breadcrumb')
<h1>
    Agenda Posyandu
    <small>kelola agenda</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Agenda</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detail Agenda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tr>
                        <th>Kegiatan</th>
                        <td>{{ $data->kegiatan }}</td>
                    </tr>
                    <tr>
                        <th>Tempat</th>
                        <td>{{ $data->tempat }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ $data->start }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Selesai</th>
                        <td>{{ $data->end }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kegiatan</th>
                        <td>
                            @if ($data->j_kegiatan == 0)
                                Rutin
                            @else
                                Tambahan
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Warna</th>
                        <td><i class="fa fa-square" aria-hidden="true" style="
                        @if ($data->color == null)
                            color: #4169E1
                        @else
                            color: {{ $data->color }}
                        @endif
                        "></i></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>
                            @if($data->keterangan == null)
                                Tidak Ada
                            @else
                                {{ $data->keterangan }}
                            @endif
                        </td>
                    </tr>
                </table>

                <form action="{{ route('agenda.destroy', $data->id_agenda) }}" method="post" style="padding: 15px">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a href="{{ route('agenda.index') }}" class=" btn btn-sm btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                    <button type="button" class=" btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">Edit</button>
                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                    <a href="{{ route('printAbsen', $data->id_agenda) }}" class=" btn btn-sm btn-success" target="_blank"><span><i class="fa fa-print" aria-hidden="true"></i></span> Cetak Absen</a>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Agenda</h4>
                    </div>
                    <form method="post" action="{{ route('agenda.update', $data->id_agenda) }}">
                    @csrf
                        <input name="_method" type="hidden" value="PATCH" />
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kegiatan">Nama Kegiatan:</label>
                                <input type="text" class="form-control" id="kegiatan" name="kegiatan" required value="{{ $data->kegiatan }}">
                            </div>
                            <div class="form-group">
                                <label for="tempat">Tempat:</label>
                                <input type="text" class="form-control" id="tempat" name="tempat" required value="{{ $data->tempat }}">
                            </div>
                            <div class="form-group">
                                <label for="start">Tanggal Mulai:</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control pull-right" id="datetimepicker" name="start" required autocomplete="off" value="{{ $data->start }}">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end">Tanggal Selesai:</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control pull-right" id="datetimepicker2" name="end" required autocomplete="off" value="{{ $data->end }}">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="j_kegiatan">Jenis Kegiatan</label>
                                <div class="input-group">
                                    <div class="form-check-inline">
                                        <label class="form-check-label" style="padding: 6px 10px 0px 0px;">
                                            <input type="radio" name="j_kegiatan" class="form-check-input minimal" value="0" <?php echo ($data->j_kegiatan == 0)?'checked':'' ?> required> Rutin
                                        </label>
                                        <label class="form-check-label">
                                            <input type="radio" name="j_kegiatan" class="form-check-input minimal" value="1" <?php echo ($data->j_kegiatan == 1)?'checked':'' ?> required> Tambahan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Color Picker -->
                            <div class="form-group">
                                <label for="warna">Warna Agenda:</label>
                                <div class="input-group my-colorpicker2">
                                    <input type="text" class="form-control" id="color" name="color" 
                                    value="{{ $data->color }}">
                                    <div class="input-group-addon">
                                        <i></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                            <div class="form-group">
                                <label for="keterangan">Keterangan:</label>
                                <textarea class="form-control" rows="4" id="keterangan" name="keterangan">{{ $data->keterangan }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>      
            </div>
        </div>
    </div>
</div>
@endsection

@section('java')
<!-- bootstrap datetimepicker -->
<script src="{!! asset('bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}"></script>
<!-- bootstrap color picker -->
<script src="{!! asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') !!}"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker, #datetimepicker2').datetimepicker({
            format: 'YYYY/MM/DD hh:mm'
        })

        //color picker with addon
        $('.my-colorpicker2').colorpicker()
    })
</script>
@endsection