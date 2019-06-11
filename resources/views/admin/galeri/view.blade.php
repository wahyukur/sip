@extends('layouts.base')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
<style type="text/css" media="screen">
    /*body {
        padding-top: 50px;
    }*/
    .thumbnail {
        position:relative;
        overflow:hidden;
        margin: 5px;
    }
    .caption {
        position:absolute;
        top:-100%;
        right:0;
        background:rgba(66, 139, 202, 0.75);
        width:100%;
        height:100%;
        padding:2%;
        text-align:center;
        color:#fff !important;
        z-index:2;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
    }
    .thumbnail:hover .caption {
        top:0%;
    }
</style>
@endsection

@section('breadcrumb')
<h1>
    Galeri Posyandu
    <small>foto kegiatan posyandu</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Galeri</li>
</ol>
@endsection

@section('content')

@include('notification')

<div class="row">
    <!-- Left col -->
    <section class="col-lg-12">
        <!-- TO DO List -->
        <div class="box box-solid">
            <div class="box-header">
                <!-- // -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="timeline">
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-gray">
                            <a href="{{ route('albumList') }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> 
                                 Kembali
                            </a>
                            <a href="{{ route('addImage', $data1->id_album) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus-square" aria-hidden="true"></i> 
                                 Tambah Foto
                            </a>
                        </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-camera bg-purple"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header bg-gray"><a href="#">Foto</a></h3>
                            <div class="timeline-body">
                                <div class="row">
                                    @foreach($data as $datas)
                                        @if($datas->image == null)
                                        <div class="col-xs-6 col-sm-4 col-md-3">
                                            <div class="thumbnail">
                                                <div class="caption">
                                                    <h4>Tidak ada foto</h4>
                                                    <p>
                                                        <a href="{{ route('addImage', $datas->id_album) }}" class="label label-danger">
                                                            <i class="fa fa-plus-square" aria-hidden="true"></i> 
                                                             Tambah Foto
                                                        </a>
                                                    </p>
                                                </div>
                                                <img src="{!! asset('dist/img/placehold.jpg') !!}" alt="Empty Picture">
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-xs-6 col-sm-4 col-md-3">
                                            <div class="thumbnail">
                                                <div class="caption">
                                                    <h4>{{ $datas->title }}</h4>
                                                    <!-- <p>{{ $datas->description }}</p> -->
                                                    <p>
                                                        <a href="#" class="label label-warning">Zoom</a>
                                                        <a href="{{ route('deleteImage', $datas->id) }}" class="label label-danger">Hapus</a>
                                                        <a href="{{ asset($datas->image) }}" class="label label-info" download="{{ asset($datas->image) }}">Download</a>
                                                    </p>
                                                </div>
                                                <img src="{{ asset($datas->image) }}" alt="{{ $datas->description }}">
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    
                    <li>
                        <i class="fa fa-check bg-blue"></i>
                    </li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
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