<head>
    <title>Katalog Lemari {{ $lemari->NAMA_LEMARI }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <table width="100%">
        <tr>
            <td width="30%" style="font-size:68pt;text-align:center;padding-left:0px;padding-right:0px">{{ $lemari->NAMA_LEMARI }}</td>
            <td width="50%" style="line-height:1.5;text-align:left;font-family:'Times New Roman';font-weight:bold">
                DAFTAR INVENTARIS
                <br>LABORATORIUM {{ strtoupper(Auth::user()->laboratorium->lab()) }}
                <br>SMA NEGERI 3 SIDOARJO
            </td>
            <td><img src="{{ $_SERVER['DOCUMENT_ROOT'].'/images/logo/sman3.png' }}" height="60"></td>
            <td><img src="{{ $_SERVER['DOCUMENT_ROOT'].'/images/logo/dispendik.png' }}" height="60"></td>
        </tr>
    </table>

    @if(count($lemari->alats) != 0)
    <table class="table table-bordered table-sm" width="100%">
        <thead>
            <tr>
                <th class="text-left">NO.</th>
                <th class="text-left">NO. KATALOG</th>
                <th class="text-left">NAMA ALAT</th>
                <th class="text-left">UKURAN</th>
                <th class="text-left">JML</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lemari->katalog_alats($lemari->ID_LEMARI) as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->ID_KATALOG_ALAT }}</td>
                <td>{{ $d->NAMA_ALAT }}</td>
                <td>{{ $d->UKURAN }}</td>
                <td>@php echo ($d->JUMLAH_BAGUS+$d->JUMLAH_RUSAK) @endphp</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if(count($lemari->bahans) != 0)
    <table class="table table-bordered table-sm" width="100%">
        <thead>
            <tr>
                <th class="text-left">NO.</th>
                <th class="text-left">KODE BAHAN</th>
                <th class="text-left">NAMA BAHAN</th>
                <th class="text-left">JML</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lemari->katalog_bahan($lemari->ID_LEMARI) as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->ID_BAHAN }}</td>
                <td>{{ $d->NAMA_BAHAN }}</td>
                <td>{{ $d->JUMLAH }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if(count($lemari->bahan_kimia) != 0)
    <table class="table table-bordered table-sm" width="100%">
        <thead>
            <tr>
                <th class="text-left">NO.</th>
                <th class="text-left">KODE</th>
                <th class="text-left">NAMA BAHAN</th>
                <th class="text-left">RUMUS</th>
                <th class="text-left">SPEK</th>
                <th class="text-left">WUJUD</th>
                <th class="text-left">JML</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lemari->katalog_bahan_kimia($lemari->ID_LEMARI) as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->ID_KATALOG_BAHAN }}</td>
                <td>{{ $d->NAMA_KATALOG_BAHAN }}</td>
                <td>{{ $d->RUMUS }}</td>
                <td>@if($d->SPESIFIKASI_BAHAN) TEK @else PA @endif</td>
                <td>{{ $d->WUJUD }}</td>
                <td>{{ $d->JUMLAH_BAHAN_KIMIA }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <p>Dokumen ini dibuat pada {{ date('Y-m-d h:i:s') }}</p>

</body>