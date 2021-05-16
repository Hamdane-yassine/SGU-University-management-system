@extends('layouts.app')
@section('title', 'Gestion des emplois')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">les emplois du temps des professeurs : </h4>
                    </div>
                    <div class="pb-20">
                        <table class="emploi_des_profs table hover nowrap">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom du fichier</th>
                                    <th>Professeur</th>
                                    <th>Date de dernière modification</th>
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
                            <h4 class="h4">Ajouter</h4>
                        </div>
                        <hr>
                        <form class="tab-wizard wizard-circle wizard pl-20" method="POST"
                            action="{{ route('uploadEmploiprof') }}" enctype="multipart/form-data">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Professeur :</label>
                                            <select class="custom-select2 form-control" name="prof"
                                                style="width: 100%; height: 38px;">
                                                <optgroup label="Professeurs">
                                                    @foreach ($profs as $prof)
                                                        <option value="{{ $prof->idProf }}">{{ $prof->nom }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-file" style="margin-top: 31px;">
                                            <input type="file" class="custom-file-input" name="uploadedFile"
                                                accept="application/pdf" required>
                                            <label class="custom-file-label">Choisir une pdf</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div style="text-align: right;"><input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
                @include('layouts.footer')
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
                                    <form action="{{ route('deleteEmploiProf') }}" method="POST" id="delemploi">
                                        @csrf
                                        <input type="hidden" id="idEmploi" name="idEmploi" value="">
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
        </div>
    </div>
@endsection
@section('SpecialScripts')
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/admin/emploi.js') }}"></script>
@endsection
