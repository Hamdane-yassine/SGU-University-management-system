<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendors/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendors/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendors/images/favicon-16x16.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/jquery-steps/jquery.steps.css') }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body>
<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Cherche ici">
                </div>
            </form>
        </div>
    </div>
    <div class="header-right">
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('vendors/images/img.jpg') }}" alt="">
                                    <h3>John Doe</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                </a>
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
                        <img src="{{ asset('vendors/images/user.svg') }}" alt="">
                    </span>
                    <span class="user-name">
                       {{ auth()->user()->personne->prenom.' '.auth()->user()->personne->nom }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Aide</a>
                    <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="dw dw-logout"></i> Se déconnecter</a>
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
        <a href="index.html">
            <img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo">
            <img src="{{ asset('vendors/images/deskapp-logo-white.svg') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="sitemap.html" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-dashboard" style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Tableau de
                            board</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-graduation-cap" style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Les
                            etudiants</span>
                    </a>
                    <ul class="submenu">
                        @php
                            $filieres=array();
                            if(!empty(auth()->user()->professeur->matieres))
                            {
                                foreach (auth()->user()->professeur->matieres as $matiere)
                                {
                                    array_push($filieres, $matiere->module->filiere);
                                }
                                $filieres = array_unique($filieres);
                            }
                        @endphp
                        @foreach ($filieres as $filiere)
                             <li><a href="/etudiants/{{ $filiere->idFiliere }}">{{ $filiere->nom.' '.$filiere->niveau }}</a></li>
                        @endforeach
                        {{-- <li><a href="index.html">Génie Logiciel - GL1</a></li>
                        <li><a href="index2.html">Administrateur Réseaux</a></li> --}}
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-bar-chart" style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Notes</span>
                    </a>
                    <ul class="submenu">
                        @if (!empty(auth()->user()->professeur->matieres))
                            @foreach (auth()->user()->professeur->matieres as $matiere)
                            <li><a href="Notes.html">{{ $matiere->nom }}</a></li>
                            @endforeach 
                        @endif
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-calendar" style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Emploi du
                            temps</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="index.html">Mon emploi du temps</a></li>
                        <li><a href="index.html">Génie Logiciel - GL1</a></li>
                        <li><a href="index2.html">Administrateur Réseaux</a></li>
                    </ul>
                </li>

                <li>
                    <a href="sitemap.html" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-calendar-check-o" style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Absenses</span>
                    </a>
                </li>

                <li>
                    <a href="sitemap.html" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-bell-o" style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Notifications</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
@yield('content')
<script src="{{ asset('vendors/scripts/core.js') }}"></script>
<script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
<script src="{{ asset('vendors/scripts/process.js') }}"></script>
<script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
@yield('SpecialScripts')
</body>
</html>

