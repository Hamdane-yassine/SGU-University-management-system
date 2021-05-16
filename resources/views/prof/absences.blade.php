    @extends('layouts.app')
    @section('title', 'Absences')
    @section('content')
        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <h4 class="text-blue h4">Table d'absence</h4>
                            <p class="mb-26"></p>
                        </div>
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Matiére</th>
                                    <th>Filière</th>
                                    <th>Departement</th>
                                    <th>Date d'absence</th>
                                    <th>État</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <h4 class="text-blue h4">Déclaration d'absence</h4>
                            <p class="mb-26"></p>
                        </div>
                        <div class="wizard-content">

                            <form class="tab-wizard wizard-circle wizard" method='POST' action='/addRatt'>
                                @csrf
                                <section>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Filiere :</label>
                                                <select class="custom-select2 form-control" name="filiere" id="filiere"
                                                    style="width: 100%; height: 38px;">
                                                    <option>--select a filiere-- </option>
                                                    @foreach ($filieresList as $filiere)
                                                        <option value={{ $filiere->idFiliere }}>{{ $filiere->nom }} -
                                                            {{ $filiere->niveau }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Matiére :</label>
                                                <select class="custom-select2 form-control " name="matiere" id="matiere"
                                                    style="width: 100%; height: 38px;" required>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Dates de rattrapage possible :</label>
                                                <input class="form-control datetimepicker-range datetimepicker"
                                                    name="dateRatt" placeholder="Date de rattrapage :" type="text"
                                                    autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date d'absence :</label>
                                                <input class="form-control datetimepicker" name="dateAbsence"
                                                    placeholder="Date d'absence :" type="text" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <div class="row form-inline">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox mb-5" style="padding-top: 10px;">
                                        <input type="checkbox" name="informerEtudiants" class="custom-control-input"
                                            id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Informer les étudiants pour
                                            l'absence</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="text-align: right;">
                                    <input class="btn btn-primary" type="submit" value="Confirmer">
                                </div>
                            </div>
                        </div>

                        </section>

                        </form>
                    </div>
                    @include('layouts.footer')
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
        <script src="{{ asset('vendors/scripts/prof/absences.js') }}"></script>
    @endsection
