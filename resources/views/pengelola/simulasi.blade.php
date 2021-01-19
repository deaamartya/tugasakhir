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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Data Praktikum</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Simulasi Praktikum</a></li>
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
                    <h4 class="card-title">Simulasi Praktikum Baru</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form id="create-praktikum" action="{{ route('pengelola.simulasi.store') }}" name="create-praktikum" method="POST">
                        @csrf
                            <div class="form-group">
                                <label>Nama Praktikum</label>
                                <input type="text" class="form-control @error('NAMA_PRAKTIKUM') is-invalid @enderror" id="NAMA_PRAKTIKUM" name="NAMA_PRAKTIKUM" value="{{ @old('NAMA_PRAKTIKUM') }}">
                                <div class="invalid-feedback animated fadeInUp">
                                    Nama Praktikum harus diisi
                                </div>
                            </div>

                            <hr></hr>

                            <div class="form-group">
                                <label>Alat Praktikum</label>
                                <div class="form-row">
                                    <div class="col-9">
                                        <select class="form-control select2" id="ID_KATALOG_ALAT">
                                            @foreach($alat as $t)
                                            <option value="{{ $t->ID_KATALOG_ALAT }}"> {{ $t->NAMA_ALAT }} {{ $t->UKURAN }} </option>
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

                            <div class="alert alert-success hasil-simulasi" id="simulasi-bisa">Praktikum dapat dilakukan.</div>
                            <div class="alert alert-danger hasil-simulasi" id="simulasi-tidakbisa">Praktikum tidak dapat dilakukan.</div>

                            <table class="table alatbahan-table" id="table-alat">
                                <thead>
                                    <th>Alat</th>
                                    <th>Jumlah Pinjam(pcs)</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            

                            <table class="table alatbahan-table" id="table-bahan">
                                <thead>
                                    <th>Bahan</th>
                                    <th>Jumlah Pinjam(pcs)</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            

                            <table class="table alatbahan-table" id="table-bahan-kimia">
                                <thead>
                                    <th>Bahan Kimia</th>
                                    <th>Jumlah Pinjam(gr)</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <hr></hr>

                            

                            <button type="button" class="btn btn-success submit-btn btn-lg">Simulasi Praktikum</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Tambahan Script --}}
@section('tambahan-script')
@if(!empty(config('dz.public.pagelevel.js.form_validation_jquery')))
	@foreach(config('dz.public.pagelevel.js.form_validation_jquery') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
<script>
$(document).ready(function(){
    $(".select2").select2();
    $(".alatbahan-table").hide();
    $(".hasil-simulasi").hide();

    var alat = <?php echo json_encode($alat); ?>;
    var bahan = <?php echo json_encode($bahan); ?>;
    var bahan_kimia = <?php echo json_encode($bahan_kimia); ?>;

    function getIndexAlat(id_alat)
    {
        for(var i=0;i<alat.length;i++)
        {
            if(alat[i]['ID_KATALOG_ALAT'] == id_alat)
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

    $(".submit-btn").on('click',function(e){
        e.preventDefault();

        var hasil_alat = true;
        var hasil_bahan = true;
        var hasil_bahan_kimia = true;

        $(".index_alat").each(function(){
            var index = $(this).val();
            var jumlah = $("#qtyalat-"+index).val();
            $.post('getStokAlat',{ _token: "{{ csrf_token() }}", id: $("#id_katalog_alat-"+index).val() },function(result){
                console.log(Number(result));
                console.log(Number(jumlah));
                if(Number(result) < Number(jumlah)){
                    hasil_alat = false;
                    $("#simulasi-bisa").hide();
                    $("#simulasi-tidakbisa").show();
                }
                if(hasil_bahan_kimia == true && hasil_bahan == true && hasil_alat == true){
                    $("#simulasi-bisa").show();
                    $("#simulasi-tidakbisa").hide();
                }
            });
        });

        $(".index_bahan").each(function(){
            var index = $(this).val();
            var jumlah = $("#qtybahan-"+index).val();
            $.post('getStokBahan',{_token: "{{ csrf_token() }}", id: $("#id_bahan-"+index).val()},function(result){
                if(Number(result) < Number(jumlah)){
                    hasil_bahan = false;
                    $("#simulasi-bisa").hide();
                    $("#simulasi-tidakbisa").show();
                }
                if(hasil_bahan_kimia == true && hasil_bahan == true && hasil_alat == true){
                    $("#simulasi-bisa").show();
                    $("#simulasi-tidakbisa").hide();
                }
            });
        });

        $(".index_bahan_kimia").each(function(){
            var index = $(this).val();
            var jumlah = $("#qtybahan-kimia-"+index).val();
            $.post('getStokBahanKimia',{_token: "{{ csrf_token() }}", id: $("#id_bahan_kimia-"+index).val()},function(result){
                console.log(Number(result));
                console.log(Number(jumlah));
                if(Number(result) < Number(jumlah)){
                    hasil_bahan_kimia = false;
                    $("#simulasi-bisa").hide();
                    $("#simulasi-tidakbisa").show();
                }
                if(hasil_bahan_kimia == true && hasil_bahan == true && hasil_alat == true){
                    $("#simulasi-bisa").show();
                    $("#simulasi-tidakbisa").hide();
                }
            });
        });
    });

    $("#add_row_alat").on('click',function(){
        var id_alat = $("#ID_KATALOG_ALAT").val();
        var index = getIndexAlat(id_alat);
        if($("#table-alat tbody tr#alat-"+index).length == 1){
            var qty = $("#qtyalat-"+index).val();
            qty = Number(qty)+1;
            $("#qtyalat-"+index).val(qty);
            hitungTotalAlat();
        }
        else{
            var nama_alat = alat[index]['ID_KATALOG_ALAT']+" "+ alat[index]['NAMA_ALAT']+" "+ alat[index]['UKURAN'];
            var markup =
            "<tr id='alat-"+index+"'>"+
                "<td width='60%'>"+nama_alat+"<input type='hidden' class='id_katalog_alat' id='id_katalog_alat-"+index+"' value='"+id_alat+"'><input type='hidden' class='index_alat' id='index_alat["+index+"]' value='"+index+"'></td>"+
                "<td width='30%'><input type='number' name='jumlah_alat["+index+"]' value='1' class='jumlah_alat' id='qtyalat-"+index+"'></td>"+
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
                "<td width='60%'>"+nama_bahan+"<input type='hidden' class='id_bahan' id='id_bahan-"+index+"' value='"+id_bahan+"'><input type='hidden' class='index_bahan' id='index_bahan["+index+"]' value='"+index+"'></td>"+
                "<td width='30%'><input type='number' name='jumlah_bahan["+index+"]' value='1' class='jumlah_bahan' id='qtybahan-"+index+"'></td>"+
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
                "<td width='60%'>"+nama_bahan+"<input type='hidden' class='id_bahan_kimia' id='id_bahan_kimia-"+index+"' value='"+id_bahan_kimia+"'><input type='hidden' class='index_bahan_kimia' name='index_bahan_kimia["+index+"]' value='"+index+"'></td>"+
                "<td width='30%'><input type='number' name='jumlah_bahan_kimia["+index+"]' value='1' class='jumlah_bahan_kimia' id='qtybahan-kimia-"+index+"'></td>"+
                "<td width='10%'><button type='button' class='btn btn-danger shadow btn-xs sharp mr-1 delete-bahan-kimia' id='"+index+"'><i class='fa fa-trash'></i></button></td>"
            "</tr>";
            $("#table-bahan-kimia tbody").append(markup);
            $("#table-bahan-kimia").show();
            hitungTotalBahanKimia();
        }
    });

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

    function hitungTotalAlat()
    {
        var total = 0;
        $(".jumlah_alat").each(function(){
            total = total+Number($(this).val());
        });
        $("#total-alat").html(total);
        $("#total-alat-input").val(total);
        hitungTotalKeseluruhan()
    }

    function hitungTotalBahan()
    {
        var total = 0;
        $(".jumlah_bahan").each(function(){
            total = total+Number($(this).val());
        });
        $("#total-bahan").html(total);
        $("#total-bahan-input").val(total);
        hitungTotalKeseluruhan()
    }

    function hitungTotalBahanKimia()
    {
        var total = 0;
        $(".jumlah_bahan_kimia").each(function(){
            total = total+Number($(this).val());
        });
        $("#total-bahan-kimia").html(total);
        $("#total-bahan-kimia-input").val(total);
        hitungTotalKeseluruhan()
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
        $("#total-keseluruhan-input").val(total);
    }

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