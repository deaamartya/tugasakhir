{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.form_validation_jquery'))) 
        @foreach(config('dz.public.pagelevel.css.form_validation_jquery') as $style)
                <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
    <style>
        td{
            color: black !important;
        }
    </style>
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
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Konfirmasi Pengembalian Alat dan Bahan Laboratorium</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form id="create-praktikum" action="{{ route('pengelola.pengembalian.update',$peminjaman->ID_PEMINJAMAN) }}" name="create-praktikum" method="POST">
                        @method('PUT')
                        @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Laboratorium</label>
                                        <div>{{ $peminjaman->ruang_laboratorium->laboratorium->NAMA_LABORATORIUM }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <div>{{ $peminjaman->praktikum->mata_pelajaran->NAMA_MAPEL }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <div>{{ $peminjaman->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Judul Praktikum</label>
                                        <div>{{ $peminjaman->praktikum->JUDUL_PRAKTIKUM }}</div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            @if(count($peminjaman->alat_peminjaman($peminjaman->ID_PEMINJAMAN)) > 0)
                            <table class="table text-black" id="table-alat">
                                <thead>
                                    <th>Nama Alat</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Jumlah Bagus</th>
                                    <th>Jumlah Rusak</th>
                                    <th>Keterangan <small class="text-danger">*Jika ada alat rusak</small></th>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($peminjaman->alat_peminjaman($peminjaman->ID_PEMINJAMAN) as $a)
                                        <tr>
                                            <td width="30%">{{ $a->alat->ID_ALAT }} {{ $a->alat->merk_tipe_alat->NAMA_MERK_TIPE }} {{ $a->alat->katalog_alat->NAMA_ALAT }} {{ $a->alat->katalog_alat->UKURAN }}</td>
                                            <input type="hidden" value="{{ $a->alat->ID_ALAT }}" name="id_alat[{{$i}}]">
                                            <td width="15%">{{ $a->JUMLAH_PINJAM }}pcs</td>
                                            <input type="hidden" value="{{ $a->JUMLAH_PINJAM }}" id="jumlah_pinjam-{{$i}}">
                                            <td width="15%">
                                                <input style="width:100%" type="number" name="jumlah_bagus[{{$i}}]" id="jumlah_bagus-{{$i}}" value="{{ $a->JUMLAH_PINJAM }}" class="jumlah_alat border p-2">
                                                <div class="text-danger animated fadeInUp error-alat" id="error_alat_{{ $i }}">
                                                    Jumlah kembali harus sama dengan jumlah pinjam.
                                                </div>
                                            </td>
                                            <td width="15%">
                                                <input style="width:100%" type="number" name="jumlah_rusak[{{$i}}]" id="jumlah_rusak-{{$i}}" value="0" class="jumlah_alat_rusak border p-2">
                                            </td>
                                            <td width="15%"><textarea name="keterangan_rusak[{{$i}}]" class="form-control"></textarea></td>
                                        </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                            @if(count($peminjaman->bahan_peminjaman($peminjaman->ID_PEMINJAMAN)) > 0)
                            <table class="table text-black" id="table-bahan">
                                <thead>
                                    <th>Nama Bahan</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Sisa</th>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($peminjaman->bahan_peminjaman($peminjaman->ID_PEMINJAMAN) as $a)
                                        <tr>
                                            <td width="50%">{{ $a->bahan->ID_BAHAN }} {{ $a->bahan->NAMA_BAHAN }}</td>
                                            <input type="hidden" value="{{ $a->bahan->ID_BAHAN }}" name="id_bahan[{{$i}}]">
                                            <td width="20%">{{ $a->JUMLAH_PINJAM }}pcs</td>
                                            <td width="15%"><input type="number" style="width:100%" value="0" name="jumlah_bahan[{{$i}}]" class="jumlah_bahan border p-2"></td>
                                        </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                            @if(count($peminjaman->bahan_kimia_peminjaman($peminjaman->ID_PEMINJAMAN)) > 0)
                            <table class="table text-black" id="table-bahan-kimia">
                                <thead>
                                    <th>Nama Bahan Kimia</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Sisa</th>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($peminjaman->bahan_kimia_peminjaman($peminjaman->ID_PEMINJAMAN) as $a)
                                            <tr>
                                                <td width="50%">{{ $a->bahan_kimia->ID_BAHAN_KIMIA }} {{ $a->bahan_kimia->katalog_bahan->NAMA_KATALOG_BAHAN }}</td>
                                                <td width="20%">{{ $a->JUMLAH_PINJAM }}gr</td>
                                                <input type="hidden" value="{{ $a->bahan_kimia->ID_BAHAN_KIMIA }}" name="id_bahan_kimia[{{$i}}]">
                                                <td width="15%">
                                                <input style="width:100%" type="number" value="0" class="jumlah_bahan_kimia border p-2" name="jumlah_bahan_kimia[{{$i}}]"></td>
                                            </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            <button type="submit" class="btn btn-success submit-btn btn-lg float-right">Konfirmasi Pengembalian</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('tambahan-script')
<script type="text/javascript">
$(document).ready(function(){

    $(document).on('input','.jumlah_alat',function(){
        let index = $(this).attr('id').substr(13);
        if($(this).val() >= 0 && !isNaN($(this).val())){
            recountAll(index);
            $(this).val(Number($(this).val()))
        }
        else{
            $(this).val(1);
        }
    });

    $(document).on('input','.jumlah_alat_rusak',function(){
        let index = $(this).attr('id').substr(13);
        if($(this).val() >= 0 && !isNaN($(this).val())){
            recountAll(index);
            $(this).val(Number($(this).val()))
        }
        else{
            $(this).val(0);
        }
    });

    $(document).on('input','.jumlah_bahan',function(){
        if($(this).val() >= 0 && !isNaN($(this).val())){
            $(this).val(Number($(this).val()))
        }
        else{
            $(this).val(0);
        }
    });

    $(document).on('input','.jumlah_bahan_kimia',function(){
        if($(this).val() >= 0 && !isNaN($(this).val())){
            $(this).val(Number($(this).val()))
        }
        else{
            $(this).val(0);
        }
    });

    function recountAll(index)
    {
        let jumlah = Number($("#jumlah_pinjam-"+index).val());
        let jumlah_bagus = Number($("#jumlah_bagus-"+index).val());
        let jumlah_rusak = Number($("#jumlah_rusak-"+index).val());
        let jumlah_sekarang = jumlah_bagus + jumlah_rusak;
        if(jumlah > jumlah_sekarang) {
            $(".submit-btn").attr('disabled',true);
            $("#error_alat_"+index).show();
        }
        else if (jumlah < jumlah_sekarang) {
            $(".submit-btn").attr('disabled',true);
            $("#error_alat_"+index).show();
        }
        else {
            $(".submit-btn").attr('disabled',false);
            $("#error_alat_"+index).hide();
        }
    }
    $(".error-alat").hide();
});
</script>
@endsection