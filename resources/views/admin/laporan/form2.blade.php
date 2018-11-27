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
    <table width="100%" style="font-size: 11px">
        <tr>
            <th>DI POSYANDU</th>
            <td>: Mandiri</td>
            <th>Jumlah Balita Riil</th>
            <td>: </td>
        </tr>
        <tr>
            <th>RT</th>
            <td>: 01-04</td>
            <th>Jumlah Balita yg dpt PMT dari Puskesmas</th>
            <td>: </td>
        </tr>
        <tr>
            <th>RW</th>
            <td>: 01</td>
            <th>Jumlah Balita yg tidak Hadir</th>
            <td></td>
        </tr>
        <tr>
            <th>KELURAHAN</th>
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
            @for ($i = 1; $i < 34; $i++)
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
                </tr>
            @endfor
        </tbody>
    </table>

    <!-- MENGETAHUI -->
    <table width="100%" style="margin: 0px">
        <tr>
            <td style="padding-left: 30px">Mengetahui</td>
            <td></td>
            <td style="padding-left: 270px">Surabaya, ..................</td>
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
