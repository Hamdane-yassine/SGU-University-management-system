@extends('layouts.prof')
@section('title','Professeurs')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Table des professeurs</h4>
                    </div>
                    <div class="pb-20">
                        <table class="table hover multiple-select-row data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Spécialité</th>
                                    <th>Email Personnel</th>
                                    <th>Téléphone</th>
                                    <th class="datatable-nosort"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Affecter une matière</h4>
                        </div>
                        <hr>
                        <form class="tab-wizard wizard-circle wizard pl-20" method="POST" enctype="multipart/form-data">
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>professeur :</label>
                                            <select class="custom-select2 form-control"
                                                style="width: 100%; height: 38px;">
                                                    <option value="AK">Otman doda</option>
                                                    <option value="HI">Abd ali lasfar</option>
                                                    <option value="HI">Mehdi el gouat</option>
                                                    <option value="HI">Hamdane Yassine</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maitére :</label>
                                            <select class="custom-select2 form-control"
                                                style="width: 100%; height: 38px;">
                                                <optgroup label="GL1">
                                                    <option value="AK">SQL SOUS ORACLE</option>
                                                    <option value="HI">PL SQL</option>
                                                    <option value="HI">DBA</option>
                                                    <option value="HI">XML</option>
                                                    <option value="AK">SQL SOUS ORACLE</option>
                                                    <option value="HI">PL SQL</option>
                                                    <option value="HI">DBA</option>
                                                    <option value="HI">XML</option>
                                                </optgroup>
                                                <optgroup label="GL2">
                                                    <option value="AK">Matiere 1</option>
                                                    <option value="AK">Matiere 2</option>
                                                    <option value="AK">Matiere 3</option>
                                                    <option value="AK">Matiere 4</option>
                                                    <option value="AK">Matiere 5</option>
                                                    <option value="AK">Matiere 6</option>
                                                    <option value="AK">Matiere 7</option>
                                                </optgroup>
                                                <optgroup label="ARI1">
                                                    <option value="AK">SQL SOUS ORACLE</option>
                                                    <option value="HI">PL SQL</option>
                                                    <option value="HI">DBA</option>
                                                    <option value="HI">XML</option>
                                                    <option value="AK">SQL SOUS ORACLE</option>
                                                    <option value="HI">PL SQL</option>
                                                    <option value="HI">DBA</option>
                                                    <option value="HI">XML</option>
                                                </optgroup>
                                                <optgroup label="ARI2">
                                                    <option value="AK">Matiere 1</option>
                                                    <option value="AK">Matiere 2</option>
                                                    <option value="AK">Matiere 3</option>
                                                    <option value="AK">Matiere 4</option>
                                                    <option value="AK">Matiere 5</option>
                                                    <option value="AK">Matiere 6</option>
                                                    <option value="AK">Matiere 7</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right"><input class="btn btn-primary" type="submit"
                                    value="Affecter"></div>
                        </form>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Détacher une matiére</h4>
                        </div>
                        <hr>
                        <form class="tab-wizard wizard-circle wizard pl-20" method="POST" enctype="multipart/form-data">
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>professeur :</label>
                                            <select class="custom-select2 form-control"
                                                style="width: 100%; height: 38px;">
                                                    <option value="AK">Otman doda</option>
                                                    <option value="HI">Abd ali lasfar</option>
                                                    <option value="HI">Mehdi el gouat</option>
                                                    <option value="HI">Hamdane Yassine</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maitére :</label>
                                            <select class="custom-select1 form-control"
                                                style="width: 100%; height: 45px;">
                                                    <option selected>----</option>
                                                    <option value="AK">SQL SOUS ORACLE</option>
                                                    <option value="HI">PL SQL</option>
                                                    <option value="HI">DBA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right"><input class="btn btn-primary" type="submit"
                                    value="Détacher"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" id="modall">
                            <dl class="row" style="padding-left: 20px;">
                                <dt class="col-sm-4">Nom</dt>
                                <dd class="col-sm-8">Abd ali</dd>

                                <dt class="col-sm-4">Prénom</dt>
                                <dd class="col-sm-8">Lasfer</dd>

                                <dt class="col-sm-4">Spécialité</dt>
                                <dd class="col-sm-8">Informatique</dd>

                                <dt class="col-sm-4">Genre</dt>
                                <dd class="col-sm-8">Masculin</dd>

                                <dt class="col-sm-4">Nationalité</dt>
                                <dd class="col-sm-8">MAROCAIN(E)</dd>

                                <dt class="col-sm-4">Adresse</dt>
                                <dd class="col-sm-8">RES ELBOUSTANE IMM G11 APT 33 LOT SAID HAJJI SALE</dd>

                                <dt class="col-sm-4">Téléphone</dt>
                                <dd class="col-sm-8">0672387235</dd>

                                <dt class="col-sm-4">E-mail personnel</dt>
                                <dd class="col-sm-8">amirnet001@gmail.com</dd>

                                <dt class="col-sm-4">E-mail institutionnel</dt>
                                <dd class="col-sm-8">yassine_hamdane@um5.ac.ma</dd>

                                <dt class="col-sm-4">Maitéres</dt>
                                <dd class="col-sm-8">
                                    SQL Sous oracle - GL1 <br>
                                    PL SQL - GL2 <br>
                                    PHP MYSQL - ARI2 <br>
                                </dd>

                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"
                                onclick="printJS({printable: 'modall',type: 'html', targetStyles: ['*']})"><i
                                    class="fa fa-print"></i>&nbsp;&nbsp;Imprimer</button>
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
    <script>
            var table1 = $('.data-table-export').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getListProfesseurs', ['departement' => $departement]) }}",
            columns: [{
                    data: 'apogee',
                    name: 'apogee'
                },
                {
                    data: 'nom',
                    name: 'nom'
                },
                {
                    data: 'prenom',
                    name: 'prenom'
                },
                {
                    data: 'cne',
                    name: 'cne'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'tel',
                    name: 'tel'
                },
                {
                    data: 'idEtudiant',
                    render: function(data, type, full, meta) {
                        return '<div class="table-actions pl-1"><a href="#" style="color: #265ed7" onclick="getEtudiantIn('+data+')" data-toggle="modal" data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a> <a href="#" style="color : #e95959" onclick="setIdEtudiant(' +
                            data +
                            ')" data-toggle="modal" data-target="#confirmation-modal" type="button"><i class="icon-copy dw dw-delete-3"></i></a></div>'
                    },
                },
                {
                    data: 'idEtudiant',
                    render: function(data, type, full, meta) {
                        return ' <a class="dropdown-item" href="" style="background-color:transparent;" onclick="getEtudiantInfo(' +
                            data +
                            ')" data-toggle="modal" data-target="#bd-example-modal-lg"><i class="dw dw-eye"></i></a>'
                    },
                }
            ],
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
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
            dom: '<"top"<"left-col"B><"right-col"f>>rtip',
            buttons: [{
                extend: 'print',
                text: '<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimer'
            }]
        });
    </script>
    @endsection