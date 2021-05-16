@extends('layouts.prof')
@section('title','Rattrapage')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                @if(count($absences) == 0)
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="card-box mb-30">
                            <div class="pd-20">
                                <p>il n'y a pas de demande de rattrapage.</p>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach ($absences as $absence)
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4 d-inline">{{ $absence->professeur->user->personne->nom }} {{ $absence->professeur->user->personne->prenom }}</h4>
                            <small class="form-text text-muted pl-10 d-inline">
                                &#8594; Absence : @php setlocale(LC_TIME, "fr_FR", "French");echo strftime("%A %d %B %G %R", strtotime($absence->dateAbsence)); @endphp | Matiere : {{ $absence->matiere->nom }} | Filiere : {{ $absence->matiere->module->semestre->filiere->nom}}
                            </small>
                        </div>
                        <hr>
                        <form class="tab-wizard wizard-circle wizard pl-20" method="POST" enctype="multipart/form-data">
                            @csrf
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Dates de rattrapage possible :</label>
                                            <select class="custom-select2 form-control" style="width: 100%; height: 38px;" name="datesRattPossibles">
                                                @foreach ( explode(" - ", $absence->dateRattrapage) as $date)
                                                    <option value="{{ $date }}" selected>@php setlocale(LC_TIME, "fr_FR", "French");echo strftime("%A %d %B %G %R", strtotime($date)); @endphp</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Autre date (optionnel):</label>
                                            <input class="form-control datetimepicker" name="dateRattOptionnel" placeholder="Date d'absence :" type="text" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Salle :</label>
                                            <input class="form-control" type="text" name="salle" required><br><br>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right">
                                <button type="submit" class="btn btn-danger" formaction="/chef/rattrapages/annuler/{{ $absence->IdAbsence }}" formnovalidate>Annuler</button>
                                <button type="submit" class="btn btn-success" formaction="/chef/rattrapages/valider/{{ $absence->IdAbsence }}">Valider</button>
                            </div>

                        </form>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
@endsection
