<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Export Excel Data Anak</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Anak</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Tempat/Tanggal Lahir</th>
                <th>Berat Badan Lahir</th>
                <th>Tinggi Badan Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Anak-Ke</th>
                <th>Jenis Persalinan</th>
                <th>Tempat Bersalin</th>
                <th>Pembantu Persalinan</th>
                <th>NIK</th>
                <th>No. BPJS</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($anakData as $dataAnak)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $dataAnak->nama_anak }}</td>
                <td>{{ $dataAnak->nama_suami }}</td>
                <td>{{ $dataAnak->nama_ibu }}</td>
                <td>
                    @php
                        $date = date("d-m-Y", strtotime($dataAnak->tgl_lhr))
                    @endphp
                    {{ $dataAnak->tempat_lhr }}, {{ $date }}
                </td>
                <td>{{ $dataAnak->bb_lahir }}</td>
                <td>{{ $dataAnak->tb_lahir }}</td>
                <td>
                    @if ($dataAnak->jenis_kelamin == 0)
                        Laki-Laki
                    @else
                        Perempuan
                    @endif
                </td>
                <td>{{ $dataAnak->anak_ke }}</td>
                <td>{{ $dataAnak->jenis_persalinan }}</td>
                <td>{{ $dataAnak->tempat_persalinan }}</td>
                <td>{{ $dataAnak->dokter }}</td>
                <td>{{ $dataAnak->NIK_anak }}</td>
                <td>{{ $dataAnak->BPJS_anak }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>