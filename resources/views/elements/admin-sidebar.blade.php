<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{!! route('admin.dashboard'); !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Data Pengguna</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{!! route('admin.user.index'); !!}">Data User</a></li>
                    <li><a href="{!! route('admin.tipe-user.index'); !!}">Data Tipe User</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
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
    
        <div class="add-menu-sidebar">
            <img src="{{ asset('images/icon1.png') }}" alt=""/>
            <p>Organize your menus through button bellow</p>
            <a href="javascript:void(0);" class="btn btn-primary btn-block light">+ Add Menus</a>
        </div>
        <div class="copyright">
            <p><strong>Davur - Restaurant Admin Dashboard</strong> © 2020 All Rights Reserved</p>
            <p>Made with <i class="fa fa-heart"></i> by DexignZone</p>
        </div>
    </div>
</div>