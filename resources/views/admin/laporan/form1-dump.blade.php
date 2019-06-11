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
                        <!-- @php
                            $bln = date('F', strtotime($data->start));
                            echo strtoupper($bln);
                        @endphp  -->
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
                <td style="border: 1px solid black; text-align: center;">{{ $S1aL }}</td>
                <td style="border: 1px solid black; text-align: center;">{{ $S1aP }}</td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black; text-align: center;"></td>
                <td colspan="2" style="border: 1px solid black; text-align: center;"></td>
                <td colspan="2" style="border: 1px solid black; text-align: center;"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">2</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang ada</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(S)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">3</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang ada</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(S)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">4</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang ada</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(S)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">5</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang ada</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(S)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 2 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">6</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">7</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">8</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">9</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">10</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang terdaftar dan punya KMS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(K)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 3 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">11</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang ditimbang bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">12</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang ditimbang bulan ini</td>
                <td colspan="2" colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">13</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang ditimbang bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">14</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang ditimbang bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">15</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang ditimbang bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(D)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 4 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">16</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">17</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">18</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">19</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">20</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(N)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 5 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">21</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">22</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">23</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">24</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">25</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang tidak naik BB nya bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 6 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">26</td>
                <td colspan="5" style="border-top: 1px solid black" nowrap>Juml Bayi (0-11 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">27</td>
                <td colspan="5" nowrap>Juml Anak Balita (12-23 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">28</td>
                <td colspan="5" nowrap>Juml Anak Balita (24-35 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">29</td>
                <td colspan="5" nowrap>Juml Anak Balita (36-48 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">30</td>
                <td colspan="5" nowrap>Juml Anak Balita (49-60 bln) yang tidak naiknya 2 kali berturut-turut bulan ini</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(2T)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 7 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">31</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">32</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">33</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">34</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">35</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang tidak timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(O)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 8 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">36</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">37</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">38</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">39</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">40</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) yang baru timbang bulan lalu</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 9 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black">41</td>
                <td colspan="5" style="border-top: 1px solid black">Juml Bayi (0-11 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">42</td>
                <td colspan="5">Juml Anak Balita (12-23 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">43</td>
                <td colspan="5">Juml Anak Balita (24-35 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">44</td>
                <td colspan="5">Juml Anak Balita (36-48 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black; border-bottom: 1px solid black">45</td>
                <td colspan="5">Juml Anak Balita (49-60 bln) dengan BB Bawah Garis Merah</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BGM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
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
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">47</td>
                <td colspan="5">Jumlah Balita dengan BB Kurang</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BBK)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">48</td>
                <td colspan="5">Jumlah Balita dengan BB Normal</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BBN)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">49</td>
                <td colspan="5">Jumlah Balita dengan BB Lebih</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BBL)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 11 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black"></td>
                <td colspan="5" style="border-right: 1px solid black; border-top: 1px solid black"><strong>TANDA - TANDA KLINIS</strong></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">50</td>
                <td colspan="5">Jumlah Balita dengan tanda Tampak kurus</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(TK)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">51</td>
                <td colspan="5">Jumlah Balita dengan MARASMUS</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(TM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">52</td>
                <td colspan="5">Jumlah Balita dengan KWASIORKOR</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(TKW)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">53</td>
                <td colspan="5">Jumlah Balita dengan MARASMUS-KWASIORKOR</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(TMK)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            
            <!-- 12 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black"></td>
                <td colspan="5" style="border-right: 1px solid black; border-top: 1px solid black"><strong>HASIL VERIFIKASI (BB/TB atau (BB/PB) DARI 2T & BGM (2T+BGM=...))</strong></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">54</td>
                <td colspan="5">Jumlah Balita Sangat Kurus</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BTBSK)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">55</td>
                <td colspan="5">Jumlah Balita Kurus</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BTBK)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">56</td>
                <td colspan="5">Jumlah Balita Normal</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BTBN)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">57</td>
                <td colspan="5">Jumlah Balita Gemuk</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BTBG)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 13 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black"></td>
                <td colspan="5" style="border-right: 1px solid black; border-top: 1px solid black"><strong>PEMBERIAN MP-ASI (ini yang dapat dari Puskesmas)</strong></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">58</td>
                <td colspan="5">Jumlah Bayi (6-11 bln) BGM Gakin</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BY6-BGM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">59</td>
                <td colspan="5">Jumlah Bayi (6-11 bln) BGM Gakin dapat MP ASI</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(MP6-GK)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">60</td>
                <td colspan="5">Jumlah Bayi (12-24 bln) BGM Gakin</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B24-BGM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">61</td>
                <td colspan="5">Jumlah Bayi (12-24 bln) BGM Gakin dapat MP ASI</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(MP24-GK)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 14 -->
            <tr>
                <td style="border-right: 1px solid black">62</td>
                <td colspan="5">Jumlah Bayi (6-11 bln) Non BGM Gakin</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(BY6-BGM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">63</td>
                <td colspan="5">Jumlah Bayi (6-11 bln) Non BGM Gakin dapat MP ASI</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(MP6-GK)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">64</td>
                <td colspan="5">Jumlah Bayi (12-24 bln) Non BGM Gakin</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(B24-BGM)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">65</td>
                <td colspan="5">Jumlah Bayi (12-24 bln) Non BGM Gakin dapat MP ASI</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(MP24-GK)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 15 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black"></td>
                <td colspan="5" style="border-right: 1px solid black; border-top: 1px solid black"><strong>Penanggulangan KVA (kolom ini diisi pd Bulan Feb-Agustus)</strong></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">66</td>
                <td colspan="5">Jumlah Bayi (6-12 bln) yang dapat Vitamin A 1 kali bulan ini (kapsul biru:100.000 IU)</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(A0)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">67</td>
                <td colspan="5">Jumlah Anak (1-4 thn) dapat Vitamin A (200.000 IU) 1 kali tahun ini Februari/Agustus</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(A1)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">68</td>
                <td colspan="5">Jumlah Anak (1-4 thn) dapat Vitamin A (200.000 IU) 2 kali tahun ini (Agustus)</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(A2)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">69</td>
                <td colspan="5">Jumlah Balita yang menerima 9 kapsul Vit A</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">(A9)</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>

            <!-- 16 -->
            <tr>
                <td style="border-right: 1px solid black; border-top: 1px solid black"></td>
                <td colspan="5" style="border-right: 1px solid black; border-top: 1px solid black"><strong>ASI EKSLUSIF :</strong></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
                <td colspan="2" style="border-top: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">70</td>
                <td colspan="5">JUMLAH BAYI DENGAN ASI EKSLUSIF: (Umur 0-6 bulan)</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
                <td colspan="2" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td rowspan="4" style="border: 1px solid black; text-align: center;"></td>
                <td rowspan="2" style="border: 1px solid black; text-align: center;"></td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">E0</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">E1</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">E2</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">E3</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">E4</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">E5</td>
                <td colspan="2" style="border: 1px solid black; text-align: center;">E6</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center;">L</td>
                <td style="border: 1px solid black; text-align: center;">P</td>
                <td style="border: 1px solid black; text-align: center;">L</td>
                <td style="border: 1px solid black; text-align: center;">P</td>
                <td style="border: 1px solid black; text-align: center;">L</td>
                <td style="border: 1px solid black; text-align: center;">P</td>
                <td style="border: 1px solid black; text-align: center;">L</td>
                <td style="border: 1px solid black; text-align: center;">P</td>
                <td style="border: 1px solid black; text-align: center;">L</td>
                <td style="border: 1px solid black; text-align: center;">P</td>
                <td style="border: 1px solid black; text-align: center;">L</td>
                <td style="border: 1px solid black; text-align: center;">P</td>
                <td style="border: 1px solid black; text-align: center;">L</td>
                <td style="border: 1px solid black; text-align: center;">P</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">Ya</td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
                <td style="text-align: center;  border-right: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid black">Tidak</td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
                <td style="text-align: center; border-right: 1px solid black"></td>
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
