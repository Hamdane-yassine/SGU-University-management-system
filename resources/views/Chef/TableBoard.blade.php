@extends('layouts.app')
@section('title', 'Tableau de bord')
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
            <div class="row pb-10">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{ $Count_etudiants }}</div>
                                <div class="font-14 text-secondary weight-500">Etudiants<span style="opacity:0;">xxxx xxxxx</span></div>
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
                                <div class="weight-700 font-24 text-dark">{{ $Count_filieres }}</div>
                                <div class="font-14 text-secondary weight-500">Filières<span style="opacity:0;">xxxx xxxxxx</span></div>
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
                                <div class="weight-700 font-24 text-dark">{{ $Count_absences }}</div>
                                <div class="font-14 text-secondary weight-500">Total des absences</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon"><i class="micon fa fa-calendar-check-o" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
                        @if($etat_notes == 'ouvert')
						    <div class="d-flex flex-wrap">
						    	<div class="widget-data">
						    		<div class="weight-700 font-24 text-dark">{{ $etat_notes }}</div>
						    		<div class="font-14 text-secondary weight-500">Insertion des notes</div>
						    	</div>
						    	<div class="widget-icon">
						    		<div class="icon" data-color="#09cc06"><i class="icon-copy fi-check"
						    				aria-hidden="true"></i></div>
						    		<!-- <div class="icon" data-color="red"><i class="icon-copy fi-x" aria-hidden="true"></i></div> -->
						    	</div>
						    </div>
                        @elseif ($etat_notes == 'fermé')
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $etat_notes }}</div>
                                        <div class="font-14 text-secondary weight-500">Insertion des notes</div>
                                    </div>
                                    <div class="widget-icon">
                                        <div class="icon" data-color="red"><i class="icon-copy fi-x" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                        @endif
					</div>
				</div>
            </div>

            <div class="row pb-10">
                <div class="col-md-8 mb-20">
                    <div class="card-box height-100-p pd-20">
                        <div class="h5 pb-1">Demandes des rattrapages</div>
                        <table class="data-table table nowrap">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom du professeur</th>
                                    <th>Date d'absence</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4 mb-20">
                    <div class="card-box height-100-p pd-20">
                        <div class="h5 mb-md-0">Evènements</div>
                        <hr>
                        <!-- <div class="text-center text-secondary">Aucun notification</div> -->
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                @include('components.EventsComponents')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
@section('SpecialScripts')
    <!--<script src="{{ asset('src/plugins/apexcharts/apexcharts.min.js') }}"></script> -->
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/dashboard3.js') }}"></script>
    <script src="{{ asset('vendors/scripts/chef/tableboard.js') }}"></script>
@endsection
