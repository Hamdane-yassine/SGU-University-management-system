@extends('layouts.prof')
@section('title', 'Gestion d\'université')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Les departements</h4>
                    </div>
                    <div class="pb-20">
                        <table class="table hover multiple-select-row data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Insértion des notes</th>
                                    <th>Nb des filières</th>
                                    <th>Nb des professeurs</th>
                                    <th class="datatable-nosort">Actions</th>
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
                            <h4 class="h4">Ajouter une departement</h4>
                        </div>
                        <hr>
                        <form action="{{ route('AjouterDepartement') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="ajdep">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Nom</label>
                                            <input class="form-control" type="text" id="ajdepnom" name="ajdepnom"
                                                placeholder="Nom" required>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right">
                                <button type="button" onclick="reset();$('html, body').animate({scrollTop: 0 }, 'fast');"
                                    class="btn btn-secondary" style="text-decoration: none;">Annuler</button>
                                <input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Ajouter une filière</h4>
                        </div>
                        <hr>
                        <form action="{{ route('AjouterFiliere') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="ajfiliere">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departement :</label>
                                            <select class="custom-select2 form-control" name="ajfildep" id="ajfildep"
                                                style="width: 100%; height: 45px;" required>
                                                @foreach ($departements as $departement)
                                                    <option value="{{ $departement->idDepartement }}">
                                                        {{ $departement->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diplome :</label>
                                            <select class="custom-select2 form-control" name="diplome" id="diplome"
                                                style="width: 100%; height: 45px;" required>
                                                <option value="1" selected>DUT/DEUG</option>
                                                <option value="2">licence</option>
                                                <option value="3">master</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nom du Filière :</label>
                                            <input class="form-control" type="text" id="filnom" name="filnom"
                                                placeholder="Nom" required>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right">
                                <button type="button" onclick="reset();$('html, body').animate({scrollTop: 0 }, 'fast');"
                                    class="btn btn-secondary" style="text-decoration: none;">Annuler</button>
                                <input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Affectation des semesteres</h4>
                        </div>
                        <hr>
                        <form action="{{ route('AffecterSemesteres') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="affsem">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departement :</label>
                                            <select class="custom-select2 form-control" name="semdep" id="semdep"
                                                style="width: 100%; height: 45px;" required>
                                                <option disabled selected>---Sélectioné une département---
                                                </option>
                                                @foreach ($departements as $departement)
                                                    <option value="{{ $departement->idDepartement }}">
                                                        {{ $departement->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filière :</label>
                                            <select class="custom-select2 form-control" name="semfil" id="semfil"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Semester :</label>
                                            <select class="custom-select2 form-control" multiple="multiple" id="semester"
                                                name="semester[]" style="width: 100%;">
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="S4">S4</option>
                                                <option value="S5">S5</option>
                                                <option value="S6">S6</option>
                                                <option value="S7">S7</option>
                                                <option value="S8">S8</option>
                                                <option value="S9">S9</option>
                                                <option value="S10">S10</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right">
                                <button type="button" onclick="$('html, body').animate({scrollTop: 0 }, 'fast');"
                                    class="btn btn-secondary" style="text-decoration: none;">Annuler</button>
                                <input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Ajouter des modules</h4>
                        </div>
                        <hr>
                        <form action="{{ route('AjouterModule') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="ajmodule">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departement :</label>
                                            <select class="custom-select2 form-control" name="moddep" id="moddep" 
                                                style="width: 100%; height: 45px;" required>
                                                <option disabled selected>---Sélectioné une département---</option>
                                                @foreach ($departements as $departement)
                                                    <option value="{{ $departement->idDepartement }}">
                                                        {{ $departement->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filière :</label>
                                            <select class="custom-select2 form-control" name="modfil" id="modfil"
                                                style="width: 100%; height: 45px;" required>
                                                <option disabled selected>---Sélectioné une filiére---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Semester :</label>
                                            <select class="custom-select2 form-control" name="modsem" id="modsem"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Nom de module :</label>
                                            <input class="form-control" type="text" id="modnom" name="modnom"
                                                placeholder="Nom" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>volume horaire :</label>
                                            <input class="form-control" type="number" id="modvh" name="modvh" min="0"
                                                placeholder="VH" required>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right">
                                <button type="button" onclick="reset();$('html, body').animate({scrollTop: 0 }, 'fast');"
                                    class="btn btn-secondary" style="text-decoration: none;">Annuler</button>
                                <input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Ajouter des matieres</h4>
                        </div>
                        <hr>
                        <form action="{{ route('AjouteMatiere') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="ajmatiere">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departement :</label>
                                            <select class="custom-select2 form-control" name="matdep" id="matdep"
                                                style="width: 100%; height: 45px;" required>
                                                <option disabled selected>---Sélectioné une département---</option>
                                                @foreach ($departements as $departement)
                                                    <option value="{{ $departement->idDepartement }}">
                                                        {{ $departement->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filière :</label>
                                            <select class="custom-select2 form-control" name="matfil" id="matfil"
                                                style="width: 100%; height: 45px;" required>
                                                <option disabled selected>---Sélectioné une filiére---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Semester :</label>
                                            <select class="custom-select2 form-control" name="matsem" id="matsem"
                                                style="width: 100%; height: 45px;" required>
                                                <option disabled selected>---Sélectioné une semester---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>module :</label>
                                            <select class="custom-select2 form-control" name="matmod" id="matmod"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nom du matiére :</label>
                                            <input class="form-control" type="text" id="matnom" name="matnom"
                                                placeholder="Nom" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>volume horaire :</label>
                                            <input class="form-control" type="number" id="matvh" name="matvh" min="0"
                                                placeholder="VH" required>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right">
                                <button type="button" onclick="reset();$('html, body').animate({scrollTop: 0 }, 'fast');"
                                    class="btn btn-secondary" style="text-decoration: none;">Annuler</button>
                                <input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg" id="bd-edit-modal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('UpdateDepartement') }}" method="POST" id="updDep">
                        @csrf
                        <input type="hidden" id="upIdDep" name="upIdDep" value="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" id="modall-edit">
                            <div class="pl-2 pr-2">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nom</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" type="text" id="upnom" name="upnom" placeholder="Nom"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Insértion<br> des notes</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select class="custom-select col-12" id="etatnote" name="etatnote">
                                            <option value="ouvert" selected>Ouvert</option>
                                            <option value="fermé">Fermé</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-secondary"
                                style="text-decoration: none;">Annuler</button>
                            <input class="btn btn-primary" type="submit" value="Enregistrer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20 pt-5" id="msgsuccess"></h3>
                    <div class="mb-30 text-center"><img src="{{ asset('vendors/images/success.png') }}"></div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">terminer</button>
                </div>
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
                            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-times"></i></button>
                            NON
                        </div>
                        <div class="col-6">
                            <form action="{{ route('SupprimerDepartement') }}" method="POST" id="suppdep">
                                @csrf
                                <input type="hidden" id="idDep" name="idDep" value="">
                                <button type="submit"
                                    class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                        class="fa fa-check"></i></button>
                                OUI
                            </form>
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
            ajax: "{{ route('getDepartements') }}",
            columns: [{
                    data: 'idDepartement',
                    name: 'idDepartement'
                },
                {
                    data: 'nom',
                    name: 'nom'
                },
                {
                    data: 'insertion_notes',
                    render: function(data, type, full, meta) {
                        return '<span class="pl-5">' + data + '</span>'
                    }
                },
                {
                    data: 'NBfiliere',
                    render: function(data, type, full, meta) {
                        return '<span class="pl-5">' + data + '</span>'
                    }
                },
                {
                    data: 'NBprofesseurs',
                    render: function(data, type, full, meta) {
                        return '<span class="pl-5">' + data + '</span>'
                    }
                },
                {
                    data: 'idDepartement',
                    render: function(data, type, full, meta) {
                        return '<div class="table-actions pl-1"><a href="#" style="color: #265ed7" onclick="getDepInfo(' +
                            data +
                            ')" data-toggle="modal" data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a> <a href="#" style="color : #e95959" onclick="setDepId(' +
                            data +
                            ')" data-toggle="modal" data-target="#confirmation-modal" type="button"><i class="icon-copy dw dw-delete-3"></i></a></div>'
                    }
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
        function setDepId(id) {
            document.getElementById('idDep').value = id;
        }
        function ReloadSelects(id) {
            jQuery.ajax({
                url: "{{ route('getNewDepartements') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    jQuery('select[name="' + id + '"]').empty();
                    if (id != 'ajfildep') {
                        $('select[name="' + id + '"]').append(
                            '<option disabled selected>---Sélectioné une département---</option>'
                            );
                    }
                    jQuery.each(response, function(key, value) {
                        $('select[name="' + id + '"]').append(
                            '<option value="' + value.idDepartement +
                            '">' + value.nom + '</option>');
                    });
                }
            });
        }

        function ReloadAllSelects() {
            ReloadSelects('ajfildep');
            ReloadSelects('semdep');
            ReloadSelects('moddep');
            ReloadSelects('matdep');
            jQuery('select[name="semfil"]').empty();
            jQuery('select[name="modfil"]').empty();
            $('select[name="modfil"]').append('<option disabled selected>---Sélectioné une filiére---</option>');
            jQuery('select[name="modsem"]').empty();
            jQuery('select[name="matfil"]').empty();
            $('select[name="matfil"]').append('<option disabled selected>---Sélectioné une filiére---</option>');
            jQuery('select[name="modsem"]').empty();
            jQuery('select[name="matmod"]').empty();
            jQuery('select[name="matsem"]').empty();
            $('select[name="matsem"]').append('<option disabled selected>---Sélectioné une semester---</option>');
        }
        function LoadFilieres(depsel,filsel)
        {
            jQuery('select[name="'+depsel+'"]').on('change', function() {
                var idDep = jQuery(this).val();
                if (idDep) {
                    jQuery.ajax({
                        url: '/master/getFilieresDep/' + idDep,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery('select[name="'+filsel+'"]').empty();
                            if(filsel=='modfil' || filsel=='matfil')
                            {
                            $('select[name="'+filsel+'"]').append('<option disabled selected>---Sélectioné une filiére---</option>');
                            }
                            jQuery.each(data, function(key, value) {
                                $('select[name="'+filsel+'"]').append('<option value="' +
                                    value.idFiliere + '">' + value.nom + ' ' + value
                                    .niveau + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="'+filsel+'"]').empty();
                }
            });
        }
        function LoadSemesters(filsel,semsel)
        {
            jQuery('select[name="'+filsel+'"]').on('change', function() {
                var idFil = jQuery(this).val();
                if (idFil) {
                    jQuery.ajax({
                        url: '/master/getSemestersFil/' + idFil,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery('select[name="'+semsel+'"]').empty();
                            if(semsel=='matsem')
                            {
                                $('select[name="'+semsel+'"]').append('<option disabled selected>---Sélectioné une semester---</option>');
                            }
                            jQuery.each(data, function(key, value) {
                                $('select[name="'+semsel+'"]').append('<option value="' +
                                    value.idSemestre + '">' + value.nom +'</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="'+semsel+'"]').empty();
                }
            });
        }
        function LoadModules(semsel,modsel)
        {
            jQuery('select[name="'+semsel+'"]').on('change', function() {
                var idSem = jQuery(this).val();
                if (idSem) {
                    jQuery.ajax({
                        url: '/master/getModulesSem/' + idSem,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery('select[name="'+modsel+'"]').empty();
                            jQuery.each(data, function(key, value) {
                                $('select[name="'+modsel+'"]').append('<option value="' +
                                    value.idModule + '">' + value.nom +'</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="'+modsel+'"]').empty();
                }
            });
        }
        function getDepInfo(id) {
            $.ajax({
                type: 'GET',
                url: "/master/departement/" + id,
                dataType: 'JSON',
                data: {},
                success: function(response) {
                    console.log(response);
                    document.getElementById("upnom").value = response[0].nom;
                    document.getElementById("upIdDep").value = response[0].idDepartement;
                    document.getElementById("etatnote").value = response[0].insertion_notes;

                }
            })
        }
        jQuery(document).ready(LoadFilieres('semdep','semfil'));
        jQuery(document).ready(LoadFilieres('moddep','modfil'));
        jQuery(document).ready(LoadSemesters('modfil','modsem'));
        jQuery(document).ready(LoadFilieres('matdep','matfil'));
        jQuery(document).ready(LoadSemesters('matfil','matsem'));
        jQuery(document).ready(LoadModules('matsem','matmod'));
        $("#suppdep").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    $('#confirmation-modal').modal('hide');
                    table1.ajax.reload();
                    ReloadAllSelects();
                }
            });
        });
        $("#updDep").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    $('#bd-edit-modal').modal('hide');
                    table1.ajax.reload();
                }
            });
        });
        $("#ajdep").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    document.getElementById('msgsuccess').innerHTML = "Département Ajoutée!";
                    document.getElementById("ajdep").reset();
                    $('#success-modal').modal('show');
                    table1.ajax.reload();
                    ReloadAllSelects();
                }
            });
        });
        $("#ajfiliere").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    document.getElementById('msgsuccess').innerHTML = "Filière Ajoutée!";
                    document.getElementById("ajfiliere").reset();
                    $('#success-modal').modal('show');
                }
            });
        });
        $("#affsem").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    document.getElementById('msgsuccess').innerHTML = "Les semesteres sont Affecté!";
                    $('#success-modal').modal('show');
                }
            });
        });
        $("#ajmodule").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    document.getElementById('msgsuccess').innerHTML = "Module ajoutée!";
                    document.getElementById("ajmodule").reset();
                    $('#success-modal').modal('show');
                }
            });
        });
        $("#ajmatiere").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    document.getElementById('msgsuccess').innerHTML = "Matiere ajoutée!";
                    document.getElementById("ajmatiere").reset();
                    $('#success-modal').modal('show');
                }
            });
        });
    </script>
@endsection
