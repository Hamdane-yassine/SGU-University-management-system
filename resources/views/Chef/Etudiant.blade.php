@extends('layouts.prof')
@section('title',"$filiere->nom $filiere->niveau")
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">{{ $filiere->nom.' '.$filiere->niveau }}</h4>
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
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAooNE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" data-toggle="modal"
                                                data-target="#confirmation-modal" type="button"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-plus">19020547</td>
                                    <td>HAMDANE</td>
                                    <td>YASSINE</td>
                                    <td>&nbsp;J136461372</td>
                                    <td>amirnet001@gmail.com</td>
                                    <td>0672387235</td>
                                    <td>
                                        <div class="table-actions pl-1">
                                            <a href="#" data-color="#265ed7" data-toggle="modal"
                                                data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="dropdown-item" style="background-color:transparent;" href="#"
                                            data-toggle="modal" data-target="#bd-example-modal-lg"><i
                                                class="dw dw-eye"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                                <dd class="col-sm-8">HAMDANE</dd>

                                <dt class="col-sm-4">Prénom</dt>
                                <dd class="col-sm-8">YASSINE</dd>

                                <dt class="col-sm-4">Code Apogée</dt>
                                <dd class="col-sm-8">19020547</dd>

                                <dt class="col-sm-4">CNE / Code Massar</dt>
                                <dd class="col-sm-8">J136461372</dd>

                                <dt class="col-sm-4">Genre</dt>
                                <dd class="col-sm-8">Masculin</dd>

                                <dt class="col-sm-4">Date de naissance</dt>
                                <dd class="col-sm-8">16/02/2001</dd>

                                <dt class="col-sm-4">Situation familiale</dt>
                                <dd class="col-sm-8">Célibataire</dd>

                                <dt class="col-sm-4">Nationalité</dt>
                                <dd class="col-sm-8">MAROCAIN(E)</dd>

                                <dt class="col-sm-4">Lieu de naissance</dt>
                                <dd class="col-sm-8">RABAT</dd>

                                <dt class="col-sm-4">N° C.N.I.E</dt>
                                <dd class="col-sm-8">AE293178</dd>

                                <dt class="col-sm-4">N° C.N.I.E du père</dt>
                                <dd class="col-sm-8">E322801</dd>

                                <dt class="col-sm-4">N° C.N.I.E de la mère</dt>
                                <dd class="col-sm-8">AB306235</dd>

                                <dt class="col-sm-4">Adresse </dt>
                                <dd class="col-sm-8">RES ELBOUSTANE IMM G11 APT 33 LOT SAID HAJJI SALE</dd>

                                <dt class="col-sm-4">Téléphone</dt>
                                <dd class="col-sm-8">0672387235</dd>

                                <dt class="col-sm-4">E-mail personnel</dt>
                                <dd class="col-sm-8">amirnet001@gmail.com</dd>

                                <dt class="col-sm-4">E-mail institutionnel</dt>
                                <dd class="col-sm-8">yassine_hamdane@um5.ac.ma</dd>

                                <dt class="col-sm-4">Année du BAC</dt>
                                <dd class="col-sm-8">2019</dd>

                                <dt class="col-sm-4">Couverture médicale</dt>
                                <dd class="col-sm-8">Aucune couverture</dd>

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
                                    <button type="button"
                                        class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                        data-dismiss="modal"><i class="fa fa-check"></i></button>
                                    OUI
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
                        <form>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body" id="modall-edit">
                                <div class="pl-2 pr-2">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Nom</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" type="text" placeholder="Nom" value="HAMDANE">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Prénom</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="Prénom" type="text"
                                                value="YASSINE">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Code Apogée</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="19020547" type="number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Code Massar</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="J136461372" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Genre</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select class="custom-select col-12">
                                                <option value="1" selected>Masculin</option>
                                                <option value="2">Féminin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Naissance</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control date-picker" placeholder="Date de naissance"
                                                type="text" value="16/02/2001">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">Situation
                                            familiale</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select class="custom-select col-12">
                                                <option value="1" selected>Célibataire</option>
                                                <option value="2">Divorcé</option>
                                                <option value="3">Marié</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Nationalité</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="Nationalité" type="text"
                                                value="MAROCAIN(E)">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">Lieu de naissance</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="Lieu de naissance" type="text"
                                                value="RABAT">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">C.N.I.E</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="N° C.N.I.E" type="text"
                                                value="AE293178">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">C.N.I.E(père)</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="N° C.N.I.E du père" type="text"
                                                value="E322801">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">C.N.I.E(mère)</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="N° C.N.I.E de la mère" type="text"
                                                value="AB306235">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">Adresse</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="Adresse" type="text"
                                                value="RES ELBOUSTANE IMM G11 APT 33 LOT SAID HAJJI SALE">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Téléphone</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="0672387235" type="tel">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">E-mail personnel</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="amirnet001@gmail.com" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">E-mail
                                            institutionnel</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="yassine_hamdane@um5.ac.ma" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Année du BAC</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" value="2019" type="number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label pt-0">Couverture
                                            médicale</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input class="form-control" placeholder="Couverture médicale" type="text"
                                                value="Aucune couverture">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-secondary" style="text-decoration: none;">Annuler</button>
                                <input class="btn btn-primary" type="submit" value="Enregistrer">
                            </div>
                        </form>
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
    <script src="vendors/scripts/print.min.js"></script>
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <!-- buttons for Export datatable -->
    <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
    <!-- Datatable Setting js -->
    <script src="vendors/scripts/datatable-setting.js"></script>
    <!-- add sweet alert js & css in footer -->
    <script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="src/plugins/sweetalert2/sweet-alert.init.js"></script>
    @endsection