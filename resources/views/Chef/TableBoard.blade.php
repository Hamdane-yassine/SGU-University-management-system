@extends('layouts.prof')
@section('title','Tableau de board')
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
								<div class="weight-700 font-24 text-dark">{{ $Count_filieres }}</div>
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
								<div class="weight-700 font-24 text-dark">{{  $Count_absences }}</div>
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
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark">{{ $etat_notes }}</div>
								<div class="font-14 text-secondary weight-500">Insértion des notes</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#09cc06"><i class="icon-copy fi-check"
										aria-hidden="true"></i></div>
								<!-- <div class="icon" data-color="red"><i class="icon-copy fi-x" aria-hidden="true"></i></div> -->
							</div>
						</div>
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
						<div class="h5 mb-md-0">Notifications</div>
						<hr>
						<!-- <div class="text-center text-secondary">Aucun notification</div> -->
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
                                    @if(Auth::User()->notifications->count())
                                    @foreach (Auth::User()->notifications as $notification)
                                    <li>
                                        @if($notification->type === 'App\Notifications\NotifyEvent' )
                                        <a href="{{ url('/evenement/'.$notification->data['idEvent']) .'?idNotif='.$notification->data['idNotif']}}">
                                        @else <a href="{{ url('/notifications?idNotif='.$notification->data['idNotif']) }}">
                                        @endif
                                            <img src="{{ $notification->data['image'] }}" alt="profile image">
                                            <h3>{{$notification->data['from']}}</h3>
                                            <p style="word-wrap: break-word">{{Str::substr($notification->data['brief'], 0, 50) }}...</p>
                                        </a>
                                    </li>
                                    @endforeach
                                    @endif
								</li>
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
	<!--<script src="{{ asset('src/plugins/apexcharts/apexcharts.min.js') }}"></script> -->
	<script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('vendors/scripts/dashboard3.js') }}"></script>
    <script type="text/javascript">
        $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getAbsencesListForChefDashboard') }}",
                columns: [
                    {data: 'idAbsence', name: 'idAbsence'},
                    {data: 'nomProf', name: 'nomProf'},
                    {data: 'dateAbsence', name: 'dateAbsence'},
                ],
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "info": "_START_ à _END_ sur _TOTAL_ éléments",
                    "emptyTable": "Aucune donnée disponible dans le tableau",
                    "lengthMenu": "Afficher _MENU_ éléments",
                    "zeroRecords": "Aucun élément correspondant trouvé",
                    "processing": "Traitement...",
                    "infoEmpty": "Affichage de 0 à 0 sur 0 éléments",
                    "loadingRecords": "Chargement...",
                    "infoFiltered": "(filtrés depuis un total de _MAX_ éléments)",
                    search: "Rechercher:",
                    searchPlaceholder: "Rechercher",
                    paginate: {
                        next: '<i class="ion-chevron-right"></i>',
                        previous: '<i class="ion-chevron-left"></i>'
                    }
                },
            });
    </script>
	@endsection
