<div class="deznav">
    <div class="deznav-scroll">
        @if(Request::segment(1) == "admin" || Auth::user()->tipe_user->NAMA_TIPE_USER == 'Admin')
        <ul class="metismenu" id="menu">
            <li><a href="{!! route('admin.dashboard'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-home-2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-box-2"></i>
                    <span class="nav-text">Data Master</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! route('admin.lab.index'); !!}">Data Laboratorium</a></li>
                    <li><a href="{!! route('admin.tipe-user.index'); !!}">Data Tipe User</a></li>
                    <li><a href="{!! route('admin.user.index'); !!}">Data User</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-folder-6"></i>
                    <span class="nav-text">Data Akademik</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! route('admin.tahun-akademik.index'); !!}">Tahun Akademik</a></li>
                    <li><a href="{!! route('admin.mata-pelajaran.index'); !!}">Mata Pelajaran</a></li>
                    <li><a href="{!! route('admin.guru.index'); !!}">Guru</a></li>
                    <li><a href="{!! route('admin.jenis-kelas.index'); !!}">Jenis Kelas</a></li>
                    <li><a href="{!! route('admin.kelas.index'); !!}">Kelas</a></li>
                </ul>
            </li>
        </ul>
        @elseif(Request::segment(1) == "guru" || Auth::user()->tipe_user->NAMA_TIPE_USER == 'Guru')
        <ul class="metismenu" id="menu">
            <li><a href="{!! route('guru.dashboard'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-home-2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a href="{!! route('guru.praktikum.index'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-calendar-1"></i>
                    <span class="nav-text">Praktikum Kelas Saya</span>
                </a>
            </li>
            <li><a href="{!! route('guru.penjadwalan-ulang.index'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-edit"></i>
                    <span class="nav-text">Penjadwalan Ulang</span>
                </a>
            </li>
        </ul>
        @elseif(Request::segment(1) == "pengelola" || (strpos(Auth::user()->tipe_user->NAMA_TIPE_USER,'Pengelola') > -1))
        <ul class="metismenu" id="menu">
            <li><a href="{!! route('pengelola.dashboard'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-home-2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-file-1"></i>
                    <span class="nav-text">Data Master</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! route('pengelola.ruang-lab.index'); !!}">Data Ruang Laboratorium</a></li>
                    <li><a href="{!! route('pengelola.lemari.index'); !!}">Data Lemari</a></li>
                    <li><a href="{!! route('pengelola.kategori-alat.index'); !!}">Data Kategori Alat</a></li>
                    <li><a href="{!! route('pengelola.katalog-alat.index'); !!}">Data Katalog Alat</a></li>
                    <li><a href="{!! route('pengelola.tipe.index'); !!}">Data Merk/Tipe</a></li>
                    <li><a href="{!! route('pengelola.alat.index'); !!}">Data Alat</a></li>
                    <li><a href="{!! route('pengelola.katalog-bahan.index'); !!}">Data Katalog Bahan</a></li>
                    <li><a href="{!! route('pengelola.bahan-kimia.index'); !!}">Data Bahan Kimia</a></li>
                    <li><a href="{!! route('pengelola.bahan.index'); !!}">Data Bahan</a></li>
                    <li><a href="{!! route('pengelola.praktikum.index'); !!}">Data Praktikum</a></li>
                </ul>
            </li>
            <li><a href="{!! url('pengelola/jadwal-praktikum'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-calendar-7"></i>
                    <span class="nav-text">Jadwal Praktikum</span>
                </a>
            </li>
            <li><a href="{!! url('pengelola/penjadwalan-ulang'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-edit"></i>
                    <span class="nav-text">Penjadwalan Ulang</span>
                </a>
            </li>
            <li><a href="{!! url('pengelola/peminjaman'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-list"></i>
                    <span class="nav-text">Peminjaman</span>
                </a>
            </li>
            <li><a href="{!! url('pengelola/pengembalian'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-list-1"></i>
                    <span class="nav-text">Pengembalian</span>
                </a>
            </li>
            <li><a href="{!! url('pengelola/simulasi'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-search-3"></i>
                    <span class="nav-text">Simulasi Praktikum</span>
                </a>
            </li>
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-download"></i>
                    <span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('pengelola/cetak/kartu-stok'); !!}">Cetak Kartu Stok</a></li>
                    <li><a href="{!! url('pengelola/cetak/katalog-lemari'); !!}">Cetak Katalog Lemari</a></li>
                    <li><a href="{!! url('pengelola/cetak/alat-rusak'); !!}">Cetak Daftar Alat Rusak</a></li>
                </ul>
            </li>
        </ul>
        @elseif(Request::segment(1) == "kepalalab" || (Auth::user()->tipe_user->NAMA_TIPE_USER == 'Kepala Laboratorium'))
        <ul class="metismenu" id="menu">
            <li><a href="{!! route('kepalalab.dashboard'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-home-2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-file-1"></i>
                    <span class="nav-text">Data Master</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('kepalalab/ruang-lab'); !!}">Data Ruang Laboratorium</a></li>
                    <li><a href="{!! url('kepalalab/lemari'); !!}">Data Lemari</a></li>
                    <li><a href="{!! url('kepalalab/kategori-alat'); !!}">Data Kategori Alat</a></li>
                    <li><a href="{!! url('kepalalab/katalog-alat'); !!}">Data Katalog Alat</a></li>
                    <li><a href="{!! url('kepalalab/tipe'); !!}">Data Merk/Tipe</a></li>
                    <li><a href="{!! url('kepalalab/alat'); !!}">Data Alat</a></li>
                    <li><a href="{!! url('kepalalab/katalog-bahan'); !!}">Data Katalog Bahan</a></li>
                    <li><a href="{!! url('kepalalab/bahan-kimia'); !!}">Data Bahan Kimia</a></li>
                    <li><a href="{!! url('kepalalab/bahan'); !!}">Data Bahan</a></li>
                    <li><a href="{!! url('kepalalab/praktikum'); !!}">Data Praktikum</a></li>
                </ul>
            </li>
            <li><a href="{!! url('kepalalab/jadwal-praktikum'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-calendar-7"></i>
                    <span class="nav-text">Jadwal Praktikum</span>
                </a>
            </li>
            <li><a href="{!! url('kepalalab/penjadwalan-ulang'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-edit"></i>
                    <span class="nav-text">Penjadwalan Ulang</span>
                </a>
            </li>
            <li><a href="{!! url('kepalalab/peminjaman'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-list"></i>
                    <span class="nav-text">Peminjaman</span>
                </a>
            </li>
            <li><a href="{!! url('kepalalab/pengembalian'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-list-1"></i>
                    <span class="nav-text">Pengembalian</span>
                </a>
            </li>
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-download"></i>
                    <span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('kepalalab/cetak/kartu-stok'); !!}">Cetak Kartu Stok</a></li>
                    <li><a href="{!! url('kepalalab/cetak/katalog-lemari'); !!}">Cetak Katalog Lemari</a></li>
                    <li><a href="{!! url('kepalalab/cetak/alat-rusak'); !!}">Cetak Daftar Alat Rusak</a></li>
                </ul>
            </li>
        </ul>
        @elseif(Request::segment(1) == "sarpras" || (Auth::user()->tipe_user->NAMA_TIPE_USER == 'WAKA Sarpras'))
        <ul class="metismenu" id="menu">
            <li><a href="{!! route('sarpras.dashboard'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-home-2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-file-1"></i>
                    <span class="nav-text">Data Master</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('sarpras/alat'); !!}">Data Alat</a></li>
                    <li><a href="{!! url('sarpras/bahan-kimia'); !!}">Data Bahan Kimia</a></li>
                    <li><a href="{!! url('sarpras/bahan'); !!}">Data Bahan</a></li>
                </ul>
            </li>
            <li><a href="{!! url('sarpras/cetak/alat-rusak'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-search-3"></i>
                    <span class="nav-text">Cetak Daftar Alat Rusak</span>
                </a>
            </li>
        </ul>
        @endif
        <div class="copyright mt-3">
            <p><strong>SILAB SMA Negeri 3 Sidoarjo</strong> © {{ date('Y') }} All Rights Reserved</p>
            <p>Made with <i class="fa fa-heart"></i> by <a href="http://deaamartya.com">Dea</a> Template by <a href="http://dexignzone.com/" target="_blank">DexignZone</a></p>
        </div>
    </div>
</div>