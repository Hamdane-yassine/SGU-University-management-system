@extends('layouts.prof')
@section('title','Absences')
@section('content')
    <div class="main-container">

        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <h4 class="text-blue h4">Table d'absence</h4>
                        <p class="mb-26"></p>
                    </div>
                    <table class="data-table table nowrap">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Matiére</th>
                                <th>Filière</th>
                                <th>Nom du professeur</th>
                                <th>Date d'absence</th>
                                <th>État</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>PL SQL</td>
                                <td>Génie logiciel 2</td>
                                <td>Abd Ali lasfar</td>
                                <td>27 April 2021 11:55 am</td>
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5"
                                        data-color="green">Rattrapé</span>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>SQL SOUS ORACLE</td>
                                <td>Administration reseaux informatique 1</td>
                                <td>Abd rahim qadi</td>
                                <td>16 April 2021 08:55 am</td>
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#c2a502">En
                                        attend</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>JAVA AVANCE</td>
                                <td>Génie logiciel 2</td>
                                <td>Khadija bousdig</td>
                                <td>30 April 2021 04:55 pm</td>
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5"
                                        data-color="green">Rattrapé</span>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>SQL SOUS ORACLE</td>
                                <td>Administration reseaux informatique 1</td>
                                <td>Abd Ali lasfar</td>
                                <td>27 April 2021 11:55 am</td>
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#c2a502">En
                                        attend</span>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>PL SQL</td>
                                <td>Génie logiciel 2</td>
                                <td>Khadija bousdig</td>
                                <td>16 April 2021 08:55 am</td>
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5"
                                        data-color="green">Rattrapé</span>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>PL SQL</td>
                                <td>Génie logiciel 2</td>
                                <td>Abd Ali lasfar</td>
                                <td>16 April 2021 08:55 am</td>
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5"
                                        data-color="green">Rattrapé</span>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>JAVA AVANCE</td>
                                <td>Génie logiciel 2</td>
                                <td>Abd rahim qadi</td>
                                <td>27 April 2021 11:55 am</td>
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#c2a502">En
                                        attend</span>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>PL SQL</td>
                                <td>Génie logiciel 2</td>
                                <td>Khadija bousdig</td>
                                <td>16 April 2021 08:55 am</td>
                                <td><span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#c2a502">En
                                        attend</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="footer-wrap pd-20 mb-20 card-box">
                    DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit
                        Hingarajiya</a>
                </div>
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
        <!-- Datatable Setting js -->
        <script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>
    @endsection
