@extends('layouts.app')
@section('title', 'etudiant')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20 row pt-30">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="text-blue h4">{{ $filiere->nom.' '.$filiere->niveau }}</h4>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="text-center">
                                    <th rowspan="2" colspan="2"></th>
                                    <th colspan="2">Session 1</th>
                                    <th colspan="2">Session 2</th>
                                </tr>

                                <tr class="text-center">
                                    <th>Note</th>
                                    <th>Résultat</th>

                                    <th>Note</th>
                                    <th>Résultat</th>
                                </tr>

                                <tr>
                                    <td>
                                        <font style="padding-left: 10px">{{ $filiere->niveau }}ème année : {{ $filiere->nom }}</font>
                                    </td>
                                    <td>AN{{ $filiere->niveau }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr></tr>
                                @foreach ($filiere->semestres as $semestre)   
                                <tr>
                                    <td>
                                        <font style="padding-left: 30px">Semestre 3 DUT : Génie Logiciel (GL)</font>
                                    </td>
                                    <td>SE03</td>
                                    <td>16.19</td>
                                    <td>Validé</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr></tr>
                                <tr>
                                    <td>
                                        <font style="padding-left: 50px">Recherche opérationnelle et analyse de données
                                        </font>
                                    </td>
                                    <td>MO</td>
                                    <td>17.75</td>
                                    <td>Validé</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr></tr>
                                <tr>
                                    <td>
                                        <font style="padding-left: 70px">Recherche opérationnelle</font>
                                    </td>
                                    <td>EM</td>
                                    <td>16.00</td>
                                    <td>A</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
@endsection
@section('SpecialScripts')
    <script src="{{ asset('src/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('vendors/scripts/advanced-components.js') }}"></script>
@endsection
