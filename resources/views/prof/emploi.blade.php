@extends('layouts.prof')
@section('title','Emploi du temps')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        @if( $Mine == 'true')
                            <h4 class="text-blue h4">Mon Emploi du temps</h4>
                        @elseif ($Mine == 'false')
                            <h4 class="text-blue h4">Emploi du temps :</h4>
                        @endif
                        <!-- get file name from database based on the name of the professor-->
                        <!-- assuming here that the name of the current prof is : lasfar -->

                            @if( $path_to_file != 'notFound')
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ $path_to_file }}"> </iframe> <!-- pdf reader -->
                                </div>
                            @else
                                <p>Emploi non trouvé , peut-être qu'il n'y a pas encore d'entrées d'emploi.</p>
                            @endif

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
    <!-- buttons for Export datatable -->
    <script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.printprint.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>

    <script src="{{ asset('vendors/scripts/printThis.js') }}"></script>
    <script src="{{ asset('vendors/scripts/print.min.js') }}"></script>
    @endsection
