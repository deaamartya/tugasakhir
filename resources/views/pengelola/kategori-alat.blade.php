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
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, @auth {{ Auth::user()->NAMA_LENGKAP }} @endif</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Data Master</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Kategori Alat</a></li>
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
                    <h4 class="card-title">Kategori Alat</h4>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#create-modal">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Buat Kategori Alat Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Kategori Alat</th>
                                    <th>Nama Lab.</th>
                                    <th>Nama Kategori Alat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategori as $d)
                                <tr>
                                    <td> {{ $d->ID_KATEGORI_ALAT }} </td>
                                    <td> {{ $d->laboratorium->NAMA_LABORATORIUM }} </td>
                                    <td> {{ $d->NAMA_KATEGORI }} </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal" data-target="#modal-edit-{{ $d->ID_KATEGORI_ALAT }}"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#modal-delete-{{ $d->ID_KATEGORI_ALAT }}"><i class="fa fa-trash"></i></button>
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

{{-- Create Modal --}}
<div id="create-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Kategori Alat Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form id="create-kategori" action="{{ route('pengelola.kategori-alat.store') }}" name="create-kategori" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Laboratorium</label>
                            <select class="form-control select2" name="ID_LABORATORIUM" id="ID_LABORATORIUM">
                                <option value="{{ $lab->ID_LABORATORIUM }}" selected>{{ $lab->NAMA_LABORATORIUM }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama Kategori Alat</label>
                            <input type="text" class="form-control @error('NAMA_KATEGORI') is-invalid @enderror" id="NAMA_KATEGORI" name="NAMA_KATEGORI" value="{{ @old('NAMA_KATEGORI') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Nama Kategori Alat harus diisi dengan minimal 3 karakter
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary submit-btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End of Create Modal --}}

@foreach($kategori as $d)
{{-- Edit Modal --}}
<div id="modal-edit-{{ $d->ID_KATEGORI_ALAT }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori Alat #{{ $d->ID_KATEGORI_ALAT }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" action="{{ route('pengelola.kategori-alat.update',$d->ID_KATEGORI_ALAT) }}" name="edit-kategori" method="POST" enctype="multipart/form-data" id="form-edit-{{ $d->ID_KATEGORI_ALAT }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Laboratorium</label>
                        <select class="form-control select2" name="ID_LABORATORIUM" id="ID_LABORATORIUM">
                            <option value="{{ $lab->ID_LABORATORIUM }}" selected>{{ $lab->NAMA_LABORATORIUM }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori Alat</label>
                        <input type="text" class="form-control @error('NAMA_KATEGORI') is-invalid @enderror" id="NAMA_KATEGORI" name="NAMA_KATEGORI" value="{{ $d->NAMA_KATEGORI }}">
                        <div class="invalid-feedback animated fadeInUp">
                            Nama Kategori Alat harus diisi.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary submit-btn" id="{{ $d->ID_KATEGORI_ALAT }}">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}

{{-- Delete Modal --}}
<div class="modal fade" id="modal-delete-{{ $d->ID_KATEGORI_ALAT }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Kategori Alat #{{ $d->ID_KATEGORI_ALAT }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengelola.kategori-alat.destroy',[$d->ID_KATEGORI_ALAT]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    Apakah anda yakin ingin menghapus ruang lab {{ $d->NAMA_KATEGORI }} ?
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Tidak, batalkan.</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
{{-- End of Delete Modal --}}
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
    $("#create-kategori").validate({
        rules: {
            ID_LABORATORIUM: {
                required: true
            },
            NAMA_KATEGORI: {
                required: true,
            },
        },
        messages: {
            ID_LABORATORIUM: "Silahkan pilih lab",
            NAMA_KATEGORI: {
                required: "Silahkan isi nama Kategori Alat",
            }
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
                NAMA_KATEGORI: {
                    required: true,
                },
            },
            messages: {
                ID_LABORATORIUM: "Silahkan pilih lab",
                NAMA_KATEGORI: {
                    required: "Silahkan isi Nama Kategori Alat",
                },
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