{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.ui_modal'))) 
        @foreach(config('dz.public.pagelevel.css.ui_modal') as $style)
                <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.css.table_datatable_basic'))) 
        @foreach(config('dz.public.pagelevel.css.table_datatable_basic') as $style)
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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Akademik</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Praktikum Kelas Saya</a></li>
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
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-intro-title">Jadwal Praktikum</h4>
                    <div class="">
                        <div id="external-events" class="my-3">
                            <div class="external-event" data-class="bg-primary"><i class="fa fa-move"></i>X MIPA</div>
                            <div class="external-event" data-class="bg-success"><i class="fa fa-move"></i>XI MIPA
                            </div>
                            <div class="external-event" data-class="bg-warning"><i class="fa fa-move"></i>XII MIPA</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div id="calendar" class="app-fullcalendar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Praktikum</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Praktikum</th>
                                    <th>Kelas</th>
                                    <th>Guru</th>
                                    <th>Waktu Pelaksanaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($praktikum as $d)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $d->praktikum->NAMA_PRAKTIKUM }} </td>
                                    <td> {{ $d->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</td>
                                    <td> {{ $d->praktikum->kelas->guru->NAMA_LENGKAP }}</td>
                                    <td> {{ $d->TANGGAL_PEMINJAMAN }} {{ $d->JAM_MULAI }} - {{ $d->JAM_SELESAI }} </td>	
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('guru.penjadwalan-ulang',$d->ID_PRAKTIKUM) }}">
                                                <button type="button" class="btn btn-primary shadow sharp mr-3"><i class="fa fa-pencil mr-2"></i>Jadwalkan Ulang</button>
                                            </a>
                                            <a href="{{ route('guru.penjadwalan-ulang.destroy',$d->ID_PRAKTIKUM) }}">
                                                <button type="button" class="btn btn-danger shadow sharp" data-toggle="modal" data-target="#modal-delete-{{ $d->ID_PRAKTIKUM }}"><i class="fa fa-trash mr-2"></i>Batalkan</button>
                                            </a>
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
@endsection

{{-- Tambahan Script --}}
@section('tambahan-script')
@if(!empty(config('dz.public.pagelevel.js.ui_modal')))
	@foreach(config('dz.public.pagelevel.js.ui_modal') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
@endif
@if(!empty(config('dz.public.pagelevel.js.table_datatable_basic')))
	@foreach(config('dz.public.pagelevel.js.table_datatable_basic') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
@endif
<script>
    $('document').ready( function(){
        var a;
        $.get('datapraktikum',function(result){
            a = result;
            var calendar = $("#calendar").fullCalendar({
                slotDuration: "00:15:00",
                minTime: "06:00:00",
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
    });
</script>
@endsection