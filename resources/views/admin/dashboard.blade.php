@extends('layouts.base')

@section('breadcrumb')
<h1>
    Dashboard
    <small>Overview</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@endsection

@section('css')
<!-- fullCalendar -->
<link rel="stylesheet" href="{!! asset('bower_components/fullcalendar/dist/fullcalendar.min.css') !!}">
<link rel="stylesheet" href="{!! asset('bower_components/fullcalendar/dist/fullcalendar.print.min.css') !!}" media="print">
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $data1 }}</h3>
                <p>Ibu</p>
            </div>
            <div class="icon">
                <i class="fa fa-female"></i>
            </div>
            <a href="{{ route('ibu.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $data2 }}</h3>
                <p>Anak</p>
            </div>
            <div class="icon">
                <i class="fa fa-child"></i>
            </div>
            <a href="{{ route('anak.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $data3 }}</h3>
                <p>Kader</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-md"></i>
            </div>
            <a href="{{ route('kader.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $data4 }}</h3>
                <p>Pengguna</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="{{ route('pengguna.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5">
        <!-- Calendar -->
        <div class="box box-solid bg-solid-gradient">
            <div class="box-header">
                <i class="fa fa-calendar"></i>
                <h3 class="box-title" style="color: black;"><i class="fa fa-calendar" aria-hidden="true"></i> Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                {!! $calendar->calendar() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- right col -->
    
    <!-- Left col -->
    <section class="col-lg-7">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Rekap Data Anak Tahun @php echo date("Y"); @endphp
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <div id="chart1" style="height: 420px;"></div>
                            {!! $chart1 !!}
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.Left col -->
</div>
<!-- /.row (main row) -->
@endsection

@section('java')
<!-- fullCalendar -->
<script src="{!! asset('bower_components/moment/moment.js') !!}"></script>
<script src="{!! asset('bower_components/fullcalendar/dist/fullcalendar.min.js') !!}"></script>
<!-- highchart -->
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<script>
function myFunction() {
    var checkBox = document.getElementById("todo-check");
    var text = document.getElementById("todo-text");
    if (checkBox.checked == true){
        // text.style.display = "none";
        text.style.textDecoration = "line-through"
        text.style.fontWeight = "normal"
    } else {
        // text.style.display = "block";
        text.style.textDecoration = "none"
        text.style.fontWeight = "bold"
    }
}
</script>

{!! $calendar->script() !!}
@endsection