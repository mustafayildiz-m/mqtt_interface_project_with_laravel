<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ url('assets/images/flags/tr.svg') }}" class="wd-20 me-1" title="tr" alt="tr"> <span
                        class="ms-1 me-1 d-none d-md-inline-block">Türkçe</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <a href="javascript:;" class="dropdown-item py-2"> <img
                            src="{{ url('assets/images/flags/tr.svg') }}" class="wd-20 me-1" title="tr" alt="tr"> <span
                            class="ms-1"> Türkçe </span></a>
                    <a href="javascript:;" class="dropdown-item py-2"> <img
                            src="{{ url('assets/images/flags/us.svg') }}" class="wd-20 me-1" title="us" alt="us"> <span
                            class="ms-1"> English </span></a>
                </div>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="grid"></i>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="appsDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p class="mb-0 fw-bold">Web Apps</p>
                        <a href="javascript:;" class="text-muted">Edit</a>
                    </div>
                    <div class="row g-0 p-1">
                        <div class="col-3 text-center">
                            <a href="{{ url('/apps/chat') }}"
                                class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                    data-feather="message-square" class="icon-lg mb-1"></i>
                                <p class="tx-12">Chat</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                            <a href="{{ url('/apps/calendar') }}"
                                class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                    data-feather="calendar" class="icon-lg mb-1"></i>
                                <p class="tx-12">Calendar</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                            <a href="{{ url('/email/inbox') }}"
                                class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                    data-feather="mail" class="icon-lg mb-1"></i>
                                <p class="tx-12">Email</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                            <a href="{{ route('account.profile') }}"
                                class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                    data-feather="instagram" class="icon-lg mb-1"></i>
                                <p class="tx-12">Profile</p>
                            </a>
                        </div>
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="mail"></i>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="messageDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>9 New Messages</p>
                        <a href="javascript:;" class="text-muted">Clear all</a>
                    </div>
                    <div class="p-1">
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div class="me-3">
                                <img class="wd-30 ht-30 rounded-circle"
                                    src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                            </div>
                            <div class="d-flex justify-content-between flex-grow-1">
                                <div class="me-4">
                                    <p>Leonardo Payne</p>
                                    <p class="tx-12 text-muted">Project status</p>
                                </div>
                                <p class="tx-12 text-muted">2 min ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div class="me-3">
                                <img class="wd-30 ht-30 rounded-circle"
                                    src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                            </div>
                            <div class="d-flex justify-content-between flex-grow-1">
                                <div class="me-4">
                                    <p>Carl Henson</p>
                                    <p class="tx-12 text-muted">Client meeting</p>
                                </div>
                                <p class="tx-12 text-muted">30 min ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div class="me-3">
                                <img class="wd-30 ht-30 rounded-circle"
                                    src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                            </div>
                            <div class="d-flex justify-content-between flex-grow-1">
                                <div class="me-4">
                                    <p>Jensen Combs</p>
                                    <p class="tx-12 text-muted">Project updates</p>
                                </div>
                                <p class="tx-12 text-muted">1 hrs ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div class="me-3">
                                <img class="wd-30 ht-30 rounded-circle"
                                    src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                            </div>
                            <div class="d-flex justify-content-between flex-grow-1">
                                <div class="me-4">
                                    <p>{{ Auth::user()->name }}</p>
                                    <p class="tx-12 text-muted">Project deatline</p>
                                </div>
                                <p class="tx-12 text-muted">2 hrs ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div class="me-3">
                                <img class="wd-30 ht-30 rounded-circle"
                                    src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                            </div>
                            <div class="d-flex justify-content-between flex-grow-1">
                                <div class="me-4">
                                    <p>Yaretzi Mayo</p>
                                    <p class="tx-12 text-muted">New record</p>
                                </div>
                                <p class="tx-12 text-muted">5 hrs ago</p>
                            </div>
                        </a>
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li> --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>3 Yeni Bildirim</p>
                        <a href="javascript:;" class="text-muted">Tümünü Temizle</a>
                    </div>
                    <div class="p-1">
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div
                                class="wd-30 ht-30 d-flex align-items-center justify-content-center rounded-circle me-3">
                                <i class="icon-sm" data-feather="wifi-off"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>SC-23 adlı cihazın elektrik veya internet bağlantısı kesildi</p>
                                <p class="tx-12 text-muted">30 dakika önce</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div
                                class="wd-30 ht-30 d-flex align-items-center justify-content-center rounded-circle me-3">
                                <i class="icon-sm" data-feather="coffee"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>SC-23 adlı cihazın sıcaklığı <span class="badge bg-danger">kritik</span> seviyede</p>
                                <p class="tx-12 text-muted">45 dakika önce</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div
                                class="wd-30 ht-30 d-flex align-items-center justify-content-center rounded-circle me-3">
                                <i class="icon-sm" data-feather="droplet"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>SC-23 adlı cihazın nemi <span class="badge bg-danger">kritik</span> seviyede</p>
                                <p class="tx-12 text-muted">49 dakika önce</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div
                                class="wd-30 ht-30 d-flex align-items-center justify-content-center rounded-circle me-3">
                                <i class="icon-sm" data-feather="droplet"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>SC-23 adlı cihazın nemi <span class="badge bg-warning">yüksek</span> seviyede</p>
                                <p class="tx-12 text-muted">49 dakika önce</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div
                                class="wd-30 ht-30 d-flex align-items-center justify-content-center rounded-circle me-3">
                                <i class="icon-sm" data-feather="droplet"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>SC-23 adlı cihazın sıcaklığı <span class="badge bg-warning">yüksek</span> seviyede
                                </p>
                                <p class="tx-12 text-muted">49 dakika önce</p>
                            </div>
                        </a>
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="3/issues">Hepsini Görüntüle</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle"
                         src="{{ asset(\App\Models\UserInfo::where('user_id',auth()->user()->id)->first()->user_img) }}" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle"
                                 src="{{ asset(\App\Models\UserInfo::where('user_id',auth()->user()->id)->first()->user_img) }}" alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                            <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ route('account.profile',['workspace'=>request()->segment(1)]) }}"
                               class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Profil</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a class="text-body ms-0" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                Çıkış
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
