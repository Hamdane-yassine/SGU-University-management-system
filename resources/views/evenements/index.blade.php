@extends('layouts.app')
@section('title','Evenements')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            @can('create', App\Models\Evenement::class)
                            <a href="{{ route('evenement.create') }}">
                                <div class="pull-right fa-2x">
                                    <small class="pt-3"><i class="fa fa-plus"></i></small>
                                </div>
                            </a>
                            @endcan
                            <h4>Evènementss</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Tableau de bord</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Evènementss</li>
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
                                    @if($evenements->count())
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
                                                            @cannot('update', $evenement)
                                                            <a href="{{ url('/evenement/' . $evenement->idEvenement ) }}" class="btn btn-outline-primary">Détails</a>
                                                            @endcannot
                                                            @can('update', $evenement)
                                                            <div class="dropdown mt-10 justify-between">
                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-danger" href="#" role="button" data-toggle="dropdown">
                                                                    <i class="dw dw-more"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                    <a class="dropdown-item" href="{{ route('evenement.show',$evenement) }}"><i class="dw dw-eye"></i> Détailes</a>
                                                                    <a class="dropdown-item" href="{{ route('evenement.edit',$evenement) }}"><i class="dw dw-edit2"></i> Editer</a>
                                                                    <a class="dropdown-item" href="{{ route('evenement.delete',$evenement) }}"><i class="dw dw-delete-3"></i> Supprimer</a>
                                                                </div>
                                                            </div>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @else
                                    <li>
                                        <div class="chat-body clearfix ml-3">
                                            <p style="word-wrap: break-word"><span class="d-block text-secondary pb-1">
                                            </span class="align-self-center" ><i class="fa fa-info-circle mr-1"></i>Aucun évènements n'est trouvé pour le moment</span>
                                            <div class="chat_time float-right mb-10"> </div>
                                        </div>
                                    </li>
                                    @endif
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
                                <h5 class="pd-20 h5 mb-0">Les évènements les plus récents</h5>
                                <div class="latest-post">
                                    <ul>
                                        @if(\App\Models\Evenement::first())
                                            @foreach (\App\Models\Evenement::all()->take(6) as $evt)
                                            <li>
                                                <h4><a href="{{ url('/evenement/'.$evt->idEvenement) }}">{{ $evt->titre }}</a></h4>
                                                <p class="caption" style="word-break:break-all">{{ Str::substr($evt->resume,0,50) }}...</p>
                                                <span>{{ $evt->date->format('Y M D') }}</span>

                                            </li>
                                            @endforeach
                                        @else
                                        <div class="chat-body clearfix ml-3">
                                            <p style="word-wrap: break-word"><span class="d-block text-secondary pb-1">
                                            </span class="align-self-center" ><i class="fa fa-info-circle mr-1"></i>Aucun évènements n'est trouvé pour le moment</span>
                                            <div class="chat_time float-right mb-10"> </div>
                                        </div>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
