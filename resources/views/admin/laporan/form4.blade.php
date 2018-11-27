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
            <td>: </td>
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
            <tr>
                @for ($i = 1; $i < 19; $i++)
                    <td style="border-right: 1px solid black; text-align: center;">{{ $i }}</td>
                @endfor
            </tr>
        </tbody>
    </table>

    <!-- MENGETAHUI -->
    <table width="100%" style="margin: 0px">
        <tr>
            <td style="padding-left: 50px;">Mengetahui</td>
            <td></td>
            <td style="padding-left: 500px">Surabaya, 00 Bulan 9999</td>
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
