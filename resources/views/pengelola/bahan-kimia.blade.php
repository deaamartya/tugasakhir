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
                    <h4 class="card-title">Bahan Kimia</h4>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#create-modal">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Buat Bahan Kimia Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Bahan</th>
                                    <th>Lab. - Lemari</th>
                                    <th>Bahan Kimia</th>
                                    <th>Spek.</th>
                                    <th>Jumlah(gr)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bahankimia as $d)
                                <tr>
                                    <td> {{ $d->ID_BAHAN_KIMIA }} </td>
                                    <td> {{ $d->lemari->laboratorium->NAMA_LABORATORIUM }} - {{ $d->lemari->NAMA_LEMARI }} </td>
                                    <td> {{ $d->katalog_bahan->NAMA_KATALOG_BAHAN }} ({{ $d->RUMUS }}) - {{ $d->WUJUD }}</td>
                                    <td> @if($d->SPESIFIKASI_BAHAN == "1")
                                    TEK
                                    @elseif($d->SPESIFIKASI_BAHAN == "0")
                                    PA
                                    @endif </td>
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
                <h5 class="modal-title">Buat Bahan Kimia Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form id="create-bahankimia" action="{{ route('pengelola.bahan-kimia.store') }}" name="create-bahankimia" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Lemari</label>
                            <select class="form-control select2" name="ID_LEMARI" id="ID_LEMARI">
                                @foreach($lemari as $t)
                                    <option value="{{ $t->ID_LEMARI }}">{{ $t->laboratorium->NAMA_LABORATORIUM }} - {{ $t->NAMA_LEMARI }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback animated fadeInUp">
                                Lemari harus diisi
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Bahan</label>
                            <select class="form-control select2" name="ID_KATALOG_BAHAN" id="ID_KATALOG_BAHAN">
                                @foreach($katalogbahan as $t)
                                    <option value="{{ $t->ID_KATALOG_BAHAN }}">{{ $t->ID_KATALOG_BAHAN }} - {{ $t->NAMA_KATALOG_BAHAN }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback animated fadeInUp">
                                Bahan harus diisi
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Rumus</label>
                            <input type="text" class="form-control @error('RUMUS') is-invalid @enderror" id="RUMUS" name="RUMUS" value="{{ @old('RUMUS') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Rumus harus diisi
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row ml-1">
                                <label>Spesifikasi</label>
                            </div>
                            <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="SPESIFIKASI_BAHAN" value="true" checked>TEK (Teknis)</label>
                            <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="SPESIFIKASI_BAHAN" value="false">PA (Pro Analis)</label>
                            <div class="invalid-feedback animated fadeInUp">
                                Spesifikasi harus diisi
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row ml-1">
                                <label>Wujud</label>
                            </div>
                            <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="WUJUD" value="Padat" checked>Padat</label>
                            <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="WUJUD" value="Cair">Cair</label>
                            <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="WUJUD" value="Gas">Gas</label>
                            <div class="invalid-feedback animated fadeInUp">
                                Wujud harus diisi
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jumlah (gr)</label>
                            <input type="number" class="form-control @error('JUMLAH_BAHAN_KIMIA') is-invalid @enderror" id="JUMLAH_BAHAN_KIMIA" name="JUMLAH_BAHAN_KIMIA" value="{{ @old('JUMLAH_BAHAN_KIMIA') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Jumlah bahan kimia harus diisi
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

@foreach($bahankimia as $d)
{{-- Edit Modal --}}
<div id="modal-edit-{{ $loop->index }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bahan Kimia #{{ $d->ID_BAHAN_KIMIA }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" action="{{ route('pengelola.bahan-kimia.update') }}" name="edit-bahankimia" method="POST" enctype="multipart/form-data" id="form-edit-{{ $loop->index }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="ID_BAHAN_KIMIA" value="{{ $d->ID_BAHAN_KIMIA }}">

                    <div class="form-group">
                        <label>Lemari</label>
                        <select class="form-control select2" name="ID_LEMARI" id="ID_LEMARI">
                            @foreach($lemari as $t)
                                <option value="{{ $t->ID_LEMARI }}" @if($d->ID_LEMARI == $t->ID_LEMARI) selected @endif>{{ $t->laboratorium->NAMA_LABORATORIUM }} - {{ $t->NAMA_LEMARI }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bahan</label>
                        <select class="form-control select2" name="ID_KATALOG_BAHAN" id="ID_KATALOG_BAHAN">
                            @foreach($katalogbahan as $t)
                                <option value="{{ $t->ID_KATALOG_BAHAN }}" @if($d->ID_KATALOG_BAHAN == $t->ID_KATALOG_BAHAN) selected @endif >{{ $t->ID_KATALOG_BAHAN }} - {{ $t->NAMA_KATALOG_BAHAN }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback animated fadeInUp">
                            Bahan harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Rumus</label>
                        <input type="text" class="form-control @error('RUMUS') is-invalid @enderror" id="RUMUS" name="RUMUS" value="{{ $d->RUMUS }}">
                        <div class="invalid-feedback animated fadeInUp">
                            Rumus harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row ml-1">
                            <label>Spesifikasi</label>
                        </div>
                        <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="SPESIFIKASI_BAHAN" value="true" @if($d->SPESIFIKASI_BAHAN == 1) checked @endif >TEK (Teknis)</label>
                        <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="SPESIFIKASI_BAHAN" value="false" @if($d->SPESIFIKASI_BAHAN == 0) checked @endif >PA (Pro Analis)</label>
                    </div>

                    <div class="form-group">
                        <div class="form-row ml-1">
                            <label>Wujud</label>
                        </div>
                        <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="WUJUD" value="Padat" @if($d->WUJUD == "Padat") checked @endif >Padat</label>
                        <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="WUJUD" value="Cair" @if($d->WUJUD == "Cair") checked @endif >Cair</label>
                        <label class="radio-inline mr-3"><input class="mr-2" type="radio" name="WUJUD" value="Gas" @if($d->WUJUD == "Gas") checked @endif >Gas</label>
                        <div class="invalid-feedback animated fadeInUp">
                            Wujud harus diisi
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary submit-btn" id="{{ $d->ID_BAHAN_KIMIA }}">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}
{{-- Pengadaan Modal --}}
<div class="modal fade" id="modal-tambah-{{ $loop->index }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keluar Masuk Stok Bahan Kimia #{{ $d->ID_BAHAN_KIMIA }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengelola.bahan-kimia.updateStock') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ID_BAHAN_KIMIA" value="{{ $d->ID_BAHAN_KIMIA }}">

                    <div class="form-group">
                        <label>Jumlah Masuk<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_BAHAN_KIMIA_MASUK') is-invalid @enderror" id="JUMLAH_BAHAN_KIMIA_MASUK" name="JUMLAH_BAHAN_KIMIA_MASUK" min="0" value="0">
                        <div class="invalid-feedback animated fadeInUp">
                            Jumlah masuk harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Keluar<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_BAHAN_KIMIA_KELUAR') is-invalid @enderror" id="JUMLAH_BAHAN_KIMIA_KELUAR" name="JUMLAH_BAHAN_KIMIA_KELUAR" min="0" value="0">
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
{{-- End of Pengadaan Modal --}}
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
    $("#create-bahankimia").validate({
        rules: {
            ID_LEMARI: {
                required: true
            },
            RUMUS: {
                required: true,
            },
            SPESIFIKASI_BAHAN: {
                required: true,
            },
            WUJUD: {
                required: true,
            },
            JUMLAH_BAHAN_KIMIA: {
                required: true,
                min: 0,
            },
        },
        messages: {
            ID_LEMARI: "Silahkan pilih lemari",
            RUMUS: "Silahkan isi nama rumus bahan",
            SPESIFIKASI_BAHAN: "Silahkan pilih spesifikasi bahan",
            WUJUD: "Silahkan pilih wujud bahan",
            JUMLAH_BAHAN_KIMIA: "Silahkan isi jumlah(gr) bahan",
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
                RUMUS: {
                    required: true,
                },
                SPESIFIKASI_BAHAN: {
                    required: true,
                },
                WUJUD: {
                    required: true,
                },
                JUMLAH_BAHAN_KIMIA: {
                    required: true,
                    min: 0,
                },
            },
            messages: {
                ID_LEMARI: "Silahkan pilih lemari",
                RUMUS: "Silahkan isi nama rumus bahan",
                SPESIFIKASI_BAHAN: "Silahkan pilih spesifikasi bahan",
                WUJUD: "Silahkan pilih wujud bahan",
                JUMLAH_BAHAN_KIMIA: "Silahkan isi jumlah(gr) bahan",
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