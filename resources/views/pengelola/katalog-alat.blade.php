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
                    <h4 class="card-title">Katalog Alat</h4>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#create-modal">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Buat Katalog Alat Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Katalog Alat</th>
                                    <th>Nama Kategori</th>
                                    <th>Nama Katalog Alat</th>
                                    <th>Ukuran</th>
                                    {{-- <th>Jumlah Bagus</th>
                                    <th>Jumlah Rusak</th>
                                    <th>Jumlah</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($katalogalat as $d)
                                <tr>
                                    <td> {{ $d->ID_KATALOG_ALAT }} </td>
                                    <td> {{ $d->kategori_alat->NAMA_KATEGORI }} </td>
                                    <td> {{ $d->NAMA_ALAT }} </td>
                                    <td> {{ $d->UKURAN }} </td>
                                    {{-- <td> @if($d->alats->JUMLAH_BAGUS != null){{ count($d->alats->JUMLAH_BAGUS) }} @else 0 @endif</td>
                                    <td> @if($d->alats->JUMLAH_RUSAK != null){{ count($d->alats->JUMLAH_RUSAK) }} @else 0 @endif</td>
                                    <td> @if($d->alats->JUMLAH_BAGUS != null && $d->alats->JUMLAH_RUSAK != null){{ count($d->alats->JUMLAH_BAGUS) + count($d->alats->JUMLAH_RUSAK) }} @else 0 @endif</td> --}}
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
                <h5 class="modal-title">Buat Katalog Alat Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form id="create-katalogalat" action="{{ route('pengelola.katalog-alat.store') }}" name="create-katalogalat" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Kategori Alat</label>
                            <select class="form-control select2" name="ID_KATEGORI_ALAT" id="ID_KATEGORI_ALAT">
                                @foreach($kategori as $t)
                                    <option value="{{ $t->ID_KATEGORI_ALAT }}">{{ $t->NAMA_KATEGORI }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ID Katalog Alat</label>
                            <input type="text" class="form-control @error('ID_KATALOG_ALAT') is-invalid @enderror" id="ID_KATALOG_ALAT" name="ID_KATALOG_ALAT" value="{{ @old('ID_KATALOG_ALAT') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                ID Katalog Alat harus diisi dan unik
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama Alat</label>
                            <input type="text" class="form-control @error('NAMA_ALAT') is-invalid @enderror" id="NAMA_ALAT" name="NAMA_ALAT" value="{{ @old('NAMA_ALAT') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Nama Alat harus diisi
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ukuran</label>
                            <input type="text" class="form-control @error('UKURAN') is-invalid @enderror" id="UKURAN" name="UKURAN" value="{{ @old('UKURAN') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Ukuran harus diisi
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

@foreach($katalogalat as $d)
{{-- Edit Modal --}}
<div id="modal-edit-{{ $loop->index }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Katalog Alat #{{ $d->ID_KATALOG_ALAT }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" action="{{ route('pengelola.katalog-alat.update') }}" name="edit-katalogalat" method="POST" enctype="multipart/form-data" id="form-edit-{{ $loop->index }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="ID_KATALOG_LAMA" value="{{ $d->ID_KATALOG_ALAT }}">
                    <div class="form-group">
                        <label>ID Katalog Alat</label>
                        <input type="text" class="form-control @error('ID_KATALOG_ALAT') is-invalid @enderror" id="ID_KATALOG_ALAT" name="ID_KATALOG_ALAT" value="{{ $d->ID_KATALOG_ALAT }}">
                        <div class="invalid-feedback animated fadeInUp">
                            ID Katalog Alat harus diisi
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kategori Alat</label>
                        <select class="form-control select2" name="ID_KATEGORI_ALAT" id="ID_KATEGORI_ALAT">
                            @foreach($kategori as $t)
                                <option value="{{ $t->ID_KATEGORI_ALAT }}" @if($d->ID_KATEGORI_ALAT == $t->ID_KATEGORI_ALAT) selected @endif>{{ $t->NAMA_KATEGORI }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Alat</label>
                        <input type="text" class="form-control @error('NAMA_ALAT') is-invalid @enderror" id="NAMA_ALAT" name="NAMA_ALAT" value="{{ $d->NAMA_ALAT }}">
                        <div class="invalid-feedback animated fadeInUp">
                            Nama Alat harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="text" class="form-control @error('UKURAN') is-invalid @enderror" id="UKURAN" name="UKURAN" value="{{ $d->UKURAN }}">
                        <div class="invalid-feedback animated fadeInUp">
                            Ukuran harus diisi
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary submit-btn" id="{{ $d->ID_KATALOG_ALAT }}">Simpan</button>
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
                <h5 class="modal-title">Delete Katalog Alat #{{ $d->ID_KATALOG_ALAT }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengelola.katalog-alat.destroy') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    Apakah anda yakin ingin menghapus katalog alat {{ $d->NAMA_ALAT }} {{$d->UKURAN}} ?
                    <input type="hidden" name="ID_KATALOG_LAMA" value="{{ $d->ID_KATALOG_ALAT }}">
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
    $("#create-katalogalat").validate({
        rules: {
            ID_KATEGORI_ALAT: {
                required: true
            },
            NAMA_ALAT: {
                required: true,
            },
            ID_KATALOG_ALAT: {
                required: true,
            },
        },
        messages: {
            ID_KATEGORI_ALAT: "Silahkan pilih kategori alat",
            NAMA_ALAT: "Silahkan isi nama katalog Alat",
            ID_KATALOG_ALAT: "Silahkan isi katalog alat",
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
                ID_KATEGORI_ALAT: {
                    required: true
                },
                NAMA_ALAT: {
                    required: true,
                },
                ID_KATALOG_ALAT: {
                    required: true,
                },
            },
            messages: {
                ID_KATEGORI_ALAT: "Silahkan pilih kategori alat",
                NAMA_ALAT: "Silahkan isi nama katalog Alat",
                ID_KATALOG_ALAT: "Silahkan isi katalog alat",
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