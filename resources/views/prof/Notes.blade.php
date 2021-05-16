@extends('layouts.app')
@section('title', "$matiere->nom")
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
                @include('layouts.footer')
            </div>
            <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
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
                                <input type="hidden" id="idEtudiant" name="idEtudiant" value="">
                                <input type="hidden" id="idMatiere" name="idMatiere" value="{{ $matiere->idMatiere }}">
                                <div class="form-group row" style="padding-left: 5px;">
                                    <label class="col-sm-12 col-md-4 col-form-label"
                                        style="margin-right: -70px;">Controle</label>
                                    <div class="col-sm-12 col-md-4">
                                        <input class="form-control" id="control" name="control" value="" step="0.01"
                                            type="number" required>
                                    </div>
                                    <label class="col-sm-12 col-md-4 col-form-label"
                                        style="margin-right: -85px;">Coef:</label>
                                    <div class="col-sm-12 col-md-3">
                                        <input class="form-control" id="coefcontrol" name="coefcontrol" value="25" step="25"
                                            max="100" min="0" type="number" required>
                                    </div>
                                </div>
                                <div class="form-group row" style="padding-left: 5px;">
                                    <label class="col-sm-12 col-md-4 col-form-label"
                                        style="margin-right: -70px;">Examen</label>
                                    <div class="col-sm-12 col-md-4">
                                        <input class="form-control" id="exam" name="exam" value="" step="0.01" type="number"
                                            required>
                                    </div>
                                    <label class="col-sm-12 col-md-4 col-form-label"
                                        style="margin-right: -85px;">Coef:</label>
                                    <div class="col-sm-12 col-md-3">
                                        <input class="form-control" value="25" id="coefexam" name="coefexam" step="25"
                                            max="100" min="0" type="number" required>
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
    <script src="{{ asset('src/plugins/datatables/js/jszip.min.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/prof/notes.js') }}"></script>

@endsection
