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
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Akademik</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Kelas</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
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
                    <h4 class="card-title">Kelas</h4>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#create-modal">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Buat Kelas Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Kelas</th>
                                    <th>Nama Kelas</th>
                                    <th>Tahun Akademik</th>
                                    <th>Guru</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kelas as $d)
                                <tr>
                                    <td>{{ $d->ID_KELAS }}</td>
                                    <td>{{ $d->jenis_kelas->NAMA_JENIS_KELAS }}</td>
                                    <td>{{ $d->tahun_akademik->TAHUN_AKADEMIK }}</td>
                                    <td>{{ $d->guru->NAMA_LENGKAP }}</td>	
                                    <td>{{ $d->mapel->NAMA_MAPEL }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal" data-target="#modal-edit-{{ $d->ID_KELAS }}"><i class="fa fa-pencil"></i></button>
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
                <h5 class="modal-title">Buat Kelas Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form id="create-kelas" action="{{ route('admin.kelas.store') }}" name="create-kelas" method="POST">
                    @csrf
                        <div class="form-group">
                            <label>Jenis Kelas</label>
                            <select class="form-control select2" name="ID_JENIS_KELAS" id="ID_JENIS_KELAS">
                                @foreach($jeniskelas as $t)
                                    <option value="{{ $t->ID_JENIS_KELAS }}">{{ $t->NAMA_JENIS_KELAS }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun Akademik</label>
                            <select class="form-control select2" name="ID_TAHUN_AKADEMIK" id="ID_TAHUN_AKADEMIK">
                                @foreach($tahunakademik as $t)
                                    <option value="{{ $t->ID_TAHUN_AKADEMIK }}">{{ $t->TAHUN_AKADEMIK }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Guru</label>
                            <select class="form-control select2" name="ID_USER" id="ID_USER">
                                @foreach($guru as $t)
                                    <option value="{{ $t->ID_USER }}">{{ $t->NAMA_LENGKAP }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control select2" name="ID_MAPEL" id="ID_MAPEL">
                                @foreach($mapel as $t)
                                    <option value="{{ $t->ID_MAPEL }}">{{ $t->NAMA_MAPEL }}</option>
                                @endforeach
                            </select>
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

@foreach($kelas as $d)
{{-- Edit Modal --}}
<div id="modal-edit-{{ $d->ID_KELAS }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kelas #{{ $d->ID_KELAS }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" action="{{ route('admin.kelas.update',$d->ID_KELAS) }}" name="edit-kelas" method="POST" enctype="multipart/form-data" id="form-edit-{{ $d->ID_KELAS }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Jenis Kelas</label>
                    <select class="form-control select2" name="ID_JENIS_KELAS" id="ID_JENIS_KELAS">
                        @foreach($jeniskelas as $t)
                            <option value="{{ $t->ID_JENIS_KELAS }}" @if($d->ID_JENIS_KELAS == $t->ID_JENIS_KELAS) selected @endif >{{ $t->NAMA_JENIS_KELAS }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun Akademik</label>
                    <select class="form-control select2" name="ID_TAHUN_AKADEMIK" id="ID_TAHUN_AKADEMIK">
                        @foreach($tahunakademik as $t)
                            <option value="{{ $t->ID_TAHUN_AKADEMIK }}" @if($d->ID_TAHUN_AKADEMIK == $t->ID_TAHUN_AKADEMIK) selected @endif >{{ $t->TAHUN_AKADEMIK }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Guru</label>
                    <select class="form-control select2" name="ID_USER" id="ID_USER">
                        @foreach($guru as $t)
                            <option value="{{ $t->ID_USER }}" @if($d->ID_USER == $t->ID_USER) selected @endif >{{ $t->NAMA_LENGKAP }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <select class="form-control select2" name="ID_MAPEL" id="ID_MAPEL">
                        @foreach($mapel as $t)
                            <option value="{{ $t->ID_MAPEL }}" @if($d->ID_MAPEL == $t->ID_MAPEL) selected @endif >{{ $t->NAMA_MAPEL }}</option>
                        @endforeach
                    </select>
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
{{-- End of Edit Modal --}}

{{-- Delete Modal --}}
<div class="modal fade" id="modal-delete-{{ $d->ID_KELAS }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Kelas #{{ $d->ID_KELAS }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.kelas.destroy',$d->ID_KELAS) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    Apakah anda yakin ingin menghapus Kelas {{ $d->ID_KELAS }} ?
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
@if(!empty(config('dz.public.pagelevel.js.form_validation_jquery')))
	@foreach(config('dz.public.pagelevel.js.form_validation_jquery') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
<script>
$(document).ready(function(){
    $("#create-kelas").validate({
        rules: {
            ID_JENIS_KELAS: {
                required: true,
            },
            ID_TAHUN_AKADEMIK: {
                required: true,
            },
            ID_USER: {
                required: true,
            },
            ID_MAPEL: {
                required: true,
            }
        },
        messages: {
            ID_JENIS_KELAS: "Silahkan pilih jenis kelas",
            ID_TAHUN_AKADEMIK: "Silahkan pilih tahun akademik",
            ID_USER: "Silahkan pilih guru",
            ID_MAPEL: "Silahkan pilih mata pelajaran",

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
                ID_JENIS_KELAS: {
                    required: true,
                },
                ID_TAHUN_AKADEMIK: {
                    required: true,
                },
                ID_USER: {
                    required: true,
                },
                ID_MAPEL: {
                    required: true,
                }
            },
            messages: {
                ID_JENIS_KELAS: "Silahkan pilih jenis kelas",
                ID_TAHUN_AKADEMIK: "Silahkan pilih tahun akademik",
                ID_USER: "Silahkan pilih guru",
                ID_MAPEL: "Silahkan pilih mata pelajaran",

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