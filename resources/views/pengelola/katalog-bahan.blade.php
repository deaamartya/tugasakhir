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
                    <h4 class="card-title">Katalog Bahan</h4>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#create-modal">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Buat Katalog Bahan Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Katalog Bahan</th>
                                    <th>Lab.</th>
                                    <th>Nama Katalog Bahan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($katalogbahan as $d)
                                <tr>
                                    <td> {{ $d->ID_KATALOG_BAHAN }} </td>
                                    <td> {{ $d->laboratorium->NAMA_LABORATORIUM }} </td>
                                    <td> {{ $d->NAMA_KATALOG_BAHAN }} </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal" data-target="#modal-edit-{{ $loop->index }}"><i class="fa fa-pencil"></i></button>
                                            {{-- <button type="button" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#modal-delete-{{ $loop->index }}"><i class="fa fa-trash"></i></button> --}}
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
                <h5 class="modal-title">Buat Katalog Bahan Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form id="create-katalogbahan" action="{{ route('pengelola.katalog-bahan.store') }}" name="create-katalogbahan" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Laboratorium</label>
                            <select class="form-control select2" name="ID_LABORATORIUM" id="ID_LABORATORIUM">
                                <option value="{{ $lab->ID_LABORATORIUM }}" selected>{{ $lab->NAMA_LABORATORIUM }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ID Katalog Bahan</label>
                            <input type="text" class="form-control @error('ID_KATALOG_BAHAN') is-invalid @enderror" id="ID_KATALOG_BAHAN" name="ID_KATALOG_BAHAN" value="{{ @old('ID_KATALOG_BAHAN') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                ID Katalog Bahan harus diisi dan unik
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama Bahan</label>
                            <input type="text" class="form-control @error('NAMA_KATALOG_BAHAN') is-invalid @enderror" id="NAMA_KATALOG_BAHAN" name="NAMA_KATALOG_BAHAN" value="{{ @old('NAMA_KATALOG_BAHAN') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Nama Bahan harus diisi
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

@foreach($katalogbahan as $d)
{{-- Edit Modal --}}
<div id="modal-edit-{{ $loop->index }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Katalog Bahan #{{ $d->ID_KATALOG_BAHAN }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" action="{{ route('pengelola.katalog-bahan.update') }}" name="edit-katalogbahan" method="POST" enctype="multipart/form-data" id="form-edit-{{ $loop->index }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="ID_KATALOG_LAMA" value="{{ $d->ID_KATALOG_BAHAN }}">

                    <div class="form-group">
                        <label>Laboratorium</label>
                        <select class="form-control select2" name="ID_LABORATORIUM" id="ID_LABORATORIUM">
                            <option value="{{ $lab->ID_LABORATORIUM }}" selected>{{ $lab->NAMA_LABORATORIUM }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>ID Katalog Bahan</label>
                        <input type="text" class="form-control @error('ID_KATALOG_BAHAN') is-invalid @enderror" id="ID_KATALOG_BAHAN" name="ID_KATALOG_BAHAN" value="{{ $d->ID_KATALOG_BAHAN }}">
                        <div class="invalid-feedback animated fadeInUp">
                            ID Katalog Bahan harus diisi dan unik
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Bahan</label>
                        <input type="text" class="form-control @error('NAMA_KATALOG_BAHAN') is-invalid @enderror" id="NAMA_KATALOG_BAHAN" name="NAMA_KATALOG_BAHAN" value="{{ $d->NAMA_KATALOG_BAHAN }}">
                        <div class="invalid-feedback animated fadeInUp">
                            Nama Bahan harus diisi
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary submit-btn" id="{{ $d->ID_KATALOG_BAHAN }}">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}

{{-- Delete Modal --}}
<div class="modal fade" id="modal-delete-{{ $loop->index }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Katalog Bahan #{{ $d->ID_KATALOG_BAHAN }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengelola.katalog-bahan.destroy') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    Apakah anda yakin ingin menghapus katalog bahan {{ $d->NAMA_KATALOG_BAHAN }} ?
                    <input type="hidden" name="ID_KATALOG_LAMA" value="{{ $d->ID_KATALOG_BAHAN }}">
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
    $("#create-katalogbahan").validate({
        rules: {
            ID_LABORATORIUM: {
                required: true
            },
            NAMA_KATALOG_BAHAN: {
                required: true,
            },
            ID_KATALOG_BAHAN: {
                required: true,
            },
        },
        messages: {
            ID_LABORATORIUM: "Silahkan pilih laboratorium",
            NAMA_KATALOG_BAHAN: "Silahkan isi nama katalog bahan",
            ID_KATALOG_BAHAN: "Silahkan isi katalog bahan",
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
                NAMA_KATALOG_BAHAN: {
                    required: true,
                },
                ID_KATALOG_BAHAN: {
                    required: true,
                },
            },
            messages: {
                ID_LABORATORIUM: "Silahkan pilih laboratorium",
                NAMA_KATALOG_BAHAN: "Silahkan isi nama katalog bahan",
                ID_KATALOG_BAHAN: "Silahkan isi katalog bahan",
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