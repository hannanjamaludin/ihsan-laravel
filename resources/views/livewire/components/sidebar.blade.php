<aside class="container-fluid"> 
    <div class="row flex-nowrap">
        <div class="min-vh-100 d-flex flex-column justify-content-between" id="sidebar-main">
            <div class="p-2">
                <a class="d-flex text-decoration-none mt-1 align-items-center text-primary">
                    <img src="{{ asset('assets/img/ihsan-logo-32x32.png') }}" class="navbar-brand-img h-100 me-3" alt="...">
                    <span class="fs-5 my-2 d-none d-sm-inline">Ihsan</span>
                </a>
                <hr class="text-primary">
                <ul class="nav nav-pills flex-column mt-4">
                    <li class="nav-item py-2 py-sm-1">
                        <a href="{{ route('home') }}" class="nav-link text-primary {{ request()->routeIs('home') ? 'active' : '' }}">
                            <i class="fs-5 fa fa-home"></i>
                            <span class="fs-5 ms-3 d-none d-sm-inline">Utama</span>
                        </a>
                    </li>
                    @if ($role->user_type == 1)
                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('pengguna.index') }}" class="nav-link text-primary {{ request()->routeIs('pengguna.index') ? 'active' : '' }}">
                                <i class="fs-5 fa fa-user-secret"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Profil Pengguna</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('pengguna.index_admin') }}" class="nav-link text-primary {{ request()->routeIs('pengguna.index_admin') || request()->routeIs('pengguna.kemaskini_pengguna') ? 'active' : '' }}">
                                <i class="fs-5 fa fa-users"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Pengurusan Pengguna</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('pendaftaran.permohonan') }}" class="nav-link text-primary {{ request()->routeIs('pendaftaran.permohonan') ? 'active' : '' }}">
                                <i class="fs-5 fa fa-list-check"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Permohonan Pendaftaran</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('kelas.kelas') }}" class="nav-link text-primary {{ request()->routeIs('kelas.kelas') || request()->routeIs('kelas.kelas_detail') ? 'active' : '' }}">
                                <i class="fs-5 fa fa-graduation-cap"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Bilik & Kelas</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('pengguna.index') }}" class="nav-link text-primary {{ request()->routeIs('pengguna.index') ? 'active' : '' }}">
                                <i class="fs-5 fa fa-id-card"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Profil Pengguna</span>
                            </a>
                        </li>
                    @endif
                    @if ($role->user_type == 2)
                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('pendaftaran.permohonan') }}" class="nav-link text-primary {{ request()->routeIs('pendaftaran.permohonan') ? 'active' : '' }}">
                                <i class="fs-5 fa fa-list-check"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Permohonan Pendaftaran</span>
                            </a>
                        </li>

                        @if ($teacher->is_admin == true)
                            <li class="nav-item py-2 py-sm-1">
                                <a href="{{ route('kelas.kelas') }}" class="nav-link text-primary {{ request()->routeIs('kelas.kelas') || request()->routeIs('kelas.kelas_detail') ? 'active' : '' }}">
                                    <i class="fs-5 fa fa-graduation-cap"></i>
                                    @if ($teacher->branch_id == 1)
                                        <span class="fs-5 ms-3 d-none d-sm-inline">Pengurusan Bilik</span>
                                    @else
                                        <span class="fs-5 ms-3 d-none d-sm-inline">Pengurusan Kelas</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item py-2 py-sm-1">
                                <a href="{{ route('staff.index') }}" class="nav-link text-primary {{ request()->routeIs('staff.index') ? 'active' : '' }}">
                                    <i class="fs-5 fa fa-chalkboard-user"></i>
                                    @if ($teacher->branch_id == 1)
                                        <span class="fs-5 ms-3 d-none d-sm-inline">Pengurusan Pengasuh</span>
                                    @else
                                        <span class="fs-5 ms-3 d-none d-sm-inline">Pengurusan Guru</span>
                                    @endif
                                </a>
                            </li>
                        @endif

                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('murid.aktiviti_harian') }}" class="nav-link text-primary {{ request()->routeIs('murid.aktiviti_harian') ? 'active' : '' }}">
                                <i class="fs-5 fa fa-school"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Aktiviti Harian</span>
                            </a>
                        </li>
                        
                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('kehadiran.index') }}" class="nav-link text-primary {{ request()->routeIs('kehadiran.index') ? 'active' : '' }}">
                                <i class="fs-5 fa fa-calendar-check"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Kehadiran</span>
                            </a>
                        </li>
                        @if ($teacher->is_admin == true)
                            <li class="nav-item py-2 py-sm-1">
                                <a href="{{ route('kehadiran.rekod_kehadiran') }}" class="nav-link text-primary {{ request()->routeIs('kehadiran.rekod_kehadiran') || request()->routeIs('kehadiran.rekod_kehadiran_detail') ? 'active' : '' }}">
                                    <i class="fs-5 fa fa-chart-line"></i>
                                    <span class="fs-5 ms-3 d-none d-sm-inline">Rekod Kehadiran</span>
                                </a>
                            </li>
                        @endif

                    @endif
                    @if ($role->user_type == 3 || $role->user_type == 4)
                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('pendaftaran.index') }}" class="nav-link text-primary {{ request()->routeIs('pendaftaran.index') || request()->routeIs('pendaftaran.pendaftaranBaru') || request()->routeIs('pendaftaran.pendaftaranBaruFinal')  ? 'active' : '' }}">
                                <i class="fs-5 fa-regular fa-folder-open"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Pendaftaran</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1">
                            <a href="{{ route('murid.profile') }}" class="nav-link text-primary {{ request()->routeIs('murid.profile') || request()->routeIs('murid.detail') || request()->routeIs('murid.kemaskini_profil') ? 'active' : '' }}">
                                <i class="fs-5 fa fa-user-graduate"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Profil Anak</span>
                            </a>
                        </li>
                        @if ($children->isNotEmpty())
                            <li class="nav-item py-2 py-sm-1">
                                <a href="{{ route('pembayaran.index') }}" class="nav-link text-primary {{ request()->routeIs('pembayaran.index') || request()->routeIs('pembayaran.yuran_student') ? 'active' : '' }}">
                                    <i class="fs-5 fa fa-credit-card"></i>
                                    <span class="fs-5 ms-3 d-none d-sm-inline">Pembayaran</span>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</aside>

<style>
    .nav-link.active {
        background-color: #703232 !important;
        color:  #BABABA !important;
    }

    /* .nav-link.active i {
        background-color: #B66D0D  !important;
        color: #BABABA !important;
        border-radius: 10%;
        padding: 3px; 
        display: inline-flex;
        align-items: center;
        justify-content: center;
    } */
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const collapsibleLinks = document.querySelectorAll('[data-bs-toggle="collapse"]');
        collapsibleLinks.forEach(link => {
            const collapseElement = document.querySelector(link.getAttribute('href'));
            const arrowIcon = link.querySelector('.fa-chevron-down');

            collapseElement.addEventListener('show.bs.collapse', function() {
                arrowIcon.classList.remove('fa-chevron-down');
                arrowIcon.classList.add('fa-chevron-up');
            });

            collapseElement.addEventListener('hide.bs.collapse', function() {
                arrowIcon.classList.remove('fa-chevron-up');
                arrowIcon.classList.add('fa-chevron-down');
            });
        });
    });
</script>
