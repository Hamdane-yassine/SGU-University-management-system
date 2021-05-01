@extends('layouts.prof')
@section('title','Gestion des emplois')
@section('content')
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
							<span class="micon fa fa-dashboard"
								style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Tableau de
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
							<li><a href="index.html">Génie Logiciel - GL1</a></li>
							<li><a href="index2.html">Administrateur Réseaux</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-bar-chart"
								style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Notes</span>
						</a>
						<ul class="submenu">
							<li><a href="index.html">Génie Logiciel - GL1</a></li>
							<li><a href="index2.html">Administrateur Réseaux</a></li>
						</ul>
					</li>

					<li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon fa fa-calendar"
								style="padding-left: 15px; padding-bottom: 5px;"></span><span class="mtext">Emploi du
								temps</span>
						</a>
					</li>

					<li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon fa fa-user-o"
								style="padding-left: 15px; padding-bottom: 5px;"></span><span
								class="mtext">Gestion des Professeurs</span>
						</a>
					</li>

					<li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon fa fa-calendar-check-o"
								style="padding-left: 15px; padding-bottom: 5px;"></span><span
								class="mtext">Absenses</span>
						</a>
					</li>

					<li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon fa fa-calendar-minus-o"
								style="padding-left: 15px; padding-bottom: 5px;"></span><span
								class="mtext">Rattrapage</span>
						</a>
					</li>

					<li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon fa fa-bell-o"
								style="padding-left: 15px; padding-bottom: 5px;"></span><span
								class="mtext">Notifications</span>
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
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">les emplois du temps</h4>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table hover nowrap">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom du fichier</th>
                                    <th>Filière / professeur</th>
                                    <th>Date de lancement </th>
                                    <th class="datatable-nosort">&nbsp;Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-plus">1</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>Génie Logiciel - GL2 </td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">2</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>Génie Logiciel - GL1 </td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">3</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>Abd ali lasfar</td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">4</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>khadija bousdig </td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">5</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>Hamdane yassine</td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">6</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>otman doda </td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">7</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>mehdi el gouat</td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">8</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>Administrateur reseaux -ARI2</td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">9</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>Génie Logiciel - GL2 </td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">10</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>Génie Logiciel - GL2 </td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">11</td>
                                    <td><a href="EDT_GL_S4_REC_LE_3-3-21.pdf" target="_blank"
                                            class="card-link text-primary">EDT_GL_S4_REC_LE_3-3-21.pdf</a></td>
                                    <td>Génie Logiciel - GL2 </td>
                                    <td style="padding-left: 40px;">29-03-2018</td>
                                    <td>
                                        <a href="#" data-color="#e95959" data-toggle="modal"
                                            data-target="#confirmation-modal" type="button"><i
                                                class="icon-copy dw dw-delete-3 pl-20"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Ajouter</h4>
                        </div>
                        <hr>
                        <form class="tab-wizard wizard-circle wizard pl-20" method="POST" enctype="multipart/form-data">
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filière / professeur :</label>
                                            <select class="custom-select2 form-control" style="width: 100%; height: 38px;">
                                                <optgroup label="professeurs">
                                                    <option value="AK">Otman doda</option>
                                                    <option value="HI">Abd ali lasfar</option>
                                                    <option value="HI">Mehdi el gouat</option>
                                                    <option value="HI">Hamdane Yassine</option>
                                                </optgroup>
                                                <optgroup label="Filières">
                                                    <option value="CA">Génie Logiciel - GL1</option>
                                                    <option value="CA">Génie Logiciel - GL2</option>
                                                    <option value="CA">Administrateur réseaux - ARI1</option>
                                                    <option value="CA">Administrateur réseaux - ARI2</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-file" style="margin-top: 31px;">
                                            <input type="file" class="custom-file-input" name="pdf" required>
                                            <label class="custom-file-label">Choisir une pdf</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div style="text-align: right;"><input class="btn btn-primary" type="submit" value="Ajouter"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">
                            <h4 class="padding-top-30 mb-30 weight-500">Vous êtes sûr ?</h4>
                            <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                                <div class="col-6">
                                    <button type="button"
                                        class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                        data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    NON
                                </div>
                                <div class="col-6">
                                    <button type="button"
                                        class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                        data-dismiss="modal"><i class="fa fa-check"></i></button>
                                    OUI
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit
                    Hingarajiya</a>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/print.min.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <!-- Datatable Setting js -->
    <script src="vendors/scripts/datatable-setting.js"></script>
    @endsection
    @section('SpecialScripts')
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.printprint.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>

    <script src="{{ asset('vendors/scripts/printThis.js') }}"></script>
    <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
    @endsection
