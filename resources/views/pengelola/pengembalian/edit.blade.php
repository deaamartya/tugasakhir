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
                <h4>Hi, @auth {{ Auth::user()->NAMA_LEMARI }} @endif</h4>
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
                        <form id="create-praktikum" action="{{ route('pengelola.peminjaman.update',$peminjaman->ID_PEMINJAMAN) }}" name="create-praktikum" method="POST">
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
                                <input type="number" value="5" name="jumlah_kelompok" id="jumlah_kelompok" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Kebutuhan Praktikum :</label>
                            </div>

                            <table class="table text-black" id="table-alat">
                                <thead>
                                    <th>Nama Alat</th>
                                    <th>Stok Tersedia</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Total Pinjam</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->praktikum->alat_bahan_praktikums as $a)
                                        @php $i = 1; @endphp
                                        @if($a->ID_TIPE == 1)
                                        <tr>
                                            <td width="50%">{{ $a->alat->ID_ALAT }} {{ $a->alat->merk_tipe_alat->NAMA_MERK_TIPE }} {{ $a->alat->katalog_alat->NAMA_ALAT }} {{ $a->alat->katalog_alat->UKURAN }}</td>
                                            <td width="20%">{{ $a->alat->JUMLAH_BAGUS }}pcs</td>
                                            <input type="hidden" value="{{ $a->alat->ID_ALAT }}" name="id_alat[{{$i}}]">
                                            <td width="15%"><input style="width:100%" type="number" value="{{ $a->JUMLAH }}" class="jumlah_alat"></td>
                                            <td width="15%"><input style="width:100%" type="number" name="jumlah_alat[{{$i}}]" class="total_alat" id="t_alat-{{$i}}" readonly></td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="table text-black" id="table-bahan">
                                <thead>
                                    <th>Nama Bahan</th>
                                    <th>Stok Tersedia</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Total Pinjam</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->praktikum->alat_bahan_praktikums as $a)
                                        @php $i = 1; @endphp
                                        @if($a->ID_TIPE == 2)
                                        <tr>
                                            <td width="50%">{{ $a->bahan->ID_BAHAN }} {{ $a->bahan->NAMA_BAHAN }}</td>
                                            <input type="hidden" value="{{ $a->bahan->ID_BAHAN }}" name="id_bahan[{{$i}}]">
                                            <td width="20%">{{ $a->bahan->JUMLAH }}pcs</td>
                                            <td width="15%"><input type="number" style="width:100%" value="{{ $a->JUMLAH }}" class="jumlah_bahan"></td>
                                            <td width="15%"><input style="width:100%" type="number" name="jumlah_bahan[{{$i}}]" class="total_bahan_kimia" id="t_bahan-{{$i}}" readonly></td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="table text-black" id="table-bahan-kimia">
                                <thead>
                                    <th>Nama Bahan Kimia</th>
                                    <th>Stok Tersedia</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Total Pinjam</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->praktikum->alat_bahan_praktikums as $a)
                                        @php $i = 1; @endphp
                                        @if($a->ID_TIPE == 3)
                                            <tr>
                                                <td width="50%">{{ $a->bahan_kimia->ID_BAHAN_KIMIA }} {{ $a->bahan_kimia->katalog_bahan->NAMA_KATALOG_BAHAN }}</td>
                                                <td width="20%">{{ $a->bahan_kimia->JUMLAH_BAHAN_KIMIA }}gr</td>
                                                <input type="hidden" value="{{ $a->bahan_kimia->ID_BAHAN_KIMIA }}" name="id_bahan_kimia[{{$i}}]">
                                                <td width="15%">
                                                <input style="width:100%" type="number" value="{{ $a->JUMLAH }}" class="jumlah_bahan_kimia"></td>
                                                <td width="15%">
                                                <input style="width:100%" type="number" name="jumlah_bahan_kimia[{{$i}}]" class="total_bahan_kimia" id="t_bahan_kimia-{{$i}}" readonly></td>
                                            </tr>
                                        @php $i++; @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="row justify-content-end">
                                <div class="col-9 text-right">
                                    <div class="row justify-content-end">
                                        <div class="col-4">
                                            <p class="text-left">Total Alat : </p>
                                        </div>
                                        <div class="col-3">
                                            <span class="ml-3 text-right" id="total-alat">0</span>
                                        </div>
                                        <input type="hidden" name="total_alat" id="total_alat">
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-4">
                                            <p class="text-left">Total Bahan : </p>
                                        </div>
                                        <div class="col-3">
                                            <span class="ml-3 text-right" id="total-bahan">0</span>
                                        </div>
                                        <input type="hidden" name="total_bahan" id="total_bahan">
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-4">
                                            <p class="text-left">Total Bahan Kimia : </p>
                                        </div>
                                        <div class="col-3">
                                            <span class="ml-3 text-right" id="total-bahan-kimia">0</span>
                                        </div>
                                        <input type="hidden" name="total_bahan_kimia" id="total_bahan_kimia">
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-4">
                                            <p class="text-left">Total Keseluruhan : </p>
                                        </div>
                                        <div class="col-3">
                                            <span class="ml-3 text-right" id="total-keseluruhan">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success submit-btn btn-md">Konfirmasi Peminjaman</button>
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