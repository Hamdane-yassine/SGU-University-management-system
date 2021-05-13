@extends('layouts.prof')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Form</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Form</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                January 2018
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Export List</a>
                                <a class="dropdown-item" href="#">Policies</a>
                                <a class="dropdown-item" href="#">View Assets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ======== START ============== --}}
                <!-- horizontal Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">horizontal Basic Forms</h4>
							<p class="mb-30">All bootstrap element classies</p>
						</div>
					</div>
					<form id="evtform" method="POST" action="/evenement/store" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group ">
                                <label >Date d'evenement</label>
                                <input class="form-control date-picker @error('date') is-invalid @enderror"
                                       placeholder="Date d'evenement" type="text"
                                       id="date"
                                       name="date"
                                       value="{{ old('date') }}" required>
                        </div>
                        @error('date')
                                    <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                </span>
                        @enderror

						<div class="form-group">
							<label>Titre</label>
							<input id="titre"
                                   class="form-control @error('titre')  is-invalid @enderror"
                                   type="text"
                                   name="titre"
                                   value="{{ old('titre') }}"
                                   placeholder="Titre" required>
                            @error('titre')
                                    <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
						</div>
						<div class="form-group">
							<label>Resumé</label>
							<textarea id="resume"
                                      class="form-control @error('resume') is-invalid @enderror "
                                      name="resume"
                                      form="evtform"
                                      required >{{ old('resume') }}</textarea>
                            @error('resume')
                                    <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
						</div>
                        <div class="form-group">
                            <div class="html-editor mb-30">
                                <h4 class="h4 text-blue">Corps</h4>
                                <p>Ajouter le corp d'évenement</p>
                                <textarea id="corps"
                                          name="corps"
                                          class="textarea_editor form-control border-radius-0 @error('corps') is-invalid @enderror"
                                          form="evtform"
                                          required>{{ old('corps')}}</textarea>
                            </div>
                            @error('htmlEditor')
                                    <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>attachments</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="attachments">ajouter des fichiers (max 3 avec image headingImg.*)</label>
                                <input id="attachments"
                                       name="attachments[]"
                                       type="file"
                                       class="custom-file-input @error('attachments') is-invalid @enderror"
                                       multiple>
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
            </div>
    </div>
</div>
@endsection
<!-- js -->
@section('SpecialScripts')

<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
<script>
    // $(function(){
    //         $("input[type = 'submit']").click(function(){
    //            var $fileUpload = $("input[type='file']");
    //            if (parseInt($fileUpload.get(0).files.length) > 3){
    //               alert("You are only allowed to upload a maximum of 3 files");
    //            }
    //         });
    //     });
</script>
@endsection

