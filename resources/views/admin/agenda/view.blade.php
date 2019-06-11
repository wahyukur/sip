@extends('layouts.base')

@section('css')
<!-- fullCalendar -->
<link rel="stylesheet" href="{!! asset('bower_components/fullcalendar/dist/fullcalendar.min.css') !!}">
<link rel="stylesheet" href="{!! asset('bower_components/fullcalendar/dist/fullcalendar.print.min.css') !!}" media="print">
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

@include('notification')

<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Buat Agenda</h3>
            </div>
            <div class="box-body">
                <form method="post" action="{{ route('agenda.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="kegiatan">Nama Kegiatan:</label>
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat:</label>
                        <input type="text" class="form-control" id="tempat" name="tempat" required>
                    </div>
                    <div class="form-group">
                        <label for="start">Tanggal Mulai:</label>
                        <div class="input-group date">
                            <input type="text" class="form-control pull-right" id="datetimepicker" name="start" required autocomplete="off">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end">Tanggal Selesai:</label>
                        <div class="input-group date">
                            <input type="text" class="form-control pull-right" id="datetimepicker2" name="end" required autocomplete="off">
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
                                    <input type="radio" name="j_kegiatan" class="form-check-input minimal" value="0" required> Rutin
                                </label>
                                <label class="form-check-label">
                                    <input type="radio" name="j_kegiatan" class="form-check-input minimal" value="1" required> Tambahan
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Color Picker -->
                    <div class="form-group">
                        <label for="warna">Warna Agenda:</label>
                        <div class="input-group my-colorpicker2">
                            <input type="text" class="form-control" id="color" name="color">
                            <div class="input-group-addon">
                                <i></i>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea class="form-control" rows="4" id="keterangan" name="keterangan"></textarea>
                    </div>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                {!! $calendar->calendar() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('java')
<!-- fullCalendar -->
<script src="{!! asset('bower_components/moment/moment.js') !!}"></script>
<script src="{!! asset('bower_components/fullcalendar/dist/fullcalendar.min.js') !!}"></script>
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

{!! $calendar->script() !!}
@endsection