{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.app_calender'))) 
        @foreach(config('dz.public.pagelevel.css.app_calender') as $style)
                <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.css.form_pickers'))) 
        @foreach(config('dz.public.pagelevel.css.form_pickers') as $style)
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

    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jadwal Praktikum</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="create-jadwal" action="{{ route('pengelola.jadwal-praktikum.store') }}" name="create-praktikum" method="POST">
                        @csrf
                            <div class="form-group">
                                <label>Ruang Laboratorium</label>
                                <select class="select2-single" name="ID_RUANG_LABORATORIUM" id="ID_RUANG_LABORATORIUM">
                                    @foreach($ruanglaboratorium as $t)
                                        <option value="{{ $t->ID_RUANG_LABORATORIUM }}">{{ $t->NAMA_RUANG_LABORATORIUM }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback animated fadeInUp">
                                    Silahkan pilih praktikum
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Praktikum</label>
                                <select class="select2-single" name="ID_MAPEL" id="ID_MAPEL">
                                    @foreach($praktikum as $t)
                                        <option value="{{ $t->ID_PRAKTIKUM }}">{{ $t->NAMA_PRAKTIKUM }} - {{ $t->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback animated fadeInUp">
                                    Silahkan pilih praktikum
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Praktikum</label>
                                <input name="datepicker" class="datepicker-default form-control" id="datepicker">
                                <div class="invalid-feedback animated fadeInUp">
                                    Tanggal Praktikum harus diisi
                                </div>
                            </div>
                                <div class="form-group">
                                    <label>Jam Mulai Praktikum</label>
                                    <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" class="form-control"> 
                                        <span class="input-group-append"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                    </div>
                                    <div class="invalid-feedback animated fadeInUp">
                                    Jam Mulai Praktikum harus diisi
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jam Selesai Praktikum</label>
                                    <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" class="form-control"> 
                                        <span class="input-group-append"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                    </div>
                                    <div class="invalid-feedback animated fadeInUp">
                                    Jam Selesai Praktikum harus diisi
                                    </div>
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
@if(!empty(config('dz.public.pagelevel.js.app_calender')))
	@foreach(config('dz.public.pagelevel.js.app_calender') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
@endif
@if(!empty(config('dz.public.pagelevel.js.form_pickers')))
	@foreach(config('dz.public.pagelevel.js.form_pickers') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
@endif

<script>
$(document).ready(function(){
    $("#ID_MAPEL").select2();
    $("#ID_RUANG_LABORATORIUM").select2();
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
    $(".form-valide").each(function(){
        $(this).validate({
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
});
    
</script>
@endsection