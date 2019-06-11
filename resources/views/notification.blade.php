@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ $message }}
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
        {{ $message }}
    </div>
@endif
@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
        {{ $message }}
    </div>
@endif
@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Info!</h4>
        {{ $message }}
    </div>
@endif
@if ($message = Session::get('success&vitA'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        <p>Data Berhasil Di Tambah</p>
        {{ $message }}
    </div>
@endif
@if(Session::get('info_imun'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Info!</h4>
        <p>Jadwal Tepat Imunisasi Lengkap : </p>
        <ul>
            @foreach(Session::get('info_imun') as $key)
                <li>{{ $key }}</li>
            @endforeach
        </ul>
        <a href="{{ route('imunisasi.create') }}">Imunisasi >></a>
    </div>
@endif
@if ($message = Session::get('pswd'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        <p>Data Berhasil Di Tambah</p>
        Password : {{ $message }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Pemberitahuan!</h4>
        {{ $message }}
    </div>
@endif