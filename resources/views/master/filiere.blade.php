    @extends('layouts.prof')
    @section('title','Absences')
    @section('content')
    <div class="main-container">

        <div class="pd-20 mb-20 card-box">
            <div class="clearfix">
                <h4 class="text-blue h4">Table des Filieres : </h4>
                <p class="mb-26"></p>
            </div>
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Niveau</th>
                        <th>Nombre Etudiants</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/updateFiliere/{{ $idDepartement }}">
                            @csrf
                            <label>Nom : </label>
                            <input type="text" class="form-control" name="nomFiliere" placeholder="nom du filiere" ><br>
                            <label>Niveau : </label>
                            <input type="number" class="form-control" name="niveau" placeholder="niveau" >
                            <input type="hidden" class="form-control" name="idFiliere" id="hiddenIdFiliere">
                            <input type="hidden" class="form-control" name="idDepartement" value={{ $idDepartement }}>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 mb-20 card-box">
            <div class="wizard-content">
                <div>
                    <h4 class="h4 d-inline">Supprimer semestre : </h4>
                </div>
                <hr>
                <form class="tab-wizard wizard-circle wizard pl-20" method="POST" action="{{ route('deleteSemestreOfFiliere') }}">
                @csrf
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Filiere : </label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px;" name="filieres1" required>
                                        <option>--select a filiere--</option>
                                        @foreach ($filieres as $filiereX)
                                            <option value="{{  $filiereX->idFiliere }}">{{  $filiereX->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Semestre :</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px;" name="semestre1" required>
                                    </select>
                                </div>
                                <div class="text-right form-group">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="wizard-content">
                <div>
                    <h4 class="h4 d-inline">Modifier Module : </h4>
                </div>
                <hr>
                <form class="tab-wizard wizard-circle wizard pl-20" method="POST" enctype="multipart/form-data">
                @csrf
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Filiere :</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px;" name="filiere2">
                                        <option>--sélectionner une filiere--</option>
                                        @foreach ($filieres as $filiere)
                                            <option value="{{ $filiere->idFiliere }}">{{ $filiere->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Module :</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px;" name="module2" required>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nom :</label>
                                    <input class="form-control" name="NomModule2"  type="text" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Semestre :</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px;" name="semestre2">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Volume Horaire :</label>
                                    <input class="form-control" type="number" name="VH2" >
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="text-right">
                        <button type="submit" class="btn btn-danger"  formaction="/master/deleteModule" >Supprimer</button>
                        <button type="submit" class="btn btn-success" formaction="/master/saveModule">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="wizard-content">
                <div>
                    <h4 class="h4 d-inline">Modifier Matiere : </h4>
                </div>
                <hr>
                <form class="tab-wizard wizard-circle wizard pl-20" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Filiere :</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px;" name="filiere3">
                                        <option>--sélectionner une filiere--</option>
                                        @foreach ($filieres as $filiere)
                                            <option value="{{ $filiere->idFiliere }}">{{ $filiere->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Module :</label>
                                    <select class="custom-select2 form-control"  style="width: 100%; height: 38px;" name="module3">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nom :</label>
                                    <input class="form-control " name="nom3" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>coefficient :</label>
                                    <input class="form-control" type="number" name="coeff3" type="text" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Semestre :</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px;" name="semestre3">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Matiere :</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px;" name="matiere3" required>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Volume Horaire :</label>
                                    <input class="form-control"type="number" name="vh3">
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="text-right">
                        <button type="submit" class="btn btn-danger" formaction="/master/deleteMatiere" formnovalidate>Supprimer</button>
                        <button type="submit" class="btn btn-success" formaction="/master/saveMatiere">Valider</button>
                    </div>
                </form>
            </div>
        </div>



    </div>
    <!-- js -->
    @endsection
    @section('SpecialScripts')
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/dashboard3.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <script src="{{ asset('vendors/scripts/steps-setting.js') }}"></script>
    <script type="text/javascript">
        $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('MasterFiliereDatatable',['idDepartement' => $idDepartement])}}' ,
                columns: [
                    {data: 'idFiliere', name: 'idFiliere'},
                    {data: 'nomFiliere', name: 'nomFiliere'},
                    {data: 'niveau', name: 'niveau'},
                    {data: 'CountEtudiant', name: 'CountEtudiant'},
                    {data: 'action', name: 'action'},
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

            function initModal(idFiliere)
            {
                document.getElementById("hiddenIdFiliere").value = idFiliere;
            }
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {
                jQuery('select[name="filieres1"]').on('change',function(){
                   var idFiliere = jQuery(this).val();
                   if(idFiliere)
                   {
                      jQuery.ajax({
                         url : '/master/getSemestresOfFiliere/'+idFiliere,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="semestre1"]').empty();
                            jQuery.each(data, function(key,value){
                               $('select[name="semestre1"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="semestre1"]').empty();
                   }
                });
        });
    </script>
    <!--module-->
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {
                jQuery('select[name="filiere2"]').on('change',function(){
                    jQuery('select[name="module2"]').empty();
                   var idFiliere = jQuery(this).val();
                   if(idFiliere)
                   {
                      jQuery.ajax({
                         url : '/master/getSemestresOfFiliere/'+idFiliere,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="semestre2"]').empty();
                            $('select[name="semestre2"]').append('<option value="" selected>--select Semestre--</option>');
                            jQuery.each(data, function(key,value){
                               $('select[name="semestre2"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="semestre2"]').empty();
                   }
                });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {
                jQuery('select[name="semestre2"]').on('change',function(){
                   var idSemester = jQuery(this).val();
                   if(idSemester)
                   {
                      jQuery.ajax({
                         url : '/master/getModuleOfSemester/' + idSemester,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="module2"]').empty();
                            jQuery.each(data, function(key,value){
                               $('select[name="module2"]').append('<option value="'+ value.idModule +'">'+ value.name +'</option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="module2"]').empty();
                   }
                });
        });
    </script>
    <!--third one-->
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {
                jQuery('select[name="filiere3"]').on('change',function(){
                    jQuery('select[name="module3"]').empty();
                   var idFiliere = jQuery(this).val();
                   if(idFiliere)
                   {
                      jQuery.ajax({
                         url : '/master/getSemestresOfFiliere/'+idFiliere,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="semestre3"]').empty();
                            $('select[name="semestre3"]').append('<option value="" selected>--select Semestre--</option>');
                            jQuery.each(data, function(key,value){
                               $('select[name="semestre3"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="semestre3"]').empty();
                   }
                });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {
                jQuery('select[name="semestre3"]').on('change',function(){
                   var idSemester = jQuery(this).val();
                   if(idSemester)
                   {
                      jQuery.ajax({
                         url : '/master/getModuleOfSemester/' + idSemester,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="module3"]').empty();
                            jQuery.each(data, function(key,value){
                               $('select[name="module3"]').append('<option value="'+ value.idModule +'">'+ value.name +'</option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="module3"]').empty();
                   }
                });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {
                jQuery('select[name="semestre3"]').on('change',function(){
                   var idSemester = jQuery(this).val();
                   if(idSemester)
                   {
                      jQuery.ajax({
                         url : '/master/getModuleOfSemester/' + idSemester,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="module3"]').empty();
                            $('select[name="module3"]').append('<option value="" selected>--select module--</option>');
                            jQuery.each(data, function(key,value){
                               $('select[name="module3"]').append('<option value="'+ value.idModule +'">'+ value.name +'</option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="module3"]').empty();
                   }
                });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {
                jQuery('select[name="module3"]').on('change',function(){
                   var idModule = jQuery(this).val();
                   if(idModule)
                   {
                      jQuery.ajax({
                         url : '/master/getMatieresOfModule/' + idModule,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="matiere3"]').empty();

                            jQuery.each(data, function(key,value){
                               $('select[name="matiere3"]').append('<option value="'+ value.idMatiere +'">'+ value.name +'</option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="matiere3"]').empty();
                   }
                });
        });
    </script>



    @endsection
