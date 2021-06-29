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
                    <h4 class="card-title">Bahan</h4>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#create-modal">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Buat Bahan Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Bahan</th>
                                    <th>Lab. - Lemari</th>
                                    <th>Nama Bahan</th>
                                    <th>Jumlah(pcs)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bahan as $d)
                                <tr>
                                    <td> {{ $d->ID_BAHAN }} </td>
                                    <td> {{ $d->lemari->laboratorium->NAMA_LABORATORIUM }} - {{ $d->lemari->NAMA_LEMARI }} </td>
                                    <td> {{ $d->NAMA_BAHAN }} </td>
                                    <td> {{ $d->stok() }} </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal" data-target="#modal-edit-{{ $loop->index }}"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#modal-tambah-{{ $loop->index }}"><i class="fa fa-plus"></i></button>
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
                <h5 class="modal-title">Buat Bahan Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form id="create-bahan" action="{{ route('pengelola.bahan.store') }}" name="create-bahan" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Lemari</label>
                            <select class="form-control select2 @error('ID_LEMARI') is-invalid @enderror" name="ID_LEMARI" id="ID_LEMARI">
                                @foreach($lemari as $t)
                                    <option value="{{ $t->ID_LEMARI }}">{{ $t->laboratorium->NAMA_LABORATORIUM }} - {{ $t->NAMA_LEMARI }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback animated fadeInUp">
                                Silahkan pilih lemari
                            </div>
                        </div>

                        <div class="form-group">
                            <label>ID Bahan</label>
                            <input type="text" class="form-control @error('ID_BAHAN') is-invalid @enderror" id="ID_BAHAN" name="ID_BAHAN" value="{{ @old('ID_BAHAN') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                ID Bahan harus diisi dan unik
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama Bahan</label>
                            <input type="text" class="form-control @error('NAMA_BAHAN') is-invalid @enderror" id="NAMA_BAHAN" name="NAMA_BAHAN" value="{{ @old('NAMA_BAHAN') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Nama Bahan harus diisi
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jumlah(pcs)</label>
                            <input type="number" class="form-control @error('JUMLAH') is-invalid @enderror" id="JUMLAH" name="JUMLAH" value="{{ @old('JUMLAH') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Jumlah harus diisi minimal 0
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

@foreach($bahan as $d)
{{-- Edit Modal --}}
<div id="modal-edit-{{ $loop->index }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bahan #{{ $d->ID_BAHAN }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" action="{{ route('pengelola.bahan.update') }}" name="edit-bahan" method="POST" id="form-edit-{{ $loop->index }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="ID_BAHAN_LAMA" value="{{ $d->ID_BAHAN }}">

                    <div class="form-group">
                        <label>Lemari</label>
                        <select class="form-control select2 @error('ID_LEMARI') is-invalid @enderror" name="ID_LEMARI" id="ID_LEMARI">
                            @foreach($lemari as $t)
                                <option value="{{ $t->ID_LEMARI }}" @if($d->ID_LEMARI == $t->ID_LEMARI) selected @endif >{{ $t->laboratorium->NAMA_LABORATORIUM }} - {{ $t->NAMA_LEMARI }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback animated fadeInUp">
                            Silahkan pilih lemari
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ID Bahan</label>
                        <input type="text" class="form-control @error('ID_BAHAN') is-invalid @enderror" id="ID_BAHAN" name="ID_BAHAN" value="{{ $d->ID_BAHAN }}">
                        <div class="invalid-feedback animated fadeInUp">
                            ID Bahan harus diisi dan unik
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Bahan</label>
                        <input type="text" class="form-control @error('NAMA_BAHAN') is-invalid @enderror" id="NAMA_BAHAN" name="NAMA_BAHAN" value="{{ $d->NAMA_BAHAN }}">
                        <div class="invalid-feedback animated fadeInUp">
                            Nama Bahan harus diisi
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary submit-btn" id="{{ $d->ID_BAHAN }}">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}

{{-- Delete Modal --}}
<div class="modal fade" id="modal-tambah-{{ $loop->index }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keluar Masuk Stok Bahan #{{ $d->ID_BAHAN }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengelola.bahan.updateStock') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ID_BAHAN_LAMA" value="{{ $d->ID_BAHAN }}">
                    <div class="form-group">
                        <label>Jumlah Masuk<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_MASUK') is-invalid @enderror" id="JUMLAH_MASUK" name="JUMLAH_MASUK" min="0" value="0">
                        <div class="invalid-feedback animated fadeInUp">
                            Jumlah masuk harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Keluar<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_KELUAR') is-invalid @enderror" id="JUMLAH_KELUAR" name="JUMLAH_KELUAR" min="0" value="0">
                        <div class="invalid-feedback animated fadeInUp">
                            Jumlah keluar harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan<small class="text-danger">*</small></label>
                        <input type="text" class="form-control @error('KETERANGAN') is-invalid @enderror" id="KETERANGAN" name="KETERANGAN" value="Stok tambahan dari pengadaan">
                        <div class="invalid-feedback animated fadeInUp">
                            Keterangan harus diisi
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    $("#create-bahan").validate({
        rules: {
            ID_LEMARI: {
                required: true
            },
            ID_BAHAN: {
                required: true,
            },
            NAMA_BAHAN: {
                required: true,
            },
            JUMLAH: {
                required: true,
                min: 0,
            },
        },
        messages: {
            ID_LEMARI: "Silahkan pilih lemari lokasi bahan",
            ID_BAHAN: "Silahkan isi id bahan. Pastikan id unik.",
            NAMA_BAHAN: "Silahkan isi nama bahan",
            JUMLAH: {
                "required" : "Silahkan isi jumlah bahan",
                "min" : "Minimal jumlah bahan 0"
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
    $(".form-valide").each(function(){
        $(this).validate({
            rules: {
                ID_LEMARI: {
                    required: true
                },
                ID_BAHAN: {
                    required: true,
                },
                NAMA_BAHAN: {
                    required: true,
                },
                JUMLAH: {
                    required: true,
                    min: 0,
                },
            },
            messages: {
                ID_LEMARI: "Silahkan pilih lemari lokasi bahan",
                ID_BAHAN: "Silahkan isi id bahan. Pastikan id unik.",
                NAMA_BAHAN: "Silahkan isi nama bahan",
                JUMLAH: {
                    "required" : "Silahkan isi jumlah bahan",
                    "min" : "Minimal jumlah bahan 0"
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