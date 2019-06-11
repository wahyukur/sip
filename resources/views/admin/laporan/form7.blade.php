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
            <td nowrap>
                <p style="font-size: 16px; margin-top: 0px; margin-bottom: 2px">
                    <strong>POSYANDU MANDIRI RT : 01-04 RW : 01</strong>
                </p>
                <p style="font-size: 16px; margin-top: 1px; margin-bottom: 2px">
                    <strong>"PUSKESMAS BENOWO KECAMATAN PAKAL"</strong>
                </p>
                <p style="font-size: 16px; margin-bottom: 0px; margin-top: 1px">
                    <strong>KELURAHAN SUMBEREJO</strong>
                </p>
            </td>
            <td align="right" style="padding-right: 40px">
                <img src="{!! asset('dist/img/logoGray2.png') !!}" alt="Logo" width="80">
            </td>
        </tr>
    </table>
    <!-- <hr width="100%" style="margin: 0px"> -->
    <br/>
    <table style="margin: 0px; font-size: 11px;">
        <tr>
            <th>KEGIATAN KE</th>
            <td> : 1</td>
        </tr>
        <tr>
            <th>HARI</th>
            <td> : 
                @php
                    $date = date("D", strtotime($data->start));
                    if ($date == 'Sun'){
                        $hari_ini = "Minggu";
                    } elseif ($date == 'Mon'){
                        $hari_ini = "Senin";
                    } elseif ($date == 'Tue'){
                        $hari_ini = "Selasa";
                    } elseif ($date == 'Wed'){
                        $hari_ini = "Rabu";
                    } elseif ($date == 'Thu'){
                        $hari_ini = "Kamis";
                    } elseif ($date == 'Fri'){
                        $hari_ini = "Jumat";
                    } elseif ($date == 'Sat'){
                        $hari_ini = "Sabtu";
                    } else {
                        $hari_ini = "Tidak di ketahui";
                    }
                @endphp
                {{ $hari_ini }}
            </td>
        </tr>
        <tr>
            <th>TANGGAL</th>
            <td> : 
                @php 
                    $tgl = date("d-m-Y", strtotime($data->start))
                @endphp
                {{ $tgl }}
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px">
        <tr>
            <!-- @if($data->gambar_kegiatan1 == null)
            @endif -->
            <td style="border: 1px solid black; text-align: center;" height="300px">
                <img src="{{ asset($data->gambar_kegiatan1) }}" alt="Logo" style="max-width: 215px;">
            </td>
            <td style="border: 1px solid black; text-align: center;" height="300px">
                <img src="{{ asset($data->gambar_kegiatan2) }}" alt="Logo" style="max-width: 215px;">
            </td>
        </tr>
    </table>

    <table style="margin: 0px; font-size: 11px;">
        <tr>
            <th>KEGIATAN KE</th>
            <td> : 2</td>
        </tr>
        <tr>
            <th>HARI</th>
            <td> : {{ $hari_ini }}</td>
        </tr>
        <tr>
            <th>TANGGAL</th>
            <td> : {{ $tgl }}</td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px">
        <tr>
            <td style="border: 1px solid black;text-align: center;" height="300px">
                <img src="{{ asset($data->pmt1) }}" alt="Logo" style="max-width: 215px;">
            </td>
            <td style="border: 1px solid black;text-align: center;" height="300px">
                <img src="{{ asset($data->pmt2) }}" alt="Logo" style="max-width: 215px;">
            </td>
        </tr>
    </table>

    <!-- MENGETAHUI -->
    <table width="100%" style="margin: 0px; text-align: center;">
        <tr>
            <td>Diketahui</td>
            <td></td>
            <td>Surabaya, 
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
            <td>PKK RW</td>
            <td>UKM {{ $data->nama_ukm }}</td>
            <td>Posyandu Mandiri</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Ketua</td>
        </tr>
        <tr>
            <td style="padding-top: 50px">(Bu {{ $data->nama_ketua }})</td>
            <td style="padding-top: 50px;">(Bu {{ $data->nama_pemilik }})</td>
            <td style="padding-top: 50px;">(Bu ........................)</td>
        </tr>
    </table>
</body>
</html>
