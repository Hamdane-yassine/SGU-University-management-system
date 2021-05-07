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
                                        <td><a href="/admin/etudiants/{{ $filiere->idFiliere }}" target="_blank" class="card-link text-primary">{{ $filiere->nom }}</a></td>
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
                            <h4 class="h4">Ajouter</h4>
                        </div>
                        <hr>
                        <form class="tab-wizard wizard-circle wizard pl-20" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filiere  :</label>
                                            <select class="custom-select2 form-control" name="prof" style="width: 100%; height: 38px;">
                                                    @foreach ($departement->filieres as $filiere)
                                                         <option value="{{ $filiere->idFiliere }}" >{{ $filiere->nom.' '.$filiere->niveau }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-file" style="margin-top: 31px;">
                                            <input type="file" class="custom-file-input" name="uploadedFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                            <label class="custom-file-label">Choisir une csv</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div style="text-align: right;"><input class="btn btn-primary" type="submit" value="Ajouter"></div>
                        </form>
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
@endsection
