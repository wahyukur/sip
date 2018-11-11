@extends('layouts.base')

@section('css')

@endsection

@section('breadcrumb')
<h1>
    Detail Ibu Hamil
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Data Ibu Hamil</li>
</ol>
@endsection

@section('content')

@foreach($data as $datas)
<div class="row">
	<div class="col-md-3">
		<!-- Profile Image -->
		<div class="box box-primary">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="{!! asset('dist/img/avatar2.png') !!}" alt="User profile picture">
				<h3 class="profile-username text-center">{{ $datas->nama_bumil }}</h3>
				<p class="text-muted text-center">Ibu Hamil</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Umur</b> <a class="pull-right">{{ $datas->umur }} Tahun</a>
					</li>
					<li class="list-group-item">
						<b>BB sebelum hamil</b> <a class="pull-right">{{ $datas->bb_sebelum_hamil }} Kg</a>
					</li>
					<li class="list-group-item">
						<b>BB sekarang</b> <a class="pull-right">{{ $datas->bb_sekarang }} Kg</a>
					</li>
                    <li class="list-group-item">
                        <b>TB sekarang</b> <a class="pull-right">{{ $datas->tb_bumil }} cm</a>
                    </li>
				</ul>
				<a href="{{ route('ibuhamil.index') }}" class="btn btn-primary btn-block"><b>Kembali</b></a>
			</div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

    <div class="col-md-9">
    	<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            	<li class="active"><a href="#activity" data-toggle="tab">Detail</a></li>
            </ul>
            <div class="tab-content">
            	<div class="active tab-pane" id="activity">
            		<div class="tab-pane" id="activity">
            			<!-- The timeline -->
            			<ul class="timeline timeline-inverse">
            				<!-- timeline time label -->
            				<li class="time-label">
            					<span class="bg-red">
            						@php
            							$date = date("d M. Y", strtotime($datas->created_at))
            						@endphp
            						{{ $date }}
            					</span>
            				</li>
            				<!-- /.timeline-label -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-mars bg-light-blue"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">Nama Suami : </a> {{ $datas->nama_suami }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-address-card bg-yellow"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">Alamat : </a> {{ $datas->alamat }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-child bg-aqua"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">Hamil Ke : </a> {{ $datas->hamil_ke }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-user bg-aqua"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">Usia Kehamilan : </a> {{ $datas->usia_kehamilan }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-thermometer-empty bg-green"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">Penyakit Penyerta : </a> {{ $datas->penyakit_penyerta }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-list-ol bg-green"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">Lingkar Lengan Atas : </a> {{ $datas->lila }} cm
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-hospital-o bg-green"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">Periksa Kehamilan : </a> {{ $datas->periksa_kehamilan }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
                            @if($datas->status == "Meninggal")
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-blue">
                                        Status: {{ $datas->status }}
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-info bg-yellow"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Detail Meninggal</a></h3>

                                        <div class="timeline-body">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Umur Meninggal</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->umur_meninggal }} Tahun</td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Meninggal</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->tempat_meninggal }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                            @elseif($datas->status == "Melahirkan")
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-blue">
                                        Status: {{ $datas->status }}
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-info bg-yellow"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Detail Melahirkan</a></h3>

                                        <div class="timeline-body">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Umur Melahirkan</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->umur_melahirkan }} Tahun</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Melahirkan</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->tgl_melahirkan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Bayi</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->nama_anak }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Berat Badan Anak</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->bb_anak }} Kg</td>
                                                </tr>
                                                <tr>
                                                    <th>Tinggi Badan Anak</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->tb_anak }} cm</td>
                                                </tr>
                                                <tr>
                                                    <th>Anak Ke</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->anak_ke }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Persalinan</th>
                                                    <th> : </th>
                                                    <td>Persalinan {{ $datas->jenis_persalinan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Persalinan</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->tempat_persalinan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Dokter/Bidan</th>
                                                    <th> : </th>
                                                    <td>{{ $datas->dokter }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                            @endif
            				<li>
            					<i class="fa fa-check bg-gray"></i>
            				</li>
            			</ul>
            		</div>
            		<!-- /.tab-pane -->
            	</div>
            	<!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
   	</div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endforeach

@endsection

@section('java')
@endsection