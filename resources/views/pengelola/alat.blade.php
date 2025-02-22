{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
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
                    <h4 class="card-title">Alat</h4>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#create-modal">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Buat Alat Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Alat</th>
                                    <th>Lemari</th>
                                    <th>ID Katalog</th>
                                    <th>Alat</th>
                                    <th>Jumlah Bagus(pcs)</th>
                                    <th>Jumlah Rusak(pcs)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alat as $d)
                                <tr>
                                    <td>{{ $d->ID_ALAT }}</td>
                                    <td>{{ $d->lemari->NAMA_LEMARI }}</td>
                                    <td>{{ $d->ID_KATALOG_ALAT }}</td>
                                    <td>{{ $d->katalog_alat->NAMA_ALAT }} {{ $d->merk_tipe_alat->NAMA_MERK_TIPE }} {{ $d->katalog_alat->UKURAN }} </td>
                                    <td>{{ $d->stok_bagus() }}</td>
                                    <td>{{ $d->stok_rusak() }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal" data-target="#modal-edit-{{ $loop->index }}"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#modal-tambah-{{ $loop->index }}"><i class="fa fa-plus"></i></button>
                                            @if($d->stok_bagus() == 0)
                                            <div class="ml-2 badge badge-danger"><i class="fa fa-warning mr-2"></i>Alat habis</div>
                                            @elseif($d->stok_bagus() < 10)
                                            <div class="ml-2 badge badge-warning"><i class="fa fa-warning mr-2"></i>Alat akan habis</div>
                                            @endif
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
                <h5 class="modal-title">Buat Alat Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="form-validation">
                    
                    <form id="create-alat" action="{{ route('pengelola.alat.store') }}" name="create-alat" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Katalog Alat</label>
                            <select class="select2 @error('ID_KATALOG_ALAT') is-invalid @enderror" name="ID_KATALOG_ALAT" id="ID_KATALOG_ALAT">
                                @foreach($katalog as $t)
                                    <option value="{{ $t->ID_KATALOG_ALAT }}">{{ $t->ID_KATALOG_ALAT }} - {{ $t->NAMA_ALAT }} {{ $t->UKURAN }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback animated fadeInUp">
                                Silahkan pilih katalog alat
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Lemari</label>
                            <select class="select2 @error('ID_LEMARI') is-invalid @enderror" name="ID_LEMARI" id="ID_LEMARI">
                                @foreach($lemari as $t)
                                    <option value="{{ $t->ID_LEMARI }}">{{ $t->NAMA_LEMARI }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback animated fadeInUp">
                                Silahkan pilih lemari
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Merk/Tipe</label>
                            <select class="select2 @error('ID_MERK_TIPE') is-invalid @enderror" name="ID_MERK_TIPE" id="ID_MERK_TIPE">
                                @foreach($tipe as $t)
                                    <option value="{{ $t->ID_MERK_TIPE }}">{{ $t->NAMA_MERK_TIPE }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback animated fadeInUp">
                                Silahkan pilih merk/tipe alat
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jumlah Bagus</label>
                            <input type="number" class="form-control @error('JUMLAH_BAGUS') is-invalid @enderror" id="JUMLAH_BAGUS" name="JUMLAH_BAGUS" value="{{ @old('JUMLAH_BAGUS') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Jumlah bagus harus diisi
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jumlah Rusak</label>
                            <input type="number" class="form-control @error('JUMLAH_RUSAK') is-invalid @enderror" id="JUMLAH_RUSAK" name="JUMLAH_RUSAK" value="{{ @old('JUMLAH_RUSAK') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Jumlah rusak harus diisi
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

@foreach($alat as $d)
{{-- Edit Modal --}}
<div id="modal-edit-{{ $loop->index }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Alat #{{ $d->ID_ALAT }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" action="{{ route('pengelola.alat.update') }}" name="edit-alat" method="POST" id="form-edit-{{ $loop->index }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="ID_ALAT_LAMA" value="{{ $d->ID_ALAT }}">
                    <div class="form-group">
                        <label>Katalog Alat</label>
                        <select class="select2 @error('ID_KATALOG_ALAT') is-invalid @enderror" name="ID_KATALOG_ALAT" id="ID_KATALOG_ALAT{{ $loop->iteration }}">
                            @foreach($katalog as $t)
                                <option value="{{ $t->ID_KATALOG_ALAT }}" @if($d->ID_KATALOG_ALAT == $t->ID_KATALOG_ALAT) selected @endif >{{ $t->ID_KATALOG_ALAT }} - {{ $t->NAMA_ALAT }} {{ $t->UKURAN }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback animated fadeInUp">
                            Silahkan pilih katalog alat
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Lemari</label>
                        <select class="select2 @error('ID_LEMARI') is-invalid @enderror" name="ID_LEMARI" id="ID_LEMARI{{ $loop->iteration }}">
                            @foreach($lemari as $t)
                                <option value="{{ $t->ID_LEMARI }}" @if($d->ID_LEMARI == $t->ID_LEMARI) selected @endif >{{ $t->NAMA_LEMARI }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback animated fadeInUp">
                            Silahkan pilih lemari
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Merk/Tipe</label>
                        <select class="select2 @error('ID_MERK_TIPE') is-invalid @enderror" name="ID_MERK_TIPE" id="ID_MERK_TIPE{{ $loop->iteration }}">
                            @foreach($tipe as $t)
                                <option value="{{ $t->ID_MERK_TIPE }}" @if($d->ID_MERK_TIPE == $t->ID_MERK_TIPE) selected @endif >{{ $t->NAMA_MERK_TIPE }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback animated fadeInUp">
                            Silahkan pilih merk/tipe alat
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary submit-btn" id="{{ $d->ID_ALAT }}">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}

{{-- Keluar Masuk Stok Modal --}}
<div class="modal fade" id="modal-tambah-{{ $loop->index }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keluar Masuk Stok Alat #{{ $d->ID_ALAT }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengelola.alat.updateStock') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ID_ALAT_LAMA" value="{{ $d->ID_ALAT }}">

                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select class="form-control @error('JENIS_TRANSAKSI') is-invalid @enderror" name="JENIS_TRANSAKSI" id="JENIS_TRANSAKSI">
                            <option value="1">Pengadaan Barang</option>
                            <option value="2">Ditemukan Alat Rusak</option>
                        </select>
                        <div class="invalid-feedback animated fadeInUp">
                            Silahkan pilih jenis transaksi
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Jumlah Masuk Alat Bagus<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_BAGUS_MASUK') is-invalid @enderror" id="JUMLAH_BAGUS_MASUK" name="JUMLAH_BAGUS_MASUK" min="0" value="0">
                        <div class="invalid-feedback animated fadeInUp">
                            Jumlah masuk alat bagus harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Keluar Alat Bagus<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_BAGUS_KELUAR') is-invalid @enderror" id="JUMLAH_BAGUS_KELUAR" name="JUMLAH_BAGUS_KELUAR" min="0" value="0">
                        <div class="invalid-feedback animated fadeInUp">
                            Jumlah keluar alat bagus harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Masuk Alat Rusak<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_RUSAK_MASUK') is-invalid @enderror" id="JUMLAH_RUSAK_MASUK" name="JUMLAH_RUSAK_MASUK" min="0" value="0">
                        <div class="invalid-feedback animated fadeInUp">
                            Jumlah masuk alat rusak harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Keluar Alat Rusak<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_RUSAK_KELUAR') is-invalid @enderror" id="JUMLAH_RUSAK_KELUAR" name="JUMLAH_RUSAK_KELUAR" min="0" value="0">
                        <div class="invalid-feedback animated fadeInUp">
                            Jumlah keluar alat rusak harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan<small class="text-danger">*</small></label>
                        <input type="text" class="form-control @error('KETERANGAN') is-invalid @enderror" id="KETERANGAN" name="KETERANGAN" value="Stok tambahan dari pengadaan" required>
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
    $(".select2").each(function(key, value) {
        $(this).select2();
    });
    $("#create-alat").validate({
        rules: {
            ID_KATALOG_ALAT: {
                required: true
            },
            ID_LEMARI: {
                required: true,
            },
            ID_MERK_TIPE: {
                required: true,
            },
            JUMLAH_BAGUS: {
                required: true,
                min: 0,
            },
            JUMLAH_RUSAK: {
                required: true,
                min: 0,
            },
        },
        messages: {
            ID_KATALOG_ALAT: "Silahkan pilih katalog alat",
            ID_LEMARI: "Silahkan pilih lemari lokasi alat",
            ID_MERK_TIPE: "Silahkan pilih merk/tipe alat",
            JUMLAH_BAGUS: {
                "required" : "Silahkan isi jumlah bagus",
                "min" : "Minimal jumlah bagus 0"
            },
            JUMLAH_RUSAK: {
                "required" : "Silahkan isi jumlah rusak",
                "min" : "Minimal jumlah rusak 0"
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
                ID_KATALOG_ALAT: {
                    required: true
                },
                ID_LEMARI: {
                    required: true,
                },
                ID_MERK_TIPE: {
                    required: true,
                },
                JUMLAH_BAGUS: {
                    required: true,
                    min: 0,
                },
                JUMLAH_RUSAK: {
                    required: true,
                    min: 0,
                },
            },
            messages: {
                ID_KATALOG_ALAT: "Silahkan pilih katalog alat",
                ID_LEMARI: "Silahkan pilih lemari lokasi alat",
                ID_MERK_TIPE: "Silahkan pilih merk/tipe alat",
                JUMLAH_BAGUS: {
                    "required" : "Silahkan isi jumlah bagus",
                    "min" : "Minimal jumlah bagus 0"
                },
                JUMLAH_RUSAK: {
                    "required" : "Silahkan isi jumlah rusak",
                    "min" : "Minimal jumlah rusak 0"
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