@extends('layouts.app')
@section('title',"$evenement->titre")
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>{{ $evenement->titre }}</h4>
                            @can('update', $evenement)
                            <mtext class="pull-right">
                                <div class="dropdown mt-10 justify-between">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-danger" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('evenement.edit',$evenement) }}"><i class="dw dw-edit2"></i> Editer</a>
                                        <a class="dropdown-item" href="{{ route('evenement.delete',$evenement) }}"><i class="dw dw-delete-3"></i> Supprimer</a>
                                    </div>
                                </div>
                            </mtext>
                            @endcan
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Tableau de bord</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('evenement.index') }}">Evénements</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $evenement->titre }}</li>
                            </ol>
                        </nav>
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
                                    @if(!empty($attachments[0]))
                                    <form method="GET" action="{{ route('evenement.download', $evenement->idEvenement) }}">
                                        <div class="form-group">
                                            <button type="submit" id="download" type="button" class="btn btn-success">
                                                télécharger les fichiers <i class="fa fa-download" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card-box mb-30">
                                <h5 class="pd-20 h5 mb-0">Les évènements les plus récents</h5>
                                {{-- where('id_chef','<>',Auth::user()->ID_chef) --}}
                                @foreach (\App\Models\Evenement::where('idEvenement','<>',request()->idEvenement)->orderBy('created_at','DESC')->take(5)->get() as $evt)
                                    <div class="latest-post pd-1">
                                        <ul class="card">
                                            <li>
                                                <h4><a href="{{ url('/evenement/'.$evt->idEvenement) }}">{{ $evt->titre }}</a></h4>
                                                <p class="caption break-all">{{ Str::substr($evt->resume, 0, 50) }}</p>
                                                <span>{{ $evt->date->format('Y M D') }}</span>
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
