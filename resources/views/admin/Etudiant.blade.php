@extends('layouts.prof')
@section('title', "$filiere->nom $filiere->niveau")
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box pb-10">
                    <div class="pd-20">
                        <h4 class="text-blue h4">{{ $filiere->nom . ' ' . $filiere->niveau }}</h4>
                    </div>
                    <div class="pb-20">
                        <table class="table hover multiple-select-row data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th>N° Apogée</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Code Massar</th>
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
                        <form action="{{ route('AjouterEtudiant') }}" method="POST" id="ajoutetud">
                            @csrf
                            <input type="hidden" id="idFiliere" name="idFiliere" value="{{ $filiere->idFiliere }}">
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
                                <label class="col-sm-12 col-md-2 col-form-label">Code Apogée</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" id="ajapogee" placeholder="Apogée" name="ajapogee"
                                        type="number" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="msgerrapog"></strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Code Massar</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" id="ajcne" name="ajcne" placeholder="CNE"
                                        type="text" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="msgerrcne"></strong></span>
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
                                <label class="col-sm-12 col-md-2 col-form-label">C.N.I.E(père)</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="N° C.N.I.E du père" type="text" id="ajcinpere"
                                        name="ajcinpere" value="" required>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">C.N.I.E(mère)</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="N° C.N.I.E de la mère" type="text"
                                        id="ajcinmere" name="ajcinmere" value="" required>
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
                                    <input class="form-control" value="" type="email" placeholder="Email" id="ajemail"
                                        name="ajemail" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="msgerrmail"></strong></span>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label pt-0">E-mail
                                    institutionnel</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" id="ajemailins" placeholder="Email institutionnel"
                                        name="ajemailins" type="email" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="msgerrmailins"></strong></span>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Année du BAC</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" type="number" placeholder="Année du BAC" min="2015"
                                        id="ajannebac" name="ajannebac" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Couverture
                                    médicale</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="Couverture médicale" type="text" id="ajcouv"
                                        name="ajcouv" value="" required>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="reins()" class="btn btn-secondary"
                                    style="text-decoration: none;">Annuler</button>
                                <input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
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

                        <dt class="col-sm-4">Code Apogée</dt>
                        <dd class="col-sm-8" id="apogee"></dd>

                        <dt class="col-sm-4">CNE / Code Massar</dt>
                        <dd class="col-sm-8" id="cne"></dd>

                        <dt class="col-sm-4">Genre</dt>
                        <dd class="col-sm-8" id="genre"></dd>

                        <dt class="col-sm-4">Date de naissance</dt>
                        <dd class="col-sm-8" id="datenais"></dd>

                        <dt class="col-sm-4">Situation familiale</dt>
                        <dd class="col-sm-8" id="situation"></dd>

                        <dt class="col-sm-4">Nationalité</dt>
                        <dd class="col-sm-8" id="nationalite"></dd>

                        <dt class="col-sm-4">Lieu de naissance</dt>
                        <dd class="col-sm-8" id="LieuNaissance"></dd>

                        <dt class="col-sm-4">N° C.N.I.E</dt>
                        <dd class="col-sm-8" id="cin"></dd>

                        <dt class="col-sm-4">N° C.N.I.E du père</dt>
                        <dd class="col-sm-8" id="cinpere"></dd>

                        <dt class="col-sm-4">N° C.N.I.E de la mère</dt>
                        <dd class="col-sm-8" id="cinmere"></dd>

                        <dt class="col-sm-4">Adresse </dt>
                        <dd class="col-sm-8" id="adresse"></dd>

                        <dt class="col-sm-4">Téléphone</dt>
                        <dd class="col-sm-8" id="tel"></dd>

                        <dt class="col-sm-4">E-mail personnel</dt>
                        <dd class="col-sm-8" id="email"></dd>

                        <dt class="col-sm-4">E-mail institutionnel</dt>
                        <dd class="col-sm-8" id="emailins"></dd>

                        <dt class="col-sm-4">Année du BAC</dt>
                        <dd class="col-sm-8" id="annebac"></dd>

                        <dt class="col-sm-4">Couverture médicale</dt>
                        <dd class="col-sm-8" id="couv"></dd>

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
                            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-times"></i></button>
                            NON
                        </div>
                        <div class="col-6">
                            <form action="{{ route('SupprimerEtudiantAdmin') }}" method="POST" id="suppetud">
                                @csrf
                                <input type="hidden" id="idEtudiant" name="idEtudiant" value="">
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
                <form action="{{ route('updateEtudiantAdmin') }}" method="POST" id="updEtud">
                    @csrf
                    <input type="hidden" id="inIdEtudiant" name="inIdEtudiant">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" id="modall-edit">
                        <div class="pl-2 pr-2">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Nom</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" type="text" id="innom" name="innom" placeholder="Nom"
                                        value="" required>
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
                                <label class="col-sm-12 col-md-2 col-form-label">Code Apogée</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" id="inapogee" name="inapogee" type="number"
                                        required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="inmsgerrapog"></strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Code Massar</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" id="incne" name="incne" type="text" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="inmsgerrcne"></strong></span>
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
                                    <input class="form-control date-picker" placeholder="Date de naissance" type="text"
                                        id="indatenais" name="indatenais" value="" required>
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
                                    <input class="form-control" placeholder="Nationalité" type="text" id="innationalite"
                                        name="innationalite" value="" required>
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
                                    <input class="form-control" placeholder="N° C.N.I.E" type="text" id="incin" name="incin"
                                        value="" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="inmsgerrcin"></strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">C.N.I.E(père)</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="N° C.N.I.E du père" type="text" id="incinpere"
                                        name="incinpere" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">C.N.I.E(mère)</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="N° C.N.I.E de la mère" type="text"
                                        id="incinmere" name="incinmere" value="" required>
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
                                    <input class="form-control" value="" type="tel" id="intel" name="intel" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label pt-0">E-mail personnel</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" type="email" id="inemail" name="inemail" required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="inmsgerrmail"></strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label pt-0">E-mail
                                    institutionnel</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" id="inemailins" name="inemailins" type="email"
                                        required>
                                    <span class="invalid-feedback pl-2" role="alert"> <strong
                                            style="font-family:'Inter',sans-serif; font-weight: 400;"
                                            id="inmsgerrmailins"></strong></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Année du BAC</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" value="" type="number" min="2015" id="inannebac"
                                        name="inannebac" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label pt-0">Couverture
                                    médicale</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" placeholder="Couverture médicale" type="text" id="incouv"
                                        name="incouv" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary" style="text-decoration: none;"
                            onclick="reinsup()">Annuler</button>
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
                    <h3 class="mb-20 pt-5">Etudiant est ajouté!</h3>
                    <div class="mb-30 text-center"><img src="{{ asset('vendors/images/success.png') }}"></div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" onclick="ren()" data-dismiss="modal">terminer</button>
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
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendors/scripts/admin/etudiants.js') }}"></script>
@endsection
