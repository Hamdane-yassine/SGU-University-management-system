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
                        <form action="{{ route('AffecterMatiere') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="affecter">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Nom</label>
                                            <input class="form-control" type="text" id="depnom" name="depnom"
                                                placeholder="Nom" required>
                                        </div>
                                    </div>
                            </section>
                    </div>
                    <div class="text-right">
                        <button type="button" onclick="reset();$('html, body').animate({scrollTop: 0 }, 'fast');"
                            class="btn btn-secondary" style="text-decoration: none;">Annuler</button>
                        <input class="btn btn-primary" type="submit" value="Ajouter">
                    </div>
                    </form>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Ajouter une filière</h4>
                        </div>
                        <hr>
                        <form action="{{ route('DetacherMatiere') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="detacher">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departement :</label>
                                            <select class="custom-select2 form-control" name="profdet" id="profdet"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diplome :</label>
                                            <select class="custom-select2 form-control" name="matiere" id="matiere"
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
                                            <input class="form-control" type="text" id="depnom" name="depnom"
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
                        <form action="{{ route('DetacherMatiere') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="detacher">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departement :</label>
                                            <select class="custom-select2 form-control" name="profdet" id="profdet"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filière :</label>
                                            <select class="custom-select2 form-control" name="matiere" id="matiere"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Semester :</label>
                                            <select class="custom-select2 form-control" multiple="multiple"
                                                style="width: 100%;">
                                                <option value="1">S1</option>
                                                <option value="2">S2</option>
                                                <option value="3">S3</option>
                                                <option value="4">S4</option>
                                                <option value="5">S5</option>
                                                <option value="6">S6</option>
                                                <option value="7">S7</option>
                                                <option value="8">S8</option>
                                                <option value="9">S9</option>
                                                <option value="10">S10</option>
                                            </select>
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
                            <h4 class="h4">Ajouter des modules</h4>
                        </div>
                        <hr>
                        <form action="{{ route('DetacherMatiere') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="detacher">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departement :</label>
                                            <select class="custom-select2 form-control" name="profdet" id="profdet"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filière :</label>
                                            <select class="custom-select2 form-control" name="matiere" id="matiere"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Semester :</label>
                                            <select class="custom-select2 form-control" name="matiere" id="matiere"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Nom de module :</label>
                                            <input class="form-control" type="text" id="depnom" name="depnom"
                                                placeholder="Nom" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>volume horaire :</label>
                                            <input class="form-control" type="text" id="depnom" name="depnom"
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
                            <h4 class="h4">Ajouter des matieres</h4>
                        </div>
                        <hr>
                        <form action="{{ route('DetacherMatiere') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="detacher">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departement :</label>
                                            <select class="custom-select2 form-control" name="profdet" id="profdet"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filière :</label>
                                            <select class="custom-select2 form-control" name="matiere" id="matiere"
                                                style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Semester :</label>
                                            <select class="custom-select2 form-control" name="matiere" id="matiere"
                                            style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>module :</label>
                                            <select class="custom-select2 form-control" name="matiere" id="matiere"
                                            style="width: 100%; height: 45px;" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nom du matiére :</label>
                                                <input class="form-control" type="text" id="depnom" name="depnom"
                                                    placeholder="Nom" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>volume horaire :</label>
                                                <input class="form-control" type="text" id="depnom" name="depnom"
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
            </div>
        </div>
        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center font-18">
                        <h3 class="mb-20 pt-5">Affectation réussie!</h3>
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
                                <button type="button"
                                    class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                    data-dismiss="modal"><i class="fa fa-times"></i></button>
                                NON
                            </div>
                            <div class="col-6">
                                <form action="{{ route('SupprimerDepartement') }}" method="POST" id="suppdep">
                                    @csrf
                                    <input type="hidden" id="idDep" name="idDep" value="">
                                    <button type="submit"
                                        class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                        ><i class="fa fa-check"></i></button>
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
                    render:function(data,type,full,meta){
                        return '<span class="pl-5">'+data+'</span>'
                     }
                },
                {
                    data: 'NBfiliere',
                    render:function(data,type,full,meta){
                        return '<span class="pl-5">'+data+'</span>'
                     }
                },
                {
                    data: 'NBprofesseurs',
                    render:function(data,type,full,meta){
                        return '<span class="pl-5">'+data+'</span>'
                     }
                },
                {
                    data: 'idDepartement',
                    render: function(data, type, full, meta) {
                        return '<div class="table-actions pl-1"><a href="#" style="color: #265ed7" onclick="" data-toggle="modal" data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a> <a href="#" style="color : #e95959" onclick="setDepId('+data+')" data-toggle="modal" data-target="#confirmation-modal" type="button"><i class="icon-copy dw dw-delete-3"></i></a></div>'
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
        function setDepId(id)
        {
            document.getElementById('idDep').value=id;
        }
        // $("#suppdep").submit(function(e) {
        //     e.preventDefault(); // avoid to execute the actual submit of the form.
        //     var form = $(this);
        //     var url = form.attr('action');
        //     $.ajax({
        //         type: "POST",
        //         url: url,
        //         data: form.serialize(), // serializes the form's elements.
        //         success: function(data) {
        //             $('#confirmation-modal').modal('hide');
        //             table1.ajax.reload();
        //         }
        //     });
        // });
        function getProfInfo(id) {
            document.getElementById("matieres").innerHTML = "";
            $.ajax({
                type: 'GET',
                url: "/chef/professeur/" + id,
                dataType: 'JSON',
                data: {},
                success: function(response) {
                    console.log(response);
                    document.getElementById("nom").innerHTML = response.prof[0].nom;
                    document.getElementById("prenom").innerHTML = response.prof[0].prenom;
                    document.getElementById("genre").innerHTML = response.prof[0].genre;
                    document.getElementById("datenais").innerHTML = response.prof[0].dateNaissance;
                    document.getElementById("situation").innerHTML = response.prof[0].situationFamiliale;
                    document.getElementById("nationalite").innerHTML = response.prof[0].nationalite;
                    document.getElementById("LieuNaissance").innerHTML = response.prof[0].lieuNaissance;
                    document.getElementById("cin").innerHTML = response.prof[0].cin;
                    document.getElementById("adresse").innerHTML = response.prof[0].adressePersonnele;
                    document.getElementById("tel").innerHTML = response.prof[0].tel;
                    document.getElementById("email").innerHTML = response.prof[0].email;
                    document.getElementById("emailins").innerHTML = response.prof[0].emailInstitutionne;
                    document.getElementById("specialite").innerHTML = response.prof[0].specialite;
                    if (response.matieres.length > 0) {
                        response.matieres.forEach(myFunction);
                    } else {
                        document.getElementById("matieres").innerHTML = "Aucune Matiere";
                    }

                    function myFunction(item, index) {
                        document.getElementById("matieres").innerHTML += item.nom + "<br>";
                    }
                }
            })
        }
        jQuery(document).ready(function() {
            jQuery('select[name="profdet"]').on('change', function() {
                var idProf = jQuery(this).val();
                var idDep = document.getElementById("depA").value;
                if (idProf) {
                    jQuery.ajax({
                        url: '/chef/professeur/getMatiere/' + idProf + '/' + idDep,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery('select[name="matiere"]').empty();
                            jQuery.each(data, function(key, value) {
                                $('select[name="matiere"]').append('<option value="' +
                                    value.idMatiere + '">' + value.nom + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="matiere"]').empty();
                }
            });
        });
        $("#affecter").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                dataType: "JSON",
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    $('#success-modal-aff').modal('show');
                    if (document.getElementById("profdet").value == data[0].idProf) {
                        jQuery('select[name="matiere"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="matiere"]').append('<option value="' + value
                                .idMatiere + '">' + value.nom + '</option>');
                        });
                    } else {
                        jQuery.ajax({
                            url: '/chef/professeur/getMatiere/' + document.getElementById(
                                    "profdet").value + '/' + document.getElementById("depA")
                                .value,
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                jQuery('select[name="matiere"]').empty();
                                jQuery.each(response, function(key, value) {
                                    $('select[name="matiere"]').append(
                                        '<option value="' + value.idMatiere +
                                        '">' + value.nom + '</option>');
                                });
                            }
                        });
                    }
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    alert(msg);
                }
            });
        });
        $("#detacher").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                dataType: "JSON",
                data: form.serialize(),
                success: function(data) {
                    $('#success-modal-det').modal('show');
                    jQuery('select[name="matiere"]').empty();
                    jQuery.each(data, function(key, value) {
                        $('select[name="matiere"]').append('<option value="' + value.idMatiere +
                            '">' + value.nom + '</option>');
                    });
                }
            });
        });

    </script>
@endsection
