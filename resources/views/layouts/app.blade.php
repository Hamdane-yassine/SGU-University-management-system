<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Site favicon -->
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendors/images/fav180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendors/images/fav32.png') }}"> --}}
    <link rel="icon" type="image/png" href="{{ asset('vendors/images/i.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    @notifyCss
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/jquery-steps/jquery.steps.css') }}">
    @yield('SpecialStyles')
</head>

<body>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
        </div>
        <div class="header-right">
            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                        <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active" style="display: none"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 customscroll">
                            <ul id="notifications">
                                @include('components.NotificationComponents')
                                <li id='info'>
                                    <p>pas de nouvelles notifications</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{ url(Auth::user()->profile->croppedImage) }}" alt="">
                        </span>
                        <span class="user-name">
                            {{ auth()->user()->personne->prenom . ' ' . auth()->user()->personne->nom }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="{{ url('profile/' . Auth::user()->id) }}"><i
                                class="dw dw-user1"></i> Profile</a>
                        @if (Auth::user()->canImpersonate())
                            <a class="dropdown-item" href="{{ url('user/impersonate') }}"><i class="dw dw-help"></i>
                                {{ app('impersonate')->isImpersonating() ? 'Quitter' : 'personnifier' }}
                            </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="dw dw-logout"></i> Se déconnecter</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <div class="github-link">
                <span><img src="{{ asset('vendors/images/draw.svg') }}" alt=""></span>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('vendors/images/logo.svg') }}" alt="" class="light-logo">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        @if (auth()->user()->role == 'prof')
            <div class="menu-block customscroll">
                <div class="sidebar-menu">
                    <ul id="accordion-menu">
                        <li>
                            <a href="/Dashboard" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-dashboard"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Tableau
                                    de
                                    board</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-graduation-cap"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Les
                                    etudiants</span>
                            </a>
                            <ul class="submenu">
                                @php
                                    $filieres = [];
                                    if (!empty(auth()->user()->professeur->matieres)) {
                                        foreach (auth()->user()->professeur->matieres as $matiere) {
                                            array_push($filieres, $matiere->module->semestre->filiere);
                                        }
                                        $filieres = array_unique($filieres);
                                    }
                                @endphp
                                @foreach ($filieres as $filiere)
                                    <li><a
                                            href="/etudiants/{{ $filiere->idFiliere }}">{{ $filiere->nom . ' ' . $filiere->niveau }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-bar-chart"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Notes</span>
                            </a>
                            <ul class="submenu">
                                @if (!empty(auth()->user()->professeur->matieres))
                                    @foreach (auth()->user()->professeur->matieres as $matiere)
                                        <li><a href="/notes/{{ $matiere->idMatiere }}">{{ $matiere->nom }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-calendar"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Emploi
                                    du
                                    temps</span>
                            </a>
                            <ul class="submenu">
                                @php
                                    $filieres = [];
                                    if (!empty(auth()->user()->professeur->matieres)) {
                                        foreach (auth()->user()->professeur->matieres as $matiere) {
                                            array_push($filieres, $matiere->module->semestre->filiere);
                                        }
                                        $filieres = array_unique($filieres);
                                    }
                                @endphp
                                <li><a href="/emploi/my">Mon emploi du temps</a></li>
                                @foreach ($filieres as $filiere)
                                    <li><a href="/emploi/filiere/{{ $filiere->idFiliere }}">{{ $filiere->nom }} -
                                            {{ $filiere->niveau }} </a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li>
                            <a href="/absences" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-calendar-check-o"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Absenses</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/notifications') }}" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-bell-o"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Notifications</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @elseif (auth()->user()->role == 'chefdep')
            <div class="menu-block customscroll">
                <div class="sidebar-menu">
                    <ul id="accordion-menu">
                        <li>
                            <a href="/chef/dashboard" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-dashboard"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Tableau
                                    de
                                    board</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-graduation-cap"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Les
                                    etudiants</span>
                            </a>
                            <ul class="submenu">
                                @foreach (auth()->user()->professeur->chefdep->departement->filieres as $filiere)
                                    <li><a
                                            href="/chef/etudiants/{{ $filiere->idFiliere }}">{{ $filiere->nom . ' ' . $filiere->niveau }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-bar-chart"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Notes</span>
                            </a>
                            <ul class="submenu">
                                @foreach (auth()->user()->professeur->chefdep->departement->filieres as $filiere)
                                    <li><a
                                            href="/chef/matieres/{{ $filiere->idFiliere }}">{{ $filiere->nom . ' ' . $filiere->niveau }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li>
                            <a href="/chef/emploi" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-calendar"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Emploi
                                    du
                                    temps</span>
                            </a>
                        </li>

                        <li>
                            <a href="/chef/professeurs/{{ auth()->user()->professeur->chefdep->departement->idDepartement }}"
                                class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-user-o"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Gestion
                                    des Professeurs</span>
                            </a>
                        </li>

                        <li>
                            <a href="/chef/absences" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-calendar-check-o"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Absenses</span>
                            </a>
                        </li>

                        <li>
                            <a href="/chef/rattrapages" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-calendar-minus-o"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Rattrapage</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/evenement') }}" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-globe"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Evénements</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('notifications') }}" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-bell-o"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Notifications</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        @elseif (auth()->user()->role=='admin')
            <div class="menu-block customscroll">
                <div class="sidebar-menu">
                    <ul id="accordion-menu">

                        <li>
                            <a href="/admin/dashboard" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-dashboard"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Tableau
                                    de bord</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/emploi" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-calendar"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Emploi
                                    des professeurs</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/emploi/filiere" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-calendar"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Emploi
                                    des Filieres</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-graduation-cap"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Les
                                    etudiants</span>
                            </a>
                            <ul class="submenu">
                                @php
                                    $departements = App\Models\Departement::All();
                                @endphp
                                @foreach ($departements as $departement)
                                    <li><a
                                            href="/admin/filieres/{{ $departement->idDepartement }}">{{ $departement->nom }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-user-o"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Les
                                    professeurs</span>
                            </a>
                            <ul class="submenu">
                                @foreach ($departements as $departement)
                                    <li><a
                                            href="/admin/professeurs/{{ $departement->idDepartement }}">{{ $departement->nom }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/evenement') }}" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-globe"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Evénements</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/notifications') }}" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-bell-o"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Notifications</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @elseif (auth()->user()->role=='master')
            <div class="menu-block customscroll">
                <div class="sidebar-menu">
                    <ul id="accordion-menu">
                        <li>
                            <a href="/master/dashboard" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-dashboard"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Tableau
                                    de bord</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('GestionUniversite') }}" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-gears"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Gestion
                                    d'université</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('MasterAdminsIndex') }}" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-gears"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Gestion
                                    des admins</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/evenement') }}" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-globe"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Evénements</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/notifications') }}" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-bell-o"
                                    style="padding-left: 15px; padding-bottom: 5px;"></span><span
                                    class="mtext">Notifications</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        @include('notify::messages')
    </div>
    <div class="mobile-menu-overlay"></div>
    @yield('content')
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
    <script>
        const parser = new DOMParser();
        // const html = "<li><h id='info'>pas de nouvelles notifications</h></li>";
        // const infoNode = parser.parseFromString(html,'text/html');
        var infoNodeExists;
        var unread;
        hello();
        if (document.getElementById('notifications').children.length == 0) {
            // node.append(' <li><p>Empty</p></li>');
            $('.badge').css('display', 'none');
            $('#notifications').append
        };

        function playSound(url) {
            const audio = new Audio('{{ asset('vendors/sounds/notification.mp3') }}');
            audio.play();
        }

        window.Echo.private('App.Models.User.{{ Auth::user()->id }}')
            .listen('.Evt', (e) => {
                console.log(e);
            }).listen('\\Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', (notification) => {
                console.log(notification);
                addToDropDown(notification);
                playSound();

            }).on('pusher:subscription_succeeded', (member) => {
                console.log('successfulddly subscribed!');
            });

        function addToDropDown(notification) {
            $('#info').hide();
            $('.badge').css('display', '');
            $('#notifications').prepend(format(notification));
        };

        function format(data) {
            const htmText = "<li><a href=/notifications?idNotif=" + data.idNotif + "><img src='" + data.image +
                "'' alt='image'><h3>" + data.from + "</h3><p>" + data.brief.substr(0, 70) + "...</p></a></li>";
            const node = parser.parseFromString(htmText, "text/html");
            return node.body;
        };

        $('.badge').css('display', 'none');
        $('#info').show();

        function hello() {
            unread = {{ Auth::user()->unreadNotifications->count() }};
            // console.log(unread+' '+infoNodeExists);
            if (unread == 0) {
                $('.badge').css('display', 'none');
                $('#info').show();
                // console.log('Ha');
            } else {
                $('.badge').css('display', '');
                $('#info').hide();
            }
        }
        $('.icon-copy').click(hello());

        // $('img').click(function (param) {

        //     @php
        //         notify()->success('Welcome to Laravel Notify ⚡', 'My custom title');
        //     @endphp
        // });

    </script>
    @notifyJs
    @yield('SpecialScripts')
</body>

</html>
