@extends('layouts.prof')
@section('title', "$departement->nom")
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">{{ $departement->nom }} </h4>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table nowrap">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Niveau</th>
                                    <th>Les etudiants</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departement->filieres as $filiere)
                                    <tr>
                                        <td class="table-plus">{{ $filiere->idFiliere }}</td>
                                        <td><a href="/admin/etudiants/{{ $filiere->idFiliere }}" target="_blank"
                                                class="card-link text-primary">{{ $filiere->nom }}</a></td>
                                        <td>{{ $filiere->niveau }}</td>
                                        <td style="padding-left: 50px">{{ count($filiere->etudiants) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            = <h4 class="h4">Ajouter</h4>
                        </div>
                        <hr>
                        <form class="tab-wizard wizard-circle wizard pl-20" action="{{ route('ImportExcelfile') }}"
                            method="POST" enctype="multipart/form-data" id="addexcel">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filiere :</label>
                                            <select class="custom-select2 form-control" name="filiere" id="filiere"
                                                style="width: 100%; height: 38px;">
                                                @foreach ($departement->filieres as $filiere)
                                                    <option value="{{ $filiere->idFiliere }}">
                                                        {{ $filiere->nom . ' ' . $filiere->niveau }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-file" style="margin-top: 31px;">
                                            <input type="file" class="custom-file-input" name="uploadedFile"
                                                id="uploadedFile"
                                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                                required>
                                            <label class="custom-file-label">Choisir un fichier excel</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div style="text-align: right;"><input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal fade" id="success-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center font-18">
                                <h3 class="mb-20 pt-5">Les donné sont ajouté!</h3>
                                <div class="mb-30 text-center"><img src="{{ asset('vendors/images/success.png') }}"></div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-primary" onclick="ren()"
                                    data-dismiss="modal">terminer</button>
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
        <script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("#addexcel").submit(function(e) {
                    e.preventDefault(); // avoid to execute the actual submit of the form.
                    var formData = new FormData();
                    formData.append('uploadedFile', $('#uploadedFile')[0].files[0],$('#uploadedFile')[0].files[0].name);
                    formData.append('filiere', $('#filiere').val());
                    formData.append('_token', '{{ csrf_token() }}');
                    var form = $(this);
                    var url = form.attr('action');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData, // serializes the form's elements.
                        processData : false,
                        contentType : false,
                        success: function(data) {
                           
                        },
                        error: function(err) {

                        }
                    });
                });
            })

        </script>
    @endsection
