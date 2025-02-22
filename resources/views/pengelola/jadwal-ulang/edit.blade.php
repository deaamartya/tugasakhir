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
                    <h4 class="card-title">Ubah Jadwal Praktikum</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="edit-jadwal" action="{{ route('pengelola.penjadwalan-ulang.update',$jadwalulang->ID_PEMINJAMAN) }}" name="edit-jadwal" method="POST">
                        @method('PUT')
                        @csrf
                            <input type="hidden" name="ID_PEMINJAMAN" value="{{ $jadwalulang->ID_PEMINJAMAN }}">

                            <div class="form-group px-2">
                                <div>Guru : </div>
                                <div>{{ $jadwalulang->guru->NAMA_LENGKAP }}</div>
                            </div>

                            <div class="form-group px-2">
                                <div>Permintaan Tanggal Baru :</div>
                                <div>@if($jadwalulang->TANGGAL_BARU != null){{ $jadwalulang->TANGGAL_BARU }} @else - @endif</div>
                            </div>

                            <div class="form-group px-2">
                                <div>Permintaan Jam Mulai :</div>
                                <div>@if($jadwalulang->JAM_MULAI_BARU != null){{ $jadwalulang->JAM_MULAI_BARU }} @else - @endif</div>
                            </div>

                            <div class="form-group px-2">
                                <div>Permintaan Jam Selesai :</div>
                                <div>@if($jadwalulang->JAM_SELESAI_BARU != null){{ $jadwalulang->JAM_SELESAI_BARU }} @else - @endif</div>
                            </div>

                            <div class="form-group px-2">
                                <div>Pesan :</div>
                                <div>@if($jadwalulang->PESAN != null){{ $jadwalulang->PESAN }} @else - @endif</div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label>Ruang Laboratorium</label>
                                <select disabled class="select2-single @error('ID_RUANG_LABORATORIUM') is-invalid @enderror" name="ID_RUANG_LABORATORIUM" id="ID_RUANG_LABORATORIUM">
                                        <option value="{{ $jadwalulang->peminjaman_alat_bahan->ID_RUANG_LABORATORIUM }}" selected>{{ $jadwalulang->peminjaman_alat_bahan->ruang_laboratorium->NAMA_RUANG_LABORATORIUM }}</option>
                                </select>
                                <div class="invalid-feedback animated fadeInUp">
                                    Silahkan pilih ruang laboratorium
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Praktikum</label>
                                <select disabled class="select2-single @error('ID_PRAKTIKUM') is-invalid @enderror" name="ID_PRAKTIKUM" id="ID_PRAKTIKUM">
                                    <option value="{{ $jadwalulang->peminjaman_alat_bahan->ID_PRAKTIKUM }}" selected>{{ $jadwalulang->peminjaman_alat_bahan->praktikum->JUDUL_PRAKTIKUM }} - {{ $jadwalulang->peminjaman_alat_bahan->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</option>
                                </select>
                                <div class="invalid-feedback animated fadeInUp">
                                    Silahkan pilih praktikum
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Baru</label>
                                <input class="datepicker-default form-control" name="TANGGAL_PEMINJAMAN" value="{{ date("d F Y",strtotime($jadwalulang->peminjaman_alat_bahan->TANGGAL_PEMINJAMAN)) }}">
                                <div class="invalid-feedback animated fadeInUp">
                                    Tanggal Peminjaman harus diisi
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Jam Mulai Baru</label>
                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                    <input type="text" class="form-control @error('JAM_MULAI') is-invalid @enderror" name="JAM_MULAI" id="JAM_MULAI" value="{{ $jadwalulang->peminjaman_alat_bahan->JAM_MULAI }}">
                                </div>
                                <div class="invalid-feedback animated fadeInUp">
                                Jam Mulai Praktikum harus diisi
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jam Selesai Baru</label>
                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                    <input type="text" class="form-control @error('JAM_SELESAI') is-invalid @enderror" name="JAM_SELESAI" id="JAM_SELESAI" value="{{ $jadwalulang->peminjaman_alat_bahan->JAM_SELESAI }}">
                                </div>
                                <div class="invalid-feedback animated fadeInUp">
                                Jam Selesai Praktikum harus diisi
                                </div>
                            </div>

                            <div class="form-row px-3">
                                <div class="alert alert-danger animated pulse infinite" hidden id="alert-gagal"><i class="fa fa-exclamation-triangle mr-2"></i> Terdapat praktikum dengan ruang laboratorium pada tanggal dan jam diatas</div>

                                <div class="alert alert-success animated pulse" hidden id="alert-sukses"><i class="fa fa-check mr-2"></i>Ruang laboratorium dapat digunakan pada tanggal dan jam diatas</div>
                            </div>

                            <button type="submit" class="btn btn-primary submit-btn" id="button-form-jadwal">Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($praktikum as $p)
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
                    <div class="col-8">{{ $p->praktikum->JUDUL_PRAKTIKUM }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Jadwal Prakt.</div>
                    <div class="col-8">{{ $p->TANGGAL_PEMINJAMAN }} {{$p->JAM_MULAI}} - {{ $p->JAM_SELESAI }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Kelas</div>
                    <div class="col-8">{{ $p->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Guru</div>
                    <div class="col-8">{{ $p->kelas->guru->NAMA_LENGKAP }}</div>
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

    $("#edit-jadwal").validate({
        rules: {
            TANGGAL_PEMINJAMAN: {
                required: true
            },
            JAM_MULAI: {
                required: true
            },
            JAM_SELESAI: {
                required: true
            },
        },
        messages: {
            TANGGAL_PEMINJAMAN: "Tanggal Peminjaman baru harus diisi",
            JAM_MULAI: "Jam Mulai Baru harus diisi",
            JAM_SELESAI: "Jam Selesai Baru harus diisi",
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
            timeFormat: 'HH(:mm)',
            height: $(window).height(),
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
    function checkRuang(tgl, id_ruang, jam_mulai, jam_selesai) {
        $.get("{{ url('/pengelola/cekRuang') }}", { tgl: tgl, id_ruang: id_ruang, jam_mulai: jam_mulai, jam_selesai:jam_selesai }, function(booked){
            if(booked){
                $("#button-form-jadwal").attr('disabled',true);
                $("#alert-gagal").attr('hidden',false);
                $("#alert-sukses").attr('hidden',true);
            } else {
                $("#button-form-jadwal").attr('disabled',false);
                $("#alert-gagal").attr('hidden',true);
                $("#alert-sukses").attr('hidden',false);
            }
        });
    };

    $("input").on('change', function(){
        let tgl = $("input[name='TANGGAL_PEMINJAMAN_submit']").val();
        let id_ruang = $("select[name='ID_RUANG_LABORATORIUM']").val();
        let jam_mulai = $("input[name='JAM_MULAI']").val();
        let jam_selesai = $("input[name='JAM_SELESAI']").val();
        if((tgl != "" && id_ruang != "") && (jam_mulai != "" && jam_selesai != "")){
            jam_mulai = jam_mulai.split(":");
            jam_mulai =  parseInt(jam_mulai[0]*60)+parseInt(jam_mulai[1]);
            jam_selesai = jam_selesai.split(":");
            jam_selesai =  parseInt(jam_selesai[0]*60)+parseInt(jam_selesai[1]);
            
            checkRuang(tgl, id_ruang, jam_mulai, jam_selesai);
        }
    });
});
    
</script>
@endsection