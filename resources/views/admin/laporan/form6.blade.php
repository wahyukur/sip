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
                    <strong>SIMPRO BALITA TAHUN 9999</strong>
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
            <td>: BLA BLA</td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th></th>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px; border: 1px solid black; border-collapse: collapse;">
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
            <tr>
                @for ($i = 1; $i < 12; $i++)
                    <td style="border-right: 1px solid black; text-align: center;">{{ $i }}</td>
                @endfor
            </tr>
        </tbody>
    </table>

    <!-- MENGETAHUI -->
    <table width="100%" style="margin: 0px">
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Surabaya, 00 Bulan 9999</td>
        </tr>
        <tr>
            <td style="padding-left: 50px;"></td>
            <td></td>
            <td style="padding-left: 630px">Ketua Kader Posyandu</td>
        </tr>
        <tr>
            <td style="padding-left: 50px; padding-top: 50px"></td>
            <td></td>
            <td style="padding-left: 630px; padding-top: 50px;">(Bu ........................)</td>
        </tr>
    </table>
</body>
</html>
