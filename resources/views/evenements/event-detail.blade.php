@extends('layouts.prof')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Blog Detail</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-wrap">
                <div class="container pd-1">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="blog-detail card-box overflow-hidden mb-30">
                                {{-- @if($evenement->attachments))
                                    @php



                                        // $matches = preg_match('/.(jpg|jpeg|png|gif)/i',$evenement->attachments);
                                        // if($matches)
                                        //     public_path('evenements\\'.$evenement->idEvenement.'$evenement->attachments[]'); ?>{{  }}

                                    @endphp
                                    <div class="blog-img">
                                        <img src="" alt="">
                                    </div>
                                @endif --}}
                                <div class="blog-caption card">
                                    <div class="blog-caption">
                                        {!! $evenement->html !!}
                                    </div>
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
        </div>
    </div>
</div>
@endsection
