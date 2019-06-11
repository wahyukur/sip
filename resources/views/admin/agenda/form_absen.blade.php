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
    <table width="100%" style="text-align: center; margin: 0px; font-size: 11px;">
        <tr>
            <td>
                <p style="font-size: 11px; margin: 0px">
                    <strong>DAFTAR HADIR</strong>
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px">
        <tr>
            <th>KEGIATAN</th>
            <td>: </td>
            <th></th>
            <td></td>
        </tr>
        <tr>
            <th>KELURAHAN</th>
            <td>: SUMBERREJO</td>
            <th>PUSKESMAS</th>
            <td>: BENOWO</td>
        </tr>
        <tr>
            <th>RW/RT</th>
            <td>: 1/01-04</td>
            <th>BULAN</th>
            <td>: </td>
        </tr>
        <tr>
            <th>NAMA POSYANDU</th>
            <td>: MANDIRI SUMBERREJO</td>
            <th>TANGGAL</th>
            <td>: </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px; border: 1px solid black; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th rowspan="2" style="border: 1px solid black">NO</th>
                <th rowspan="2" style="border: 1px solid black">NAMA BALITA</th>
                <th rowspan="2" style="border: 1px solid black">L/P</th>
                <th colspan="2" style="border: 1px solid black">NAMA ORANG TUA</th>
                <th rowspan="2" style="border: 1px solid black">ALAMAT/RT</th>
                <th rowspan="2" colspan="2" style="border: 1px solid black">TANDA TANGAN</th>
            </tr>
            <tr>
                <th style="border: 1px solid black">BAPAK</th>
                <th style="border: 1px solid black">IBU</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data1 as $data1s)
                <tr>
                    <td style="border: 1px solid black; text-align: center;">{{ $no++ }}</td>
                    <td style="border: 1px solid black;">nama balita</td>
                    <td style="border: 1px solid black; text-align: center;">l/p</td>
                    <td style="border: 1px solid black;">nama bapak</td>
                    <td style="border: 1px solid black;">nama ibu</td>
                    <td style="border: 1px solid black;">alamat</td>
                    <td style="border: 1px solid black;">ttd ganjil</td>
                    <td style="border: 1px solid black;">ttd genap</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
