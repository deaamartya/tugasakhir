{{-- Extends layout --}}
@extends('layout.fullwidth')
@php $action = "page_login"; $page_title = 'Login'; @endphp
{{-- Content --}}
@section('content')
<div class="col-md-6">
    <div class="authincation-content">
        <div class="row no-gutters">
            <div class="col-xl-12">
                <div class="auth-form">
                    <div class="row justify-content-center mb-3">
                        <img class="logo-abbr mr-3" src="{{ asset('images/logo.png') }}" alt="" height="90">
                        <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt="" height="90">
                    </div>
                    <h4 class="text-center mb-4">Selamat datang di Sistem Informasi Laboratorium IPA Terpadu SMA Negeri 3 Sidoarjo</h4>
                    @if($errors->any())
                        <div class="alert alert-danger">Username dan Password salah</div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label class="mb-1 text-black"><strong>Username</strong></label>
                            <input type="text" class="form-control" name="username" placeholder="Masukkan username Anda..." required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1 text-black"><strong>Kata Sandi</strong></label>
                            <div class="input-group transparent-append">
                                <input type="password" class="form-control" id="val-password1" name="password" placeholder="Masukkan kata sandi Anda.." required>
                                <div class="input-group-append show-pass" style="cursor: pointer;">
                                    <span class="input-group-text"> <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){   
        $(".show-pass").on('click',function(){
            // console.log("masuk show pass");
            var el = $("#val-password1");
            if(el.attr('type') == "password"){
                $("#val-password1").attr('type',"text");
                $(".show-pass span i").removeClass('fa-eye');
                $(".show-pass span i").addClass('fa-eye-slash');
            }
            else if(el.attr('type') == "text"){
                $("#val-password1").attr('type','password');
                $(".show-pass span i").removeClass('fa-eye-slash');
                $(".show-pass span i").addClass('fa-eye');
            }
        });
    });
</script>
@endsection