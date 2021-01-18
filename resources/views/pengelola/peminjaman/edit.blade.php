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
                        <form id="create-praktikum" action="{{ route('pengelola.peminjaman.store') }}" name="create-praktikum" method="POST">
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
                                <label>Alat Praktikum</label>
                                <div class="form-row">
                                    <div class="col-9">
                                        <select class="form-control select2" id="ID_ALAT">
                                            @foreach($alat as $t)
                                            <option value="{{ $t->ID_ALAT }}"> {{ $t->merk_tipe_alat->NAMA_MERK_TIPE }} - {{ $t->katalog_alat->NAMA_ALAT }} {{ $t->katalog_alat->UKURAN }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" id="add_row_alat" class="btn btn-primary btn-sm" >+ Alat</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Bahan Praktikum</label>
                                <div class="form-row">
                                    <div class="col-9">
                                        <select class="form-control select2" id="ID_BAHAN">
                                            @foreach($bahan as $t)
                                            <option value="{{ $t->ID_BAHAN }}"> {{ $t->NAMA_BAHAN }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" id="add_row_bahan" class="btn btn-info btn-sm">+ Bahan</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Bahan Kimia Praktikum</label>
                                <div class="form-row">
                                    <div class="col-9">
                                        <select class="form-control select2" id="ID_BAHAN_KIMIA">
                                            @foreach($bahan_kimia as $t)
                                            <option value="{{ $t->ID_BAHAN_KIMIA }}"> {{ $t->katalog_bahan->NAMA_KATALOG_BAHAN }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" id="add_row_bahan_kimia" class="btn btn-warning btn-sm">+ Bahan Kimia</button>
                                    </div>
                                </div>
                            </div>

                            <hr></hr>

                            <div class="form-group">
                                <label>Kebutuhan Tiap Kelompok :</label>
                            </div>

                            <table class="table text-black" id="table-alat">
                                <thead>
                                    <th>Nama Bahan</th>
                                    <th>Stok Tersedia</th>
                                    <th>Jumlah Pinjam per kelompok</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->praktikum->alat_bahan_praktikums as $a)
                                        @if($a->ID_TIPE == 1)
                                        <tr>
                                            <td width="80%">{{ $a->alat->ID_ALAT }} {{ $a->alat->merk_tipe_alat->NAMA_MERK_TIPE }} {{ $a->alat->katalog_alat->NAMA_ALAT }} {{ $a->alat->katalog_alat->UKURAN }}</td>
                                            <td width="10%">{{ $a->alat->JUMLAH_BAGUS }}pcs</td>
                                            <input type="hidden" value="{{ $a->ID_ALAT }}" name="id_alat[]">
                                            <td width="10%"><input type="number" value="{{ $a->JUMLAH }}" name="jumlah_alat[]" class="jumlah_alat"></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="table text-black" id="table-bahan">
                                <thead>
                                    <th>Nama Bahan</th>
                                    <th>Stok Tersedia</th>
                                    <th>Kebutuhan Praktikum</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->praktikum->alat_bahan_praktikums as $a)
                                        @if($a->ID_TIPE == 2)
                                        <tr>
                                            <td width="70%">{{ $a->bahan->ID_BAHAN }} {{ $a->bahan->NAMA_BAHAN }}</td>
                                            <input type="hidden" value="{{ $a->ID_BAHAN }}" name="id_bahan[]">
                                            <td width="10%">{{ $a->bahan->JUMLAH }}pcs</td>
                                            <td width="10%"><input type="number" value="{{ $a->JUMLAH }}" name="jumlah_bahan[]" class="jumlah_bahan"></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="table text-black" id="table-bahan-kimia">
                                <thead>
                                    <th>Nama Bahan Kimia</th>
                                    <th>Stok Tersedia</th>
                                    <th>Kebutuhan Praktikum</th>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman->praktikum->alat_bahan_praktikums as $a)
                                        @if($a->ID_TIPE == 3)
                                            <tr>
                                                <td width="80%">{{ $a->bahan_kimia->ID_BAHAN_KIMIA }} {{ $a->bahan_kimia->katalog_bahan->NAMA_KATALOG_BAHAN }}</td>
                                                <td width="10%">{{ $a->bahan_kimia->JUMLAH_BAHAN_KIMIA }}gr</td>
                                                <input type="hidden" value="{{ $a->ID_BAHAN_KIMIA }}" name="id_bahan_kimia[]">
                                                <td width="10%"><input type="number" value="{{ $a->JUMLAH }}" name="jumlah_bahan_kimia[]" class="jumlah_bahan_kimia"></td>
                                            </tr>
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
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-4">
                                            <p class="text-left">Total Bahan : </p>
                                        </div>
                                        <div class="col-3">
                                            <span class="ml-3 text-right" id="total-bahan">0</span>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-4">
                                            <p class="text-left">Total Bahan Kimia : </p>
                                        </div>
                                        <div class="col-3">
                                            <span class="ml-3 text-right" id="total-bahan-kimia">0</span>
                                        </div>
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

                            <button type="submit" class="btn btn-success submit-btn btn-lg">Konfirmasi Peminjaman</button>
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

    var alat = <?php echo json_encode($alat); ?>;
    var bahan = <?php echo json_encode($bahan); ?>;
    var bahan_kimia = <?php echo json_encode($bahan_kimia); ?>;

    function getIndexAlat(id_alat)
    {
        for(var i=0;i<alat.length;i++)
        {
            if(alat[i]['ID_ALAT'] == id_alat)
            {
                return i;
            }
        }
    }

    function getIndexBahan(id_bahan)
    {
        for(var i=0;i<bahan.length;i++)
        {
            if(bahan[i]['ID_BAHAN'] == id_bahan)
            {
                return i;
            }
        }
    }

    function getIndexBahanKimia(id_bahan_kimia)
    {
        for(var i=0;i<bahan_kimia.length;i++)
        {
            if(bahan_kimia[i]['ID_BAHAN_KIMIA'] == id_bahan_kimia)
            {
                return i;
            }
        }
    }

    $("#add_row_alat").on('click',function(){
        var id_alat = $("#ID_ALAT").val();
        var index = getIndexAlat(id_alat);
        if($("#table-alat tbody tr#alat-"+index).length == 1){
            var qty = $("#qtyalat-"+index).val();
            qty = Number(qty)+1;
            $("#qtyalat-"+index).val(qty);
            hitungTotalAlat();
        }
        else{
            var nama_alat = alat[index]['ID_ALAT']+" "+ alat[index]['NAMA_MERK_TIPE'] +" "+ alat[index]['NAMA_ALAT']+" "+ alat[index]['UKURAN'];
            var markup =
            "<tr id='alat-"+index+"'>"+
                "<td width='60%'>"+nama_alat+"<input type='hidden' name='id_alat[]' value='"+id_alat+"'><input type='hidden' name='index_alat["+index+"]' value='"+index+"'></td>"+
                "<td width='30%'><input type='number' name='jumlah_alat[]' value='1' class='jumlah_alat' id='qtyalat-"+index+"'></td>"+
                "<td width='10%'><button type='button' class='btn btn-danger shadow btn-xs sharp mr-1 delete-alat' id='"+index+"'><i class='fa fa-trash'></i></button></td>"
            "</tr>";
            $("#table-alat tbody").append(markup);
            $("#table-alat").show();
            hitungTotalAlat();
        }
    });

    $("#add_row_bahan").on('click',function(){
        var id_bahan = $("#ID_BAHAN").val();
        var index = getIndexBahan(id_bahan);
        if($("#table-bahan tbody tr#bahan-"+index).length == 1){
            var qty = $("#qtybahan-"+index).val();
            qty = Number(qty)+1;
            $("#qtybahan-"+index).val(qty);
            hitungTotalBahan();
        }
        else{
            var nama_bahan = bahan[index]['ID_BAHAN'] +" "+ bahan[index]['NAMA_BAHAN'];
            var markup =
            "<tr id='bahan-"+index+"'>"+
                "<td width='60%'>"+nama_bahan+"<input type='hidden' name='id_bahan[]' value='"+id_bahan+"'><input type='hidden' name='index_bahan["+index+"]' value='"+index+"'></td>"+
                "<td width='30%'><input type='number' name='jumlah_bahan[]' value='1' class='jumlah_bahan' id='qtybahan-"+index+"'></td>"+
                "<td width='10%'><button type='button' class='btn btn-danger shadow btn-xs sharp mr-1 delete-bahan' id='"+index+"'><i class='fa fa-trash'></i></button></td>"
            "</tr>";
            $("#table-bahan tbody").append(markup);
            $("#table-bahan").show();
            hitungTotalBahan();
        }
    });

    $("#add_row_bahan_kimia").on('click',function(){
        var id_bahan_kimia = $("#ID_BAHAN_KIMIA").val();
        var index = getIndexBahanKimia(id_bahan_kimia);
        if($("#table-bahan-kimia tbody tr#bahan-kimia-"+index).length == 1){
            var qty = $("#qtybahan-kimia-"+index).val();
            qty = Number(qty)+1;
            $("#qtybahan-kimia-"+index).val(qty);
            hitungTotalBahanKimia();
        }
        else{
            var nama_bahan = bahan_kimia[index]['ID_BAHAN_KIMIA'] +" "+ bahan_kimia[index]['NAMA_KATALOG_BAHAN'];
            var markup =
            "<tr id='bahan-kimia-"+index+"'>"+
                "<td width='60%'>"+nama_bahan+"<input type='hidden' name='id_bahan_kimia[]' value='"+id_bahan_kimia+"'><input type='hidden' name='index_bahan_kimia["+index+"]' value='"+index+"'></td>"+
                "<td width='30%'><input type='number' name='jumlah_bahan_kimia[]' value='1' class='jumlah_bahan_kimia' id='qtybahan-kimia-"+index+"'></td>"+
                "<td width='10%'><button type='button' class='btn btn-danger shadow btn-xs sharp mr-1 delete-bahan-kimia' id='"+index+"'><i class='fa fa-trash'></i></button></td>"
            "</tr>";
            $("#table-bahan-kimia tbody").append(markup);
            $("#table-bahan-kimia").show();
            hitungTotalBahanKimia();
        }
    });

    function hitungTotalAlat()
    {
        var total = 0;
        $(".jumlah_alat").each(function(){
            total = total+Number($(this).val());
        });
        $("#total-alat").html(total);
        hitungTotalKeseluruhan();
        console.log("total alat "+total);
    }

    function hitungTotalBahan()
    {
        var total = 0;
        $(".jumlah_bahan").each(function(){
            total = total+Number($(this).val());
        });
        $("#total-bahan").html(total);
        hitungTotalKeseluruhan();
        console.log("total bahan "+total);
    }

    function hitungTotalBahanKimia()
    {
        var total = 0;
        $(".jumlah_bahan_kimia").each(function(){
            total = total+Number($(this).val());
        });
        $("#total-bahan-kimia").html(total);
        hitungTotalKeseluruhan();
        console.log("total bahan kimia "+total);
    }

    function hitungTotalKeseluruhan()
    {
        var total = 0;
        $(".jumlah_bahan_kimia").each(function(){
            total = total+Number($(this).val());
        });
        $(".jumlah_bahan").each(function(){
            total = total+Number($(this).val());
        });
        $(".jumlah_alat").each(function(){
            total = total+Number($(this).val());
        });
        $("#total-keseluruhan").html(total);
        console.log("total keseluruhan "+total);
    }

    hitungTotalAlat();
    hitungTotalBahan();
    hitungTotalBahanKimia();
    hitungTotalKeseluruhan();

    $(document).on('input','.jumlah_alat',function(){
        if($(this).val() >= 1){
            hitungTotalAlat();
        }
        else{
            $(this).val(1);
        }
    });

    $(document).on('input','.jumlah_bahan',function(){
        if($(this).val() >= 1){
            hitungTotalBahan();
        }
        else{
            $(this).val(1);
        }
    });

    $(document).on('input','.jumlah_bahan_kimia',function(){
        if($(this).val() >= 1){
            hitungTotalBahanKimia();
        }
        else{
            $(this).val(1);
        }
    });

    $(document).on('click','.delete-alat',function(){
        $("#table-alat tbody tr#alat-"+$(this).attr('id')).remove();
        hitungTotalAlat();
        if($("#table-alat tbody tr").length < 1){
            $("#table-alat").hide();
        }
    });

    $(document).on('click','.delete-bahan',function(){
        $("#table-bahan tbody tr#bahan-"+$(this).attr('id')).remove();
        hitungTotalBahan();
        if($("#table-bahan tbody tr").length < 1){
            $("#table-bahan").hide();
        }
    });

    $(document).on('click','.delete-bahan-kimia',function(){
        $("#table-bahan-kimia tbody tr#bahan-kimia-"+$(this).attr('id')).remove();
        hitungTotalBahanKimia();
        if($("#table-bahan-kimia tbody tr").length < 1){
            $("#table-bahan-kimia").hide();
        }
    });
});
</script>
@endsection