{{-- Extends layout --}}
@extends('layout.default')
{{-- Content --}}
@section('content')

<div class="container-fluid">

    @if($errors->any())
        <div class="alert alert-danger">Data tidak berhasil disimpan. Cek kembali form</div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Alat</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Alat</th>
                                    <th>Lab - Lemari</th>
                                    <th>ID Katalog</th>
                                    <th>Nama Alat</th>
                                    <th>Ukuran</th>
                                    <th>Merk/Type</th>
                                    <th>Jumlah Bagus(pcs)</th>
                                    <th>Jumlah Rusak(pcs)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alat as $d)
                                <tr>
                                    <td>{{ $d->ID_ALAT }}</td>
                                    <td>{{ $d->lemari->laboratorium->lab() }} - {{ $d->lemari->NAMA_LEMARI }}</td>
                                    <td>{{ $d->ID_KATALOG_ALAT }}</td>
                                    <td>{{ $d->katalog_alat->NAMA_ALAT }}</td>
                                    <td>{{ $d->katalog_alat->UKURAN }}</td>
                                    <td>{{ $d->merk_tipe_alat->NAMA_MERK_TIPE }}</td>
                                    <td>{{ $d->stok_bagus() }}</td>
                                    <td>{{ $d->stok_rusak() }}</td>	
                                    <td>
                                        @if($d->stok_bagus() == 0)
                                        <div class="badge badge-danger"><i class="fa fa-warning mr-2"></i>Alat habis</div>
                                        @elseif($d->stok_bagus() < 10)
                                        <div class="badge badge-warning"><i class="fa fa-warning mr-2"></i>Alat akan habis</div>
                                        @endif
                                    </td>		
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection