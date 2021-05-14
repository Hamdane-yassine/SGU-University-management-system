@extends('layouts.prof')
@section('title', 'Professeurs')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box pb-10">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Table des professeurs</h4>
                    </div>
                    <div class="pb-20">
                        <table class="table hover multiple-select-row data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Spécialité</th>
                                    <th>Email Personnel</th>
                                    <th>Téléphone</th>
                                    <th class="datatable-nosort">Actions</th>
                                    <th class="datatable-nosort"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="title pb-20 pt-20 pl-">
                    <h2 class="h3 mb-0">Ajouter</h2>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <form action="{{ route('AjouterProfesseur') }}" method="POST" id="ajoutprof">
                            @csrf
                            <input type="hidden" id="idDepart" name="idDepart" value="{{ $departement->idDepartement }}">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Nom</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" type="text" id="ajnom" name="ajnom" placeholder="Nom"
                                        value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Prénom</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="Prénom" id="ajprenom" name="ajprenom"
                                        type="text" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Genre</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select col-12" id="ajgenre" name="ajgenre">
                                        <option value="Masculin" selected>Masculin</option>
                                        <option value="Féminin">Féminin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Naissance</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control date-picker" placeholder="Date de naissance" type="text"
                                        id="ajdatenais" name="ajdatenais" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label pt-0">Situation
                                    familiale</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select col-12" id="ajsituation" name="ajsituation">
                                        <option value="Célibataire" selected>Célibataire</option>
                                        <option value="Divorcé">Divorcé</option>
                                        <option value="Marié">Marié</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Nationalité</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="Nationalité" type="text" id="ajnationalite"
                                        name="ajnationalite" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label pt-0">Lieu de naissance</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="Lieu de naissance" type="text"
                                        id="ajLieuNaissance" name="ajLieuNaissance" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">C.N.I.E</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="N° C.N.I.E" type="text" id="ajcin" name="ajcin"
                                        value="" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="msgerrcin"></strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label pt-0">Adresse</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="Adresse" type="text" id="ajadresse"
                                        name="ajadresse" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Téléphone</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" type="tel" placeholder="Téléphone" id="ajtel"
                                        name="ajtel" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label pt-0">E-mail personnel</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" type="email" placeholder="Email" id="ajemail" name="ajemail"
                                        value="" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="msgerrmail"></strong></span>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label pt-0">E-mail
                                    institutionnel</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" id="ajemailins" placeholder="Email institutionnel"
                                        name="ajemailins" value="" type="email" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="msgerrmailins"></strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Spécialité</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" type="text" id="ajspecialite"
                                        placeholder="Spécialité" name="ajspecialite" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Rôle</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select col-12" id="ajrole" name="ajrole">
                                        <option value="1" selected>Professeur</option>
                                        <option value="2">Chef de departement</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="reins();" class="btn btn-secondary"
                                    style="text-decoration: none;">Annuler</button>
                                <input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Affecter un professeur</h4>
                        </div>
                        <hr>
                        <form action="{{ route('AffecterProfesseur') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="affecter">
                            @csrf
                            <input type="hidden" id="depA" name="depA" value="{{ $departement->idDepartement }}">
                            <section>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>professeur :</label>
                                            <select class="custom-select2 form-control" style="width: 100%; height: 38px;"
                                                name="prof" id="prof">
                                                @foreach ($professeurs as $professeur)
                                                    @php
                                                        $check = 0;
                                                    @endphp
                                                    @foreach ($departement->prof_departements as $prof_departement)
                                                        @if ($prof_departement->professeur->idProf == $professeur->idProf)
                                                            @php
                                                                $check++;
                                                                break;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    @if ($check == 0)
                                                        <option value="{{ $professeur->idProf }}">
                                                            {{ $professeur->user->personne->nom . ' ' . $professeur->user->personne->prenom }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right"><input class="btn btn-primary" type="submit" value="Affecter"></div>
                        </form>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="wizard-content">
                        <div>
                            <h4 class="h4">Retirer un professeur</h4>
                        </div>
                        <hr>
                        <form action="{{ route('RetirerProfesseur') }}" class="tab-wizard wizard-circle wizard pl-20"
                            method="POST" id="retirer">
                            @csrf
                            <input type="hidden" id="depD" name="depD" value="{{ $departement->idDepartement }}">
                            <section>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>professeur :</label>
                                            <select class="custom-select2 form-control" name="profdet" id="profdet"
                                                style="width: 100%; height: 38px;" required>
                                                @foreach ($departement->prof_departements as $prof_departement)
                                                    <option value="{{ $prof_departement->professeur->idProf }}">
                                                        {{ $prof_departement->professeur->user->personne->nom . ' ' . $prof_departement->professeur->user->personne->prenom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="text-right"><input class="btn btn-primary" type="submit" value="Retirer"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body" id="modall">
                            <dl class="row" style="padding-left: 20px;">
                                <dt class="col-sm-4">Nom</dt>
                                <dd class="col-sm-8" id="nom"></dd>

                                <dt class="col-sm-4">Prénom</dt>
                                <dd class="col-sm-8" id="prenom"></dd>

                                <dt class="col-sm-4">Genre</dt>
                                <dd class="col-sm-8" id="genre"></dd>

                                <dt class="col-sm-4">Nationalité</dt>
                                <dd class="col-sm-8" id="nationalite"></dd>

                                <dt class="col-sm-4">Lieu de naissance</dt>
                                <dd class="col-sm-8" id="LieuNaissance"></dd>

                                <dt class="col-sm-4">Date de naissance</dt>
                                <dd class="col-sm-8" id="datenais"></dd>

                                <dt class="col-sm-4">Situation familiale</dt>
                                <dd class="col-sm-8" id="situation"></dd>

                                <dt class="col-sm-4">N° C.N.I.E</dt>
                                <dd class="col-sm-8" id="cin"></dd>

                                <dt class="col-sm-4">Adresse</dt>
                                <dd class="col-sm-8" id="adresse"></dd>

                                <dt class="col-sm-4">Téléphone</dt>
                                <dd class="col-sm-8" id="tel"></dd>

                                <dt class="col-sm-4">E-mail personnel</dt>
                                <dd class="col-sm-8" id="email"></dd>

                                <dt class="col-sm-4">E-mail institutionnel</dt>
                                <dd class="col-sm-8" id="emailins"></dd>

                                <dt class="col-sm-4">Spécialité</dt>
                                <dd class="col-sm-8" id="specialite"></dd>

                                <dt class="col-sm-4">role</dt>
                                <dd class="col-sm-8" id="outrole"></dd>

                                <dt class="col-sm-4">Maitéres</dt>
                                <dd class="col-sm-8" id="matieres">
                                </dd>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"
                                onclick="printJS({printable: 'modall',type: 'html', targetStyles: ['*']})"><i
                                    class="fa fa-print"></i>&nbsp;&nbsp;Imprimer</button>
                        </div>
                    </div>
                </div>
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
                                    <form action="{{ route('SupprimerProfesseur') }}" method="POST" id="suppprof">
                                        @csrf
                                        <input type="hidden" id="idProf" name="idProf" value="">
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
            <div class="modal fade bs-example-modal-lg" id="bd-edit-modal" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('updateProfesseur') }}" method="POST" id="updProf">
                            @csrf
                            <input type="hidden" id="inidProf" name="inidProf" value="">
                            <input type="hidden" id="idDepup" name="idDepup" value="{{ $departement->idDepartement }}">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body" id="modall-edit">
                                <div class="pl-2 pr-2">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Nom</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="text" id="innom" name="innom"
                                                placeholder="Nom" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Prénom</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="Prénom" id="inprenom" name="inprenom"
                                                type="text" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Genre</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select class="custom-select col-12" id="ingenre" name="ingenre">
                                                <option value="Masculin" selected>Masculin</option>
                                                <option value="Féminin">Féminin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Naissance</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control date-picker" placeholder="Date de naissance"
                                                type="text" id="indatenais" name="indatenais" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">Situation
                                            familiale</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select class="custom-select col-12" id="insituation" name="insituation">
                                                <option value="Célibataire" selected>Célibataire</option>
                                                <option value="Divorcé">Divorcé</option>
                                                <option value="Marié">Marié</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Nationalité</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="Nationalité" type="text"
                                                id="innationalite" name="innationalite" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">Lieu de naissance</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="Lieu de naissance" type="text"
                                                id="inLieuNaissance" name="inLieuNaissance" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">C.N.I.E</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="N° C.N.I.E" type="text" id="incin"
                                                name="incin" value="" required>
                                            <span class="invalid-feedback pl-2" role="alert"> <strong
                                                    style="font-family:'Inter',sans-serif; font-weight: 400;"
                                                    id="msgerrincin"></strong></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">Adresse</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="Adresse" type="text" id="inadresse"
                                                name="inadresse" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Téléphone</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="" type="tel" id="intel" name="intel"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">E-mail personnel</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="" type="email" id="inemail" name="inemail"
                                                required>
                                            <span class="invalid-feedback pl-2" role="alert"> <strong
                                                    style="font-family:'Inter',sans-serif; font-weight: 400;"
                                                    id="msgerrinmail"></strong></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">E-mail
                                            institutionnel</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="" id="inemailins" name="inemailins"
                                                type="email" required>
                                            <span class="invalid-feedback pl-2" role="alert"> <strong
                                                    style="font-family:'Inter',sans-serif; font-weight: 400;"
                                                    id="msgerrinmainins"></strong></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Spécialité</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="" type="text" id="inspecialite"
                                                name="inspecialite" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">role</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select class="custom-select col-12" id="role" name="role">
                                                <option value="1" selected>Professeur</option>
                                                <option value="2">Chef de departement</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-secondary"
                                    style="text-decoration: none;" onclick="reinsupd()">Annuler</button>
                                <input class="btn btn-primary" type="submit" value="Enregistrer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">
                            <h3 class="mb-20 pt-5" id="msg"></h3>
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
    <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendors/scripts/admin/profs.js') }}"></script>
@endsection
