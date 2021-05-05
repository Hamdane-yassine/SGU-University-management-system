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
                                    <th>ID</th>
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
                        <form action="{{ route('AffecterMatiere') }}" class="tab-wizard wizard-circle wizard pl-20" method="POST" id="affecter">
                            @csrf
                            <input type="hidden" id="depA" name="depA" value="{{ $departement->idDepartement }}">
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>professeur :</label>
                                            <select class="custom-select2 form-control"
                                                style="width: 100%; height: 38px;" name="prof" id="prof">
                                                @foreach ($departement->prof_departements as $prof_departement)
                                                   <option value="{{ $prof_departement->professeur->idProf }}">{{$prof_departement->professeur->user->personne->nom.' '.$prof_departement->professeur->user->personne->prenom }}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Matière :</label>
                                            <select class="custom-select2 form-control"
                                                style="width: 100%; height: 38px;" name="matiereafect" id="matiereafect">
                                                @foreach ($departement->filieres as $filiere)
                                                    <optgroup label="{{ $filiere->nom.' '.$filiere->niveau }}">
                                                        @foreach ($filiere->modules as $module)
                                                            @foreach ($module->matieres as $matiere)
                                                                <option value="{{ $matiere->idMatiere }}">{{ $matiere->nom }}</option>
                                                            @endforeach
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
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
                            <h4 class="h4">Retirer une matiére</h4>
                        </div>
                        <hr>
                        <form action="{{ route('DetacherMatiere') }}" class="tab-wizard wizard-circle wizard pl-20" method="POST" id="detacher">
                            @csrf
                            <input type="hidden" id="depD" name="depD" value="{{ $departement->idDepartement }}">
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>professeur :</label>
                                            <select class="custom-select2 form-control" name="profdet" id="profdet"
                                                style="width: 100%; height: 38px;" required>
                                                <option value="">---Selectioné un professeur---</option>
                                                @foreach ($departement->prof_departements as $prof_departement)
                                                   <option value="{{ $prof_departement->professeur->idProf }}">{{$prof_departement->professeur->user->personne->nom.' '.$prof_departement->professeur->user->personne->prenom }}</option>
                                                @endforeach                                                 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Matière :</label>
                                            <select class="custom-select1 form-control" name="matiere" id="matiere" style="width: 100%; height: 45px;" required>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right"><input class="btn btn-primary" type="submit"
                                    value="Retirer"></div>
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
                                <dd class="col-sm-8" id="nom"></dd>

                                <dt class="col-sm-4">Prénom</dt>
                                <dd class="col-sm-8" id="prenom"></dd>

                                <dt class="col-sm-4">Genre</dt>
                                <dd class="col-sm-8" id="genre"></dd>
                         
                                <dt class="col-sm-4">Nationalité</dt>
                                <dd class="col-sm-8" id="nationalite"></dd>

                                <dt class="col-sm-4">Lieu de naissance</dt>
                                <dd class="col-sm-8" id="LieuNaissance"></dd>

                                <dt class="col-sm-4">Date de naissance</dt>
                                <dd class="col-sm-8" id="datenais"></dd>

                                <dt class="col-sm-4">Situation familiale</dt>
                                <dd class="col-sm-8" id="situation"></dd>

                                <dt class="col-sm-4">N° C.N.I.E</dt>
                                <dd class="col-sm-8" id="cin"></dd>

                                <dt class="col-sm-4">Adresse</dt>
                                <dd class="col-sm-8" id="adresse"></dd>

                                <dt class="col-sm-4">Téléphone</dt>
                                <dd class="col-sm-8" id="tel"></dd>

                                <dt class="col-sm-4">E-mail personnel</dt>
                                <dd class="col-sm-8" id="email"></dd>

                                <dt class="col-sm-4">E-mail institutionnel</dt>
                                <dd class="col-sm-8" id="emailins"></dd>

                                <dt class="col-sm-4">Spécialité</dt>
                                <dd class="col-sm-8" id="specialite"></dd>

                                <dt class="col-sm-4">Maitéres</dt>
                                <dd class="col-sm-8" id="matieres">
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
            <div class="modal fade" id="success-modal-aff" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
            <div class="modal fade" id="success-modal-det" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">
                            <h3 class="mb-20 pt-5">Retrait réussi‏!</h3>
                            <div class="mb-30 text-center"><img src="{{ asset('vendors/images/success.png') }}"></div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">terminer</button>
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
                    data: 'idProf',
                    name: 'idProf'
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
                    data: 'specialite',
                    name: 'specialite'
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
                    data: 'idProf',
                    render: function(data, type, full, meta) {
                        return ' <a class="dropdown-item" href="" style="background-color:transparent;" onclick="getProfInfo('+data+')" data-toggle="modal" data-target="#bd-example-modal-lg"><i class="dw dw-eye"></i></a>'
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

        function getProfInfo(id)
        {
            document.getElementById("matieres").innerHTML="";
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
                    if(response.matieres.length > 0)
                    {
                        response.matieres.forEach(myFunction);
                    }else{
                        document.getElementById("matieres").innerHTML = "Aucune Matiere";
                    }
                    function myFunction(item, index) {
                    document.getElementById("matieres").innerHTML += item.nom + "<br>";
                    }
                }
            })
        }
        jQuery(document).ready(function ()
        {
                jQuery('select[name="profdet"]').on('change',function(){
                   var idProf = jQuery(this).val();
                   var idDep = document.getElementById("depA").value;
                   if(idProf)
                   {
                      jQuery.ajax({
                         url : '/chef/professeur/getMatiere/'+idProf+'/'+idDep,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="matiere"]').empty();
                            jQuery.each(data, function(key,value){
                               $('select[name="matiere"]').append('<option value="'+ value.idMatiere +'">'+ value.nom +'</option>');
                            });
                         }
                      });
                   }
                   else
                   {
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
                dataType : "JSON",
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    $('#success-modal-aff').modal('show');
                    if(document.getElementById("profdet").value == data[0].idProf)
                    {
                        jQuery('select[name="matiere"]').empty();
                        jQuery.each(data, function(key,value){
                            $('select[name="matiere"]').append('<option value="'+ value.idMatiere +'">'+ value.nom +'</option>');
                        });
                    }else{
                        jQuery.ajax({
                         url : '/chef/professeur/getMatiere/'+document.getElementById("profdet").value+'/'+document.getElementById("depA").value,
                         type : "GET",
                         dataType : "json",
                         success:function(response)
                         {
                            console.log(response);
                            jQuery('select[name="matiere"]').empty();
                            jQuery.each(response, function(key,value){
                               $('select[name="matiere"]').append('<option value="'+ value.idMatiere +'">'+ value.nom +'</option>');
                            });
                         }
                      });
                    }
                },
                error: function (jqXHR, exception) {
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
                dataType : "JSON",
                data: form.serialize(),
                success: function(data) {
                    $('#success-modal-det').modal('show');
                    jQuery('select[name="matiere"]').empty();
                    jQuery.each(data, function(key,value){
                        $('select[name="matiere"]').append('<option value="'+ value.idMatiere +'">'+ value.nom +'</option>');
                    });
                }
            });
        });

    </script>
    @endsection