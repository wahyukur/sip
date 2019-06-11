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
                <p style="font-size: 12px; margin: 0px">
                    <strong>REKAP NAMA "BALITA 2T" DAN "BGM"</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>BERDASARKAN BB/U (SANGAT KURANG)</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px">
        <tr>
            <th>Bulan</th>
            <td>: 
                @php
                    function bln_indo($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
                        return $bulan[ (int)$pecahkan[1] ];
                    }
                    echo strtoupper(bln_indo(date('Y-m-d', strtotime($data_bln->tgl_timbang))));
                @endphp
            </td>
            <th>Posyandu</th>
            <td>: Mandiri</td>
        </tr>
        <tr>
            <th>Kelurahan</th>
            <td>: Sumberejo</td>
            <th>RW</th>
            <td>: 01</td>
        </tr>
        <tr>
            <th></th>
            <td></td>
            <th>RT</th>
            <td>: 01-04</td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">No</th>
                <th colspan="2" style="border: 1px solid black">Kasus</th>
                <th rowspan="2" style="border: 1px solid black">Nama Balita</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th rowspan="2" style="border: 1px solid black">Tanggal Lahir</th>
                <th rowspan="2" style="border: 1px solid black">Umur Bulan</th>
                <th rowspan="2" style="border: 1px solid black">BB (Kg)</th>
                <th rowspan="2" style="border: 1px solid black">TB (Cm)</th>
                <th rowspan="2" style="border: 1px solid black">Nama Orang Tua</th>
                <th rowspan="2" style="border: 1px solid black">Alamat RT/RW</th>
                <th rowspan="2" style="border: 1px solid black">No.KTP/KSK</th>
                <th colspan="2" style="border: 1px solid black">BALITA "2T"</th>
                <th colspan="2" style="border: 1px solid black">BALITA "BGM"</th>
                <th colspan="2" style="border: 1px solid black">Keterangan</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">B</th>
                <th style="border: 1px solid black">L</th>
                <th style="border: 1px solid black">Penyebab</th>
                <th style="border: 1px solid black">BB/U</th>
                <th style="border: 1px solid black">Penyebab</th>
                <th style="border: 1px solid black">BB/U</th>
                <th style="border: 1px solid black">Non Gakin</th>
                <th style="border: 1px solid black">Gakin</th>
            </tr>
        </thead>
        <tbody>
            @if (count($data) >= 1)
                @php $no = 1; @endphp
                @foreach($data as $datas)
                <tr>
                    <td style="border: 1px solid black;">{{ $no++ }}</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;">{{ $datas->nama_anak }}</td>
                    <td style="border: 1px solid black;">
                        @if ($datas->jenis_kelamin == 0)
                            L
                        @else
                            P
                        @endif
                    </td>
                    <td style="border: 1px solid black;">{{ date('d-m-Y', strtotime($datas->tgl_lhr)) }}</td>
                    <td style="border: 1px solid black;">{{ $datas->umur }} Bulan</td>
                    <td style="border: 1px solid black;">{{ $datas->berat_badan }}</td>
                    <td style="border: 1px solid black;">{{ $datas->tinggi_badan }}</td>
                    <td style="border: 1px solid black;">{{ $datas->nama_ibu }} & {{ $datas->nama_suami }}</td>
                    <td style="border: 1px solid black;">{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                    <td style="border: 1px solid black;">{{ $datas->No_KK }}</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;">
                        @if($datas->ket_timbang == 'Balita 2T' or $datas->ket_timbang == 'Balita 2T & BGM')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;">
                        @if($datas->ket_timbang == 'Balita BGM' or $datas->ket_timbang == 'Balita 2T & BGM')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if($datas->gakin == 0)
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if($datas->gakin == 1)
                            Y
                        @endif
                    </td>
                </tr>
                @endforeach
                @for ($i = 1; $i < 19-count($data); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @for ($i = 1; $i < 19; $i++)
                    <tr>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @endif
        </tbody>
    </table>

    <!-- MENGETAHUI -->
    <table width="100%" style="margin: 0px">
        <tr>
            <td style="padding-left: 50px;">Mengetahui</td>
            <td></td>
            <td style="padding-left: 500px">Surabaya, 
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
            <td style="padding-left: 50px;">Ketua Kader Posyandu</td>
            <td></td>
            <td style="padding-left: 500px">Kader yang membuat laporan</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px">(Bu ........................)</td>
            <td></td>
            <td style="padding-left: 500px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>
</body>
</html>
