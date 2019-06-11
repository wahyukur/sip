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
                    <strong>LAPORAN BULANAN PELAYANAN GIZI TINGKAT POSYANDU</strong>
                </p>
                <p style="font-size: 12px; margin: 0px">
                    <strong>
                        BULAN : 
                        @php
                            function bln_indo($tanggal){
                                $bulan = array (
                                    1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                                );
                                $pecahkan = explode('-', $tanggal);

                                // variabel pecahkan 0 = tanggal
                                // variabel pecahkan 1 = bulan
                                // variabel pecahkan 2 = tahun

                                return $bulan[ (int)$pecahkan[1] ];
                            }
                            echo strtoupper(bln_indo(date('Y-m-d', strtotime($data->start))));
                        @endphp 
                        TAHUN : 
                        @php
                            $thn = date('Y', strtotime($data->start));
                            echo $thn;
                        @endphp 
                    </strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px">
        <tr>
            <th>Nama Posyandu</th>
            <td>: Mandiri</td>
            <th>RW</th>
            <td>: 01</td>
            <th>Kota</th>
            <td>: Surabaya</td>
        </tr>
        <tr>
            <th>Kelurahan</th>
            <td>: Sumberejo</td>
            <th>RT</th>
            <td>: 01-04</td>
            <th>Kader yang ada</th>
            <td>: </td>
        </tr>
        <tr>
            <th>Puskesmas</th>
            <td>: Benowo</td>
            <th></th>
            <td></td>
            <th>Kader yang aktif</th>
            <td>: </td>
        </tr>
        <tr>
            <th>Hari Buka Posyandu</th>
            <td>: 
                @php
                    $day = date('w', strtotime($data->start));
                    function hari_ini($day){
                        date_default_timezone_set('Asia/Jakarta');
                        $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                        return $seminggu[$day];
                    }
                    echo hari_ini($day);
                @endphp 
            </td>
            <th>Minggu ke-</th>
            <td>: 1</td>
            <th>Tgl Buka Posyandu</th>
            <td>: 
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
    </table>
    <table width="100%" style="font-size: 11px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th width="5%" rowspan="2" style="border: 1px solid black">No</th>
                <th width="59%" rowspan="2" colspan="5" style="border: 1px solid black">VARIABEL</th>
                <th width="10%" colspan="2" rowspan="2" style="border: 1px solid black">KODE</th>
                <th width="13%" colspan="2" style="border: 1px solid black">Gakin(A)</th>
                <th width="13%" colspan="2" style="border: 1px solid black">Gakin(B)</th>
                <th width="20%" colspan="4" style="border: 1px solid black">Total</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">L</th>
                <th style="border: 1px solid black">P</th>
                <th style="border: 1px solid black">L</th>
                <th style="border: 1px solid black">P</th>
                <th colspan="2" style="border: 1px solid black">L</th>
                <th colspan="2" style="border: 1px solid black">P</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border-right: 1px solid black">1</td>
                <td colspan="5">Juml Bayi (0-11 bln) yang ada</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(S)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S1AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S1AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S1BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S1BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S1TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S1TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">2</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang ada</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(S)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S2AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S2AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S2BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S2BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S2TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S2TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">3</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang ada</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(S)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S3AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S3AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S3BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S3BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S3TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S3TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">4</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang ada</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(S)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S4AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S4AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S4BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S4BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S4TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S4TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">5</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang ada</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(S)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S5AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S5AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S5BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S5BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S5TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $S5TP }}</td>
            </tr>

            <!-- 2 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">6</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K6AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K6AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K6BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K6BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K6TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K6TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">7</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K7AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K7AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K7BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K7BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K7TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K7TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">8</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K8AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K8AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K8BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K8BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K8TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K8TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">9</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K9AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K9AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K9BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K9BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K9TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K9TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">10</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K10AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K10AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K10BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $K10BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K10TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $K10TP }}</td>
            </tr>

            <!-- 3 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">11</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang ditimbang bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D11AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D11AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D11BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D11BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D11TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D11TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">12</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang ditimbang bulan ini</td>
                <td colspan="2" colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D12AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D12AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D12BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D12BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D12TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D12TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">13</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang ditimbang bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D13AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D13AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D13BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D13BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D13TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D13TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">14</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang ditimbang bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D14AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D14AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D14BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D14BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D14TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D14TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">15</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang ditimbang bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D15AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D15AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D15BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $D15BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D15TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $D15TP }}</td>
            </tr>

            <!-- 4 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">16</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N16AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N16AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N16BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N16BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N16TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N16TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">17</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N17AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N17AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N17BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N17BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N17TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N17TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">18</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N18AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N18AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N18BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N18BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N18TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N18TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">19</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N19AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N19AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N19BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N19BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N19TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N19TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">20</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N20AL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N20AP }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N20BL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $N20BP }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N20TL }}</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">{{ $N20TP }}</td>
            </tr>

            <!-- 5 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">21</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T21AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T21AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T21BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T21BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T21TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T21TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">22</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T22AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T22AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T22BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T22BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T22TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T22TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">23</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T23AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T23AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T23BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T23BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T23TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T23TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">24</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T24AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T24AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T24BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T24BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T24TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T24TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">25</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T25AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T25AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T25BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $T25BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T25TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $T25TP }}</td>
            </tr>

            <!-- 6 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">26</td>
                <td colspan="5" style="border-top: 1px solid black" nowrap>Juml Bayi (0-11 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T26AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T26AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T26BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T26BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T26TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T26TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">27</td>
                <td colspan="5" nowrap>Juml Anak Balita (12-23 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T27AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T27AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T27BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T27BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T27TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T27TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">28</td>
                <td colspan="5" nowrap>Juml Anak Balita (24-35 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T28AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T28AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T28BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T28BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T28TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T28TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">29</td>
                <td colspan="5" nowrap>Juml Anak Balita (36-48 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T29AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T29AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T29BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T29BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T29TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T29TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">30</td>
                <td colspan="5" nowrap>Juml Anak Balita (49-60 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T30AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T30AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T30BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $a2T30BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T30TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $a2T30TP }}</td>
            </tr>

            <!-- 7 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">31</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O31AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O31AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O31BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O31BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O31TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O31TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">32</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O32AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O32AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O32BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O32BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O32TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O32TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">33</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O33AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O33AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O33BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O33BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O33TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O33TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">34</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O34AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O34AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O34BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O34BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O34TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O34TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">35</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O35AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O35AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O35BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $O35BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O35TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $O35TP }}</td>
            </tr>

            <!-- 8 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">36</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B36AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B36AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B36BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B36BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B36TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B36TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">37</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B37AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B37AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B37BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B37BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B37TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B37TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">38</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B38AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B38AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B38BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B38BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B38TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B38TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">39</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B39AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B39AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B39BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B39BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B39TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B39TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">40</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B40AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B40AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B40BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $B40BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B40TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $B40TP }}</td>
            </tr>

            <!-- 9 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">41</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM41AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM41AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM41BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM41BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM41TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM41TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">42</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM42AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM42AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM42BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM42BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM42TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM42TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">43</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM43AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM43AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM43BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM43BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM43TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM43TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">44</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM44AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM44AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM44BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM44BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM44TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM44TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black">45</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM45AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM45AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM45BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BGM45BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM45TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BGM45TP }}</td>
            </tr>

            <!-- 10 -->
            <tr>
                <td style="border-right: 1px solid black"></td>
                <td colspan="5" style="border-right: 1px solid black; border-top: 1px solid black"><strong>STATUS GIZI BB/U DARI BALITA YANG DATANG (D)</strong></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">46</td>
                <td colspan="5">Jumlah Balita dengan BB Sangat Kurang</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BSK)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BSK46AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BSK46AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BSK46BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BSK46BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BSK46TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BSK46TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">47</td>
                <td colspan="5">Jumlah Balita dengan BB Kurang</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BBK)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBK47AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBK47AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBK47BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBK47BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BBK47TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BBK47TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">48</td>
                <td colspan="5">Jumlah Balita dengan BB Normal</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BBN)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBN48AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBN48AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBN48BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBN48BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BBN48TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BBN48TP }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">49</td>
                <td colspan="5">Jumlah Balita dengan BB Lebih</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BBL)</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBL49AL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBL49AP }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBL49BL }}</td>
                <td style="border: 1px solid black;text-align: center;">{{ $BBL49BP }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BBL49TL }}</td>
                <td colspan="2" style="border: 1px solid black;text-align: center;">{{ $BBL49TP }}</td>
            </tr>
        </tbody>
    </table>

    <!-- MENGETAHUI -->
    <table width="100%" style="margin: 0px">
        <tr>
            <td>Mengetahui</td>
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
            <td>Ketua Kader Posyandu</td>
            <td></td>
            <td style="padding-left: 270px">Kader yang membuat laporan</td>
        </tr>
        <tr>
            <td style="padding-top: 70px">(Bu ........................)</td>
            <td></td>
            <td style="padding-top: 70px; padding-left: 270px">(Bu ........................)</td>
        </tr>
    </table>
</body>
</html>
