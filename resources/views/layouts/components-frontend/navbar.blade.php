<header id="header" class="header fixed-top">
    <style>
        .dropdown-menu-user {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: white;
            padding: 10px 0;
            border-radius: 5px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <h3 class="sitename" style="margin-top: 6px">@include('partials.logo')</h3>

            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}" class="active">Beranda<br></a></li>

                    <li class="dropdown position-relative">
                        <a href="#"><span>{{ Auth::user()->name }}</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul class="dropdown-menu-user">
                            <li><a href="{{ route('profile', Auth::user()->id) }}">Profil</a></li>
                            <li><a href="#">{{ Auth::user()->isAdmin == 1 ? 'Admin' : 'Siswa' }}</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="border-0 bg-transparent ms-auto" tabindex="0" type="button"
                                    aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="logout">Log Out
                                </a>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>

    </div>

</header>
