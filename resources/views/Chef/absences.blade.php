@extends('layouts.prof')
@section('title','Absences')
@section('content')
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
                                <th>Nom du professeur</th>
                                <th>Date d'absence</th>
                                <th>État</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="footer-wrap pd-20 mb-20 card-box">
                    DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit
                        Hingarajiya</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('SpecialScripts')
        <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
        <!-- buttons for Export datatable -->
        <script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
        <!-- Datatable Setting js -->


        <script type="text/javascript">
            $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('getAbsencesForChef') }}",
                    columns: [
                        {data: 'idAbsence', name: 'idAbsence'},
                        {data: 'nomMatiere', name: 'nomMatiere'},
                        {data: 'nomFiliere', name: 'nomFiliere'},
                        {data: 'nomProf', name: 'nomProf'},
                        {data: 'date', name: 'date'},
                        {data: 'etat', name: 'etat'}
                    ],
                    scrollCollapse: true,
                    autoWidth: false,
                    responsive: true,

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
