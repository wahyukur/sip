<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Anak</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body>
    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 40px">
                <img src="{!! asset('dist/img/logoGray.png') !!}" alt="Logo" width="80">
            </td>
            <td>
                <p style="font-size: 12px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PAGUYUBAN KADER BALITA</strong>
                </p>
                <p style="font-size: 15px">
                    <strong>"BHAKTI MULIA KASIH"</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>PUSKESMAS BENOWO KEC.PAKAL</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 40px">
                <img src="{!! asset('dist/img/logoGray2.png') !!}" alt="Logo" width="80">
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 14px; margin: 0px">
                    <strong>DATA BALITA YANG TIDAK BISA HADIR</strong>
                </p>
            </td>
        </tr>
    </table>
    <table style="font-size: 11px; width: 100%">
        <tr>
            <th style="width: 25%">DI POSYANDU</th>
            <td>: Mandiri</td>
            <th>Jumlah Balita Riil</th>
            <td>: {{ $data1 }}</td>
        </tr>
        <tr>
            <th style="width: 25%">RT</th>
            <td>: 01-04</td>
            <th>Jumlah Balita yg dpt PMT dari Puskesmas</th>
            <td>: </td>
        </tr>
        <tr>
            <th style="width: 25%">RW</th>
            <td>: 01</td>
            <th>Jumlah Balita yg tidak Hadir</th>
            <td>: {{ count($data) }}</td>
        </tr>
        <tr>
            <th style="width: 25%">KELURAHAN</th>
            <td>: Sumberejo</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">No</th>
                <th nowrap rowspan="2" style="border: 1px solid black">NAMA BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th rowspan="2" style="border: 1px solid black">UMUR (BULAN)</th>
                <th rowspan="2" style="border: 1px solid black">BB KG</th>
                <th rowspan="2" style="border: 1px solid black">TB CM</th>
                <th rowspan="2" style="border: 1px solid black">STATUS GIZI (BB/U)</th>
                <th colspan="5" style="border: 1px solid black">DIISI TANGGAL SAAT DIKUNJUNGI</th>
                <th rowspan="2" style="border: 1px solid black">KETERANGAN</th>
                <th rowspan="2" style="border: 1px solid black">TANDA TANGAN YG DIKUNJUNGI</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">KETIDURAN</th>
                <th style="border: 1px solid black">PERGI</th>
                <th style="border: 1px solid black">SAKIT</th>
                <th style="border: 1px solid black">LUPA</th>
                <th style="border: 1px solid black">DLL</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data) >= 1)
                @php $no = 1; @endphp
                @foreach($data as $datas)
                <tr>
                    <td style="border: 1px solid black;">{{ $no++ }}</td>
                    <td style="border: 1px solid black;">{{ $datas->nama_anak }}</td>
                    <td style="border: 1px solid black;">
                        @if ($datas->jenis_kelamin == 0)
                            L
                        @else
                            P
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @php
                        $date = date("Y-m-d");
                        $timeStart = strtotime("$datas->tgl_lhr");
                        $timeEnd = strtotime("$date");
                        // Menambah bulan ini + semua bulan pada tahun sebelumnya
                        $numBulan = (date("Y",$timeEnd)-date("Y",$timeStart))*12;
                        // menghitung selisih bulan
                        $numBulan += date("m",$timeEnd)-date("m",$timeStart);

                        echo $numBulan;
                        @endphp
                        Bulan
                    </td>
                    <td style="border: 1px solid black;">{{ $datas->berat_badan }}</td>
                    <td style="border: 1px solid black;">{{ $datas->tinggi_badan }}</td>
                    <td style="border: 1px solid black;">{{ $datas->status_gizi }}</td>
                    <td style="border: 1px solid black;">
                        @if($datas->alasan == 'Ketiduran')
                            {{ date('d/m/y', strtotime($datas->tgl_kunjungan)) }}
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if($datas->alasan == 'Pergi')
                            {{ date('d/m/y', strtotime($datas->tgl_kunjungan)) }}
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if($datas->alasan == 'Sakit')
                            {{ date('d/m/y', strtotime($datas->tgl_kunjungan)) }}
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if($datas->alasan == 'Lupa')
                            {{ date('d/m/y', strtotime($datas->tgl_kunjungan)) }}
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if($datas->alasan == 'DLL')
                            {{ date('d/m/y', strtotime($datas->tgl_kunjungan)) }}
                        @endif
                    </td>
                    <td style="border: 1px solid black;">{{ $datas->ket_hadir }}</td>
                    <td style="border: 1px solid black;">TTD</td>
                </tr>
                @endforeach
                @for ($i = 1; $i < 34-count($data); $i++)
                    <tr>
                        <td style="border: 1px solid black">{{ $no++ }}</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 34; $i++)
                    <tr>
                        <td style="border: 1px solid black">{{ $no++ }}</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                        <td style="border: 1px solid black; color: white">A</td>
                    </tr>
                @endfor
            @endif
        </tbody>
    </table>

    <!-- MENGETAHUI -->
    <table width="100%" style="margin: 0px">
        <tr>
            <td style="padding-left: 30px">Mengetahui</td>
            <td></td>
            <td style="padding-left: 270px">
                Surabaya, 
                @php
                    function tgl_indon($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indon(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 30px">Ketua Kader Posyandu</td>
            <td></td>
            <td style="padding-left: 270px">Kader yang membuat laporan</td>
        </tr>
        <tr>
            <td style="padding-top: 70px; padding-left: 30px">(Bu ........................)</td>
            <td></td>
            <td style="padding-top: 70px; padding-left: 270px">(Bu ........................)</td>
        </tr>
    </table>
</body>
</html>
