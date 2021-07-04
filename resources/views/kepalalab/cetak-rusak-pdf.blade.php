<head>
    <title>Daftar Alat Rusak</title>
    <link rel="stylesheet" href="{{ $_SERVER['DOCUMENT_ROOT'].'/vendor/bootstrap/dist/css/bootstrap.min.css' }}">
</head>
<body>
    <table width="100%" style="font-family:'Times New Roman';font-weight:bold">
        <tr>
            <td><img src="{{ $_SERVER['DOCUMENT_ROOT'].'/images/logo/dispendik.png' }}" height="60" class="float-left"></td>
            <td colspan="10" style="line-height:1.5;text-align:center">
                LABORATORIUM {{ strtoupper(Auth::user()->laboratorium->lab()) }}
            </td>
            <td><img src="{{ $_SERVER['DOCUMENT_ROOT'].'/images/logo/sman3.png' }}" height="60" class="float-right"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="10" style="line-height:1.5;text-align:center">SMA NEGERI 3 SIDOARJO</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="12"></td>
        </tr>
    </table>

    <hr>

    <div style="margin-left:-30px;width:100%;line-height:1.5;text-align:center;margin-top:50px;font-size:18pt;font-weight:bold;">LAPORAN BARANG RUSAK</div>

    <div style="margin-left:-30px;width:100%;line-height:1.5;text-align:center;margin-top:10px;margin-bottom:50px;font-size:18pt;">{{ $tahunakademik->TAHUN_AKADEMIK }}</div>

    <table class="table table-bordered mt-3 table-sm">
        <thead class="text-center">
            <tr>
                <th>No.</th>
                <th>KODE ALAT</th>
                <th>NAMA ALAT</th>
                <th>JUMLAH</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
            @foreach($histori_rusak as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->ID_KATALOG_ALAT }}</td>
                <td>{{ $d->NAMA_ALAT }}</td>
                <td>{{ $d->JUMLAH_MASUK }}</td>
                <td>@if(isset($d->KETERANGAN)) {{ $d->KETERANGAN }} @else - @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>