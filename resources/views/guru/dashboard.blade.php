{{-- Extends layout --}}
@extends('layout.default')

@section('tambahan-style')
	@if(!empty(config('dz.public.pagelevel.css.app_calender'))) 
		@foreach(config('dz.public.pagelevel.css.app_calender') as $style)
						<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
		@endforeach
	@endif
@endsection

{{-- Content --}}
@section('content')
<!-- row -->
<div class="container-fluid">
	<div class="form-head d-flex mb-3 align-items-start">
		<div class="mr-auto d-none d-lg-block">
			<h2 class="text-black font-w600 mb-0">Dashboard</h2>
			<p class="mb-0">Welcome to SILAB!</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-12" data-aos="fade-down">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary">
							<!-- <i class="ti-user"></i> -->
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="512" height="512" fill="#2F4CDD"><g id="Calendar-2" data-name="Calendar"><path d="M57,8H52V6a4,4,0,0,0-8,0V8H36V6a4,4,0,0,0-8,0V8H20V6a4,4,0,0,0-8,0V8H7a5,5,0,0,0-5,5V53a5,5,0,0,0,5,5H35a1,1,0,0,0,0-2H7a3.009,3.009,0,0,1-3-3V22H60V39a1,1,0,0,0,2,0V13A5,5,0,0,0,57,8ZM46,6a2,2,0,0,1,4,0v6a2,2,0,0,1-4,0ZM30,6a2,2,0,0,1,4,0v6a2,2,0,0,1-4,0ZM14,6a2,2,0,0,1,4,0v6a2,2,0,0,1-4,0ZM60,20H4V13a3.009,3.009,0,0,1,3-3h5v2a4,4,0,0,0,8,0V10h8v2a4,4,0,0,0,8,0V10h8v2a4,4,0,0,0,8,0V10h5a3.009,3.009,0,0,1,3,3Z"/><path d="M30,29a2,2,0,0,0-2-2H24a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V29h4v3Z"/><path d="M18,29a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V29h4v3Z"/><path d="M52,34a2,2,0,0,0,2-2V29a2,2,0,0,0-2-2H48a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2Zm-4-5h4v3H48Z"/><path d="M30,38a2,2,0,0,0-2-2H24a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V38h4v3Z"/><path d="M18,38a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V38h4v3Z"/><path d="M28,45H24a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2V47A2,2,0,0,0,28,45Zm-4,5V47h4v3Z"/><path d="M36,34h4a2,2,0,0,0,2-2V29a2,2,0,0,0-2-2H36a2,2,0,0,0-2,2v3A2,2,0,0,0,36,34Zm0-5h4v3H36Z"/><path d="M34,41a2,2,0,0,0,2,2,1,1,0,0,0,0-2V38h4a1,1,0,0,0,0-2H36a2,2,0,0,0-2,2Z"/><path d="M16,45H12a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2V47A2,2,0,0,0,16,45Zm-4,5V47h4v3Z"/><path d="M49,36A13,13,0,1,0,62,49,13.015,13.015,0,0,0,49,36Zm0,24A11,11,0,1,1,60,49,11.013,11.013,0,0,1,49,60Z"/><path d="M53.707,44.293a1,1,0,0,0-1.414,0L49,47.586l-3.293-3.293a1,1,0,0,0-1.414,1.414L47.586,49l-3.293,3.293a1,1,0,1,0,1.414,1.414L49,50.414l3.293,3.293a1,1,0,0,0,1.414-1.414L50.414,49l3.293-3.293A1,1,0,0,0,53.707,44.293Z"/></g></svg>
						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $menunggu_penjadwalan }}</span></h3>
							<p class="mb-0">Total Praktikum Belum Dijadwalkan</p>
							<small>{{ $tahun_akademik->TAHUN_AKADEMIK }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-12" data-aos="fade-down">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary">
							<svg id="Layer_1_1_" enable-background="new 0 0 64 64" height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg" fill="#2F4CDD"><path d="m56 40.10529v-28.10529c0-2.75684-2.24316-5-5-5h-2v-2c0-1.6543-1.3457-3-3-3s-3 1.3457-3 3v2h-5v-2c0-1.6543-1.3457-3-3-3s-3 1.3457-3 3v2h-6v-2c0-1.6543-1.3457-3-3-3s-3 1.3457-3 3v2h-5v-2c0-1.6543-1.3457-3-3-3s-3 1.3457-3 3v2h-2c-2.75684 0-5 2.24316-5 5v40c0 2.75684 2.24316 5 5 5h33.62347c2.07868 3.58081 5.94617 6 10.37653 6 6.61719 0 12-5.38281 12-12 0-4.83142-2.87561-8.99408-7-10.89471zm-11-35.10529c0-.55176.44824-1 1-1s1 .44824 1 1v6c0 .55176-.44824 1-1 1s-1-.44824-1-1zm-11 0c0-.55176.44824-1 1-1s1 .44824 1 1v6c0 .55176-.44824 1-1 1s-1-.44824-1-1zm-12 0c0-.55176.44824-1 1-1s1 .44824 1 1v6c0 .55176-.44824 1-1 1s-1-.44824-1-1zm-11 0c0-.55176.44824-1 1-1s1 .44824 1 1v6c0 .55176-.44824 1-1 1s-1-.44824-1-1zm-4 4h2v2c0 1.6543 1.3457 3 3 3s3-1.3457 3-3v-2h5v2c0 1.6543 1.3457 3 3 3s3-1.3457 3-3v-2h6v2c0 1.6543 1.3457 3 3 3s3-1.3457 3-3v-2h5v2c0 1.6543 1.3457 3 3 3s3-1.3457 3-3v-2h2c1.6543 0 3 1.3457 3 3v5h-50v-5c0-1.6543 1.3457-3 3-3zm0 46c-1.6543 0-3-1.3457-3-3v-33h50v20.39484c-.96082-.24866-1.96246-.39484-3-.39484-.6828 0-1.34808.07056-2 .1806v-5.1806c0-.55273-.44727-1-1-1h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h2.38086c-3.23914 2.15106-5.38086 5.82843-5.38086 10 0 1.40411.25494 2.74664.70001 4zm40-16h-4v-4h4zm4 22c-5.51367 0-10-4.48633-10-10s4.48633-10 10-10 10 4.48633 10 10-4.48633 10-10 10z"/><path d="m52 49.2774v-6.2774h-2v6.2774c-.59528.34644-1 .98413-1 1.7226 0 .10126.01526.19836.02979.29553l-3.65479 2.92322 1.25 1.5625 3.65161-2.92133c.22492.08759.46753.14008.72339.14008 1.10455 0 2-.89545 2-2 0-.73846-.40472-1.37616-1-1.7226z"/><path d="m15 22h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m26 22h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m37 22h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m42 30h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1zm1-6h4v4h-4z"/><path d="m15 33h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m26 33h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m37 33h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m15 44h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m26 44h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m37 44h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/></svg>
						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $sedang_pinjam }}</span></h3>
							<p class="mb-0">Total Praktikum Sudah Dijadwalkan</p>
							<small>{{ $tahun_akademik->TAHUN_AKADEMIK }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-12" data-aos="fade-down">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary">
							<!-- <i class="ti-user"></i> -->
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="512" height="512"><g id="Calendar"><path d="M57,8H52V6a4,4,0,0,0-8,0V8H36V6a4,4,0,0,0-8,0V8H20V6a4,4,0,0,0-8,0V8H7a5,5,0,0,0-5,5V53a5,5,0,0,0,5,5H35a1,1,0,0,0,0-2H7a3.009,3.009,0,0,1-3-3V22H60V39a1,1,0,0,0,2,0V13A5,5,0,0,0,57,8ZM46,6a2,2,0,0,1,4,0v6a2,2,0,0,1-4,0ZM30,6a2,2,0,0,1,4,0v6a2,2,0,0,1-4,0ZM14,6a2,2,0,0,1,4,0v6a2,2,0,0,1-4,0ZM60,20H4V13a3.009,3.009,0,0,1,3-3h5v2a4,4,0,0,0,8,0V10h8v2a4,4,0,0,0,8,0V10h8v2a4,4,0,0,0,8,0V10h5a3.009,3.009,0,0,1,3,3Z" fill="#2F4CDD"/><path d="M30,29a2,2,0,0,0-2-2H24a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V29h4v3Z" fill="#2F4CDD"/><path d="M18,29a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V29h4v3Z" fill="#2F4CDD"/><path d="M52,34a2,2,0,0,0,2-2V29a2,2,0,0,0-2-2H48a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2Zm-4-5h4v3H48Z" fill="#2F4CDD"/><path d="M30,38a2,2,0,0,0-2-2H24a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V38h4v3Z" fill="#2F4CDD"/><path d="M18,38a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V38h4v3Z" fill="#2F4CDD"/><path d="M28,45H24a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2V47A2,2,0,0,0,28,45Zm-4,5V47h4v3Z" fill="#2F4CDD"/><path d="M36,34h4a2,2,0,0,0,2-2V29a2,2,0,0,0-2-2H36a2,2,0,0,0-2,2v3A2,2,0,0,0,36,34Zm0-5h4v3H36Z" fill="#2F4CDD"/><path d="M34,41a2,2,0,0,0,2,2,1,1,0,0,0,0-2V38h4a1,1,0,0,0,0-2H36a2,2,0,0,0-2,2Z" fill="#2F4CDD"/><path d="M16,45H12a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2V47A2,2,0,0,0,16,45Zm-4,5V47h4v3Z" fill="#2F4CDD"/><path d="M49,36A13,13,0,1,0,62,49,13.015,13.015,0,0,0,49,36Zm0,24A11,11,0,1,1,60,49,11.013,11.013,0,0,1,49,60Z" fill="#2F4CDD"/><path d="M54.778,44.808,47,52.586,43.465,49.05a1,1,0,0,0-1.414,1.414l4.242,4.243a1,1,0,0,0,1.414,0l8.485-8.485a1,1,0,0,0-1.414-1.414Z" fill="#2F4CDD"/></g></svg>

						</span>
						<div class="media-body">
							<h3 class="mb-0 text-black"><span class="counter ml-0">{{ $dikembalikan }}</span></h3>
							<p class="mb-0">Total Praktikum Selesai Dilaksanakan</p>
							<small>{{ $tahun_akademik->TAHUN_AKADEMIK }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12" data-aos="fade-down">
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
                            <div class="external-event" data-class="bg-danger"><i class="fa fa-move"></i>XII MIPA</div>
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
    </div>
		<div class="col-6" data-aos="fade-down">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<h3 class="text-black font-w600 mb-4">Daftar Praktikum Akan Datang</h3>
					<div class="row justify-content-center">
						@foreach($praktikum_menunggu as $p)
						<div class="col-12">
							<h5 class="mb-0 text-black">
								<span class="ml-0">{{ $p->praktikum->JUDUL_PRAKTIKUM }}</span>
							</h5>
							<p class="mb-0">{{ $p->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</p>
							<small>{{ $p->TANGGAL_PEMINJAMAN }} {{ $p->JAM_MULAI }} - {{ $p->JAM_SELESAI }}</small>
							<hr>
						</div>
						@endforeach
						@if($praktikum_menunggu->isEmpty())
						<div class="col-12 text-center">
							Tidak ada praktikum.
						</div>
						@else
						<div class="col-12">
							<a href="{{ url('guru/praktikum') }}">
								<button class="btn btn-outline-success">Lihat Lainnya<i class="fa fa-arrow-right ml-2"></i></button>
							</a>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-6" data-aos="fade-down">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<h3 class="text-black font-w600 mb-4">Daftar Praktikum Selesai</h3>
					<div class="row justify-content-center">
						@foreach($praktikum_selesai as $p)
						<div class="col-12">
							<h5 class="mb-0 text-black">
								<span class="ml-0">{{ $p->praktikum->JUDUL_PRAKTIKUM }}</span>
							</h5>
							<p class="mb-0">{{ $p->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</p>
							<small>{{ $p->TANGGAL_PEMINJAMAN }} {{ $p->JAM_MULAI }} - {{ $p->JAM_SELESAI }}</small>
							<hr>
						</div>
						@endforeach
						@if($praktikum_selesai->isEmpty())
						<div class="col-12 text-center">
							Tidak ada praktikum.
						</div>
						@else
						<div class="col-12">
							<a href="{{ url('guru/praktikum') }}">
								<button class="btn btn-outline-success">Lihat Lainnya<i class="fa fa-arrow-right ml-2"></i></button>
							</a>
						</div>
						@endif
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

@section('tambahan-script')
@if(!empty(config('dz.public.pagelevel.js.app_calender')))
	@foreach(config('dz.public.pagelevel.js.app_calender') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
		@endforeach
@endif
{{-- @auth
    <script src="{{ asset('js/enable-push.js') }}" defer></script>
@endauth --}}
<script>
	$('document').ready( function(){
			var a;
			var url = "{{ url('guru/datapraktikum') }}";

			$.get(url,function(result){
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
							timeFormat: 'HH(:mm)',
							height: $(window).height() - 100,
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
	});
</script>
@endsection	