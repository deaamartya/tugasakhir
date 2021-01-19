<head>
    <title>Katalog Lemari</title>
    <link rel="stylesheet" href="{{ $_SERVER['DOCUMENT_ROOT'].'/vendor/bootstrap/dist/css/bootstrap.min.css' }}">
</head>
<body>
    <table width="100%">
        <tr>
            <td><img src="{{ $_SERVER['DOCUMENT_ROOT'].'/images/logo/sman3.png' }}" height="60" class="float-left"></td>
            <td colspan="10" style="line-height:1.5;text-align:center">
                LABORATORIUM {{ strtoupper(Auth::user()->tipe_user->laboratorium->lab()) }}
            </td>
            <td><img src="{{ $_SERVER['DOCUMENT_ROOT'].'/images/logo/dispendik.png' }}" height="60" class="float-right"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="10" style="line-height:1.5;text-align:center">SMA NEGERI 3 SIDOARJO</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="12" ></td>
        </tr>
    </table>

    <hr></hr>

    <div style="margin-left:-30px;width:100%;line-height:1.5;text-align:center;margin-top:50px;font-size:18pt;font-weight:bold;">KARTU STOK</div>

    <table class="table table-bordered mt-3 table-sm">
        <tr>
            <td>NAMA ALAT</td>
            <td>{{ $alat->katalog_alat->NAMA_ALAT }}</td>
            <td>NO. KATALOG</td>
            <td>{{ $alat->katalog_alat->ID_KATALOG_ALAT }}</td>
        </tr>
        <tr>
            <td>UKURAN</td>
            <td>{{ $alat->katalog_alat->UKURAN }}</td>
            <td>KATEGORI ALAT</td>
            <td>{{ $alat->katalog_alat->kategori_alat->NAMA_KATEGORI }}</td>
        </tr>
        <tr>
            <td>MERK/TYPE</td>
            <td>{{ $alat->merk_tipe_alat->NAMA_MERK_TIPE }}</td>
            <td>TEMPAT PENYIMPANAN</td>
            <td>{{ $alat->lemari->NAMA_LEMARI }}</td>
        </tr>
    </table>

    <table class="table table-bordered mt-3 table-sm">
        <thead class="text-center">
            <tr>
                <th rowspan="3" class="align-middle" width="20%">Tanggal</th>
                <th colspan="6" width="60%">Keadaan</th>
                <th rowspan="3" class="align-middle" width="20%">Keterangan</th>
            </tr>
            <tr>
                <th colspan="2">Masuk</th>
                <th colspan="2">Keluar</th>
                <th colspan="2">Persediaan</th>
            </tr>
            <tr>
                <th>Baik</th>
                <th>Rusak</th>
                <th>Baik</th>
                <th>Rusak</th>
                <th>Baik</th>
                <th>Rusak</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
            @foreach($histori_bagus as $d)
            <tr>
                <td>{{ $d->TIMESTAMP }}</td>
                <td>@if($d->JUMLAH_MASUK != null){{ $d->JUMLAH_MASUK }} @else 0 @endif</td>
                <td>@if(isset($histori_rusak[$loop->index]->JUMLAH_MASUK)) {{ $histori_rusak[$loop->index]->JUMLAH_MASUK }} @else 0 @endif</td>
                <td>@if($d->JUMLAH_KELUAR != null){{ $d->JUMLAH_KELUAR }} @else 0 @endif</td>
                <td>@if(isset($histori_rusak[$loop->index]->JUMLAH_KELUAR))  {{ $histori_rusak[$loop->index]->JUMLAH_KELUAR }} @else 0 @endif</td>
                <td>{{ $d->STOK }}</td>
                <td>@if(isset($histori_rusak[$loop->index]->STOK)) {{ $histori_rusak[$loop->index]->STOK }} @else 0 @endif</td>
                <td>@if(isset($histori_rusak[$loop->index]->KETERANGAN)) {{ $histori_rusak[$loop->index]->KETERANGAN }} @else {{ $d->KETERANGAN }}@endif</td>
            </tr>
            test
            @endforeach
        </tbody>
    </table>

    <!-- <table class="table table-bordered float-right w-60 table-sm">
        <tr>
            <td>NO. KATALOG :</td>
            <td>{{ $alat->katalog_alat->ID_KATALOG_ALAT }}</td>
        </tr>
        <tr>
            <td>KATEGORI ALAT :</td>
            <td>{{ $alat->katalog_alat->kategori_alat->NAMA_KATEGORI }}</td>
        </tr>
        <tr>
            <td>TEMPAT PENYIMPANAN :</td>
            <td>{{ $alat->lemari->NAMA_LEMARI }}</td>
        </tr>
    </table> -->

</body>