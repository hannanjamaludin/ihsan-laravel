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
                    <li class="nav-item py-2 py-sm-0">
                        <a href="{{ route('home') }}" class="nav-link text-primary">
                            <i class="fs-5 fa fa-home"></i>
                            <span class="fs-5 ms-3 d-none d-sm-inline">Utama</span>
                        </a>
                    </li>
                    <li class="nav-item py-2 py-sm-0">
                        @if ($role->user_type == 1)
                            <a href="{{ route('pengguna.index_admin') }}" class="nav-link text-primary">
                                <i class="fs-5 fa fa-user-secret"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Profil Pengguna</span>
                            </a>
                        @else
                            <a href="{{ route('pengguna.index') }}" class="nav-link text-primary">
                                <i class="fs-5 fa fa-id-card"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Profil Pengguna</span>
                            </a>
                        @endif
                    </li>
                    @if ($role->user_type == 1 || $role->user_type == 2)
                        <li class="nav-item py-2 py-sm-0">
                            <a href="{{ route('pendaftaran.permohonan') }}" class="nav-link text-primary">
                                <i class="fs-5 fa fa-list-check"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Permohonan Pendaftaran</span>
                            </a>
                        </li>
                    @endif
                    @if ($role->user_type == 3 || $role->user_type == 4)
                        <li class="nav-item py-2 py-sm-0">
                            <a href="{{ route('pendaftaran.index') }}" class="nav-link text-primary">
                                <i class="fs-5 fa-regular fa-folder-open"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Pendaftaran</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#" class="nav-link text-primary">
                                <i class="fs-5 fa fa-user-graduate"></i>
                                <span class="fs-5 ms-3 d-none d-sm-inline">Profil Anak</span>
                            </a>
                        </li>
                        @if ($children->isNotEmpty())
                            <li class="nav-item py-2 py-sm-0">
                                <a href="{{ route('pembayaran.index') }}" class="nav-link text-primary">
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

