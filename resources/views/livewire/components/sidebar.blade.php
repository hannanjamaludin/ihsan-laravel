<aside class="container-fluid"> 
    <div class="row flex-nowrap">
        <div class="min-vh-100 d-flex flex-column justify-content-between shadow-sm" id="sidebar-main">
            <div class="p-2">
                <a class="d-flex text-decoration-none mt-1 align-items-center text-primary">
                    <img src="{{ asset('assets/img/ihsan-logo-32x32.png') }}" class="navbar-brand-img h-100 me-3" alt="...">
                    <span class="fs-4 my-2 d-none d-sm-inline">Ihsan</span>
                </a>
                <hr class="text-primary">
                <ul class="nav nav-pills flex-column mt-4">
                    <li class="nav-item py-2 py-sm-0">
                        <a href="{{ route('home') }}" class="nav-link text-primary">
                            <i class="fs-5 fa fa-home"></i>
                            <span class="fs-4 ms-3 d-none d-sm-inline">Utama</span>
                        </a>
                    </li>
                    <li class="nav-item py-2 py-sm-0">
                        <a href="{{ route('pendaftaran.pendaftaran') }}" class="nav-link text-primary">
                            <i class="fs-5 fa fa-folder-open"></i>
                            <span class="fs-4 ms-3 d-none d-sm-inline">Pendaftaran</span>
                        </a>
                    </li>
                    <li class="nav-item py-2 py-sm-0">
                        <a href="#" class="nav-link text-primary">
                            <i class="fs-5 fa fa-user-graduate"></i>
                            <span class="fs-4 ms-3 d-none d-sm-inline">Profil Anak</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>

