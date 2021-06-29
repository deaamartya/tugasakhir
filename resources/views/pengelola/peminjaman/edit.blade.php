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

                            <div class="form-group">
                                <label>Jumlah Kelompok</label>
                                <input type="number" value="5" name="jumlah_kelompok" id="jumlah_kelompok" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Kebutuhan Praktikum :</label>
                            </div>

                            @if(count($peminjaman->praktikum->alat_praktikum()) !== 0)
                            <table class="table text-black" id="table-alat">
                                <thead>
                                    <th>Nama Alat</th>
                                    <th>Stok Tersedia</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Total Pinjam</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->praktikum->alat_bahan_praktikum as $a)
                                        @php $i = 1; @endphp
                                        @if($a->ID_TIPE == 1)
                                        <tr>
                                            <td width="50%">{{ $a->alat->ID_ALAT }} {{ $a->alat->merk_tipe_alat->NAMA_MERK_TIPE }} {{ $a->alat->katalog_alat->NAMA_ALAT }} {{ $a->alat->katalog_alat->UKURAN }}</td>
                                            <td width="20%">{{ $a->alat->stok_bagus() }}pcs</td>
                                            <input type="hidden" value="{{ $a->alat->ID_ALAT }}" name="id_alat[{{$i}}]">
                                            <td width="15%">
                                                <input style="width:100%" type="number" value="{{ $a->JUMLAH }}" class="jumlah_alat border p-2">
                                                <div class="text-danger animated fadeInUp" id="error_alat_{{ $i }}">
                                                    Jumlah pinjam melebihi stok tersedia.
                                                </div>
                                            </td>
                                            <td width="15%"><input style="width:100%" type="number" name="jumlah_alat[{{$i}}]" class="total_alat border p-2" id="t_alat-{{$i}}" readonly max="{{ $a->alat->stok_bagus() }}"></td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            @if(count($peminjaman->praktikum->bahan_praktikum()) !== 0)
                            <table class="table text-black" id="table-bahan">
                                <thead>
                                    <th>Nama Bahan</th>
                                    <th>Stok Tersedia</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Total Pinjam</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->praktikum->alat_bahan_praktikum as $a)
                                        @php $i = 1; @endphp
                                        @if($a->ID_TIPE == 2)
                                        <tr>
                                            <td width="50%">{{ $a->bahan->ID_BAHAN }} {{ $a->bahan->NAMA_BAHAN }}</td>
                                            <input type="hidden" value="{{ $a->bahan->ID_BAHAN }}" name="id_bahan[{{$i}}]">
                                            <td width="20%">{{ $a->bahan->stok() }}pcs</td>
                                            <td width="15%">
                                                <input type="number" style="width:100%" value="{{ $a->JUMLAH }}" class="jumlah_bahan border p-2">
                                                <div class="text-danger animated fadeInUp" id="error_bahan_{{ $i }}">
                                                    Jumlah pinjam melebihi stok tersedia.
                                                </div>
                                            </td>
                                            <td width="15%"><input style="width:100%" type="number" name="jumlah_bahan[{{$i}}]" class="total_bahan_kimia border p-2" id="t_bahan-{{$i}}" max="{{ $a->bahan->stok() }}" readonly></td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            @if(count($peminjaman->praktikum->bahan_kimia_praktikum()) !== 0)
                            <table class="table text-black" id="table-bahan-kimia">
                                <thead>
                                    <th>Nama Bahan Kimia</th>
                                    <th>Stok Tersedia</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Total Pinjam</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->praktikum->alat_bahan_praktikum as $a)
                                        @php $i = 1; @endphp
                                        @if($a->ID_TIPE == 3)
                                            <tr>
                                                <td width="50%">{{ $a->bahan_kimia->ID_BAHAN_KIMIA }} {{ $a->bahan_kimia->katalog_bahan->NAMA_KATALOG_BAHAN }}</td>
                                                <td width="20%">{{ $a->bahan_kimia->stok() }}gr</td>
                                                <input type="hidden" value="{{ $a->bahan_kimia->ID_BAHAN_KIMIA }}" name="id_bahan_kimia[{{$i}}]">
                                                <td width="15%">
                                                    <input style="width:100%" type="number" value="{{ $a->JUMLAH }}" class="jumlah_bahan_kimia border p-2">
                                                    <div class="text-danger animated fadeInUp" id="error_bahan_kimia_{{ $i }}">
                                                        Jumlah pinjam melebihi stok tersedia.
                                                    </div>
                                                </td>
                                                <td width="15%">
                                                <input style="width:100%" type="number" name="jumlah_bahan_kimia[{{$i}}]" class="total_bahan_kimia border p-2" id="t_bahan_kimia-{{$i}}" max="{{ $a->bahan_kimia->stok() }}" readonly></td>
                                            </tr>
                                        @php $i++; @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

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

                            <button type="submit" class="btn btn-success float-right" id="submit-btn" disabled="false">Konfirmasi Peminjaman</button>
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
        var total_sementara = 0;
        var stok = 0;
        var error = false;
        $(".jumlah_alat").each(function(){
            console.log("masuk each jumlah alat");
            total_sementara = Number($(this).val())*jumlah_kelompok;
            stok = Number($("#t_alat-"+index).attr('max'));
            if(total_sementara > stok){
                $("#error_alat_"+index).show();
                total_sementara = 0;
                total = 0;
                error = true;
            } else{
                $("#error_alat_"+index).hide();
                total = total + total_sementara;
            }
            $("#t_alat-"+index).val(total_sementara);
            index = index+1;
        });

        $("#total-alat").html(total);
        $("#total_alat").val(total);
        total_s = total_s + total;

        total = 0;
        index = 1;
        $(".jumlah_bahan").each(function(){
            console.log("masuk each jumlah bahan");
            total_sementara = Number($(this).val())*jumlah_kelompok;
            stok = Number($("#t_bahan-"+index).attr('max'));
            if(total_sementara > stok){
                $("#error_bahan_"+index).show();
                total_sementara = 0;
                total = 0;
                error = true;
            } else{
                $("#error_bahan_"+index).hide();
                total = total + total_sementara;
            }
            $("#t_bahan-"+index).val(total_sementara);
            index = index+1;
        });
        $("#total-bahan").html(total);
        $("#total_bahan").val(total);
        total_s = total_s + total;

        total = 0;
        index = 1;
        $(".jumlah_bahan_kimia").each(function(){
            total_sementara = Number($(this).val())*jumlah_kelompok;
            stok = Number($("#t_bahan_kimia-"+index).attr('max'));
            if(total_sementara > stok){
                $("#error_bahan_kimia_"+index).show();
                total_sementara = 0;
                total = 0;
                error = true;
            } else{
                $("#error_bahan_kimia_"+index).hide();
                total = total + total_sementara;
            }
            $("#t_bahan_kimia-"+index).val(total_sementara);
            index = index+1;
        });
        $("#total-bahan-kimia").html(total);
        $("#total_bahan_kimia").val(total);
        total_s = total_s + total;

        $("#total-keseluruhan").html(total_s);

        if(error){
            $("#submit-btn").attr("disabled", true);
        }
        else{
            $("#submit-btn").attr("disabled", false);
        }
    }
    recountAll();
});
</script>
@endsection