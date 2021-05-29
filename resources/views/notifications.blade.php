@extends('layout.default')
@section('content')
<div class="container-fluid">
  <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
          <div class="welcome-text">
              <h4>Notifikasi</h4>
          </div>
      </div>
  </div>
  <!-- row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-body">
                  <div class="email-left-box px-0 mb-3">
                      <div class="mail-list mt-4">
                          <a href="{{ url('/notifications/unread') }}" class="list-group-item @if(Request::segment(1) == "notifications" && Request::segment(2) == "unread") active @endif">
                            <i class="fa fa-inbox font-18 align-middle mr-2"></i> Belum dibaca
                            <span class="badge badge-danger badge-sm float-right">{{ $unread->count() }} </span>
                          </a>
                          <a href="{{ url('/notifications') }}" class="list-group-item @if(Request::segment(1) == "notifications" && Request::segment(2) == "") active @endif">
                            <i class="fa fa-paper-plane font-18 align-middle mr-2"></i>Semua
                          </a>
                      </div>
                  </div>
                  <div class="email-right-box ml-0 ml-sm-4 ml-sm-0">
                      <div class="email-list mt-4">
                        @if(Request::segment(1) == "notifications" && Request::segment(2) == "")
                          @foreach($notifications as $n)
                          @php $sender = App\Models\User::find($n->data['ID_USER']); @endphp
                          @php $jadwal = App\Models\PerubahanJadwalPeminjaman::where('ID_PEMINJAMAN',$n->data['ID_PEMINJAMAN'])->first(); @endphp
                          <div class="card shadow-none rounded border">
                            <div class="card-body p-3">
                              @php if(Auth::user()->ID_TIPE_USER != 5){
                                $url = url('pengelola/notification/'.$n->id);
                                $isi = $sender->NAMA_LENGKAP." mengajukan penjadwalan ulang untuk praktikum ".$jadwal->peminjaman_alat_bahan->praktikum->NAMA_PRAKTIKUM." untuk kelas ".$jadwal->peminjaman_alat_bahan->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS;
                              } else {
                                $url = url('guru/notification/'.$n->id);
                                $isi = $sender->NAMA_LENGKAP." sudah merubah jadwal praktikum ".$jadwal->peminjaman_alat_bahan->praktikum->NAMA_PRAKTIKUM." untuk kelas ".$jadwal->peminjaman_alat_bahan->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS;
                              }
                              @endphp
                              <div class="row justify-content-between px-3 align-items-center">
                                <div class="col-md-9 col-12 @if(!$n->read_at)text-black @else text-muted @endif">{{ $isi }}</div>
                                @if(!$n->read_at)
                                <div  class="col-md-3 col-12 text-underline mt-md-0 mt-2 text-right">
                                  <a href="{{ url($url) }}">
                                    Jadwalkan Ulang<i class="la la-angle-right text-right ml-2"></i>
                                  </a>
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                          @endforeach
                          @if($notifications->isEmpty())
                          <div>
                            <p class="text-center my-5 py-5">Tidak ada notifikasi belum dibaca</p>
                          </div>
                          @endif
                        @elseif(Request::segment(1) == "notifications" && Request::segment(2) == "unread")
                          @foreach($unread as $n)
                          @php $sender = App\Models\User::find($n->data['ID_USER']); @endphp
                          @php $jadwal = App\Models\PerubahanJadwalPeminjaman::where('ID_PEMINJAMAN',$n->data['ID_PEMINJAMAN'])->first(); @endphp
                          <div class="card shadow-none rounded border">
                            <div class="card-body p-3">
                              @php if(Auth::user()->ID_TIPE_USER != 5){
                                $url = url('pengelola/notification/'.$n->id);
                                $isi = $sender->NAMA_LENGKAP." mengajukan penjadwalan ulang untuk praktikum ".$jadwal->peminjaman_alat_bahan->praktikum->NAMA_PRAKTIKUM." untuk kelas ".$jadwal->peminjaman_alat_bahan->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS;
                              } else {
                                $url = url('guru/notification/'.$n->id);
                                $isi = $sender->NAMA_LENGKAP." sudah merubah jadwal praktikum ".$jadwal->peminjaman_alat_bahan->praktikum->NAMA_PRAKTIKUM." untuk kelas ".$jadwal->peminjaman_alat_bahan->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS;
                              }
                              @endphp
                              <div class="row justify-content-between px-3 align-items-center">
                                <div class="col-md-9 col-12 @if(!$n->read_at)text-black @endif">{{ $isi }}</div>
                                @if(!$n->read_at)
                                <div  class="col-md-3 col-12 text-underline mt-md-0 mt-2 text-right">
                                  <a href="{{ url($url) }}">
                                    Jadwalkan Ulang<i class="la la-angle-right text-right ml-2"></i>
                                  </a>
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                          @endforeach
                          @if($unread->isEmpty())
                          <div>
                            <p class="text-center my-5 py-5">Tidak ada notifikasi belum dibaca</p>
                          </div>
                          @endif
                        @endif
                      </div>
                      <!-- panel -->
                      @if(Request::segment(1) == "notifications" && Request::segment(2) == "")
                      <div class="row mt-5">
                        <div class="col-12 pl-3">
                        @if($notifications->isNotEmpty())
                          <?php echo $notifications->links('vendor.pagination.custom'); ?>
                        @endif
                        </div>
                      </div>
                      @elseif(Request::segment(1) == "notifications" && Request::segment(2) == "unread")
                      <div class="row mt-5">
                        <div class="col-12 pl-3">
                        @if($unread->isNotEmpty())
                          <?php echo $unread->links('vendor.pagination.custom'); ?>
                        @endif
                        </div>
                      </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>

</div>
@endsection