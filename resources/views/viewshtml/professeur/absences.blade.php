<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Absences</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css">

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
                                        <img src="vendors/images/img.jpg" alt="">
                                        <h3>John Doe</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/photo1.jpg" alt="">
                                        <h3>Lea R. Frith</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/photo2.jpg" alt="">
                                        <h3>Erik L. Richards</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/photo3.jpg" alt="">
                                        <h3>John Doe</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/photo4.jpg" alt="">
                                        <h3>Renee I. Hansen</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/img.jpg" alt="">
                                        <h3>Vicki M. Coleman</h3>
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
                            <img src="vendors/images/user.svg" alt="">
                        </span>
                        <span class="user-name">Otman doda</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
                        <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Aide</a>
                        <a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Se déconnecter</a>
                    </div>
                </div>
            </div>
            <div class="github-link">
                <span><img src="vendors/images/draw.svg" alt=""></span>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="index.html">
                <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
                <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
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
                            <li><a href="index.html">Génie Logiciel - GL1</a></li>
                            <li><a href="index2.html">Administrateur Réseaux</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon fa fa-bar-chart" style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Notes</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="Notes.html">PL SQL</a></li>
                            <li><a href="Notes.html">SQL SOUS ORACLE</a></li>
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

    <div class="main-container">

        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <h4 class="text-blue h4">Table d'absence</h4>
                        <p class="mb-26"></p>
                    </div>
                    <table class="data-table table nowrap">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Matiére</th>
                                <th>Filière</th>
                                <th>Date d'absence</th>
                                <th>État</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absences as $absence)
                            <tr>
                                <td>{{ $absence->IdAbsence }}</td>  
                                <td>{{ $absence->nomMatiere }}</td>
                                <td>{{ $absence->nomFiliere }}</td>
                                <td>{{ $absence->dateAbsencee }}</td>
                                @if($absence->etat == 1)
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="green">Rattrapé</span>
                                @else
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#c2a502">En attend</span>
                                @endif
                                </td>
                            </tr>
				            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <h4 class="text-blue h4">Déclaration d'absence</h4>
                        <p class="mb-26"></p>
                    </div>
                    <div class="wizard-content">
                        <form class="tab-wizard wizard-circle wizard">
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Matiére :</label>
                                            <select class="custom-select2 form-control" name="state" style="width: 100%; height: 38px;">
                                                <optgroup>
                                                    <option value="PL SQL">PL SQL</option>
                                                    <option value="DBA">DBA</option>
                                                    <option value="SQL SOUS ORACLE">SQL SOUS ORACLE</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date d'absence :</label>
                                            <input class="form-control datetimepicker" placeholder="Date d'absence :" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Dates de rattrapage possible :</label>
                                            <input class="form-control datetimepicker-range datetimepicker" placeholder="Date de rattrapage :" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox mb-5" style="padding-top: 42px;">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Informer les
                                                étudiants pour l'absence</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div style="text-align: right;">
                                <input class="btn btn-primary" type="submit" value="Confirmer">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer-wrap pd-20 mb-20 card-box">
                    DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit
                        Hingarajiya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    <script src="src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="vendors/scripts/dashboard3.js"></script>
    <script src="src/plugins/jquery-steps/jquery.steps.js"></script>
    <script src="vendors/scripts/steps-setting.js"></script>

</body>

</html>