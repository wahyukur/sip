@extends('layouts.base')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<style type="text/css" media="screen">
.gallery
{
    display: inline-block;
    margin-top: 20px;
}
</style>
@endsection

@section('breadcrumb')
<h1>
    Kegiatan Posyandu
    <small>kelola data kegiatan posyandu</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kegiatan</li>
</ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-7">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Detail Kegiatan</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table" style="width: 100%">
                        <tr>
                            <th style="width: 30%">Nama Kegiatan</th>
                            <th style="width: 5%"> : </th>
                            <td style="width: 65%">{{ $data->kegiatan }}</td>
                        </tr>
                        <tr>
                            <th style="width: 30%">Jenis Kegiatan</th>
                            <th style="width: 5%"> : </th>
                            <td style="width: 65%">
                                @if($data->j_kegiatan == 0)
                                    Kegiatan Rutin
                                @else
                                    Kegiatan Tambahan
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <th> : </th>
                            <td>
                                @php
                                    function tgl_indo($tanggal){
                                        $bulan = array (
                                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                                        );
                                        $pecahkan = explode('-', $tanggal);
        
                                        // variabel pecahkan 0 = tanggal
                                        // variabel pecahkan 1 = bulan
                                        // variabel pecahkan 2 = tahun
 
                                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                                    }
                                    echo tgl_indo(date('Y-m-d', strtotime($data->start)));
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <th> : </th>
                            <td>{{ $data->tempat }}</td>
                        </tr>
                        <tr>
                            <th>Tamu</th>
                            <th> : </th>
                            <td>{{ $data->nama_tamu }}</td>
                        </tr>
                        <tr>
                            <th>Kerjasama UKM</th>
                            <th> : </th>
                            <td>{{ $data->nama_ukm }}</td>
                        </tr>
                        <tr>
                            <th>Mengetahui Ketua PKK</th>
                            <th> : </th>
                            <td>{{ $data->nama_ketua }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">PMT yang diberikan</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class='list-group gallery'>
                        @if($data->pmt1 == null)
                        <div class='col-xs-6 col-sm-4 col-md-6'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png">
                                <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                                <div class='text-right'>
                                    <small class='text-muted'>Gambar PMT 1</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        @else
                        <div class='col-xs-6 col-sm-4 col-md-6'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="{{ asset($data->pmt1) }}">
                                <img class="img-responsive" alt="" src="{{ asset($data->pmt1) }}" />
                                <div class='text-right'>
                                    <small class='text-muted'>Gambar PMT 1</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        @endif
                        @if($data->pmt2 == null)
                        <div class='col-xs-6 col-sm-4 col-md-6'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png">
                                <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                                <div class='text-right'>
                                    <small class='text-muted'>Gambar PMT 2</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        @else
                        <div class='col-xs-6 col-sm-4 col-md-6'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="{{ asset($data->pmt2) }}">
                                <img class="img-responsive" alt="" src="{{ asset($data->pmt2) }}" />
                                <div class='text-right'>
                                    <small class='text-muted'>Gambar PMT 2</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        @endif
                    </div> <!-- list-group / end -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Dokumentasi Kegiatan</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class='list-group gallery'>
                        @if($data->gambar_kegiatan1 == null)
                        <div class='col-xs-6 col-sm-4 col-md-12'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png">
                                <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                                <div class='text-right'>
                                    <small class='text-muted'>Dokumentasi Kegiatan 1</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        @else
                        <div class='col-xs-6 col-sm-4 col-md-12'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="{{ asset($data->gambar_kegiatan1) }}">
                                <img class="img-responsive" alt="" src="{{ asset($data->gambar_kegiatan1) }}" />
                                <div class='text-right'>
                                    <small class='text-muted'>Dokumentasi Kegiatan 1</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        @endif
                        @if($data->gambar_kegiatan2 == null)
                        <div class='col-xs-6 col-sm-4 col-md-12'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png">
                                <img class="img-responsive" alt="" src="http://placehold.it/320x320" />
                                <div class='text-right'>
                                    <small class='text-muted'>Dokumentasi Kegiatan 2</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        @else
                        <div class='col-xs-6 col-sm-4 col-md-12'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="{{ asset($data->gambar_kegiatan2) }}">
                                <img class="img-responsive" alt="" src="{{ asset($data->gambar_kegiatan2) }}" />
                                <div class='text-right'>
                                    <small class='text-muted'>Dokumentasi Kegiatan 2</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        @endif
                    </div> <!-- list-group / end -->
                </div>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //FANCYBOX
        //https://github.com/fancyapps/fancyBox
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
</script>
@endsection