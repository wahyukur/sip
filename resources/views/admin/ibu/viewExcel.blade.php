<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Export Excel Data Ibu</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Ibu</th>
                <th>Nama Ayah</th>
                <th>Tempat/Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Rt/Rw</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Agama</th>
                <th>NIK</th>
                <th>No.KK</th>
                <th>No.BPJS</th>
                <th>Status Gakin</th>
                <th>No.Telp</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($ibuData as $dataIbu)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $dataIbu->nama_ibu }}</td>
                <td>{{ $dataIbu->nama_suami }}</td>
                <td>{{ $dataIbu->tempat_lahir }}, {{ $dataIbu->tgl_lahir }}</td>
                <td>{{ $dataIbu->alamat }}</td>
                <td>{{ $dataIbu->rt }}/{{ $dataIbu->rw }}</td>
                <td>{{ $dataIbu->kelurahan }}</td>
                <td>{{ $dataIbu->kecamatan }}</td>
                <td>
                    @if ($dataIbu->agama == 0)
                        Islam
                    @elseif ($dataIbu->agama == 1)
                        Kristen
                    @elseif ($dataIbu->agama == 2)
                        Katolik
                    @elseif ($dataIbu->agama == 3)
                        Hindu
                    @elseif ($dataIbu->agama == 4)
                        Buddha
                    @elseif ($dataIbu->agama == 5)
                        Kong Hu Cu
                    @else
                        Null
                    @endif
                </td>
                <td>{{ $dataIbu->NIK }}</td>
                <td>{{ $dataIbu->No_KK }}</td>
                <td>{{ $dataIbu->No_BPJS }}</td>
                <td>
                    @if ($dataIbu->gakin == 0)
                        Non Gakin
                    @else
                        Gakin
                    @endif
                </td>
                <td>{{ $dataIbu->No_tlp }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>