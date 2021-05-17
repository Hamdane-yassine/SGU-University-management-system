@extends('layouts.app')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <a href="{{ route('evenement.create') }}"><mtext class="pull-right pt-3 fa-2x fa fa-plus"></mtext></a>
                            <h4>Blog</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="blog-wrap">
                <div class="container pd-0">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="blog-list">
                                <ul>
                                    @foreach ($evenements as $evenement )
                                        <li>
                                            <div class="row no-gutters">
                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="blog-img">
                                                        @if($evenement->headingImg != null)
                                                            <img src="{{ url('/storage/'.$evenement->headingImg) }}" alt="" class="bg_img">
                                                        @else <img src="{{ asset('vendors/images/event-default.jpg') }}" alt="" class="bg_img">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-12 col-sm-12">
                                                    <div class="blog-caption">
                                                        <h4><a href="{{ url('/evenement/' . $evenement->idEvenement ) }}">{{ $evenement->titre }}</a></h4>
                                                        <div class="blog-by" style="word-break: break-all">
                                                            <p>{{ $evenement->resume }}</p>
                                                                <div class="pt-10">
                                                                    <a href="{{ url('/evenement/' . $evenement->idEvenement ) }}" class="btn btn-outline-primary">Détails</a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="blog-pagination">
                                <div class="btn-toolbar justify-content-center mb-15">
                                    {{ $evenements->links("pagination::bootstrap-4") }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card-box mb-30">
                                <h5 class="pd-20 h5 mb-0">Les évenemenets les plus récents</h5>
                                <div class="latest-post">
                                    <ul>
                                        @foreach (\App\Models\Evenement::all()->take(6) as $evt)
                                        <li>
                                            <a href="{{ url('/evenement/'.$evt->idEvenement) }}">{{ $evt->titre }}
                                                <p class="caption">{{ Str::substr($evt->resume,0,50) }}... <small class="pull-right">{{ $evt->date }}</small></p>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div> --}}
    </div>
</div>
@endsection
