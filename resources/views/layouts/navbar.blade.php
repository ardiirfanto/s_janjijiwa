<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="logo">
            <span class="logo-light">
                <i class="mdi mdi-camera-control"></i> JANJI JIWA
            </span>
            <span class="logo-sm">
                <i class="mdi mdi-camera-control"></i>
            </span>
        </a>
    </div>

    <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">
            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/images/user.png') }}" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        {{-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i>
                            Profile</a>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-wallet"></i> Wallet</a>
                        <a class="dropdown-item d-block" href="#"><span
                                class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i>
                            Settings</a>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i>
                            Lock screen</a>
                        <div class="dropdown-divider"></div> --}}
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                            <i class="mdi mdi-power text-danger"></i>
                            Logout</a>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
            <li class="d-none d-md-inline-block">
                <h5 style="margin-top:22px">
                    Sistem Analisis Sentimen Pengguna Twitter Dengan Naive Bayes
                </h5>
            </li>
        </ul>

    </nav>

</div>
