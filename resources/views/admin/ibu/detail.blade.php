@extends('layouts.base')

@section('css')

@endsection

@section('breadcrumb')
<h1>
    Detail Ibu
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Master</a></li>
    <li class="active">Data Ibu</li>
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
				<h3 class="profile-username text-center">{{ $datas->nama_ibu }}</h3>
				<p class="text-muted text-center">Ibu Posyandu</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Tempat Lahir</b> <a class="pull-right">{{ $datas->tempat_lahir }}</a>
					</li>
					<li class="list-group-item">
						<b>Tanggal Lahir</b> <a class="pull-right">{{ $datas->tgl_lahir }}</a>
					</li>
					<li class="list-group-item">
						<b>No. Telp</b> <a class="pull-right">{{ $datas->No_tlp }}</a>
					</li>
				</ul>
				<a href="{{ route('ibu.index') }}" class="btn btn-primary btn-block"><b>Kembali</b></a>
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
            							<a href="#">Alamat : </a> {{ $datas->alamat }} Rt {{ $datas->rt }}/Rw {{ $datas->rw }} {{ $datas->kecamatan }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-user-secret bg-aqua"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">Agama : </a> {{ $datas->agama }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-id-card bg-muted"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">NIK : </a> {{ $datas->NIK }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-id-card bg-muted"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">No. KK : </a> {{ $datas->No_KK }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-id-card bg-muted"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">No. BPJS : </a>
            							@if ($datas->No_BPJS == null)
            								Tidak Ada
            							@else
            								{{ $datas->No_BPJS }}
                            			@endif
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
            				<!-- timeline item -->
            				<li>
            					<i class="fa fa-user bg-green"></i>
            					<div class="timeline-item">
            						<h3 class="timeline-header no-border">
            							<a href="#">Status Gakin : </a> {{ $datas->gakin }}
            						</h3>
            					</div>
            				</li>
            				<!-- END timeline item -->
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