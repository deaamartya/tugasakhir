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
                    <h4 class="card-title">Jenis Kelas</h4>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#create-modal">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Buat Jenis Kelas Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Jenis Kelas</th>
                                    <th>Nama Jenis Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jeniskelas as $d)
                                <tr>
                                    <td>{{ $d->ID_JENIS_KELAS }}</td>
                                    <td>{{ $d->NAMA_JENIS_KELAS }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal" data-target="#modal-edit-{{ $d->ID_JENIS_KELAS }}"><i class="fa fa-pencil"></i></button>
                                            <!-- <button type="button" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#modal-delete-{{ $d->ID_JENIS_KELAS }}"><i class="fa fa-trash"></i></button> -->
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
                <h5 class="modal-title">Buat Jenis Kelas Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form id="create-jenis-kelas" action="{{ route('admin.jenis-kelas.store') }}" name="create-jenis-kelas" method="POST">
                    @csrf
                        <div class="form-group">
                            <label>Nama Jenis Kelas</label>
                            <input type="text" class="form-control @error('nama_jenis_kelas') is-invalid @enderror" id="nama_jenis_kelas" name="nama_jenis_kelas" required minlength="3" value="{{ @old('nama_jenis_kelas') }}">
                            <div class="invalid-feedback animated fadeInUp">
                                Nama Jenis Kelas harus unik dengan minimal 3 karakter
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

@foreach($jeniskelas as $d)
{{-- Edit Modal --}}
<div id="modal-edit-{{ $d->ID_JENIS_KELAS }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Jenis Kelas #{{ $d->ID_JENIS_KELAS }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" action="{{ route('admin.jenis-kelas.update',$d->ID_JENIS_KELAS) }}" name="edit-jenis-kelas" method="POST" enctype="multipart/form-data" id="form-edit-{{ $d->ID_JENIS_KELAS }}">
                @method('PUT')
                @csrf
                    <div class="form-group">
                        <label>Nama Jenis Kelas</label>
                        <input type="text" class="form-control @error('nama_jenis_kelas') is-invalid @enderror" id="nama_jenis_kelas" name="nama_jenis_kelas" required minlength="3" value="{{ $d->NAMA_JENIS_KELAS }}">
                        <div class="invalid-feedback animated fadeInUp">
                            Nama Jenis Kelas harus unik dengan minimal 3 karakter
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
{{-- End of Edit Modal --}}

{{-- Delete Modal --}}
<div class="modal fade" id="modal-delete-{{ $d->ID_JENIS_KELAS }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Jenis Kelas #{{ $d->ID_JENIS_KELAS }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.jenis-kelas.destroy',$d->ID_JENIS_KELAS) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    Apakah anda yakin ingin menghapus Jenis Kelas {{ $d->NAMA_JENIS_KELAS }} ?
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
    $("#create-jenis-kelas").validate({
        rules: {
            nama_jenis_kelas: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            nama_jenis_kelas: {
                required: "Silahkan isi nama Jenis Kelas",
                minlength: "Nama Jenis Kelas minimal 3 karakter"
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
                nama_jenis_kelas: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                nama_jenis_kelas: {
                    required: "Silahkan isi nama Jenis Kelas",
                    minlength: "Nama Jenis Kelas minimal 3 karakter"
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