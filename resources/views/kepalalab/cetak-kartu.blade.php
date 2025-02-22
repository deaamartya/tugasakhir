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
                    <h4 class="card-title">Cetak Kartu Stok</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form id="create-stok" action="{{ url('kepalalab/cetak/kartu-stok') }}" name="create-stok" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Alat</label>
                                <select class="form-control select2 @error('ID_ALAT') is-invalid @enderror" name="ID_ALAT" id="ID_ALAT">
                                    @foreach($alat as $t)
                                        <option value="{{ $t->ID_ALAT }}">{{ $t->lemari->laboratorium->NAMA_LABORATORIUM }} - {{ $t->ID_ALAT}} {{ $t->merk_tipe_alat->NAMA_MERK_TIPE}} {{ $t->katalog_alat->NAMA_ALAT}} {{$t->katalog_alat->UKURAN}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback animated fadeInUp">
                                    Silahkan pilih lemari
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tahun Akademik</label>
                                <select class="form-control select2 @error('ID_TAHUN_AKADEMIK') is-invalid @enderror" name="ID_TAHUN_AKADEMIK" id="ID_TAHUN_AKADEMIK">
                                    @foreach($tahunakademik as $t)
                                        <option value="{{ $t->ID_TAHUN_AKADEMIK }}" @if($t->ID_TAHUN_AKADEMIK == $tahun_akademik->ID_TAHUN_AKADEMIK) selected @endif>{{ $t->TAHUN_AKADEMIK}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback animated fadeInUp">
                                    Silahkan pilih lemari
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary submit-btn">Cetak Kartu Stok</button>
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
    $("#create-stok").validate({
        rules: {
            ID_TAHUN_AKADEMIK: {
                required: true
            },
            ID_ALAT: {
                required: true
            }
        },
        messages: {
            ID_TAHUN_AKADEMIK: "Silahkan pilih tahun ajaran",
            ID_ALAT: "Silahkan pilih alat",
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