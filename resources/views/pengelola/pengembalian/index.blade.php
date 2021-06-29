{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.ui_modal'))) 
        @foreach(config('dz.public.pagelevel.css.ui_modal') as $style)
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
                    <h4 class="card-title">Pengembalian Alat dan Bahan Laboratorium</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Praktikum</th>
                                    <th>Kelas</th>
                                    <th>Guru</th>
                                    <th>Jadwal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman as $d)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $d->praktikum->JUDUL_PRAKTIKUM }} </td>
                                    <td> {{ $d->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</td>
                                    <td> {{ $d->kelas->guru->NAMA_LENGKAP }}</td>
                                    <td> {{ $d->TANGGAL_PEMINJAMAN }} {{ $d->JAM_MULAI }} - {{ $d->JAM_SELESAI }} </td>
                                    <td>
                                    @if($d->STATUS_PEMINJAMAN == "SUDAH DIKONFIRMASI")
                                        <a href="{{ route('pengelola.pengembalian.edit',[$d->ID_PEMINJAMAN]) }}">
                                            <button type="button" class="btn btn-primary">Pengembalian</button>
                                        </a>
                                    @else
                                        SUDAH DIKEMBALIKAN
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">History Pengembalian</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Praktikum</th>
                                    <th>Kelas</th>
                                    <th>Guru</th>
                                    <th>Jadwal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengembalian as $d)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $d->praktikum->JUDUL_PRAKTIKUM }} </td>
                                    <td> {{ $d->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</td>
                                    <td> {{ $d->kelas->guru->NAMA_LENGKAP }}</td>
                                    <td> {{ $d->TANGGAL_PEMINJAMAN }} {{ $d->JAM_MULAI }} - {{ $d->JAM_SELESAI }} </td>
                                    <td> {{$d->STATUS_PEMINJAMAN}} </td>			
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

{{-- Tambahan Script --}}
@section('tambahan-script')
@if(!empty(config('dz.public.pagelevel.js.ui_modal')))
	@foreach(config('dz.public.pagelevel.js.ui_modal') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
@endsection