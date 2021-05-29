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
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, @auth {{ Auth::user()->NAMA_LENGKAP }} @endif</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Data Master</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Praktikum</a></li>
            </ol>
        </div>
    </div>
    
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
                    <h4 class="card-title">Konfirmasi Pelaksanaan Praktikum</h4>
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
                                        <div>{{ $peminjaman->praktikum->laboratorium->NAMA_LABORATORIUM }}</div>
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
                                        <div>{{ $peminjaman->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Praktikum</label>
                                        <div>{{ $peminjaman->praktikum->NAMA_PRAKTIKUM }}</div>
                                    </div>
                                </div>
                            </div>

                            <hr></hr>

                            <div class="form-group">
                                <label>Jumlah Kelompok</label>
                                <input type="number" value="5" name="jumlah_kelompok" id="jumlah_kelompok" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label>Pinjaman Praktikum :</label>
                            </div>

                            <table class="table text-black" id="table-alat">
                                <thead>
                                    <th>Nama Alat</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Jumlah Bagus</th>
                                    <th>Jumlah Rusak</th>
                                    <th>Keterangan <small class="text-danger">*Jika ada alat rusak</small></th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->detail_peminjamans as $a)
                                        @php $i = 1; @endphp
                                        @if($a->ID_TIPE == 1)
                                        <tr>
                                            <td width="30%">{{ $a->alat->ID_ALAT }} {{ $a->alat->merk_tipe_alat->NAMA_MERK_TIPE }} {{ $a->alat->katalog_alat->NAMA_ALAT }} {{ $a->alat->katalog_alat->UKURAN }}</td>
                                            <input type="hidden" value="{{ $a->alat->ID_ALAT }}" name="id_alat[{{$i}}]">
                                            <td width="15%">{{ $a->JUMLAH_PINJAM }}pcs</td>
                                            <td width="15%"><input style="width:100%" type="number" name="jumlah_bagus[{{$i}}]" id="jumlah_bagus-{{$i}}" value="{{ $a->JUMLAH_PINJAM }}" class="border-0"></td>
                                            <td width="15%"><input style="width:100%" type="number" name="jumlah_rusak[{{$i}}]" id="jumlah_rusak-{{$i}}" value="0" class="border-0"></td>
                                            <td width="15%"><textarea name="keterangan_rusak[{{$i}}]" class="form-control"></textarea></td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="table text-black" id="table-bahan">
                                <thead>
                                    <th>Nama Bahan</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Sisa</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->detail_peminjamans as $a)
                                        @php $i = 1; @endphp
                                        @if($a->ID_TIPE == 2)
                                        <tr>
                                            <td width="50%">{{ $a->bahan->ID_BAHAN }} {{ $a->bahan->NAMA_BAHAN }}</td>
                                            <input type="hidden" value="{{ $a->bahan->ID_BAHAN }}" name="id_bahan[{{$i}}]">
                                            <td width="20%">{{ $a->JUMLAH_PINJAM }}pcs</td>
                                            <td width="15%"><input type="number" style="width:100%" value="0" name="jumlah_bahan[{{$i}}]" class="border-0"></td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="table text-black" id="table-bahan-kimia">
                                <thead>
                                    <th>Nama Bahan Kimia</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Sisa</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->detail_peminjamans as $a)
                                        @php $i = 1; @endphp
                                        @if($a->ID_TIPE == 3)
                                            <tr>
                                                <td width="50%">{{ $a->bahan_kimia->ID_BAHAN_KIMIA }} {{ $a->bahan_kimia->katalog_bahan->NAMA_KATALOG_BAHAN }}</td>
                                                <td width="20%">{{ $a->JUMLAH_PINJAM }}gr</td>
                                                <input type="hidden" value="{{ $a->bahan_kimia->ID_BAHAN_KIMIA }}" name="id_bahan_kimia[{{$i}}]">
                                                <td width="15%">
                                                <input style="width:100%" type="number" value="0" class="jumlah_bahan_kimia border-0" name="jumlah_bahan_kimia[{{$i}}]"></td>
                                            </tr>
                                        @php $i++; @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success submit-btn btn-lg">Konfirmasi Pengembalian</button>
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
    $(".select2").select2();

    $(document).on('input','.jumlah_alat',function(){
        if($(this).val() >= 1){
            recountAll();
        }
        else{
            $(this).val(1);
        }
    });

    $(document).on('input','.jumlah_bahan',function(){
        if($(this).val() >= 1){
            recountAll();
        }
        else{
            $(this).val(1);
        }
    });

    $(document).on('input','.jumlah_bahan_kimia',function(){
        if($(this).val() >= 1){
            recountAll();
        }
        else{
            $(this).val(1);
        }
    });

    $(document).on('input','#jumlah_kelompok',function(){
        
        if($(this).val() >= 1){
            recountAll();
        }
        else{
            $(this).val(1);
        }
    });

    function recountAll()
    {
        var jumlah_kelompok = Number($("#jumlah_kelompok").val());
        var total = 0;
        var total_s = 0;
        var index = 1;
        $(".jumlah_alat").each(function(){
            $("#t_alat-"+index).val(Number($(this).val())*jumlah_kelompok);
            total = total + Number($(this).val())*jumlah_kelompok;
            index = index+1;
        });
        $("#total-alat").html(total);
        $("#total_alat").val(total);
        total_s = total_s + total;

        total = 0;
        index = 1;
        $(".jumlah_bahan").each(function(){
            $("#t_bahan-"+index).val(Number($(this).val())*jumlah_kelompok);
            total = total + Number($(this).val())*jumlah_kelompok;
            index = index+1;
        });
        $("#total-bahan").html(total);
        $("#total_bahan").val(total);
        total_s = total_s + total;

        total = 0;
        index = 1;
        $(".jumlah_bahan_kimia").each(function(){
            $("#t_bahan_kimia-"+index).val(Number($(this).val())*jumlah_kelompok);
            total = total + Number($(this).val())*jumlah_kelompok;
            index = index+1;
        });
        $("#total-bahan-kimia").html(total);
        $("#total_bahan_kimia").val(total);
        total_s = total_s + total;

        $("#total-keseluruhan").html(total_s);
    }

    recountAll();


});
</script>
@endsection