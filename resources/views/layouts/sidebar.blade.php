<nav class="sidebar">
    <div class="sidebar-header">
        <a href="/" class="sidebar-brand">
            <img src="{{ asset('assets/images/logo.png') }}" alt="SuperLog Logo" width="150">
            {{-- Super<span>Log</span> --}}
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">

            @if (!auth()->user()->is_admin || Request::is('admin/users/*'))

                {{-- <div class="list-group">
                    <a class="workspace-selected d-flex align-items-center">
                        <img class="wd-40 ht-40 rounded-circle" src="https://via.placeholder.com/40x40" alt="">
                        <div class="d-flex flex-column mx-1 align-items-baseline">
                            <span>Supercode</span>
                            <span class="text-muted"><small>Çalışma alanı</small></span>
                        </div>
                    </a>
                </div> --}}

            @endif
            @if (auth()->user()->is_admin)
                <li class="nav-item nav-category" style="color: #000865 !important; text-shadow: 1px 1px 1px #6571ff;">
                    Admin
                </li>
                <li class="nav-item {{ active_class(['*admin/users*']) }}">
                    <a href="{{ route('admin.users') }}" class="nav-link">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Kullanıcılar</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['*admin/admins*']) }}">
                    <a href="{{ route('admin.admins') }}" class="nav-link">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Yöneticiler</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['*admin/devices*']) }}">
                    <a href="{{ route('admin.devices') }}" class="nav-link">
                        <i class="link-icon" data-feather="monitor"></i>
                        <span class="link-title">Cihazlar</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['*admin/logs*']) }}">
                    <a href="{{ route('admin.logs') }}" class="nav-link">
                        <i class="link-icon" data-feather="list"></i>
                        <span class="link-title">Loglar</span>
                    </a>
                </li>
            @endif


            @if (!auth()->user()->is_admin || Request::is('admin/users/*'))
                <li class="nav-item nav-category">Dashboard</li>
                <li class="nav-item {{ active_class(['*/dashboard*']) }}">
                    <div id="prf" class="list-group ws-list-group">
                        <!-- Example single danger button -->
                        <div class="btn-group" style="border: solid 1px #CCC; border-radius: 0;">
                            <button type="button" class="dropdown-item d-flex" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <img class="wd-40 ht-40 rounded-circle"
                                     src="https://ui-avatars.com/api/?name=Super+Code"
                                     alt="">
                                <div class="d-flex flex-row mx-1 align-items-center">
                                    <div class="d-flex flex-column mx-1 align-items-baseline">

                                        <span>{{$workspace_detail->name}}</span>
                                        <span class="text-muted"><small>Çalışma alanı</small></span>
                                    </div>
                                    <div>

                                        <i data-feather="chevron-down"></i>
                                    </div>
                                </div>
                            </button>

                                <?php
                                $userRole = \App\Models\AllowedUserAndWorkspaces::where(['allowed_user_id' => auth()->user()->id, 'allowed_workspace_id' => $workspace_detail->id])->first();

                                $workspaces = \Illuminate\Support\Facades\DB::table('allowed_user_and_workspaces as allow')
                                    ->join('work_spaces as ws', 'allow.allowed_workspace_id', '=', 'ws.id')
                                    ->select('*', 'ws.id as workspace_id')
                                    ->distinct('ws.name')
                                    ->where('allow.allowed_user_id', \auth()->user()->id)->get();
                                ?>

                            <ul class="dropdown-menu"
                                style="width: 100%; padding: 0; border: solid 1px #CCC; border-top: none; border-radius: 0;">
                                @foreach($workspaces as $key => $workspace)
                                    @if($workspace_detail->id != $workspace->id)
                                            <?php
                                            if (request()->segment(1) == 'device') {
                                                $route = 'devices';
                                            } elseif (request()->segment(2) == 'account') {
                                                $route = 'dashboard';
                                            } else {
                                                $route = request()->segment(2);
                                            }
                                            ?>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center"
                                               href="{{ route($route , ['workspace' => $workspace->id]) }}">
                                                <img class="wd-40 ht-40 rounded-circle"
                                                     src="https://ui-avatars.com/api/?name=Super+Code" alt="">
                                                <div class="d-flex flex-column mx-1 align-items-baseline">
                                                    <span>{{$workspace->name}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider" style="margin: 0;">
                                        </li>
                                    @endif
                                @endforeach

                                {{--                            <li class="mt-2">--}}
                                {{--                                <a class="dropdown-item d-flex align-items-center"--}}
                                {{--                                   href="javascript:void(0)"--}}
                                {{--                                   data-bs-toggle="modal"--}}
                                {{--                                   data-bs-target="#workspaceStaticBackdrop1"--}}
                                {{--                                >--}}
                                {{--                                    <svg style="width: 37px;" xmlns="http://www.w3.org/2000/svg" width="24"--}}
                                {{--                                         height="24"--}}
                                {{--                                         viewBox="0 0 24 24"--}}
                                {{--                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                                {{--                                         stroke-linejoin="round" class="feather feather-plus btn-icon-append">--}}
                                {{--                                        <line x1="12" y1="5" x2="12" y2="19"></line>--}}
                                {{--                                        <line x1="5" y1="12" x2="19" y2="12"></line>--}}
                                {{--                                    </svg>--}}
                                {{--                                    <strong>Cihaz Ekle</strong>--}}
                                {{--                                </a>--}}

                                {{--                            </li>--}}

                                @if($userRole->user_role ==='owner')
                                    <li class="mt-2">
                                        <a class="dropdown-item d-flex align-items-center"
                                           href="javascript:void(0)"
                                           data-bs-toggle="modal"
                                           data-bs-target="#workspaceStaticBackdrop3"
                                        >
                                            <svg style="width: 37px;" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round" class="feather feather-plus btn-icon-append">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            <strong>Çalışma Alanı Ekle</strong>
                                        </a>

                                    </li>
                                @endif


                                <li>
                                    <hr class="dropdown-divider" style="margin: 0;">
                                </li>

                                {{--                            <li class="mt-2">--}}
                                {{--                                <a class="dropdown-item d-flex align-items-center"--}}
                                {{--                                   href="{{ route('logout') }}"--}}
                                {{--                                   onclick="event.preventDefault();--}}
                                {{--                                                     document.getElementById('logout-form').submit();">--}}
                                {{--                                    <svg style="width: 37px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
                                {{--                                         viewBox="0 0 24 24"--}}
                                {{--                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                                {{--                                         stroke-linejoin="round" class="feather feather-log-out me-2 icon-md">--}}
                                {{--                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>--}}
                                {{--                                        <polyline points="16 17 21 12 16 7"></polyline>--}}
                                {{--                                        <line x1="21" y1="12" x2="9" y2="12"></line>--}}
                                {{--                                    </svg>--}}
                                {{--                                    <strong>Çıkış</strong>--}}
                                {{--                                </a>--}}
                                {{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
                                {{--                                    @csrf--}}
                                {{--                                </form>--}}
                                {{--                            </li>--}}
                                <li>
                                    <hr class="dropdown-divider" style="margin: 0;">
                                </li>

                            </ul>


                        </div>
                    </div>
                    <a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}" class="nav-link">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Anasayfa</span>
                    </a>
                </li>

                <li class="nav-item {{ active_class(['*/devices*']) }}">
                    <a class="nav-link" href="{{ route('devices', ['workspace' => $workspace_detail->id]) }}"
                       aria-expanded="{{ is_active_route(['devices/*']) }}">
                        <i class="link-icon" data-feather="monitor"></i>
                        <span class="link-title">Cihazlar</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['*/reports*']) }}">
                    <a class="nav-link" href="{{ route('reports', ['workspace' =>$workspace_detail->id]) }}"
                       aria-expanded="{{ is_active_route(['reports/*']) }}">
                        <i class="link-icon" data-feather="bar-chart"></i>
                        <span class="link-title">Raporlar</span>
                    </a>
                </li>

                @if($userRole->user_role ==='owner')

                    <li class="nav-item {{ active_class(['*/zones*']) }}">
                        <a class="nav-link" href="{{ route('zones', ['workspace' =>$workspace_detail->id]) }}"
                           aria-expanded="{{ is_active_route(['zones/*']) }}">
                            <i class="link-icon" data-feather="square"></i>
                            <span class="link-title">Bölgeler</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item {{ active_class(['*/issues*']) }}">
                    <a class="nav-link" href="{{ route('issues',['workspace' =>$workspace_detail->id]) }}"
                       aria-expanded="{{ is_active_route(['issues/*']) }}">
                        <i class="link-icon" data-feather="cloud-off"></i>
                        <span class="link-title">Olaylar</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Çalışma Alanı</li>


                @if($userRole->user_role === 'owner')
                    <li class="nav-item {{ active_class(['*/collaborations*']) }}">
                        <a href="{{ route('collaborations', ['workspace' =>$workspace_detail->id]) }}"
                           class="nav-link">
                            <i class="link-icon" data-feather="users"></i>
                            <span class="link-title">Katılımcılar</span>
                        </a>
                    </li>

                @endif


                <li class="nav-item {{ active_class(['*/settings*']) }}">
                    <a href="{{ route('settings', ['workspace' =>$workspace_detail->id]) }}"
                       class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Ayarlar</span>
                    </a>
                </li>


                <li class="nav-item nav-category">Hesap</li>
                <li class="nav-item {{ active_class(['*/profile*']) }}">
                    <a href="{{ route('account.profile',['workspace' =>$workspace_detail->id]) }}" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">Profil</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['*/plan*']) }}">
                    <a href="{{ route('account.plan',['workspace' =>$workspace_detail->id]) }}" class="nav-link">
                        <i class="link-icon" data-feather="credit-card"></i>
                        <span class="link-title">Plan</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Destek</li>
                <li class="nav-item {{ active_class(['faq']) }}">
                    <a href="{{ route('faq') }}" class="nav-link">
                        <i class="link-icon" data-feather="file"></i>
                        <span class="link-title">Sıkça Sorulan Sorular</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['apps/chat']) }}">
                    <a href="{{ url('/demo/apps/chat') }}" class="nav-link">
                        <i class="link-icon" data-feather="tag"></i>
                        <span class="link-title">Hakkında</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['apps/chat']) }}">
                    <a href="{{ route('tickets') }}" class="nav-link">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Destek Talebi</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>

<div class="modal fade" id="workspaceStaticBackdrop3" data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="workspaceStaticBackdropdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="workspaceStaticBackdropdropLabel">Çalışma
                    Alanı Ekle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <form action="/addnewworkspace" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control">
                        <label for="exampleFormControlInput1"
                               class="form-label">İsim</label>
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

                    <input type="hidden" name="workspace_id" value="{{$workspace_detail->id}}">
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


<style>
    .select2 {
        width: 100% !important;
    }

    .modal.fade {
        z-index: 10000000 !important;
    }
</style>
<!-- base js -->

<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>


<script>
    $(document).ready(function () {
        $('#select-test').select2({
            dropdownParent: $("#workspaceStaticBackdrop3")
        });


    })

    $('.sidebar-toggler').on('click', function () {
        let classn = $(this).attr('class').split(' ')[1]
        if (classn === 'not-active') {
            $('#prf').addClass('d-none')
        } else {
            $('#prf').removeClass(('d-none'))
        }
    })


</script>




