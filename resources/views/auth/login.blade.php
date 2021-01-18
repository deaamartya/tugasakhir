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
                      <h4 class="text-center mb-4">Sign in your account</h4>
                      <form action="{{ route('login') }}" method="POST">
                        @csrf
                          <div class="form-group">
                              <label class="mb-1"><strong>Username</strong></label>
                              <input type="text" class="form-control" name="username">
                          </div>
                          <div class="form-group">
                              <label class="mb-1"><strong>Password</strong></label>
                              <input type="password" class="form-control" name="password">
                          </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection