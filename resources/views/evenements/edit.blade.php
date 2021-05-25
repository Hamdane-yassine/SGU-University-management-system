@extends('layouts.app')
@section('title','modifier')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Evénements</h4>
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

                {{-- ======== START ============== --}}
                <!-- horizontal Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Ajouter un événement</h4>
                            <p class="mb-30">remplire les champs nécessaires</p>
                        </div>
                    </div>
                    <form id="evtform" method="POST" action="{{ route('evenement.update',$evenement) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group ">
                                <label >Date d'événement</label>
                                <input class="form-control date-picker @error('date') is-invalid @enderror"
                                       placeholder="Date d'evenement"
                                       id="date"
                                       name="date"
                                       value="{{ $evenement->date }}" required>
                        </div>
                        @error('date')
                            <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                            </span>
                        @enderror

                        <div class="form-group">
                            <label>Titre</label>
                            <input id="titre" class="form-control @error('titre')  is-invalid @enderror" type="text"
                                name="titre" value="{{ $evenement->titre }}" placeholder="Titre" required>
                            @error('titre')
                                <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Resumé</label>
                            <textarea id="resume" class="form-control @error('resume') is-invalid @enderror " name="resume"
                                form="evtform" required>{{ $evenement->resume }}</textarea>
                            @error('resume')
                                <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="html-editor mb-30">
                                <h4 class="h4 text-blue">Corps</h4>
                                <p>Ajouter le corps d'évenement</p>
                                <textarea id="corps" name="corps"
                                    class="textarea_editor form-control border-radius-0 @error('corps') is-invalid @enderror"
                                    type="text"
                                    form="evtform">{{ $evenement->html }}</textarea>
                            </div>
                            @error('corps')
                                <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Image d'entête</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="">ajouter une image d'entête</label>
                                <input id="" name="headingImg" type="file"
                                    class="custom-file-input @error('headingImg') is-invalid @enderror"
                                    accept="image/*" >
                            </div>
                            @error('headingImg')
                                <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Pièces jointe</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="attachments">Ajouter des fichiers (max 3)</label>
                                <input id="attachments" name="attachments[]" type="file"
                                    class="custom-file-input @error('attachments') is-invalid @enderror" multiple>
                            </div>
                            @error('attachments')
                                <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="formFileMultiple" class="form-label">Multiple files input example</label>
                            <input class="form-control" type="file" id="formFileMultiple" multiple />
                        </div> --}}
                        <div class="form-group">
                            <input class="btn btn-primary pull-right row-cols-xl-1" type="submit" value="Valider ">
                            <br>
                        </div>
                    </form>
                </div>
                <!-- horizontal Basic Forms End -->
                @include('layouts.footer')
            </div>
        </div>
    </div>
@endsection
<!-- js -->
@section('SpecialScripts')

    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
    <script>
    </script>
@endsection
