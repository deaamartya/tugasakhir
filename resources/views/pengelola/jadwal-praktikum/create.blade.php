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
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengelola.jadwal-praktikum.index') }}">Jadwal Praktikum</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Buat Jadwal Praktikum</a></li>
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
        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div id="calendar" class="app-fullcalendar"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12">
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
                                    Silahkan pilih ruang laboratorium
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

@foreach($peminjaman as $p)
<div class="modal fade" id="modal-peminjaman-{{ $p->ID_PEMINJAMAN }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Peminjaman #{{ $p->ID_PEMINJAMAN }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">Nama Prakt.</div>
                    <div class="col-8">{{ $p->praktikum->NAMA_PRAKTIKUM }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Jadwal Prakt.</div>
                    <div class="col-8">{{ $p->TANGGAL_PEMINJAMAN }} {{$p->JAM_MULAI}} - {{ $p->JAM_SELESAI }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Kelas</div>
                    <div class="col-8">{{ $p->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Guru</div>
                    <div class="col-8">{{ $p->praktikum->kelas->guru->NAMA_LENGKAP }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

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

    var url = "{{ url('/pengelola/datapraktikum') }}";

    $.get(url,function(result){
        a = result;
        console.log(a);
        $("#calendar").fullCalendar({
            slotDuration: "00:15:00",
            minTime: "06:00:00",
            maxTime: "19:00:00",
            defaultView: "month",
            header: {
                left: "prev,next today",
                center: "title",
                right: "month,agendaWeek,agendaDay"
            },
            height: $(window).height() - 350,
            events: a,
            editable: false,
            droppable: false,
            eventLimit: false,
            selectable: false,
            eventClick: function(calEvent, jsEvent, view) {
                $("#modal-peminjaman-"+calEvent.id_peminjaman).modal('toggle');
            }
        });
    });

    // $("#ID_PRAKTIKUM").on('change',function(){
    //     $.post('datapraktikum-nama',{ _token: "{{ csrf_token() }}", prakt: $(this).val() },function(result){
    //         a = result;
    //         console.log(a);
    //         $("#calendar").fullCalendar('removeEvents');
    //         $("#calendar").fullCalendar('addEventSource', a);
    //     });
    // });
});
    
</script>
@endsection