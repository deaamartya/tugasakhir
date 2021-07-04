{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<div class="container-fluid">

    @if($errors->any())
        <div class="alert alert-danger">Data tidak berhasil disimpan. Cek kembali form</div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bahan Kimia</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>ID Bahan</th>
                                    <th>Lab. - Lemari</th>
                                    <th>Bahan Kimia</th>
                                    <th>Spek.</th>
                                    <th>Jumlah(gr)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bahan_kimia as $d)
                                <tr>
                                    <td> {{ $d->ID_BAHAN_KIMIA }} </td>
                                    <td> {{ $d->lemari->laboratorium->NAMA_LABORATORIUM }} - {{ $d->lemari->NAMA_LEMARI }} </td>
                                    <td>@php echo $d->NAMA_BAHAN_KIMIA." - ".$d->RUMUS." (".$d->WUJUD.")" @endphp</td>
                                    <td> @if($d->SPESIFIKASI_BAHAN == "1")
                                    TEK
                                    @elseif($d->SPESIFIKASI_BAHAN == "0")
                                    PA
                                    @endif </td>
                                    <td> {{ $d->stok() }} </td>
                                    <td>
                                        @if($d->stok() == 0)
                                        <div class="badge badge-danger"><i class="fa fa-warning mr-2"></i>Bahan habis</div>
                                        @elseif($d->stok() < 100)
                                        <div class="badge badge-warning"><i class="fa fa-warning mr-2"></i>Bahan akan habis</div>
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
</div>
@endsection