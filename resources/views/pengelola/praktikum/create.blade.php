{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.ui_modal'))) 
        @foreach(config('dz.public.pagelevel.css.ui_modal') as $style)
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

                            <div class="form-row">
                            <div class="form-group">
                                <label>Alat Praktikum</label>
                                <select class="form-control select2" id="ID_ALAT">
                                    @foreach($alat as $t)
                                    <option value="{{ $t->ID_ALAT }}"> {{ $t->merk_tipe_alat->NAMA_MERK_TIPE }} - {{ $t->katalog_alat->NAMA_ALAT }} {{ $t->katalog_alat->UKURAN }} </option>
                                    @endforeach
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label>Bahan Praktikum</label>
                                <select class="form-control select2" id="ID_BAHAN">
                                    @foreach($bahan as $t)
                                    <option value="{{ $t->ID_BAHAN }}"> {{ $t->NAMA_BAHAN }} </option>
                                    @endforeach
                                </select> 
                            </div>

                            <div class="form-group">
                                <label>Bahan Kimia Praktikum</label>
                                <select class="form-control select2" id="ID_BAHAN_KIMIA">
                                    @foreach($bahan_kimia as $t)
                                    <option value="{{ $t->ID_BAHAN_KIMIA }}"> {{ $t->katalog_bahan->NAMA_KATALOG_BAHAN }} </option>
                                    @endforeach
                                </select> 
                            </div>

                            

                            <table class="table" id="table-alat">
                                <thead>
                                    <th>Nama Alat</th>
                                    <th>Jumlah Pinjam per Kelompok</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

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
@if(!empty(config('dz.public.pagelevel.js.ui_modal')))
	@foreach(config('dz.public.pagelevel.js.ui_modal') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
@if(!empty(config('dz.public.pagelevel.js.form_validation_jquery')))
	@foreach(config('dz.public.pagelevel.js.form_validation_jquery') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
<script>
$(document).ready(function(){
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
});
    
</script>
@endsection