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
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $data1 }}</h3>
                <p>Data Ibu</p>
            </div>
            <div class="icon">
                <i class="ion ion-woman"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $data2 }}</h3>
                <p>Data Anak</p>
            </div>
            <div class="icon">
                <i class="ion ion-happy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $data3 }}</h3>
                <p>Data User Ibu</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-7 connectedSortable">
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
            <div class="box-footer text-black">
                Calendar Footer
            </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- right col -->
    
    <!-- Left col -->
    <section class="col-lg-5 connectedSortable">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Agenda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data as $datas)
                        <tr>
                            <td>{{ $no++ }}.</td>
                            <td>{{ $datas->kegiatan }}</td>
                            <td>{{ $datas->start }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
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

{!! $calendar->script() !!}
@endsection