@extends('layouts.prof')
@section('title', 'Tableau de board')
@section('content')
    <div class="main-container">

        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Année universitaire : {{ $annee }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div>
                            <span class="btn btn-primary">{{ $date }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{ $CountEtudiant }}</div>
                                <div class="font-14 text-secondary weight-500">Etudiants</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon"><span class="icon-copy fi-torsos-all"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{ $CountEtudiant }}</div>
                                <div class="font-14 text-secondary weight-500">Filiéres</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{ $CountDepartement }}</div>
                                <div class="font-14 text-secondary weight-500">départements</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon"><i class="micon fa fa-building" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{ $CountProf }}</div>
                                <div class="font-14 text-secondary weight-500">Professeurs sans emploi</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" ><i class="icon-copy fi-calendar" aria-hidden="true"></i>
                                </div>
                                <!-- <div class="icon" data-color="red"><i class="icon-copy fi-x" aria-hidden="true"></i></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pb-10">
                <div class="col-md-8 mb-20">
                    <div class="card-box height-100-p pd-20">
                        <div class="h5">Professeurs sans emploi : </div>
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Professeur</th>
                                    <th>Specialite</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4 mb-20">
                    <div class="card-box height-100-p pd-20">
                        <div class="h5 mb-md-0">Notifications</div>
                        <hr>
                        <!-- <div class="text-center text-secondary">Aucun notification</div> -->
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                {{-- @include('components.NotificationComponents') --}}
                                @include('components.EventsComponents')
                            </ul>
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
@endsection
@section('SpecialScripts')
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/dashboard3.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <script src="{{ asset('vendors/scripts/steps-setting.js') }}"></script>
    <script src="{{ asset('vendors/scripts/admin/tableboard.js') }}"></script>
@endsection
