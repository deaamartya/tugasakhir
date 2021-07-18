{{-- Extends layout --}}
@extends('layout.default')

{{-- Tambahan Style Admin --}}
@section('tambahan-style')
    @if(!empty(config('dz.public.pagelevel.css.ui_modal'))) 
        @foreach(config('dz.public.pagelevel.css.ui_modal') as $style)
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengembalian Alat dan Bahan Laboratorium</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Praktikum</th>
                                    <th>Kelas</th>
                                    <th>Guru</th>
                                    <th>Jadwal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman as $d)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $d->praktikum->JUDUL_PRAKTIKUM }} </td>
                                    <td> {{ $d->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</td>
                                    <td> {{ $d->kelas->guru->NAMA_LENGKAP }}</td>
                                    <td> {{ $d->TANGGAL_PEMINJAMAN }} {{ $d->JAM_MULAI }} - {{ $d->JAM_SELESAI }} </td>
                                    <td>
                                    @if($d->STATUS_PEMINJAMAN == "SUDAH DIKONFIRMASI")
                                        <a href="{{ route('pengelola.pengembalian.edit',[$d->ID_PEMINJAMAN]) }}">
                                            <button type="button" class="btn btn-primary">Pengembalian</button>
                                        </a>
                                    @endif
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">History Pengembalian</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Praktikum</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengembalian as $d)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $d->praktikum->JUDUL_PRAKTIKUM }} </td>
                                    <td> {{ $d->kelas->jenis_kelas->NAMA_JENIS_KELAS }}</td>
                                    <td> {{$d->STATUS_PEMINJAMAN}} </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-2" data-toggle="modal" data-target="#modal-detail-{{ $d->ID_PEMINJAMAN }}"><i class="fa fa-info-circle"></i></button>
                                            @php $tampil = false; @endphp
                                            @if(count($d->alat_rusak) > 0)
                                                @foreach ($d->alat_rusak as $a)
                                                    @if($a->STATUS == 0)
                                                        @php $tampil = true; @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if($tampil)
                                                <button type="button" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#modal-alat-rusak-{{ $d->ID_PEMINJAMAN }}"><i class="fa fa-plus"></i></button>
                                                <div class="ml-2 badge badge-danger"><i class="fa fa-warning mr-2"></i>Alat rusak belum diganti</div>
                                            @endif
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
@foreach($pengembalian as $d)
{{-- Detail Modal --}}
<div id="modal-detail-{{ $d->ID_PEMINJAMAN }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Peminjaman #{{ $d->ID_PEMINJAMAN }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group px-2">
                    <div>Judul Praktikum : </div>
                    <div>{{ $d->praktikum->JUDUL_PRAKTIKUM }}</div>
                </div>
                <hr>
                <div class="form-group px-2">
                    <div>Kebutuhan Alat dan Bahan per kelompok : </div>
                </div>
                @php
                    $alat = false;
                    $bahan = false;
                    $bahan_kimia = false;
                @endphp
                @if(count($d->alat_peminjaman($d->ID_PEMINJAMAN)) > 0)
                    @php $alat = true; @endphp
                @elseif(count($d->bahan_peminjaman($d->ID_PEMINJAMAN)) > 0)
                    @php $bahan = true; @endphp
                @elseif(count($d->bahan_kimia_peminjaman($d->ID_PEMINJAMAN)) > 0)
                    @php $bahan_kimia = true; @endphp
                @endif
                
                @if($alat)
                <div class="form-group px-2">
                    <table class="table text-black">
                        <thead>
                            <th>Nama Alat</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach($d->alat_peminjaman($d->ID_PEMINJAMAN) as $a)
                                <tr>
                                    <td width="80%">{{ $a->alat->merk_tipe_alat->NAMA_MERK_TIPE }} - {{ $a->alat->katalog_alat->NAMA_ALAT }} {{ $a->alat->katalog_alat->UKURAN }}</td>
                                    <td width="20%">{{ $a->JUMLAH_PINJAM }}pcs</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                @if($bahan)
                <div class="form-group px-2">
                    <table class="table text-black">
                        <thead>
                            <th>Nama Bahan</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach($d->bahan_peminjaman($d->ID_PEMINJAMAN) as $a)
                                <tr>
                                    <td width="80%">{{ $a->bahan->NAMA_BAHAN }}</td>
                                    <td width="20%">{{ $a->JUMLAH_PINJAM }}pcs</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                @if($bahan_kimia)
                <div class="form-group px-2">
                    <table class="table text-black">
                        <thead>
                            <th>Nama Bahan Kimia</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach($d->bahan_kimia_peminjaman($d->ID_PEMINJAMAN) as $a)
                                <tr>
                                    <td width="80%">{{ $a->bahan_kimia->NAMA_BAHAN_KIMIA }} - @php echo $a->bahan_kimia->RUMUS; @endphp ({{ $a->bahan_kimia->WUJUD }})</td>
                                    <td width="20%">{{ $a->JUMLAH_PINJAM }}gr</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}
{{-- Alat Rusak Modal --}}
<div id="modal-alat-rusak-{{ $d->ID_PEMINJAMAN }}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penggantian Alat Rusak #{{ $d->ID_PEMINJAMAN }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengelola.pengembalian.updateStock') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ID_ALAT_LAMA" value="{{ $d->ID_ALAT }}">

                    <div class="form-group">
                        <label>Alat</label>
                        <select class="form-control @error('ID_KERUSAKAN') is-invalid @enderror kerusakan" name="ID_KERUSAKAN" id="ID_KERUSAKAN_{{ $d->ID_PEMINJAMAN }}">
                            @foreach($d->alat_rusak as $t)
                                @if($t->STATUS == 0)
                                    <option value="{{ $t->ID_KERUSAKAN }}">{{ $t->alat->merk_tipe_alat->NAMA_MERK_TIPE }} - {{ $t->alat->katalog_alat->NAMA_ALAT }} {{ $t->alat->katalog_alat->UKURAN }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback animated fadeInUp">
                            Silahkan alat
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <p id="KETERANGAN_{{ $d->ID_PEMINJAMAN }}" class="text-muted">
                        </p>
                    </div>
                    
                    <div class="form-group">
                        <label>Jumlah Masuk Alat Bagus<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_BAGUS_MASUK') is-invalid @enderror jumlah-bagus" id="JUMLAH_BAGUS_MASUK_{{ $d->ID_PEMINJAMAN }}" name="JUMLAH_BAGUS_MASUK" min="0" value="0">
                        <div class="invalid-feedback animated fadeInUp">
                            Jumlah masuk alat bagus harus diisi
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Keluar Alat Rusak<small class="text-danger">*</small></label>
                        <input type="number" class="form-control @error('JUMLAH_KELUAR_RUSAK') is-invalid @enderror jumlah-rusak" id="JUMLAH_KELUAR_RUSAK_{{ $d->ID_PEMINJAMAN }}" name="JUMLAH_KELUAR_RUSAK" min="0" value="0" readonly>
                        <div class="invalid-feedback animated fadeInUp">
                            Jumlah keluar alat rusak harus diisi
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of Edit Modal --}}
@endforeach
@endsection

{{-- Tambahan Script --}}
@section('tambahan-script')
@if(!empty(config('dz.public.pagelevel.js.ui_modal')))
	@foreach(config('dz.public.pagelevel.js.ui_modal') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
<script>
    $(".jumlah-bagus").on('input',function(){
        let id = $(this).attr('id').substr(19);
        $("#JUMLAH_KELUAR_RUSAK_"+id).val($(this).val());
    });
    $(".kerusakan").each(function(){
        let id = $(this).attr('id').substr(13);
        let id_kerusakan = $(this).val();
        $.get("{{ url('pengelola/kerusakanalat') }}"+"/"+id_kerusakan,function(result){
            $("#KETERANGAN_"+id).html(result.data.KETERANGAN_RUSAK+". Sisa alat yang perlu diganti "+result.sisa+"pcs.");
        });
    });
    $(".kerusakan").on('change',function(){
        let id = $(this).attr('id').substr(13);
        let id_kerusakan = $(this).val();
        $.get("{{ url('pengelola/kerusakanalat') }}"+"/"+id_kerusakan,function(result){
            $("#KETERANGAN_"+id).html(result.data.KETERANGAN_RUSAK+". Sisa alat yang perlu diganti "+result.sisa+"pcs.");
        });
    });
</script>
@endsection