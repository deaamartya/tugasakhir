{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.uc_select2'))) 
        @foreach(config('dz.public.pagelevel.css.uc_select2') as $style)
                <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.css.form_validation_jquery'))) 
        @foreach(config('dz.public.pagelevel.css.form_validation_jquery') as $style)
                <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
@endsection

{{-- Content --}}
@section('content')

<div class="container-fluid">
    
    @if(Session::has('created') || Session::has('updated') || Session::has('deleted') || Session::has('error'))
    <div class="alert 
        @if(Session::has('created') || Session::has('updated'))
        alert-success
        @elseif(Session::has('deleted'))
        alert-info
        @elseif(Session::has('errored'))
        alert-danger
        @endif">
        @if(Session::has('created'))
        {{ @session('created') }}
        @elseif(Session::has('updated'))
        {{ @session('updated') }}
        @elseif(Session::has('deleted'))
        {{ @session('deleted') }}
        @elseif(Session::has('errored'))
        {{ @session('errored') }}
        @endif
    </div>
    @endif

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
                                    <th>Lemari</th>
                                    <th>ID Katalog</th>
                                    <th>Nama Alat</th>
                                    <th>Ukuran</th>
                                    <th>Merk/Type</th>
                                    <th>Jumlah Bagus(pcs)</th>
                                    <th>Jumlah Rusak(pcs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alat as $d)
                                <tr>
                                    <td>{{ $d->ID_ALAT }}</td>
                                    <td>{{ $d->lemari->NAMA_LEMARI }}</td>
                                    <td>{{ $d->ID_KATALOG_ALAT }}</td>
                                    <td>{{ $d->katalog_alat->NAMA_ALAT }}</td>
                                    <td>{{ $d->katalog_alat->UKURAN }}</td>
                                    <td>{{ $d->merk_tipe_alat->NAMA_MERK_TIPE }}</td>
                                    <td>{{ $d->stok_bagus() }}</td>
                                    <td>{{ $d->stok_rusak() }}</td>
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