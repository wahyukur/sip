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
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 0-11 BULAN (L)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo1($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo1(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data0_11L) >= 1)
                @php $no = 1; @endphp
                @foreach($data0_11L as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data0_11L); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indoa($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indoa(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>

    <!-- PAGE BREAK -->
    <div class="page_break" style="page-break-before: always;"></div>

    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 12-23 BULAN (L)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo2($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo2(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data12_23L) >= 1)
                @php $no = 1; @endphp
                @foreach($data12_23L as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data12_23L); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indob($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indob(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>

    <!-- PAGE BREAK -->
    <div class="page_break" style="page-break-before: always;"></div>

    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 24-35 BULAN (L)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo3($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo3(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data24_35L) >= 1)
                @php $no = 1; @endphp
                @foreach($data24_35L as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data24_35L); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indoc($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indoc(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>

    <!-- PAGE BREAK -->
    <div class="page_break" style="page-break-before: always;"></div>

    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 36-48 BULAN (L)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo4($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo4(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data36_48L) >= 1)
                @php $no = 1; @endphp
                @foreach($data36_48L as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data36_48L); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indod($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indod(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>

    <!-- PAGE BREAK -->
    <div class="page_break" style="page-break-before: always;"></div>

    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 49-60 BULAN (L)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo5($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo5(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data49_60L) >= 1)
                @php $no = 1; @endphp
                @foreach($data49_60L as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data49_60L); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indoe($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indoe(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>

    <!-- PAGE BREAK Perempuan -->
    <div class="page_break" style="page-break-before: always;"></div>

    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 0-11 BULAN (P)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo6($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo6(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data0_11P) >= 1)
                @php $no = 1; @endphp
                @foreach($data0_11P as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data0_11P); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indof($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indof(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>

    <!-- PAGE BREAK -->
    <div class="page_break" style="page-break-before: always;"></div>

    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 12-23 BULAN (P)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo7($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo7(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data12_23P) >= 1)
                @php $no = 1; @endphp
                @foreach($data12_23P as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data12_23P); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indog($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indog(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>

    <!-- PAGE BREAK -->
    <div class="page_break" style="page-break-before: always;"></div>

    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 24-35 BULAN (P)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo8($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo8(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data24_35P) >= 1)
                @php $no = 1; @endphp
                @foreach($data24_35P as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data24_35P); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indoh($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indoh(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>

    <!-- PAGE BREAK -->
    <div class="page_break" style="page-break-before: always;"></div>

    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 36-48 BULAN (P)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo9($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo9(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data36_48P) >= 1)
                @php $no = 1; @endphp
                @foreach($data36_48P as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data36_48P); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indoi($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indoi(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>

    <!-- PAGE BREAK -->
    <div class="page_break" style="page-break-before: always;"></div>

    <!-- KOP LAPORAN -->
    <table width="100%" style="text-align: center; margin: 0px">
        <tr>
            <td align="top" style="padding-left: 190px;">
                <img src="{!! asset('dist/img/logoGray3.png') !!}" alt="Logo" width="60">
            </td>
            <td>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>PEMERINTAH KOTA SURABAYA</strong>
                </p>
                <p style="font-size: 15px; margin-top: 0px; margin-bottom: 0px">
                    <strong>DINAS KESEHATAN</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>UPTD PUSKESMAS BENOWO</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Jl. Raya Benowo No.7 Surabaya (60195)</strong>
                </p>
                <p style="font-size: 12px; margin-bottom: 0px; margin-top: 0px">
                    <strong>Telp. (031)7405936</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 140px">
                <p style="font-size: 16px">
                    <strong>UMUR : 49-60 BULAN (P)</strong>
                </p>
            </td>
        </tr>
    </table>
    <hr width="100%" style="margin: 0px">
    <br/>
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0px">
                    <strong>SIMPRO BALITA TAHUN 
                        @if($data_bln != null)
                            {{date('Y', strtotime($data_bln->tgl_vitA))}}
                        @endif
                    </strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>PKM BENOWO KEC. PAKAL</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>VITAMIN A</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px" style="border: 1px solid black">
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI</td>
            <th>KELURAHAN</th>
            <td>: SUMBEREJO</td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>BULAN</th>
            <td>: 
                @php
                    if($data_bln != null){
                        function bln_indo10($tanggal){
                            $bulan = array (
                                1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            return $bulan[ (int)$pecahkan[1] ];
                        }
                        echo strtoupper(bln_indo10(date('Y-m-d', strtotime($data_bln->tgl_vitA))));
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 12px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NO. KK</th>
                <th rowspan="2" style="border: 1px solid black">NO. NIK BALITA</th>
                <th rowspan="2" style="border: 1px solid black">NAMA LENGKAP BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="3" style="border: 1px solid black">TGL LAHIR</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT/RW</th>
                <th colspan="2" style="border: 1px solid black">TGL PEMBERIAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">TGL</th>
                <th style="border: 1px solid black">BLN</th>
                <th style="border: 1px solid black">THN</th>
                <th style="border: 1px solid black">VIT.A BIRU</th>
                <th style="border: 1px solid black">VIT.A MERAH</th>
            </tr>
        </thead>
        <tbody>
            @if(count($data49_60P) >= 1)
                @php $no = 1; @endphp
                @foreach($data49_60P as $datas)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->No_KK }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->NIK_anak }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->nama_anak }}</td>
                        <td style="border: 1px solid black;">
                            @if ($datas->jenis_kelamin == 0)
                                L
                            @else
                                P
                            @endif
                        </td>
                        <td style="border: 1px solid black;">{{ date('d', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('m', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;">{{ date('Y', strtotime($datas->tgl_lhr)) }}</td>
                        <td style="border: 1px solid black;" nowrap>{{ $datas->alamat }} 0{{ $datas->rt }}/0{{ $datas->rw }}</td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Biru')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if($datas->keterangan == 'Vitamin A Merah')
                                {{ $datas->tgl_vitA }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                @for ($i = 1; $i < 12-count($data49_60P); $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                    </tr>
                @endfor
            @else
                @php $no = 1; @endphp
                @for ($i = 1; $i < 12; $i++)
                    <tr>
                        <td style="border: 1px solid black;">{{ $no++ }}</td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white" nowrap></td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white">Y</td>
                        <td style="border: 1px solid black;color: white" nowrap>Y</td>
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
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 
                @php
                    function tgl_indoj($tanggal){
                        $bulan = array (
                            1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
 
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $a = tgl_indoj(date('Y-m-d'));
                @endphp
                {{ $a }}
            </td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 70px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 70px;">(Bu ........................)</td>
        </tr>
    </table>
</body>
</html>
