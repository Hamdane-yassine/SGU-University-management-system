@extends('layouts.prof')
@section('content')
    @section('SpecialStyles')
        <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/cropperjs/dist/cropper.css') }}">
    @endsection
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4>Profile</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @can('update',$profile)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    @else
                    <div class="col-sm-12 mb-30">
                    @endcan
                        <div class="pd-20 card-box height-100-p">
                            <div class="profile-photo">
                                <img src="{{ url($croppedImage) }}" style="" alt="" class="avatar-photo">
                                @can('update',$profile)
                                    <a href="modal" style="r" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body pd-5">
                                                    <div class="img-container">
                                                        <img id="image" src="{{ url($imagePath) }}" alt="Picture">
                                                    </div>
                                                </div>
                                                <div class="modal-footer ">
                                                    <div class="row col-sm">
                                                        <form id="formPhoto" name="formPhoto"  enctype="multipart/form-data" hidden>@csrf</form>
                                                        <input form="formPhoto" id="imgUpload" type="file" accept="image/*" value="import" hidden>
                                                        <input type="submit" value="Import" class="btn btn-success col-sm mr-2">
                                                        <input type="submit" value="Update" class="btn btn-primary col-sm mr-2">
                                                        <button id="modal-close" type="button" class="btn btn-default col-sm" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                            <h5 class="text-center h5 mb-0">{{ $nomPrenom }}</h5>
                            {{-- <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p> --}}
                            @can('update',$profile)
                            <div class="profile-info">
                            @else
                            <div class="profile-info text-center">
                            @endcan
                                <h5 class="mb-20 h5 text-blue">Informations de contact</h5>
                                <ul>
                                    <li>
                                        <span>Adresses email:</span>
                                        <ul>
                                            <li>
                                                <span class="ml-1">Institutionel:</span>{{ $personne->emailInstitutionne }}
                                            </li>
                                            <li>
                                                <span class="ml-1">Personnel:</span>{{ $personne->user->email }}
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span>Numero de telephone:</span>
                                        {{ $personne->tel }}
                                    </li>
                                    <li>
                                        <span>nationalité:</span>
                                        {{ $personne->nationalite }}
                                    </li>
                                    <li>
                                        <span>Adresse:</span>
                                        {{ $personne->adressePersonnele }}
                                    </li>
                                </ul>
                            </div>
                            <div class="profile-social">
                                <h5 class="mb-20 h5 text-blue">Reseau sociaux</h5>
                                <ul class="clearfix">
                                    <li><a href="{{ $profile->facebook }}" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);"><i class="fa fa-facebook"></i></a></li>
                                    {{-- <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(29, 161, 242);"><i class="fa fa-twitter"></i></a></li> --}}
                                    <li><a href="{{ $profile->linkedin }}" class="btn" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);"><i class="fa fa-linkedin"></i></a></li>
                                    {{-- <li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(195, 35, 97);"><i class="fa fa-dribbble"></i></a></li> --}}
                                    {{-- <li><a href="{{ $profile- }}" class="btn" data-bgcolor="#3d464d" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(61, 70, 77);"><i class="fa fa-dropbox"></i></a></li> --}}
                                    {{-- <li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(219, 68, 55);"><i class="fa fa-google-plus"></i></a></li> --}}
                                    <li><a href="{{ $profile->skype }}" class="btn" data-bgcolor="#00aff0" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 175, 240);"><i class="fa fa-skype"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @can('update', $profile)
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <ul class="nav nav-tabs customtab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#setting">Info personnel</a>
                                        </li>
                                        <li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#passwd" role="tab">Mot de passe</a>
										</li>
                                    </ul>
                                    <div class="tab-content">
                                        <!-- Setting Tab start -->
                                        <div class="tab-pane active height-100-p" id="setting" role="tabpanel">
                                            <div class="profile-setting">
                                                <form method="POST" action="{{ route('profile.update', $profile) }}">
                                                    @csrf
                                                    <ul class="profile-edit-list row">
                                                        <li class="weight-500 col-md-6">
                                                            <h4 class="text-blue h5 mb-20">Modifier vos informations</h4>
                                                            {{-- <div class="form-group">
                                                                <label>Title</label>
                                                                <input class="form-control form-control-lg" type="text">
                                                            </div> --}}
                                                            <div class="form-group">
                                                                <label>Email personnel</label>
                                                                <input
                                                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                                    name="email"
                                                                    type="email">
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <label>Date de naissance</label>
                                                                <input class="form-control form-control-lg date-picker" type="text" readonly>
                                                            </div> --}}
                                                            {{-- <div class="form-group">
                                                                <label>Gender</label>
                                                                <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                                    <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                                                    <label class="custom-control-label weight-400" for="customRadio4">Male</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                                                    <label class="custom-control-label weight-400" for="customRadio5">Female</label>
                                                                </div>
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="form-group">
                                                                <label>Country</label>
                                                                <div class="dropdown bootstrap-select form-control form-control-lg">
                                                                    <select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen" tabindex="-98"><option class="bs-title-option" value=""></option>
                                                                        <option>United States</option>
                                                                        <option>India</option>
                                                                        <option>United Kingdom</option>
                                                                    </select>
                                                                    <button type="button" class="btn dropdown-toggle btn-outline-secondary btn-lg bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-3" aria-haspopup="listbox" aria-expanded="false" title="Not Chosen"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Not Chosen</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-3" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                                            </div> --}}
                                                            {{-- <div class="form-group">
                                                                <label>State/Province/Region</label>
                                                                <input class="form-control form-control-lg" type="text">
                                                            </div> --}}
                                                            {{-- <div class="form-group">
                                                                <label>Postal Code</label>
                                                                <input class="form-control form-control-lg" type="text">
                                                            </div> --}}
                                                            <div class="form-group">
                                                                <label>Numero de telephone</label>
                                                                <input class="form-control form-control-lg" name="tel" type="tel">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Adresse</label>
                                                                <textarea class="form-control" name="adresse"></textarea>
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <div class="custom-control custom-checkbox mb-5">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck1-1">
                                                                    <label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
                                                                </div>
                                                            </div> --}}
                                                        </li>
                                                        <li class="weight-500 col-md-6">
                                                            <h4 class="text-blue h5 mb-20">Modifier les liens reseaux sociaux</h4>
                                                            <div class="form-group">
                                                                <label>Facebook URL:</label>
                                                                <input class="form-control form-control-lg" type="text" placeholder="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Linkedin URL:</label>
                                                                <input class="form-control form-control-lg" name="linkedin" type="text" placeholder="Paste your link here">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Dropbox URL:</label>
                                                                <input class="form-control form-control-lg" name="dropbox" type="text" placeholder="Paste your link here">
                                                            </div>
                                                            <div class="form-group fa-pull-right mt-0 pt-30">
                                                                <input type="submit" class="btn btn-primary bottom-0" value="Valider">
                                                            </div>
                                                            {{-- <div class="form-group mb-0">
                                                                <input type="submit" class="btn btn-primary" value="Save &amp; Update">
                                                            </div> --}}
                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Setting Tab End -->

                                        <!-- Mot de passe Tab start -->
										<div class="tab-pane fade" id="passwd" role="tabpanel">
											<div class="pd-20 profile-task-wrap">
												<div class="container pd-0">
													<!-- Open Task start -->
													<div class="task-title row align-items-center">
														<div class="col-md-8 col-sm-12">
															<h5>Changer votre mot de passe</h5>
														</div>
													</div>
                                                    <form name="formPasswd" method="POST" action="{{ route('profile.update.passwd') }}">
                                                        @csrf
                                                        <div class="profile-task-list pb-30">
                                                            <ul>
                                                                <li class="weight-500 col-md-6">
                                                                {{-- <h4 class="text-blue h5 mb-20">Edit Social Media links</h4> --}}
                                                                <div class="form-group">
                                                                    <label>Mot de passe courrant:</label>
                                                                    <input class="form-control form-control-lg @error('current')
                                                                    is-invalid
                                                                    @enderror" type="password" placeholder="" name="current" required>
                                                                    @error('current')
                                                                    <small class="ml-1 text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nouveau mot de passe:</label>
                                                                    <input class="form-control form-control-lg @error('retypedPasswd')
                                                                    is-invalid
                                                                    @enderror" type="password" name="passwd" required>
                                                                    @error('passwd')
                                                                    <small class="ml-1 text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Retaper le nouveau mot de passe:</label>
                                                                    <input class="form-control form-control-lg @error('retypedPasswd')
                                                                    is-invalid
                                                                    @enderror" type="password" name="retypedPasswd" required>
                                                                    @error('retypedPasswd')
                                                                    <small class="ml-1 text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-0">
                                                                    <input type="submit" class="btn btn-primary" value="Save & Update">
                                                                </div>
                                                            </li>
                                                            </ul>
                                                        </div>
                                                    </form>
													<!-- Open Task End -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
        </div>
    </div>
    <!-- js -->
    @section('SpecialScripts')
    <script src="{{ asset('src/plugins/cropperjs/dist/cropper.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script> --}}
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var image = document.getElementById('image');
            var cropBoxData;
            var canvasData;
            var cropper;

            $('#modal').on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                    autoCropArea: 0.5,
                    dragMode: 'move',
                    aspectRatio: 1,
                    restore: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    viewMode:3,
                    ready: function () {
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    },
                    crop(event) {},
                });
            }).on('hidden.bs.modal', function () {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });



            $('input[value=Update]').click(e=>{
                var reader = new FileReader();
                const file = cropper.getCroppedCanvas().toDataURL('image/jpg');
                const newImage = document.getElementById('imgUpload').files[0];
                reader.onerror = function (error) {
                    console.log('Error: ', error);
                };

                function sendFiles() {
                    $.ajax({
                        type: 'POST',
                        // url: "{{ route('profile.update.image',Auth::user()) }}",
                        url: "/profile/updateImage",
                        dataType: 'json',
                        // data: fdata,
                        data: {
                            'img' : file,
                            'newImg': reader.result
                        },
                        // processData: false,
                        // contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            console.log("success");
                            $('.avatar-photo').attr('src',file);
                            $('#newImage').value = "";
                            $('#modal-close').click();
                        },
                        error: function (error) {
                            console.log("error");
                        }
                    });
                };
                reader.onload = sendFiles;
                if(newImage)
                    reader.readAsDataURL(newImage);
                else sendFiles();


                // $('avatar-photo').css()
            });
            //  for custom file input
            $('input[value=Import]').click(e=>{
                $('#imgUpload').click();
            });

            $('#imgUpload').change(e => {
                $('#formPhoto').submit();
                $('input[value=Update]').show();
            });

            if($('.avatar-photo').attr('src') == "{{ url('/vendors/images/user.svg') }}"){
                $('input[value=Update]').hide();
            }

            $('#modal-close').change(e => {
                $('#newImage').value = "";
            });


            $('#formPhoto').ajaxForm({
                beforeSend: function() {
                    // status.empty();
                    var percentVal = '0%';
                    // bar.width(percentVal);
                    // percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    // bar.width(percentVal);
                    // percent.html(percentVal);
                    console.log(percentVal);
                },
                complete: function(xhr) {
                    // status.html(xhr.responseText);
                    console.log("completed");
                    const [file] = imgUpload.files;
                    if (file){
                        // $('#image').attr('src', URL.createObjectURL(file));
                        cropper.replace(URL.createObjectURL(file));
                    }
                    // cropper.destroy();
                }
            });

            @if($errors->has('current') || $errors->has('passwd') || $errors->has('retypedPasswd'))
                if('{{ request()->tab }}' == 'passwd'){
                    $('a[role=tab]').click();
                }
            @endif
        });
    </script>

    @endsection
@endsection

