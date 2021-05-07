@extends('layouts.prof')
@section('title','Gestion des emplois')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">les emplois du temps des filieres : </h4>
                    </div>
                    <div class="pb-20">
                        <table class="emploi_des_filieres table hover nowrap">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom du fichier</th>
                                    <th>Filière</th>
                                    <th>Niveau</th>
                                    <th>Date de dernière modification</th>
                                    <th class="datatable-nosort"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
    <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>
    <script type="text/javascript">
        $('.emploi_des_filieres').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getAdminEmploiFiliereDatatable') }}",
                columns: [
                    {data: 'idEmploi', name: 'idEmploi'},
                    {data: 'filename', name: 'filename'},
                    {data: 'nom', name: 'nom'},
                    {data: 'niveau', name: 'niveau'},
                    {data: 'date', name: 'date'},
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
