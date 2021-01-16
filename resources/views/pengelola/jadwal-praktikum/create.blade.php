{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.app_calender'))) 
        @foreach(config('dz.public.pagelevel.css.app_calender') as $style)
                <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.css.form_pickers'))) 
        @foreach(config('dz.public.pagelevel.css.form_pickers') as $style)
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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Data Master</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Praktikum</a></li>
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
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div id="calendar" class="app-fullcalendar"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-intro-title">Calendar</h4>

                            <div class="">
                                <div id="external-events" class="my-3">
                                    <p>Drag and drop your event or click in the calendar</p>
                                    <div class="external-event" data-class="bg-primary"><i class="fa fa-move"></i>New Theme Release</div>
                                    <div class="external-event" data-class="bg-success"><i class="fa fa-move"></i>My Event
                                    </div>
                                    <div class="external-event" data-class="bg-warning"><i class="fa fa-move"></i>Meet manager</div>
                                    <div class="external-event" data-class="bg-dark"><i class="fa fa-move"></i>Create New theme</div>
                                </div>
                                <!-- checkbox -->
                                <div class="checkbox custom-control checkbox-event custom-checkbox pt-3 pb-5">
                                    <input type="checkbox" class="custom-control-input" id="drop-remove">
                                    <label class="custom-control-label" for="drop-remove">Remove After Drop</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jadwal Praktikum</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="create-jadwal" action="{{ route('pengelola.jadwal-praktikum.store') }}" name="create-praktikum" method="POST">
                        @csrf
                            <div class="form-group">
                                <label>Ruang Laboratorium</label>
                                <select class="select2-single @error('ID_RUANG_LABORATORIUM') is-invalid @enderror" name="ID_RUANG_LABORATORIUM" id="ID_RUANG_LABORATORIUM">
                                    @foreach($ruanglaboratorium as $t)
                                        <option value="{{ $t->ID_RUANG_LABORATORIUM }}">{{ $t->NAMA_RUANG_LABORATORIUM }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback animated fadeInUp">
                                    Silahkan pilih praktikum
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Praktikum</label>
                                <select class="select2-single @error('ID_PRAKTIKUM') is-invalid @enderror" name="ID_PRAKTIKUM" id="ID_PRAKTIKUM">
                                    @foreach($praktikum as $t)
                                        <option value="{{ $t->ID_PRAKTIKUM }}">{{ $t->NAMA_PRAKTIKUM }} - {{ $t->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback animated fadeInUp">
                                    Silahkan pilih praktikum
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Praktikum</label>
                                <input name="TANGGAL_PEMINJAMAN" class="datepicker-default form-control @error('TANGGAL_PEMINJAMAN') is-invalid @enderror" id="TANGGAL_PEMINJAMAN">
                                <div class="invalid-feedback animated fadeInUp">
                                    Tanggal Praktikum harus diisi
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jam Mulai Praktikum</label>
                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                    <input type="text" class="form-control @error('JAM_MULAI') is-invalid @enderror" name="JAM_MULAI" id="JAM_MULAI">
                                </div>
                                <div class="invalid-feedback animated fadeInUp">
                                Jam Mulai Praktikum harus diisi
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jam Selesai Praktikum</label>
                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                    <input type="text" class="form-control @error('JAM_SELESAI') is-invalid @enderror" name="JAM_SELESAI" id="JAM_SELESAI"> 
                                </div>
                                <div class="invalid-feedback animated fadeInUp">
                                Jam Selesai Praktikum harus diisi
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary submit-btn">Simpan</button>
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
@if(!empty(config('dz.public.pagelevel.js.app_calender')))
	@foreach(config('dz.public.pagelevel.js.app_calender') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
@endif
@if(!empty(config('dz.public.pagelevel.js.form_pickers')))
	@foreach(config('dz.public.pagelevel.js.form_pickers') as $script)
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
    $("#ID_PRAKTIKUM").select2();
    $("#ID_RUANG_LABORATORIUM").select2();
    
    $("#create-jadwal").validate({
        rules: {
            ID_RUANG_LABORATORIUM: {
                required: true
            },
            ID_PRAKTIKUM: {
                required: true,
            },
            TANGGAL_PRAKTIKUM: {
                required: true,
            },
            JAM_MULAI: {
                required: true,
            },
            JAM_SELESAI: {
                required: true,
            },
        },
        messages: {
            ID_LABORATORIUM: "Silahkan pilih ruang laboratorium",
            ID_MAPEL: "Silahkan pilih praktikum",
            TANGGAL_PRAKTIKUM: "Silahkan isi tanggal praktikum",
            JAM_MULAI: "Silahkan isi jam mulai praktikum",
            JAM_SELESAI: "Silahkan isi jam selesai praktikum",
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
    var now = new Date();
    var a = [{
            title: "Chicken Burger",
            start: new Date(now),
            end: new Date(now + 150000000),
            className: "bg-success"
        },{
            title: "Hot dog",
            start: new Date(now),
            end: new Date(now + 338e6),
            className: "bg-primary"
        }];
    console.log(now);
    var calendar = $("#calendar").fullCalendar({
        slotDuration: "00:15:00",
        minTime: "08:00:00",
        maxTime: "19:00:00",
        defaultView: "month",
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay"
        },
        height: $(window).height() - 100,
        events: a,
        editable: false,
        droppable: false,
        eventLimit: false,
        selectable: false,
    });
});
    
</script>
@endsection