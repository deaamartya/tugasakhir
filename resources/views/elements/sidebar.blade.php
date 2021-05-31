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
                    <li><a href="{!! url('pengelola/cetak/kartu-stok'); !!}">Data Kartu Stok</a></li>
                    <li><a href="{!! url('pengelola/cetak/katalog-lemari'); !!}">Data Katalog Lemari</a></li>
                    <li><a href="{!! url('pengelola/cetak/alat-rusak'); !!}">Daftar Alat Rusak</a></li>
                </ul>
            </li>
        </ul>
        @else
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('/index'); !!}">Dashboard</a></li>
                    <li><a href="{!! url('/page-analytics'); !!}">Analytics</a></li>
                    <li><a href="{!! url('/page-review'); !!}">Review</a></li>
                    <li><a href="{!! url('/page-order'); !!}">Order</a></li>
                    <li><a href="{!! url('/page-order-list'); !!}">Order List</a></li>
                    <li><a href="{!! url('/page-general-customers'); !!}">General Customers</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Apps</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('/app-profile'); !!}">Profile</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                        <ul aria-expanded="false">
                            <li><a href="{!! url('/email-compose'); !!}">Compose</a></li>
                            <li><a href="{!! url('/email-inbox'); !!}">Inbox</a></li>
                            <li><a href="{!! url('/email-read'); !!}">Read</a></li>
                        </ul>
                    </li>
                    <li><a href="{!! url('/app-calender'); !!}">Calendar</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                        <ul aria-expanded="false">
                            <li><a href="{!! url('/ecom-product-grid'); !!}">Product Grid</a></li>
                            <li><a href="{!! url('/ecom-product-list'); !!}">Product List</a></li>
                            <li><a href="{!! url('/ecom-product-detail'); !!}">Product Details</a></li>
                            <li><a href="{!! url('/ecom-product-order'); !!}">Order</a></li>
                            <li><a href="{!! url('/ecom-checkout'); !!}">Checkout</a></li>
                            <li><a href="{!! url('/ecom-invoice'); !!}">Invoice</a></li>
                            <li><a href="{!! url('/ecom-customers'); !!}">Customers</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-controls-3"></i>
                    <span class="nav-text">Charts</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('/chart-flot'); !!}">Flot</a></li>
                    <li><a href="{!! url('/chart-morris'); !!}">Morris</a></li>
                    <li><a href="{!! url('/chart-chartjs'); !!}">Chartjs</a></li>
                    <li><a href="{!! url('/chart-chartist'); !!}">Chartist</a></li>
                    <li><a href="{!! url('/chart-sparkline'); !!}">Sparkline</a></li>
                    <li><a href="{!! url('/chart-peity'); !!}">Peity</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-internet"></i>
                    <span class="nav-text">Bootstrap</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('/ui-accordion'); !!}">Accordion</a></li>
                    <li><a href="{!! url('/ui-alert'); !!}">Alert</a></li>
                    <li><a href="{!! url('/ui-badge'); !!}">Badge</a></li>
                    <li><a href="{!! url('/ui-button'); !!}">Button</a></li>
                    <li><a href="{!! url('/ui-modal'); !!}">Modal</a></li>
                    <li><a href="{!! url('/ui-button-group'); !!}">Button Group</a></li>
                    <li><a href="{!! url('/ui-list-group'); !!}">List Group</a></li>
                    <li><a href="{!! url('/ui-media-object'); !!}">Media Object</a></li>
                    <li><a href="{!! url('/ui-card'); !!}">Cards</a></li>
                    <li><a href="{!! url('/ui-carousel'); !!}">Carousel</a></li>
                    <li><a href="{!! url('/ui-dropdown'); !!}">Dropdown</a></li>
                    <li><a href="{!! url('/ui-popover'); !!}">Popover</a></li>
                    <li><a href="{!! url('/ui-progressbar'); !!}">Progressbar</a></li>
                    <li><a href="{!! url('/ui-tab'); !!}">Tab</a></li>
                    <li><a href="{!! url('/ui-typography'); !!}">Typography</a></li>
                    <li><a href="{!! url('/ui-pagination'); !!}">Pagination</a></li>
                    <li><a href="{!! url('/ui-grid'); !!}">Grid</a></li>

                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-heart"></i>
                    <span class="nav-text">Plugins</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('/uc-select2'); !!}">Select 2</a></li>
                    <li><a href="{!! url('/uc-nestable'); !!}">Nestedable</a></li>
                    <li><a href="{!! url('/uc-noui-slider'); !!}">Noui Slider</a></li>
                    <li><a href="{!! url('/uc-sweetalert'); !!}">Sweet Alert</a></li>
                    <li><a href="{!! url('/uc-toastr'); !!}">Toastr</a></li>
                    <li><a href="{!! url('/map-jqvmap'); !!}">Jqv Map</a></li>
                </ul>
            </li>
            <li><a href="{!! url('/widget-basic'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Widget</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Forms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('/form-element'); !!}">Form Elements</a></li>
                    <li><a href="{!! url('/form-wizard'); !!}">Wizard</a></li>
                    <li><a href="{!! url('/form-editor-summernote'); !!}">Summernote</a></li>
                    <li><a href="{!! url('/form-pickers'); !!}">Pickers</a></li>
                    <li><a href="{!! url('/form-validation-jquery'); !!}">Jquery Validate</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-network"></i>
                    <span class="nav-text">Table</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('/table-bootstrap-basic'); !!}">Bootstrap</a></li>
                    <li><a href="{!! url('/table-datatable-basic'); !!}">Datatable</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-layer-1"></i>
                    <span class="nav-text">Pages</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! url('/page-register'); !!}">Register</a></li>
                    <li><a href="{!! url('/page-login'); !!}">Login</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                        <ul aria-expanded="false">
                            <li><a href="{!! url('/page-error-400'); !!}">Error 400</a></li>
                            <li><a href="{!! url('/page-error-403'); !!}">Error 403</a></li>
                            <li><a href="{!! url('/page-error-404'); !!}">Error 404</a></li>
                            <li><a href="{!! url('/page-error-500'); !!}">Error 500</a></li>
                            <li><a href="{!! url('/page-error-503'); !!}">Error 503</a></li>
                        </ul>
                    </li>
                    <li><a href="{!! url('/page-lock-screen'); !!}">Lock Screen</a></li>
                </ul>
            </li>
        </ul>
        @endif
        <div class="copyright mt-3">
            <p><strong>Davur - Restaurant Admin Dashboard</strong> © 2020 All Rights Reserved</p>
            <p>Made with <i class="fa fa-heart"></i> by DexignZone</p>
        </div>
    </div>
</div>