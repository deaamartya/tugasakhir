{{-- Extends layout --}}
@extends('layout.admin-default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style-admin')
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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pengguna</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data User</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID User</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $d)
                                <tr>
                                    @if($d->PATH_FOTO == null)
                                    <td><img class="rounded-circle" width="35" src="{{ asset('images/profile/small/pic1.jpg') }}" alt=""></td>
                                    @else
                                    <td><img class="rounded-circle" width="35" src="{{ asset('images/profile/'.$d->PATH_FOTO) }}" alt=""></td>
                                    @endif
                                    <td> {{ $d->ID_USER }} </td>
                                    <td> {{ $d->USERNAME }} </td>
                                    <td>
                                        @if($d->tipe_user->NAMA_TIPE_USER == 'Admin')
                                        <span class="badge light badge-info">
                                            <i class="fa fa-circle text-info mr-1"></i>
                                        @elseif ($d->tipe_user->NAMA_TIPE_USER == 'Guru')
                                        <span class="badge light badge-primary">
                                            <i class="fa fa-circle text-primary mr-1"></i>
                                        @else
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>
                                        @endif
                                            {{ $d->tipe_user->NAMA_TIPE_USER }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal" data-target="#modal-edit-{{ $d->ID_USER }}"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#modal-delete-{{ $d->ID_USER }}"><i class="fa fa-trash"></i></button>
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

@foreach($user as $d)
{{-- Edit Modal --}}
<div id="modal-edit-{{ $d->ID_USER }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User #{{ $d->ID_USER }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form class="form-valide" action="{{ url('admin/user') }}" name="edit-user" method="POST" enctype="multipart/form-data" id="form-edit-{{ $d->ID_USER }}">
                    @csrf
                        <div class="form-group">
                            <label>Tipe User</label>
                            <select class="form-control select2" name="id_tipe_user" id="select-tipe-user">
                                @foreach($tipeuser as $t)
                                    <option value="{{ $t->ID_TIPE_USER }}" @if($d->ID_TIPE_USER == $t->ID_TIPE_USER) selected @endif>{{ $t->NAMA_TIPE_USER }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $d->NAMA_LENGKAP }}">
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $d->USERNAME }}">
                        </div>

                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" class="form-control" name="foto" accept=".jpg,.jpeg,.png">
                            <div class="invalid-feedback">
                                Foto Profil yang diupload kurang dari 2MB dengan format .jpg, .jpeg atau .png
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary submit-btn" id="{{ $d->ID_USER }}">Simpan</button>
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}
@endforeach

@endsection

{{-- Tambahan Script --}}
@section('tambahan-script-admin')
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
    $("#select-tipe-user").select2();
    $(".form-valide").validate({
        rules: {
            id_tipe_user: {
                required: true
            },
            nama_lengkap: {
                required: true,
                minlength: 3
            },
            username: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            id_tipe_user: "Silahkan pilih tipe user",
            nama_lengkap: {
                required: "Silahkan isi nama lengkap pengguna",
                minlength: "Nama Lengkap pengguna minimal 3 karakter"
            },
            username: {
                required: "Silahkan isi username pengguna",
                minlength: "Username pengguna minimal 6 karakter"
            },
        },

        ignore: ["foto"],
        errorClass: "invalid-feedback animated fadeInUp",
        errorElement: "div",
        errorPlacement: function(e, a) {
            jQuery(a).parents(".form-group > div").append(e)
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
        },
    });
    $(".submit-btn").on('click',function(){
        console.log("submiting.....");
        $("#form-edit-"+$(this).attr('id')).submit();
    });
});
    
</script>
@endsection