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
                    <strong>REKAP NAMA BALITA GIZI BURUK - GIBUR</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>BERDASARKAN BB/TB (SANGAT KURUS)</strong>
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
    <table width="100%" style="font-size: 10px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th colspan="2" style="border: 1px solid black">ORTU</th>
                <th colspan="2" style="border: 1px solid black">ST KLRG</th>
                <th colspan="2" style="border: 1px solid black">BALITA</th>
                <th colspan="2" style="border: 1px solid black">JENIS KEL</th>
                <th rowspan="3" style="border: 1px solid black">TGL LAHIR/UMUR BULAN</th>
                <th rowspan="3" style="border: 1px solid black">BB (KG)</th>
                <th rowspan="3" style="border: 1px solid black">TB (Cm)</th>
                <th colspan="2" style="border: 1px solid black">KASUS</th>
                <th style="border: 1px solid black">(BB/U)</th>
                <th colspan="3" style="border: 1px solid black">Gizi Buruk Klinis</th>
                <th colspan="3" style="border: 1px solid black">ST.GIZI (BB/TB)</th>
                <th colspan="2" style="border: 1px solid black">PENANGANAN</th>
                <th colspan="5" style="border: 1px solid black">PENYEBAB UTAMA</th>
                <th rowspan="3" style="border: 1px solid black">
                    ALASAN<br/>BALITA<br/>GIBUR<br/>BARU<br/>DITEMU<br/>KAN/<br/>TETAP<br/>GIBUR
                </th>
                <th colspan="5" style="border: 1px solid black">HASIL TINDAKAN</th>
            </tr>
            <tr>
                <th rowspan="2" style="border: 1px solid black">NAMA</th>
                <th rowspan="2" style="border: 1px solid black">NO.KTP SBY/LUAR SBY</th>
                <th rowspan="2" style="border: 1px solid black">(G)</th>
                <th rowspan="2" style="border: 1px solid black">(NG)</th>
                <th rowspan="2" style="border: 1px solid black">NO URUT</th>
                <th rowspan="2" style="border: 1px solid black">NAMA</th>
                <th rowspan="2" style="border: 1px solid black">L</th>
                <th rowspan="2" style="border: 1px solid black">P</th>
                <th rowspan="2" style="border: 1px solid black; ">
                    <p style="
                    top: 15px;
                    transform: rotate(-90deg);
                    padding: 0px;
                    margin: 0px">BARU</p>
                </th>
                <th rowspan="2" style="border: 1px solid black"><p style="
                    top: 15px;
                    transform: rotate(-90deg);
                    padding: 0px;
                    margin: 0px">LAMA</p>
                </th>
                <th rowspan="2" style="border: 1px solid black">Sgt Krg</th>
                <th rowspan="2" style="border: 1px solid black">MRS</th>
                <th rowspan="2" style="border: 1px solid black">KWS</th>
                <th rowspan="2" style="border: 1px solid black">MRS-KWS</th>
                <th rowspan="2" style="border: 1px solid black">Sgt Kurus</th>
                <th rowspan="2" style="border: 1px solid black">Kurus</th>
                <th rowspan="2" style="border: 1px solid black">Normal</th>
                <th rowspan="2" style="border: 1px solid black">PMT-FORM<br/>ULA<br/>PUSK<br/>ESMAS</th>
                <th rowspan="2" style="border: 1px solid black">Lain2 PKK RW KEL</th>
                <th rowspan="2" style="border: 1px solid black">BBLR<br/>(BB&#60;2500<br/>gram)</th>
                <th rowspan="2" style="border: 1px solid black">SAKIT</th>
                <th rowspan="2" style="border: 1px solid black">KEMIS<br/>KINAN</th>
                <th rowspan="2" style="border: 1px solid black">PENGET<br/>AHUAN</th>
                <th rowspan="2" style="border: 1px solid black">LAIN2<br/>SEBUT<br/>KAN</th>
                <th rowspan="2" style="border: 1px solid black">DO</th>
                <th rowspan="2" style="border: 1px solid black">S</th>
                <th rowspan="2" style="border: 1px solid black">M</th>
                <th colspan="2" style="border: 1px solid black">ES</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">PUSK</th>
                <th style="border: 1px solid black">RS</th>
            </tr>
        </thead>
        <tbody>
            @if (count($data) >= 1)
                @php $no = 1; @endphp
                @foreach($data as $datas)
                <tr>
                    <td style="border: 1px solid black;">{{ $datas->nama_ibu }}</td>
                    <td style="border: 1px solid black;">{{ $datas->NIK }}</td>
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
                    <td style="border: 1px solid black;">{{ $no++ }}</td>
                    <td style="border: 1px solid black;">{{ $datas->nama_anak }}</td>
                    <td style="border: 1px solid black;">
                        @if($datas->jenis_kelamin == 0)
                            &Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if($datas->jenis_kelamin == 1)
                            &Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        {{ date('d-m-Y', strtotime($datas->tgl_lhr)) }}<br/>
                        {{ $datas->umur }} Bulan
                    </td>
                    <td style="border: 1px solid black;">{{ $datas->berat_badan }}</td>
                    <td style="border: 1px solid black;">{{ $datas->tinggi_badan }}</td>
                    <td style="border: 1px solid black;">
                        @if ($datas->kasus == 1)
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->kasus == 0)
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">&radic;</td>
                    <td style="border: 1px solid black;">
                        @if ($datas->gibur_klinis == 'MRS')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->gibur_klinis == 'KWS')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->gibur_klinis == 'MRS-KWS')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->st_gizi_bbtb == 'Sangat Kurus')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->st_gizi_bbtb == 'Kurus')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->st_gizi_bbtb == 'Normal')
                            Y
                        @endif
                    </td>
                    @if ($datas->penanganan == 'PMT-FORMULA PUSKESMAS')
                        <td style="border: 1px solid black;">Y</td>
                        <td style="border: 1px solid black;"></td>
                    @else
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;">{{ $datas->penanganan }}</td>
                    @endif

                    @if ($datas->penyebab_utama == 'BBLR (BB<=2500 gram)')
                        <td style="border: 1px solid black;">Y</td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                    @elseif ($datas->penyebab_utama == 'SAKIT')
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;">Y</td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                    @elseif ($datas->penyebab_utama == 'KEMISKINAN')
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;">Y</td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                    @elseif ($datas->penyebab_utama == 'PENGETAHUAN')
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;">Y</td>
                        <td style="border: 1px solid black;"></td>
                    @else
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;">{{ $datas->penyebab_utama }}</td>
                    @endif
                    <td style="border: 1px solid black;">{{ $datas->alasan_gibur }}</td>
                    <td style="border: 1px solid black;">
                        @if ($datas->tindakan == 'DO')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->tindakan == 'S')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->tindakan == 'M')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->tindakan == 'PUSK')
                            Y
                        @endif
                    </td>
                    <td style="border: 1px solid black;">
                        @if ($datas->tindakan == 'RS')
                            Y
                        @endif
                    </td>
                </tr>
                @endforeach
                @for ($i = 1; $i < 15-count($data); $i++)
                    <tr>
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
                @for ($i = 1; $i < 15; $i++)
                    <tr>
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
            <td style="padding-left: 50px; padding-top: 50px">(Bu ........................)</td>
            <td></td>
            <td style="padding-left: 500px; padding-top: 50px;">(Bu ........................)</td>
        </tr>
    </table>
</body>
</html>
