<head>
    <title>Katalog Lemari</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
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
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histori_bagus as $d)
            <tr>
                <td>{{ $d->TANGGAL }}</td>
                <td>{{ $d->JUMLAH_MASUK }}</td>
                <td>{{ $d->JUMLAH_KELUAR }}</td>
                <td>{{ $histori_rusak[$loop->index]->JUMLAH_MASUK }}</td>
                <td>{{ $histori_rusak[$loop->index]->JUMLAH_KELUAR }}</td>
                <td>{{ $d->STOK }}</td>
                <td>{{ $histori_rusak[$loop->index]->STOK }}</td>
                <td>{{ $histori_rusak[$loop->index]->KETERANGAN }}</td>
            </tr>
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