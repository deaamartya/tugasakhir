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
		<div class="col-md-4 col-12">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary">
							<!-- <i class="ti-user"></i> -->
							<svg width="36" height="28" viewBox="0 0 36 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M31.75 6.75H30.0064L30.2189 4.62238C30.2709 4.10111 30.2131 3.57473 30.0493 3.07716C29.8854 2.57959 29.6192 2.12186 29.2676 1.73348C28.9161 1.3451 28.4871 1.03468 28.0082 0.822231C27.5294 0.609781 27.0114 0.500013 26.4875 0.5H7.0125C6.48854 0.500041 5.9704 0.609864 5.49148 0.822391C5.01256 1.03492 4.58348 1.34543 4.23189 1.73392C3.88031 2.12241 3.61403 2.58026 3.45021 3.07795C3.28639 3.57564 3.22866 4.10214 3.28075 4.6235L5.2815 24.6224C5.31508 24.9222 5.38467 25.2168 5.48875 25.5H1.75C1.41848 25.5 1.10054 25.6317 0.866116 25.8661C0.631696 26.1005 0.5 26.4185 0.5 26.75C0.5 27.0815 0.631696 27.3995 0.866116 27.6339C1.10054 27.8683 1.41848 28 1.75 28H31.75C32.0815 28 32.3995 27.8683 32.6339 27.6339C32.8683 27.3995 33 27.0815 33 26.75C33 26.4185 32.8683 26.1005 32.6339 25.8661C32.3995 25.6317 32.0815 25.5 31.75 25.5H28.0115C28.1154 25.2172 28.1849 24.9229 28.2185 24.6235L28.881 18H31.75C32.7442 17.9989 33.6974 17.6035 34.4004 16.9004C35.1035 16.1974 35.4989 15.2442 35.5 14.25V10.5C35.4989 9.50577 35.1035 8.55258 34.4004 7.84956C33.6974 7.14653 32.7442 6.75109 31.75 6.75ZM9.0125 25.5C8.70243 25.501 8.40314 25.3862 8.17327 25.1782C7.9434 24.9701 7.79949 24.6836 7.76975 24.375L5.7685 4.37575C5.75109 4.20188 5.7703 4.0263 5.82488 3.86031C5.87946 3.69432 5.96821 3.5416 6.0854 3.412C6.2026 3.28239 6.34564 3.17877 6.50532 3.10781C6.665 3.03685 6.83777 3.00013 7.0125 3H26.4875C26.6622 3.00012 26.8349 3.03681 26.9945 3.10772C27.1541 3.17863 27.2972 3.28218 27.4143 3.4117C27.5315 3.54123 27.6203 3.69386 27.6749 3.85977C27.7295 4.02568 27.7488 4.20119 27.7315 4.375L25.7308 24.3762C25.7007 24.6848 25.5566 24.971 25.3267 25.1788C25.0967 25.3867 24.7975 25.5012 24.4875 25.5H9.0125ZM33 14.25C32.9998 14.5815 32.868 14.8993 32.6337 15.1337C32.3993 15.368 32.0815 15.4998 31.75 15.5H29.1311L29.7561 9.25H31.75C32.0815 9.2502 32.3993 9.38196 32.6337 9.61634C32.868 9.85071 32.9998 10.1685 33 10.5V14.25Z" fill="#2F4CDD"/></svg>

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
		<div class="col-md-4 col-12">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary">
							<!-- <i class="ti-user"></i> -->
							<svg width="20" height="36" viewBox="0 0 20 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.08 24.36C19.08 25.64 18.76 26.8667 18.12 28.04C17.48 29.1867 16.5333 30.1467 15.28 30.92C14.0533 31.6933 12.5733 32.1333 10.84 32.24V35.48H8.68V32.24C6.25333 32.0267 4.28 31.2533 2.76 29.92C1.24 28.56 0.466667 26.84 0.44 24.76H4.32C4.42667 25.88 4.84 26.8533 5.56 27.68C6.30667 28.5067 7.34667 29.0267 8.68 29.24V19.24C6.89333 18.7867 5.45333 18.32 4.36 17.84C3.26667 17.36 2.33333 16.6133 1.56 15.6C0.786667 14.5867 0.4 13.2267 0.4 11.52C0.4 9.36 1.14667 7.57333 2.64 6.16C4.16 4.74666 6.17333 3.96 8.68 3.8V0.479998H10.84V3.8C13.1067 3.98667 14.9333 4.72 16.32 6C17.7067 7.25333 18.5067 8.89333 18.72 10.92H14.84C14.7067 9.98667 14.2933 9.14667 13.6 8.4C12.9067 7.62667 11.9867 7.12 10.84 6.88V16.64C12.6 17.0933 14.0267 17.56 15.12 18.04C16.24 18.4933 17.1733 19.2267 17.92 20.24C18.6933 21.2533 19.08 22.6267 19.08 24.36ZM4.12 11.32C4.12 12.6267 4.50667 13.6267 5.28 14.32C6.05333 15.0133 7.18667 15.5867 8.68 16.04V6.8C7.29333 6.93333 6.18667 7.38667 5.36 8.16C4.53333 8.90667 4.12 9.96 4.12 11.32ZM10.84 29.28C12.28 29.12 13.4 28.6 14.2 27.72C15.0267 26.84 15.44 25.7867 15.44 24.56C15.44 23.2533 15.04 22.2533 14.24 21.56C13.44 20.84 12.3067 20.2667 10.84 19.84V29.28Z" fill="#2F4CDD"/></svg>
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
		<div class="col-md-4 col-12">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<div class="media ai-icon">
						<span class="mr-3 bgl-primary text-primary">
							<!-- <i class="ti-user"></i> -->
							<svg width="32" height="31" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 30.5H22.75C23.7442 30.4989 24.6974 30.1035 25.4004 29.4004C26.1035 28.6974 26.4989 27.7442 26.5 26.75V16.75C26.5 16.4185 26.3683 16.1005 26.1339 15.8661C25.8995 15.6317 25.5815 15.5 25.25 15.5C24.9185 15.5 24.6005 15.6317 24.3661 15.8661C24.1317 16.1005 24 16.4185 24 16.75V26.75C23.9997 27.0814 23.8679 27.3992 23.6336 27.6336C23.3992 27.8679 23.0814 27.9997 22.75 28H4C3.66857 27.9997 3.3508 27.8679 3.11645 27.6336C2.88209 27.3992 2.7503 27.0814 2.75 26.75V9.25C2.7503 8.91857 2.88209 8.6008 3.11645 8.36645C3.3508 8.13209 3.66857 8.0003 4 8H15.25C15.5815 8 15.8995 7.8683 16.1339 7.63388C16.3683 7.39946 16.5 7.08152 16.5 6.75C16.5 6.41848 16.3683 6.10054 16.1339 5.86612C15.8995 5.6317 15.5815 5.5 15.25 5.5H4C3.00577 5.50109 2.05258 5.89653 1.34956 6.59956C0.646531 7.30258 0.251092 8.25577 0.25 9.25V26.75C0.251092 27.7442 0.646531 28.6974 1.34956 29.4004C2.05258 30.1035 3.00577 30.4989 4 30.5Z" fill="#2F4CDD"/><path d="M25.25 0.5C24.0139 0.5 22.8055 0.866556 21.7777 1.55331C20.7499 2.24007 19.9488 3.21619 19.4758 4.35823C19.0027 5.50027 18.8789 6.75693 19.1201 7.96931C19.3613 9.1817 19.9565 10.2953 20.8306 11.1694C21.7047 12.0435 22.8183 12.6388 24.0307 12.8799C25.2431 13.1211 26.4997 12.9973 27.6418 12.5242C28.7838 12.0512 29.7599 11.2501 30.4467 10.2223C31.1334 9.19451 31.5 7.98613 31.5 6.75C31.498 5.093 30.8389 3.50442 29.6673 2.33274C28.4956 1.16106 26.907 0.501952 25.25 0.5ZM25.25 10.5C24.5083 10.5 23.7833 10.2801 23.1666 9.86801C22.5499 9.45596 22.0693 8.87029 21.7855 8.18506C21.5016 7.49984 21.4274 6.74584 21.5721 6.01841C21.7167 5.29098 22.0739 4.6228 22.5983 4.09835C23.1228 3.5739 23.791 3.21675 24.5184 3.07206C25.2458 2.92736 25.9998 3.00162 26.6851 3.28545C27.3703 3.56928 27.9559 4.04993 28.368 4.66661C28.7801 5.2833 29 6.00832 29 6.75C28.9989 7.74423 28.6035 8.69742 27.9004 9.40044C27.1974 10.1035 26.2442 10.4989 25.25 10.5Z" fill="#2F4CDD"/><path d="M6.5 13H12.75C13.0815 13 13.3995 12.8683 13.6339 12.6339C13.8683 12.3995 14 12.0815 14 11.75C14 11.4185 13.8683 11.1005 13.6339 10.8661C13.3995 10.6317 13.0815 10.5 12.75 10.5H6.5C6.16848 10.5 5.85054 10.6317 5.61612 10.8661C5.3817 11.1005 5.25 11.4185 5.25 11.75C5.25 12.0815 5.3817 12.3995 5.61612 12.6339C5.85054 12.8683 6.16848 13 6.5 13Z" fill="#2F4CDD"/><path d="M5.25 16.75C5.25 17.0815 5.3817 17.3995 5.61612 17.6339C5.85054 17.8683 6.16848 18 6.5 18H17.75C18.0815 18 18.3995 17.8683 18.6339 17.6339C18.8683 17.3995 19 17.0815 19 16.75C19 16.4185 18.8683 16.1005 18.6339 15.8661C18.3995 15.6317 18.0815 15.5 17.75 15.5H6.5C6.16848 15.5 5.85054 15.6317 5.61612 15.8661C5.3817 16.1005 5.25 16.4185 5.25 16.75Z" fill="#2F4CDD"/></svg>
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
		<div class="col-12">
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
    </div>
		<div class="col-6">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<h3 class="text-black font-w600 mb-4">Daftar Praktikum Akan Datang</h3>
					<div class="row justify-content-center">
						@foreach($praktikum_menunggu as $p)
						<div class="col-12">
							<h5 class="mb-0 text-black">
								<span class="ml-0">{{ $p->praktikum->NAMA_PRAKTIKUM }}</span>
							</h5>
							<p class="mb-0">{{ $p->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</p>
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
		<div class="col-6">
			<div class="widget-stat card">
				<div class="card-body p-4">
					<h3 class="text-black font-w600 mb-4">Daftar Praktikum Selesai</h3>
					<div class="row justify-content-center">
						@foreach($praktikum_selesai as $p)
						<div class="col-12">
							<h5 class="mb-0 text-black">
								<span class="ml-0">{{ $p->praktikum->NAMA_PRAKTIKUM }}</span>
							</h5>
							<p class="mb-0">{{ $p->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</p>
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

@section('tambahan-script')
@if(!empty(config('dz.public.pagelevel.js.app_calender')))
	@foreach(config('dz.public.pagelevel.js.app_calender') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
		@endforeach
@endif
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