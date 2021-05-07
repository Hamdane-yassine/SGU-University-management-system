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
					<form>
						<div class="form-group">
							<label>Titre</label>
							<input class="form-control" type="text" placeholder="Johnny Brown">
						</div>
						<div class="form-group">
							<label>Resumé</label>
							<textarea class="form-control"></textarea>
						</div>
                        <div class="form-group">
                            <label>Attachements</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" multiple >
                                <label class="custom-file-label">ajouter des fichiers</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="html-editor pd-20 card-box mb-30">
                                <h4 class="h4 text-blue">Corps</h4>
                                <p>Ajouter le corp d'évenement</p>
                                <textarea class="textarea_editor form-control border-radius-0" placeholder="Enter le text ..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary pull-right" type="submit" value="Valider ">
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
    $(function(){
            $("input[type = 'submit']").click(function(){
               var $fileUpload = $("input[type='file']");
               if (parseInt($fileUpload.get(0).files.length) > 3){
                  alert("You are only allowed to upload a maximum of 3 files");
               }
            });
         });
</script>
@endsection

