@extends('layouts.prof')
@section('title',"$filiere->nom $filiere->niveau")
@section('SpecialStyles')
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/switchery/switchery.min.css') }}">
<!-- bootstrap-tagsinput css -->
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
<!-- bootstrap-touchspin css -->
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css') }}">
@endsection
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20 row pt-30">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="text-blue h4">{{ $filiere->nom . ' ' . $filiere->niveau }}</h4>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Semestre</th>
                                    <th scope="col">Module</th>
                                    <th scope="col">Intitulé du module</th>
                                    <th scope="col">Matières</th>
                                    <th scope="col">VH</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filiere->semestres as $semestre )
                                    @php
                                        $rowspanval = count($semestre->modules) + 1;
                                        $NumMod = 0;
                                    @endphp
                                    <tr>
                                        <td scope="row" rowspan="{{ $rowspanval }}" class="text-center">{{ $semestre->nom }}</td>
                                    </tr>
                                    @foreach ( $semestre->modules as $module)
                                        @php
                                            $NumMod++;
                                        @endphp
                                        <tr>
                                            <td scope="row" class="text-center">M{{ $NumMod }}</td>
                                            <td scope="row">{{ $module->nom }}</td>
                                            <td scope="row">
                                                <ul>
                                                    @foreach ($module->matieres as $matiere)
                                                        <li> &#8594; <a href="/chef/notes/{{ $matiere->idMatiere }}" class="card-link text-primary"
                                                            target="_blank">{{ $matiere->nom }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td scope="row">
                                                <ul>
                                                    @foreach ($module->matieres as $matiere)
                                                        <li>{{ $matiere->vh }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>

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
    <!-- switchery js -->
    <script src="{{ asset('src/plugins/switchery/switchery.min.js') }}"></script>
    <!-- bootstrap-tagsinput js -->
    <script src="{{ asset('src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <!-- bootstrap-touchspin js -->
    <script src="{{ asset('src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('vendors/scripts/advanced-components.js') }}"></script>
    @endsection