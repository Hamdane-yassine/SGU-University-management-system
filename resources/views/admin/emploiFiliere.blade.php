@extends('layouts.app')
@section('title', 'Gestion des emplois')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">les emplois du temps des filieres : </h4>
                    </div>
                    <div class="pb-20">
                        <table class="emploi_des_filieres table hover nowrap">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom du fichier</th>
                                    <th>Filière</th>
                                    <th>Niveau</th>
                                    <th>Date de dernière modification</th>
                                    <th class="datatable-nosort"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    @endsection
    @section('SpecialScripts')
        <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>
        <script src="{{ asset('vendors/scripts/admin/emploifilieres.js') }}"></script>
    @endsection
