@extends('layouts.app')
@section('title', 'Notes et résultats')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20 row pt-30">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="text-blue h4">{{ $etudiant->personne->nom . ' ' . $etudiant->personne->prenom }}
                            </h4>
                        </div>
                    </div>
                    <ul class="nav nav-tabs customtab" role="tablist">
                        @foreach ($filieresnotes as $index => $filierenote)
                            @if ($index == 0)
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab"
                                        href="#filiere{{ $filierenote['filiere']->idFiliere }}">{{ $filierenote['filiere']->nom }}
                                        ({{ $filierenote['filiere']->shortcut . '' . $filierenote['filiere']->niveau }})</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                        href="#filiere{{ $filierenote['filiere']->idFiliere }}">{{ $filierenote['filiere']->nom }}
                                        ({{ $filierenote['filiere']->shortcut . '' . $filierenote['filiere']->niveau }})</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($filieresnotes as $index => $filierenote)
                            @if ($index == 0)
                                <div class="tab-pane active pb-20" id="filiere{{ $filierenote['filiere']->idFiliere }}"
                                    role="tabpanel">
                            @else
                                <div class="tab-pane pb-20" id="filiere{{ $filierenote['filiere']->idFiliere }}"
                                    role="tabpanel">
                            @endif
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th rowspan="2" colspan="2"></th>
                                                <th colspan="2">Session 1</th>
                                                <th colspan="2">Session 2</th>
                                            </tr>

                                            <tr>
                                                <th>Note</th>
                                                <th>Résultat</th>

                                                <th>Note</th>
                                                <th>Résultat</th>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <font style="padding-left: 10px">
                                                        {{ $filierenote['filiere']->niveau }}ème année
                                                        {{ $filierenote['filiere']->diplome }} :
                                                        {{ $filierenote['filiere']->nom }}
                                                        ({{ $filierenote['filiere']->shortcut }})
                                                    </font>
                                                </td>
                                                <td>AN{{ $filierenote['filiere']->niveau }}</td>
                                                <td>
                                                    @if ($filierenote['CheckAnne'])
                                                        {{ $filierenote['noteAnne'] }}
                                                    @endif
                                                </td>
                                                <td></td>
                                                <td>
                                                    @if ($filierenote['CheckAnneRatt'])
                                                        {{ $filierenote['noteRatt'] }}
                                                    @endif
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr></tr>
                                            @foreach ($filierenote['filiere']->semestres as $semestre)
                                                <tr>
                                                    <td>
                                                        <font style="padding-left: 30px">Semestre
                                                            {{ $semestre->num }}
                                                            {{ $filierenote['filiere']->diplome }} :
                                                            {{ $filierenote['filiere']->nom }}
                                                            ({{ $filierenote['filiere']->shortcut }})
                                                        </font>
                                                    </td>
                                                    <td>SE{{  $semestre->num }}</td>
                                                    @foreach ($filierenote['noteSemestres'] as $noteSemestre)
                                                        @if ($noteSemestre['idSemestre'] == $semestre->idSemestre)
                                                            @php
                                                                $semestreinfo = $noteSemestre;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <td>
                                                        @if ($semestreinfo['noteNormal'] >= 0 && $semestreinfo['CheckNormal'])
                                                            {{ $semestreinfo['noteNormal'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($semestreinfo['noteNormal'] >= 0 && $semestreinfo['CheckNormal'])
                                                            {{ $semestreinfo['etat'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($semestreinfo['noteNormal'] >= 0 && $semestreinfo['noteRatt'] >= 0 && $semestreinfo['etat'] == 'Non Validé' && $semestreinfo['CheckRatt'])
                                                            {{ $semestreinfo['noteRatt'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($semestreinfo['noteNormal'] >= 0 && $semestreinfo['noteRatt'] >= 0 && $semestreinfo['etat'] == 'Non Validé' && $semestreinfo['CheckRatt'])
                                                            {{ $semestreinfo['etatRatt'] }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr></tr>
                                                @foreach ($semestre->modules as $module)
                                                    <tr>
                                                        <td>
                                                            <font style="padding-left: 50px">{{ $module->nom }}
                                                            </font>
                                                        </td>
                                                        <td>MO</td>
                                                        <td>
                                                            @if ($semestreinfo['CheckNormal'])
                                                                @foreach ($filierenote['noteModules'] as $noteModule)
                                                                    @if ($noteModule['idModule'] == $module->idModule && $noteModule['noteNormal'] >= 0)
                                                                        {{ $noteModule['noteNormal'] }}
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($semestreinfo['CheckNormal'])
                                                                @foreach ($filierenote['noteModules'] as $noteModule)
                                                                    @if ($noteModule['idModule'] == $module->idModule && $noteModule['noteNormal'] >= 0)
                                                                        @if ($noteModule['noteNormal'] >= $consval)
                                                                            Validé
                                                                        @elseif ($noteModule['noteNormal'] >= $consratt)
                                                                            Rattrapage
                                                                        @else
                                                                            Non Validé
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($semestreinfo['CheckRatt'])
                                                                @foreach ($filierenote['noteModules'] as $noteModule)
                                                                    @if ($noteModule['idModule'] == $module->idModule && $noteModule['noteNormal'] >= 0 && $noteModule['noteNormal'] < $consval && $noteModule['noteRatt'] >= 0)
                                                                        @if ($noteModule['noteNormal'] >= $consratt)
                                                                            {{ $noteModule['noteRatt'] }}
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($semestreinfo['CheckRatt'])
                                                                @foreach ($filierenote['noteModules'] as $noteModule)
                                                                    @if ($noteModule['idModule'] == $module->idModule && $noteModule['noteNormal'] >= 0 && $noteModule['noteNormal'] < $consval && $noteModule['noteRatt'] >= 0)
                                                                        @if ($noteModule['noteNormal'] >= $consratt)
                                                                            @if ($noteModule['noteRatt'] >= $consval)
                                                                                Validé
                                                                            @else
                                                                                Non Validé
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr></tr>
                                                    @foreach ($module->matieres as $matiere)
                                                        <tr>
                                                            <td>
                                                                <font style="padding-left: 70px">{{ $matiere->nom }}
                                                                </font>
                                                            </td>
                                                            <td>EM</td>
                                                            <td>
                                                                @if ($semestreinfo['CheckNormal'])
                                                                    @foreach ($etudiant->notes as $note)
                                                                        @if ($note->matiere->idMatiere == $matiere->idMatiere)
                                                                            {{ $note->noteGeneral }}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($semestreinfo['CheckNormal'])
                                                                    @foreach ($etudiant->notes as $note)
                                                                        @if ($note->matiere->idMatiere == $matiere->idMatiere)
                                                                            @if ($note->noteGeneral < $consval)
                                                                                Non Validé
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($semestreinfo['CheckRatt'])
                                                                    @foreach ($etudiant->notes as $note)
                                                                        @if ($note->matiere->idMatiere == $matiere->idMatiere && $note->noteRatt != null)
                                                                            {{ $note->noteRatt }}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($semestreinfo['CheckRatt'])
                                                                    @foreach ($etudiant->notes as $note)
                                                                        @if ($note->matiere->idMatiere == $matiere->idMatiere && $note->noteRatt != null)
                                                                            @if ($note->noteRatt < $consval)
                                                                                Non Validé
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        @endforeach
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
