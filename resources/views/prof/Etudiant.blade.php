@extends('layouts.prof')
@section('title'," $filiere->nom $filiere->niveau")
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">{{ $filiere->nom.' '.$filiere->niveau }}</h4>
                    </div>
                    <div class="pb-20">

                        <table class="table hover multiple-select-row data-table-export nowrap yajra-datatable">
                            <thead>
                                <tr>
                                    <th>N° Apogée</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Code Massar</th>
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
            </div>
            <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" id="modall">
                            <dl class="row" style="padding-left: 20px;">
                                <dt class="col-sm-4">Nom</dt>
                                <dd class="col-sm-8">HAMDANE</dd>

                                <dt class="col-sm-4">Prénom</dt>
                                <dd class="col-sm-8">YASSINE</dd>

                                <dt class="col-sm-4">Code Apogée</dt>
                                <dd class="col-sm-8">19020547</dd>

                                <dt class="col-sm-4">CNE / Code Massar</dt>
                                <dd class="col-sm-8">J136461372</dd>

                                <dt class="col-sm-4">Genre</dt>
                                <dd class="col-sm-8">Masculin</dd>

                                <dt class="col-sm-4">Date de naissance</dt>
                                <dd class="col-sm-8">16/02/2001</dd>

                                <dt class="col-sm-4">Situation familiale</dt>
                                <dd class="col-sm-8">Célibataire</dd>

                                <dt class="col-sm-4">Nationalité</dt>
                                <dd class="col-sm-8">MAROCAIN(E)</dd>

                                <dt class="col-sm-4">Lieu de naissance</dt>
                                <dd class="col-sm-8">RABAT</dd>

                                <dt class="col-sm-4">N° C.N.I.E</dt>
                                <dd class="col-sm-8">AE293178</dd>

                                <dt class="col-sm-4">N° C.N.I.E du père</dt>
                                <dd class="col-sm-8">E322801</dd>

                                <dt class="col-sm-4">N° C.N.I.E de la mère</dt>
                                <dd class="col-sm-8">AB306235</dd>

                                <dt class="col-sm-4">Adresse </dt>
                                <dd class="col-sm-8">RES ELBOUSTANE IMM G11 APT 33 LOT SAID HAJJI SALE</dd>

                                <dt class="col-sm-4">Téléphone</dt>
                                <dd class="col-sm-8">0672387235</dd>

                                <dt class="col-sm-4">E-mail personnel</dt>
                                <dd class="col-sm-8">amirnet001@gmail.com</dd>

                                <dt class="col-sm-4">E-mail institutionnel</dt>
                                <dd class="col-sm-8">yassine_hamdane@um5.ac.ma</dd>

                                <dt class="col-sm-4">Année du BAC</dt>
                                <dd class="col-sm-8">2019</dd>

                                <dt class="col-sm-4">Couverture médicale</dt>
                                <dd class="col-sm-8">Aucune couverture</dd>

                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="printJS({printable: 'modall',type: 'html', targetStyles: ['*']})"><i
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
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>
    <script type="text/javascript">
        $(function () {
          var table = $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: true,

              ajax: "{{ route('getEtudiantsList',['filiere' => $filiere]) }}",
              columns: [
                  {data: 'apogee', name: 'apogee'},
                  {data: 'nom', name: 'nom'},
                  {data: 'prenom', name: 'prenom'},
                  {data: 'cne', name: 'cne'},
                  {data: 'email', name: 'email'},
                  {data: 'tel', name: 'tel'},
                  {
                    data: 'a', 
                    name: 'a', 
                    orderable: true, 
                    searchable: true
                  },
              ]
          });

        });
      </script>


    @endsection
