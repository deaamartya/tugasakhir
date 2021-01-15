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
                <h4>Hi, @auth {{ Auth::user()->NAMA_LEMARI }} @endif</h4>
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
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div id="calendar" class="app-fullcalendar"></div>
                </div>
            </div>
        </div>
        <!-- BEGIN MODAL -->
        <!-- <div class="modal fade none-border" id="event-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add New Event</strong></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                            event</button>

                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Modal Add Category
        <div class="modal fade none-border" id="add-category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add a category</strong></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Category Name</label>
                                    <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Choose Category Color</label>
                                    <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                        <option value="success">Success</option>
                                        <option value="danger">Danger</option>
                                        <option value="info">Info</option>
                                        <option value="pink">Pink</option>
                                        <option value="primary">Primary</option>
                                        <option value="warning">Warning</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Praktikum</h4>
                    <a href="{{ route('pengelola.jadwal-praktikum.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>Buat Jadwal Praktikum Baru
                        </button>
                    </a>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($praktikum as $d)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $d->praktikum->NAMA_PRAKTIKUM }} </td>
                                    <td> {{ $d->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</td>
                                    <td> {{ $d->praktikum->kelas->user->NAMA_LENGKAP }}</td>
                                    <td> {{ $d->TANGGAL_PEMINJAMAN }} </td>							
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