@extends('layouts.prof')
@section('title','Rattrapage')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                @foreach ($absences as $absence)
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4 d-inline">{{ $absence->professeur->user->personne->nom }} {{ $absence->professeur->user->personne->prenom }}</h4>
                            <small class="form-text text-muted pl-10 d-inline">
                                &#8594; Absence : @php setlocale(LC_TIME, "fr_FR", "French");echo strftime("%A %d %B %G %R", strtotime($absence->dateAbsence)); @endphp | Matiere : {{ $absence->matiere->nom }} | Filiere : {{ $absence->matiere->module->filiere->nom}}
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
                                                    <option value="{{ $date }}" selected>{{ $date }}</option>
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
                                            <input class="form-control" type="text" name="salle"><br><br>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right">
                                <!--<a href="#" class="btn btn-danger" >Annuler</a>
                                <a href="#" class="btn btn-success" >Valider</a>-->
                                <button type="submit" class="btn btn-danger" formaction="{{ route('ValiderRatt') }}">Annuler</button>
                                <button type="submit" class="btn btn-success" formaction="{{ route('')}}">Valider</button>
                            </div>

                        </form>
                    </div>
                </div>
                @endforeach

            <!--<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <button type="button"
                                        class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                        data-dismiss="modal"><i class="fa fa-check"></i></button>
                                    OUI
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

        </div>
    </div>
@endsection
