<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="superLOG">
    <meta name="keywords" content="superLOG">

    <title>superLOG</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"/>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <!-- end common css -->

    @stack('style')
</head>

<body data-base-url="{{ url('/') }}">

<script src="{{ asset('assets/js/spinner.js') }}"></script>
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
                         src="{{ asset(\App\Models\UserInfo::where('user_id',auth()->user()->id)->first()->user_img) }}"
                         alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle"
                                 src="{{ asset(\App\Models\UserInfo::where('user_id',auth()->user()->id)->first()->user_img) }}"
                                 alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                            <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <ul class="list-unstyled p-1">
                        {{--                        <li class="dropdown-item py-2">--}}
                        {{--                            <a href="{{ route('account.profile',['workspace'=>$workspace_detail->id]) }}" class="text-body ms-0">--}}
                        {{--                                <i class="me-2 icon-md" data-feather="user"></i>--}}
                        {{--                                <span>Profil</span>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        <li class="dropdown-item py-2">
                            <a class="text-body ms-0" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                Çıkış
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>

                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="main-wrapper" id="app">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-6 col-xl-4 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-12 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2"><img
                                            src="{{ asset('assets/images/logo.png') }}" alt="SuperLog Logo" width="150"></a>
                                    @if(Session::has('success'))
                                        @if(is_array(Session::get('success')))
                                            @foreach(Session::get('success') as $message)
                                                    <?php \RealRashid\SweetAlert\Facades\Alert::success($message)->showConfirmButton('Tamam', '#3085d6')
                                                    ?>
                                            @endforeach
                                        @else
                                                <?php \RealRashid\SweetAlert\Facades\Alert::success(Session::get('success'))->showConfirmButton('Tamam', '#3085d6')
                                                ?>
                                        @endif
                                    @endif

                                    @if(Session::has('error'))
                                        @if(is_array(Session::get('error')))
                                            @foreach(Session::get('error') as $message)
                                                    <?php \RealRashid\SweetAlert\Facades\Alert::error($message)->showConfirmButton('Tamam', '#3085d6');
                                                    ?>
                                            @endforeach
                                        @else
                                                <?php \RealRashid\SweetAlert\Facades\Alert::error(Session::get('error'))->showConfirmButton('Tamam', '#3085d6');
                                                ?>
                                        @endif
                                    @endif
                                    <h5 class="text-muted fw-normal mb-4">Çalışma alanı seçin.</h5>
                                    <div class="workspaces">
                                        <div class="w-100 p-0" aria-labelledby="dropdownMenuButton1">
                                            @foreach($workspaces as $workspace)

                                                <a class="btn btn-light w-100 mb-2"
                                                   href="{{ route('dashboard', ['workspace' => $workspace->workspace_id])}}">
                                                    <div class="workspace-list-name d-flex align-items-center">
                                                        <img class="wd-40 ht-40 rounded-circle"
                                                             src="https://via.placeholder.com/40x40" alt="">
                                                        <div
                                                            class="d-flex flex-row mx-2 align-items-center justify-content-between">
                                                            <span>{{$workspace->name}}</span>
                                                            <i class="btn-icon-append" data-feather="chevron-right"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach


                                            @if(\App\Models\AllowedUserAndWorkspaces::where('allowed_user_id',auth()->user()->id)->first()->user_role=='owner')

                                                <div class="d-grid gap-2">
                                                    <button type="button"
                                                            class="btn btn-primary btn-icon-text d-flex align-items-center justify-content-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#workspaceStaticBackdrop">
                                                        Çalışma Alanı Ekle
                                                        <i class="btn-icon-append" data-feather="plus"></i>
                                                    </button>
                                                </div>
                                                <div class="d-grid gap-2 mt-3">
                                                    <button type="button"
                                                            class="btn btn-warning btn-icon-text d-flex align-items-center justify-content-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#workspaceStaticBackdrop1">
                                                        Cihaz Ekle
                                                        <i class="btn-icon-append" data-feather="plus"></i>
                                                    </button>
                                                </div>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="workspaceStaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="workspaceStaticBackdropdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="workspaceStaticBackdropdropLabel">Çalışma Alanı Ekle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <form action="/addnewworkspace" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control">
                        <label for="exampleFormControlInput1" class="form-label">İsim</label>
                    </div>
                </div>
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">İptal
                    </button>
                    <button type="submit" class="btn btn-primary">Ekle</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="workspaceStaticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false"
     aria-labelledby="workspaceStaticBackdropdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="workspaceStaticBackdropdropLabel">Cihaz Ekle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <form action="/devices/create-device" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <select id="select-test" required name="workspace_id"
                                aria-label="Default select example">
                            <option selected disabled>Alan seçiniz...</option>

                            @foreach($workspaces as $workspace)
                                <option
                                    value="{{$workspace->id}}">{{$workspace->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" required name="serial_no"
                               class="form-control">
                        <label for="exampleFormControlInput1" class="form-label">Cihaz Seri No</label>
                    </div>
                </div>
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">İptal
                    </button>
                    <button type="submit" class="btn btn-primary">Ekle</button>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- base js -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>


<style>
    .select2 {
        width: 100% !important;
    }
</style>

<script>
    $(document).ready(function () {
        $('#select-test').select2({
            dropdownParent: $("#workspaceStaticBackdrop1")
        });


    })
</script>
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

<!-- common js -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- end common js -->
@include('sweetalert::alert')
@stack('custom-scripts')
</body>

</html>
