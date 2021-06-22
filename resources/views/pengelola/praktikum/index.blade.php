{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.ui_modal'))) 
        @foreach(config('dz.public.pagelevel.css.ui_modal') as $style)
                <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.css.uc_select2'))) 
        @foreach(config('dz.public.pagelevel.css.uc_select2') as $style)
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
                    <h4 class="card-title">Praktikum</h4>
                    <a href="{{ route('pengelola.praktikum.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>Buat Praktikum Baru
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Prakt.</th>
                                    <th>Kelas</th>
                                    <th>Guru</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($praktikum as $d)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $d->NAMA_PRAKTIKUM }} </td>
                                    <td> {{ $d->kelas->jenis_kelas->NAMA_JENIS_KELAS }} </td>
                                    <td> {{ $d->kelas->guru->NAMA_LENGKAP }} </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow sharp px-3" data-toggle="modal" data-target="#modal-detail-{{ $loop->iteration }}"><i class="fa fa-info-circle mr-2"></i>Detail</button>
                                        </div>												
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
</div>
@foreach($praktikum as $d)
{{-- Detail Modal --}}
<div id="modal-detail-{{ $loop->iteration }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Praktikum #{{ $d->ID_PRAKTIKUM }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group px-2">
                    <div>Judul Praktikum : </div>
                    <div>{{ $d->NAMA_PRAKTIKUM }}</div>
                </div>

                <div class="form-group px-2">
                    <div>Guru : </div>
                    <div>{{ $d->kelas->guru->NAMA_LENGKAP }}</div>
                </div>

                <div class="form-group px-2">
                    <div>Kelas : </div>
                    <div>{{ $d->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</div>
                </div>

                <hr>

                <div class="form-group px-2">
                    <div>Kebutuhan Alat dan Bahan per kelompok : </div>
                </div>
                @php
                    $alat = false;
                    $bahan = false;
                    $bahan_kimia = false;
                @endphp
                @foreach($d->alat_bahan_praktikums as $a)
                    @if($a->ID_TIPE == 1)
                        @php $alat = true; @endphp
                    @elseif($a->ID_TIPE == 2)
                        @php $bahan = true; @endphp
                    @elseif($a->ID_TIPE == 3)
                        @php $bahan_kimia = true; @endphp
                    @endif
                @endforeach
                
                @if($alat)
                <div class="form-group px-2">
                    <table class="table text-black">
                        <thead>
                            <th>Nama Alat</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach($d->alat_bahan_praktikums as $a)
                                @if($a->ID_TIPE == 1)
                                <tr>
                                    <td width="80%">{{ $a->alat->katalog_alat->NAMA_ALAT }}</td>
                                    <td width="20%">{{ $a->JUMLAH }}pcs</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                @if($bahan)
                <div class="form-group px-2">
                    <table class="table text-black">
                        <thead>
                            <th>Nama Bahan</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach($d->alat_bahan_praktikums as $a)
                                @if($a->ID_TIPE == 2)
                                <tr>
                                    <td width="80%">{{ $a->bahan->NAMA_BAHAN }}</td>
                                    <td width="20%">{{ $a->JUMLAH }}pcs</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                @if($bahan_kimia)
                <div class="form-group px-2">
                    <table class="table text-black">
                        <thead>
                            <th>Nama Bahan Kimia</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach($d->alat_bahan_praktikums as $a)
                                @if($a->ID_TIPE == 3)
                                    <tr>
                                        <td width="80%">{{ $a->bahan_kimia->katalog_bahan->NAMA_KATALOG_BAHAN }}</td>
                                        <td width="20%">{{ $a->JUMLAH }}gr</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}
@endforeach

@endsection

{{-- Tambahan Script --}}
@section('tambahan-script')
@if(!empty(config('dz.public.pagelevel.js.ui_modal')))
	@foreach(config('dz.public.pagelevel.js.ui_modal') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
@if(!empty(config('dz.public.pagelevel.js.uc_select2')))
	@foreach(config('dz.public.pagelevel.js.uc_select2') as $script)
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