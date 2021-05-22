@extends('layouts.app')
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
                @include('layouts.footer')
            </div>
        </div>
    </div>
    @endsection
