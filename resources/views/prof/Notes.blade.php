@extends('layouts.prof')
@section('title',"$matiere->nom")
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">{{ $matiere->nom }}</h4>
                    </div>
                    <div class="pb-20">

                        <table class="table hover multiple-select-row data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th>N° Apogée</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Code Massar</th>
                                    <th>Controle</th>
                                    <th>Examen‏</th>
                                    <th>Note</th>
                                    <th class="datatable-nosort"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Modifier Les notes</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="{{ route('updateNote') }}" method="POST" id="myform">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" id="idNote" name="idNote" value="">
                                <div class="form-group row" style="padding-left: 5px;">
                                    <label class="col-sm-12 col-md-4 col-form-label" style="margin-right: -70px;">Controle</label>
                                    <div class="col-sm-12 col-md-4">
                                        <input class="form-control" id="control" name="control" value="" step="0.01" type="number">
                                    </div>
                                    <label class="col-sm-12 col-md-4 col-form-label" style="margin-right: -85px;">Coef:</label>
                                    <div class="col-sm-12 col-md-3">
                                        <input class="form-control" id="coefcontrol" name="coefcontrol" value="25" step="25" max="100" min="0" type="number">
                                    </div>
                                </div>
                                <div class="form-group row" style="padding-left: 5px;">
                                    <label class="col-sm-12 col-md-4 col-form-label" style="margin-right: -70px;">Examen</label>
                                    <div class="col-sm-12 col-md-4">
                                        <input class="form-control" id="exam" name="exam" value="" step="0.01" type="number">
                                    </div>
                                    <label class="col-sm-12 col-md-4 col-form-label" style="margin-right: -85px;">Coef:</label>
                                    <div class="col-sm-12 col-md-3">
                                        <input class="form-control" value="25" id="coefexam" name="coefexam" step="25" max="100" min="0" type="number">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
                                <input type="submit" class="btn btn-primary" value="Enregistrer">
                            </div>
                        </form>
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
    <!-- buttons for Export datatable -->
    <script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
    <script>
        var table1 = $('.data-table-export').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getListNotes',['matiere' => $matiere]) }}",
            columns: [
                {data: 'apogee', name: 'apogee'},
                {data: 'nom', name: 'nom'},
                {data: 'prenom', name: 'prenom'},
                {data: 'cne', name: 'cne'},
                {
                  data: 'controle',
                  render:function(data,type,full,meta){ return '<span style="padding-left: 15px;">'+data+'</span>' },

                },
                {
                  data: 'exam', 
                  render:function(data,type,full,meta){ return '<span style="padding-left: 15px;">'+data+'</span>' },
                },
                {data: 'noteGeneral', name: 'noteGeneral'},
                {
                  data: 'idNote', 
                  render:function(data,type,full,meta){ return '<a href="" onclick="getnote('+data+')" data-toggle="modal" data-target="#Medium-modal"><i class="icon-copy dw dw-edit2"></i></a>' },
                },
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
            dom: '<"top"<"left-col"B><"right-col"f>>rtip',
            buttons: [
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimer'
            }
            ]
        });
        
       function getnote(id)
       {  
            $.ajax({
                    type: 'GET',
                    url: "/note/"+id,
                    dataType: 'JSON',
                    data:{},
                    success: function(response) {
                        document.getElementById("control").value = response[0].controle;
                        document.getElementById("exam").value = response[0].exam;
                        document.getElementById("idNote").value = response[0].idNote;
                        document.getElementById("coefcontrol").value = response[0].Coefcontrole;
                        document.getElementById("coefexam").value = response[0].Coefexam;
                    }
                })               
        };

        $("#myform").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {   
                    $('#Medium-modal').modal('hide');
                    table1.ajax.reload();
                }
                });

        });

    </script>
    @endsection