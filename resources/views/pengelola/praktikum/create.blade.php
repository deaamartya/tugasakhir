{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.form_validation_jquery'))) 
        @foreach(config('dz.public.pagelevel.css.form_validation_jquery') as $style)
                <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
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
                    <h4 class="card-title">Buat Praktikum Baru</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form id="create-praktikum" action="{{ route('pengelola.praktikum.store') }}" name="create-praktikum" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Laboratorium</label>
                                    <select class="form-control select2" name="ID_LABORATORIUM" id="ID_LABORATORIUM" readonly>
                                        <option value="{{ $lab->ID_LABORATORIUM }}" selected>{{ $lab->NAMA_LABORATORIUM }}</option>
                                    </select>
                                    <div class="invalid-feedback animated fadeInUp">
                                        Silahkan pilih lab
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Mata Pelajaran</label>
                                    <select class="form-control select2" name="ID_MAPEL" id="ID_MAPEL">
                                        @foreach($matapelajaran as $t)
                                            <option value="{{ $t->ID_MAPEL }}">{{ $t->NAMA_MAPEL }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback animated fadeInUp">
                                        Silahkan pilih mata pelajaran
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control select2" name="ID_KELAS" id="ID_KELAS">
                                    <option value="X" selected>Seluruh kelas X MIPA</option>
                                    <option value="XI">Seluruh kelas XI MIPA</option>
                                    <option value="XII">Seluruh kelas XII MIPA</option>
                                    @foreach($kelas as $t)
                                        <option value="{{ $t->ID_KELAS }}">{{ $t->jenis_kelas->NAMA_JENIS_KELAS }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback animated fadeInUp">
                                    Silahkan pilih mata pelajaran
                                </div>
                            </div>

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
                                        <button type="button" id="add_row_bahan" class="btn btn-primary btn-sm">+ Bahan</button>
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
                                        <button type="button" id="add_row_bahan_kimia" class="btn btn-primary btn-sm">+ Bahan Kimia</button>
                                    </div>
                                </div>
                            </div>

                            <hr></hr>

                            <table class="table alatbahan-table" id="table-alat">
                                <thead>
                                    <th>Alat</th>
                                    <th>Jumlah Pinjam per Kelompok (pcs)</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <table class="table alatbahan-table" id="table-bahan">
                                <thead>
                                    <th>Bahan</th>
                                    <th>Jumlah Pinjam per Kelompok</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kertas Milimeter</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table alatbahan-table" id="table-bahan-kimia">
                                <thead>
                                    <th>Bahan Kimia</th>
                                    <th>Jumlah Pinjam per Kelompok</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Natrium</td>
                                        <td>10</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <p>Total Alat : </p><p class="ml-3" id="total-alat">0</p>
                                <input type="hidden" id="total-alat-input" name="total-alat">
                            </div>
                            <div class="row">
                                <p>Total Bahan : </p><p class="ml-3" id="total-bahan">0</p>
                                <input type="hidden" id="total-bahan-input" name="total-bahan">
                            </div>
                            <div class="row">
                                <p>Total Bahan Kimia : </p><p class="ml-3" id="total-bahan-kimia">0</p>
                                <input type="hidden" id="total-bahan-kimia-input" name="total-bahan-kimia">
                            </div>

                            <button type="submit" class="btn btn-primary submit-btn">Simpan</button>
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

    $("#create-praktikum").validate({
        rules: {
            ID_LABORATORIUM: {
                required: true
            },
            ID_MAPEL: {
                required: true,
            },
            ID_KELAS: {
                required: true,
            },
            NAMA_PRAKTIKUM: {
                required: true,
            },
        },
        messages: {
            ID_LABORATORIUM: "Silahkan pilih laboratorium",
            ID_MAPEL: "Silahkan pilih mata pelajaran",
            ID_KELAS: "Silahkan pilih kelas",
            NAMA_PRAKTIKUM: "Silahkan isi nama praktikum",
        },
        errorElement : 'div',
        errorClass: "invalid-feedback animated fadeInUp",
        errorPlacement: function(error, element) {
            if(!$(element).hasClass("is-invalid")){
                $(element).after(error)
            }  
        },
        highlight: function(e) {
            $(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            $(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
        },
        submitHandler: function(form) {
            form.submit();
        },
    });

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
            var nama_alat = alat[index]['NAMA_MERK_TIPE'] +" "+ alat[index]['NAMA_ALAT']+" "+ alat[index]['UKURAN'];
            var markup =
            "<tr id='alat-"+index+"'>"+
                "<td>"+nama_alat+"<input type='hidden' name='id_alat["+index+"]' value='"+id_alat+"'></td>"+
                "<td><input type='number' name='jumlah_alat["+index+"]' value='1' class='jumlah_alat' id='qtyalat-"+index+"'></td>"+
                "<td><button type='button' class='btn btn-danger shadow btn-xs sharp mr-1 delete-alat' id='"+index+"'><i class='fa fa-trash'></i></button></td>"
            "</tr>";
            $("#table-alat tbody").append(markup);
            $("#table-alat").show();
        }
    });

    $("#add_row_bahan").on('click',function(){
        var id_bahan = $("#ID_BAHAN").val();
        var index = getIndexAlat(id_bahan);
        if($("#table-bahan tbody tr#bahan-"+index).length == 1){
            var qty = $("#qtybahan-"+index).val();
            qty = Number(qty)+1;
            $("#qtybahan-"+index).val(qty);
            hitungTotalAlat();
        }
        else{
            var nama_bahan = bahan[index]['NAMA_BAHAN'];
            var markup =
            "<tr id='bahan-"+index+"'>"+
                "<td>"+nama_bahan+"<input type='hidden' name='id_bahan["+index+"]' value='"+id_bahan+"'></td>"+
                "<td><input type='number' name='jumlah_bahan["+index+"]' value='1' class='jumlah_bahan' id='qtybahan-"+index+"'></td>"+
                "<td><button type='button' class='btn btn-danger shadow btn-xs sharp mr-1 delete-bahan' id='"+index+"'><i class='fa fa-trash'></i></button></td>"
            "</tr>";
            $("#table-bahan tbody").append(markup);
            $("#table-bahan").show();
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

    function hitungTotalAlat()
    {
        var total = 0;
        $(".jumlah_alat").each(function(){
            total = total+Number($(this).val());
        });
        $("#total-alat").html(total);
        $("#total-alat-input").val(total);
    }

    $(document).on('click','.delete-alat',function(){
        $("#table-alat tbody tr#alat-"+$(this).attr('id')).remove();
        hitungTotalAlat();
        if($("#table-alat tbody tr").length < 1){
            $("#table-alat").hide();
        }
    });
    
});
    
</script>
@endsection