@extends('layouts.app')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>{{ $evenement->titre }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-wrap pb-0">
                <div class="container pd-1">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="blog-detail card-box overflow-hidden mb-30">
                                @if($headingImg)
                                    @if($headingImg)
                                        <div class='blog-img'><img src="/storage/{{ $headingImg }}" alt=""></div>
                                    @endif
                                @endif
                                <div class="blog-caption card">
                                    <div class="blog-caption">
                                        {!! $evenement->html !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class=" overflow-hidden mb-30">
                                    @if($attachments)
                                    <form method="GET" action="{{ route('evenement.download', $evenement->idEvenement) }}">
                                        <button type="submit" id="download" type="button" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
                                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
                                            </svg>
                                            Telecharger les fichers
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card-box mb-30">
                                <h5 class="pd-20 h5 mb-0">les evenement les plus recents</h5>
                                {{-- where('id_chef','<>',Auth::user()->ID_chef) --}}
                                @foreach (\App\Models\Evenement::all()->take(6) as $evt)
                                    <div class="latest-post pd-1">
                                        <ul class="card">
                                            <li>
                                                <h4><a href="{{ url('/evenement/'.$evt->idEvenement) }}">{{ $evt->titre }}</a></h4>
                                                <p class="caption">{{ $evt->resume }}</p>
                                                <span>{{ $evt->date }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
@section('SpecialScripts')
<script>

        // $('#download').click(function(e) {
        //     // e.preventDefault();
        //     // @foreach ($attachments as $file)
        //     //     window.open(window.URL+'/storage',blank_);

        //     // @endforeach

        // });
</script>
@endsection
