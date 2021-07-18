@extends('layout.fullwidth')

@section('content')
	<div class="row justify-content-center my-5">
		<div class="col-12">
			<h1 class="judulhalaman">Ganti Password</h1>
      <hr>
		</div>
		<div class="col-12">
      <form action="{{ url('ganti-password') }}" method="POST">
        @csrf
        <div class="form-group mx-auto">
          <label>Password Lama</label>
          <div class="input-group">
            <input class="form-control @error('old_password') is-invalid @enderror" type="password" id="pwnow" required name="old_password">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
            </div>
            <div class="invalid-feedback">
              Password lama harus diisi dan benar.
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Password Baru</label>
          <div class="input-group">
            <input class="form-control" type="password" id="pwnew" required name="new_password">
            <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
          </div>
          </div>
        </div>
        <div class="form-group">
          <label>Konfirmasi Password Baru</label>
          <div class="input-group">
            <input class="form-control" type="password" id="pwnew2" required name="pwnew2">
            <div class="input-group-append">
            <span class="input-group-text" id="basic-addon3"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
          </div>
          </div>
        </div>
        <small id="konfirmasi" class="form-text text-muted text-red mb-3" style="color: red">Password Baru dan Konfirmasi Password Baru tidak sama.</small>
        <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
      </form>
		</div>
	</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script>
		$(document).ready(function() {
		    $("#basic-addon1").on('click', function(event) {
		        event.preventDefault();
		        if($('#pwnow').attr("type") == "text"){
		            $('#pwnow').attr('type', 'password');
		            $('#basic-addon1 i').addClass( "fa-eye-slash" );
		            $('#basic-addon1 i').removeClass( "fa-eye" );
		        }else if($('#pwnow').attr("type") == "password"){
		            $('#pwnow').attr('type', 'text');
		            $('#basic-addon1 i').removeClass( "fa-eye-slash" );
		            $('#basic-addon1 i').addClass( "fa-eye" );
		        }
		    });
		    $("#basic-addon2").on('click', function(event) {
		        event.preventDefault();
		        if($('#pwnew').attr("type") == "text"){
		            $('#pwnew').attr('type', 'password');
		            $('#basic-addon2 i').addClass( "fa-eye-slash" );
		            $('#basic-addon2 i').removeClass( "fa-eye" );
		        }else if($('#pwnew').attr("type") == "password"){
		            $('#pwnew').attr('type', 'text');
		            $('#basic-addon2 i').removeClass( "fa-eye-slash" );
		            $('#basic-addon2 i').addClass( "fa-eye" );
		        }
		    });
		    $("#basic-addon3").on('click', function(event) {
		        event.preventDefault();
		        if($('#pwnew2').attr("type") == "text"){
		            $('#pwnew2').attr('type', 'password');
		            $('#basic-addon3 i').addClass( "fa-eye-slash" );
		            $('#basic-addon3 i').removeClass( "fa-eye" );
		        }else if($('#pwnew2').attr("type") == "password"){
		            $('#pwnew2').attr('type', 'text');
		            $('#basic-addon3 i').removeClass( "fa-eye-slash" );
		            $('#basic-addon3 i').addClass( "fa-eye" );
		        }
		    });
		    $("#konfirmasi").hide();
		    $("#pwnew2").on('input',function(){
		    	if($(this).val().length > 6){
		    		if($(this).val() === $("#pwnew").val()){
		    			$("#konfirmasi").hide();
		    			$("#submit-btn").attr('disabled', false);
		    		}
		    		else{
		    			$("#konfirmasi").show();
		    			$("#submit-btn").attr('disabled', true);
		    		}
		    	}
          else{
            $("#submit-btn").attr('disabled', true);
          }
		    });
		})
	</script>
@endsection