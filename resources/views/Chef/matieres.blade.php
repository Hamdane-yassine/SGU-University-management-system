@extends('layouts.prof')
@section('title','Génie Logiciel - GL1')
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
                            <h4 class="text-blue h4">Génie Logiciel - GL1</h4>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="text-right font-14 text-secondary weight-500">Insértion des notes <input
                                    type="checkbox" checked class="switch-btn" data-color="#0099ff" data-size="small">
                            </div>
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
                                <tr>
                                    <td scope="row" rowspan="4">Semestre 1</td>
                                    <td scope="row" class="text-center">M1</td>
                                    <td scope="row">Langues et Techniques d’Expression</td>
                                    <td scope="row">
                                        <ul>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Français</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Anglais</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Motricité et Activité de Développement</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Techniques d’Expression et de Communication
                                                    (TEC)</a></li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        <ul>
                                            <li>25</li>
                                            <li>25</li>
                                            <li>20</li>
                                            <li>30</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="text-center">M2</td>
                                    <td scope="row">Mathématiques pour informatique</td>
                                    <td scope="row">
                                        <ul>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Analyse</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Algèbre</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Probabilités et Statistique</a></li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        <ul>
                                            <li>40</li>
                                            <li>30</li>
                                            <li>20</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="text-center">M3</td>
                                    <td scope="row">Architecture des Ordinateurs</td>
                                    <td scope="row">
                                        <ul>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Architecture d’ordinateur</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Electronique numérique</a></li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        <ul>
                                            <li>40</li>
                                            <li>40</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="text-center">M4</td>
                                    <td scope="row">Algorithmique et Programmation</td>
                                    <td scope="row">
                                        <ul>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Algorithmique</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Programmation C</a></li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        <ul>
                                            <li>44</li>
                                            <li>46</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" rowspan="4">Semestre 2</td>
                                    <td scope="row" class="text-center">M5</td>
                                    <td scope="row">Programmation orientée objet</td>
                                    <td scope="row">
                                        <ul>

                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Structures de données</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Pratique de la programmation JAVA</a></li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        <ul>
                                            <li>44</li>
                                            <li>46</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="text-center">M6</td>
                                    <td scope="row">Systèmes d’Exploitation et Réseaux Informatique</td>
                                    <td scope="row">
                                        <ul>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Introduction au Système d’exploitation Unix</a>
                                            </li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Introduction aux réseaux informatiques</a></li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        <ul>
                                            <li>44</li>
                                            <li>46</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="text-center">M7</td>
                                    <td scope="row">Systèmes d’Information et Bases de Données</td>
                                    <td scope="row">
                                        <ul>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Analyse et Conception des Systèmes
                                                    d’Information</a>
                                            </li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Bases de données Relationnelles</a></li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        <ul>
                                            <li>50</li>
                                            <li>40</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="text-center">M8</td>
                                    <td scope="row">Langues et Techniques Communication</td>
                                    <td scope="row">
                                        <ul>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Français</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Anglais</a></li>
                                            <li> &#8594; <a href="Notes.html" class="card-link text-primary"
                                                    target="_blank">Techniques d’Expression et de Communication
                                                    (TEC)</a></li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        <ul>
                                            <li>30</li>
                                            <li>30</li>
                                            <li>30</li>
                                        </ul>
                                    </td>
                                </tr>
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