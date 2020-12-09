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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pengguna</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data User</a></li>
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
                    <h4 class="card-title">User</h4>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#create-modal">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Buat User Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID User</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $d)
                                <tr>
                                    @if($d->PATH_FOTO == null)
                                    <td><img class="rounded-circle" width="50" height="50" src="{{ asset('images/profile/small/pic1.jpg') }}" alt="foto_profile" style="object-fit: cover;"></td>
                                    @else
                                    <td><img class="rounded-circle" width="50" height="50" src="{{ asset('storage'.$d->PATH_FOTO) }}" alt="foto_profile" style="object-fit: cover;"></td>
                                    @endif
                                    <td> {{ $d->ID_USER }} </td>
                                    <td> {{ $d->USERNAME }} </td>
                                    <td> {{ $d->NAMA_LENGKAP }} </td>
                                    <td>
                                        @if($d->NAMA_TIPE_USER == 'Admin')
                                        <span class="badge light badge-info">
                                            <i class="fa fa-circle text-info mr-1"></i>
                                        @elseif (strpos($d->NAMA_TIPE_USER, 'Guru') !== false)
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>
                                        @elseif (strpos($d->NAMA_TIPE_USER, 'Pengelola') !== false)
                                        <span class="badge light badge-warning">
                                            <i class="fa fa-circle text-warning mr-1"></i>
                                        @else
                                        <span class="badge light badge-primary">
                                            <i class="fa fa-circle text-primary mr-1"></i>
                                        @endif
                                            {{ $d->NAMA_TIPE_USER }}
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

{{-- Create Modal --}}
<div id="create-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat User Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form id="create-user" action="{{ route('admin.user.store') }}" name="create-user" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Tipe User</label>
                            <select class="form-control select2" name="id_tipe_user" id="id_tipe_user">
                                @foreach($tipeuser as $t)
                                    <option value="{{ $t->ID_TIPE_USER }}">{{ $t->NAMA_TIPE_USER }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ @old('nama_lengkap') }}">
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" data-rule-insz="true" id="username" name="username" value="{{ @old('username') }}">
                            <div class="invalid-feedback">
                                Username harus unik.
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="6" value="{{ @old('password') }}">
                        </div>

                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" accept=".jpg,.jpeg,.png">
                            <div class="invalid-feedback">
                                Foto Profil yang diupload kurang dari 2MB dengan format .jpg, .jpeg atau .png
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary submit-btn" id="{{ $d->ID_USER }}">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End of Create Modal --}}

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
                <form class="form-valide" action="{{ route('admin.user.update',$d->ID_USER) }}" name="edit-user" method="POST" enctype="multipart/form-data" id="form-edit-{{ $d->ID_USER }}">
                @method('PUT')
                @csrf
                    <div class="form-group">
                        <label>Tipe User</label>
                        <select class="form-control select2" name="id_tipe_user" id="id_tipe_user">
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
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $d->USERNAME }}">
                        <div class="invalid-feedback">
                            Username harus unik.
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" id="edit-password" name="password" minlength="6" value="">
                    </div>

                    <div class="form-group">
                        <label>Foto Profil</label>
                        <div class="row p-3 align-items-center">
                            @if($d->PATH_FOTO != null)
                            <img class="rounded mr-3" width="100" height="100" src="{{ asset('storage'.$d->PATH_FOTO) }}" alt="foto_profile" style="object-fit: cover;">
                            @endif
                            <input type="file" class="@error('foto') is-invalid @enderror" name="foto" accept=".jpg,.jpeg,.png">
                            <div class="invalid-feedback">
                                Foto Profil yang diupload kurang dari 2MB dengan format .jpg, .jpeg atau .png
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary submit-btn" id="{{ $d->ID_USER }}">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}

{{-- Delete Modal --}}
<div class="modal fade" id="modal-delete-{{ $d->ID_USER }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User #{{ $d->ID_USER }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.user.destroy',[$d->ID_USER]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    Apakah anda yakin ingin menghapus user {{ $d->NAMA_LENGKAP }} ?
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
    $("#select-tipe-user").select2();
    $.validator.addMethod("checkUserName", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"GET",
                async: false,
                url: "/cekusername/"+value,
                success: function(data) {
                    result = (data == true) ? false : true;
                }
            });
            // return true if username is exist in database
            return result; 
        },
        "Username ini sudah ada. Silahkan coba yang lain"
    );
    $("#create-user").validate({
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
                minlength: 6,
                checkUserName: true,
            },
            password: {
                required: true,
                minlength: 6
            }
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
            password: {
                minlength: "Password pengguna minimal 6 karakter",
                required: "Silahkan isi password pengguna"
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
                id_tipe_user: {
                    required: true
                },
                nama_lengkap: {
                    required: true,
                    minlength: 3
                },
                username: {
                    required: true,
                    minlength: 6,
                },
                password: {
                    minlength: 6
                }
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
                password: {
                    minlength: "Password baru minimal 6 karakter"
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
    });
});
    
</script>
@endsection