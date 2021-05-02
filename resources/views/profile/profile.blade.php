@extends('layouts.prof')
@section('content')
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
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="{{ asset('src/images/img1.jpg') }}" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="image" src="{{ asset('vendors/images/photo2.jpg') }}" alt="Picture">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h5 class="text-center h5 mb-0">{{ $username }}</h5>
							<p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
                                        <ul>
                                            <li>
                                                {{ $personne->emailInstitutionne }}
                                            </li>
                                            <li>
                                                {{ $personne->email }}
                                            </li>
                                        </ul>
									</li>
									<li>
										<span>Phone Number:</span>
										619-229-0054
									</li>
									<li>
										<span>Country:</span>
										America
									</li>
									<li>
										<span>Address:</span>
										1807 Holden Street<br>
										San Diego, CA 92115
									</li>
								</ul>
							</div>
							<div class="profile-social">
								<h5 class="mb-20 h5 text-blue">Social Links</h5>
								<ul class="clearfix">
									<li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(29, 161, 242);"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);"><i class="fa fa-instagram"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(195, 35, 97);"><i class="fa fa-dribbble"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(61, 70, 77);"><i class="fa fa-dropbox"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(219, 68, 55);"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(189, 8, 28);"><i class="fa fa-pinterest-p"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 175, 240);"><i class="fa fa-skype"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);"><i class="fa fa-vine"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Timeline</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Tasks</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#setting" role="tab">Settings</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Timeline Tab start -->
										<div class="tab-pane fade show active" id="timeline" role="tabpanel">
											<div class="pd-20">
												<div class="profile-timeline">
													<div class="timeline-month">
														<h5>August, 2020</h5>
													</div>
													<div class="profile-timeline-list">
														<ul>
															<li>
																<div class="date">12 Aug</div>
																<div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 Aug</div>
																<div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 Aug</div>
																<div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 Aug</div>
																<div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
														</ul>
													</div>
													<div class="timeline-month">
														<h5>July, 2020</h5>
													</div>
													<div class="profile-timeline-list">
														<ul>
															<li>
																<div class="date">12 July</div>
																<div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 July</div>
																<div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
														</ul>
													</div>
													<div class="timeline-month">
														<h5>June, 2020</h5>
													</div>
													<div class="profile-timeline-list">
														<ul>
															<li>
																<div class="date">12 June</div>
																<div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 June</div>
																<div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 June</div>
																<div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<!-- Timeline Tab End -->
										<!-- Tasks Tab start -->
										<div class="tab-pane fade" id="tasks" role="tabpanel">
											<div class="pd-20 profile-task-wrap">
												<div class="container pd-0">
													<!-- Open Task start -->
													<div class="task-title row align-items-center">
														<div class="col-md-8 col-sm-12">
															<h5>Open Tasks (4 Left)</h5>
														</div>
														<div class="col-md-4 col-sm-12 text-right">
															<a href="task-add" data-toggle="modal" data-target="#task-add" class="bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i> Add</a>
														</div>
													</div>
													<div class="profile-task-list pb-30">
														<ul>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-1">
																	<label class="custom-control-label" for="task-1"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea earum.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-2">
																	<label class="custom-control-label" for="task-2"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-3">
																	<label class="custom-control-label" for="task-3"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-4">
																	<label class="custom-control-label" for="task-4"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet. Id ea earum.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
															</li>
														</ul>
													</div>
													<!-- Open Task End -->
													<!-- Close Task start -->
													<div class="task-title row align-items-center">
														<div class="col-md-12 col-sm-12">
															<h5>Closed Tasks</h5>
														</div>
													</div>
													<div class="profile-task-list close-tasks">
														<ul>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-close-1" checked="" disabled="">
																	<label class="custom-control-label" for="task-close-1"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea earum.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-close-2" checked="" disabled="">
																	<label class="custom-control-label" for="task-close-2"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-close-3" checked="" disabled="">
																	<label class="custom-control-label" for="task-close-3"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-close-4" checked="" disabled="">
																	<label class="custom-control-label" for="task-close-4"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet. Id ea earum.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
															</li>
														</ul>
													</div>
													<!-- Close Task start -->
													<!-- add task popup start -->
													<div class="modal fade customscroll mCustomScrollbar _mCS_4 mCS_no_scrollbar" id="task-add" tabindex="-1" role="dialog" style=""><div id="mCSB_4" class="mCustomScrollBox mCS-dark-2 mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_4_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
														<div class="modal-dialog modal-dialog-centered" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLongTitle">Tasks Add</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-body pd-0">
																	<div class="task-list-form">
																		<ul>
																			<li>
																				<form>
																					<div class="form-group row">
																						<label class="col-md-4">Task Type</label>
																						<div class="col-md-8">
																							<input type="text" class="form-control">
																						</div>
																					</div>
																					<div class="form-group row">
																						<label class="col-md-4">Task Message</label>
																						<div class="col-md-8">
																							<textarea class="form-control"></textarea>
																						</div>
																					</div>
																					<div class="form-group row">
																						<label class="col-md-4">Assigned to</label>
																						<div class="col-md-8">
																							<div class="dropdown bootstrap-select show-tick form-control"><select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple="" data-selected-text-format="count" data-count-selected-text="{0} people selected" tabindex="-98">
																								<option>Ferdinand M.</option>
																								<option>Don H. Rabon</option>
																								<option>Ann P. Harris</option>
																								<option>Katie D. Verdin</option>
																								<option>Christopher S. Fulghum</option>
																								<option>Matthew C. Porter</option>
																							</select><button type="button" class="btn dropdown-toggle btn-outline-primary bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="Not Chosen"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Not Chosen</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" aria-multiselectable="true"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
																						</div>
																					</div>
																					<div class="form-group row mb-0">
																						<label class="col-md-4">Due Date</label>
																						<div class="col-md-8">
																							<input type="text" class="form-control date-picker">
																						</div>
																					</div>
																				</form>
																			</li>
																			<li>
																				<a href="javascript:;" class="remove-task" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
																				<form>
																					<div class="form-group row">
																						<label class="col-md-4">Task Type</label>
																						<div class="col-md-8">
																							<input type="text" class="form-control">
																						</div>
																					</div>
																					<div class="form-group row">
																						<label class="col-md-4">Task Message</label>
																						<div class="col-md-8">
																							<textarea class="form-control"></textarea>
																						</div>
																					</div>
																					<div class="form-group row">
																						<label class="col-md-4">Assigned to</label>
																						<div class="col-md-8">
																							<div class="dropdown bootstrap-select show-tick form-control"><select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple="" data-selected-text-format="count" data-count-selected-text="{0} people selected" tabindex="-98">
																								<option>Ferdinand M.</option>
																								<option>Don H. Rabon</option>
																								<option>Ann P. Harris</option>
																								<option>Katie D. Verdin</option>
																								<option>Christopher S. Fulghum</option>
																								<option>Matthew C. Porter</option>
																							</select><button type="button" class="btn dropdown-toggle btn-outline-primary bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" title="Not Chosen"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Not Chosen</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-2" tabindex="-1" aria-multiselectable="true"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
																						</div>
																					</div>
																					<div class="form-group row mb-0">
																						<label class="col-md-4">Due Date</label>
																						<div class="col-md-8">
																							<input type="text" class="form-control date-picker">
																						</div>
																					</div>
																				</form>
																			</li>
																		</ul>
																	</div>
																	<div class="add-more-task">
																		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Task"><i class="ion-plus-circled"></i> Add More Task</a>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-primary">Add</button>
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																</div>
															</div>
														</div>
													</div><div id="mCSB_4_scrollbar_vertical" class="mCSB_scrollTools mCSB_4_scrollbar mCS-dark-2 mCSB_scrollTools_vertical mCSB_scrollTools_onDrag_expand" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_4_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
													<!-- add task popup End -->
												</div>
											</div>
										</div>
										<!-- Tasks Tab End -->
										<!-- Setting Tab start -->
										<div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form>
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
															<div class="form-group">
																<label>Full Name</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Title</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Email</label>
																<input class="form-control form-control-lg" type="email">
															</div>
															<div class="form-group">
																<label>Date of birth</label>
																<input class="form-control form-control-lg date-picker" type="text">
															</div>
															<div class="form-group">
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
															</div>
															<div class="form-group">
																<label>Country</label>
																<div class="dropdown bootstrap-select form-control form-control-lg"><select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen" tabindex="-98"><option class="bs-title-option" value=""></option>
																	<option>United States</option>
																	<option>India</option>
																	<option>United Kingdom</option>
																</select><button type="button" class="btn dropdown-toggle btn-outline-secondary btn-lg bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-3" aria-haspopup="listbox" aria-expanded="false" title="Not Chosen"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Not Chosen</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-3" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
															</div>
															<div class="form-group">
																<label>State/Province/Region</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Postal Code</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Phone Number</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Address</label>
																<textarea class="form-control"></textarea>
															</div>
															<div class="form-group">
																<label>Visa Card Number</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Paypal ID</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="customCheck1-1">
																	<label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
																</div>
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Update Information">
															</div>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Social Media links</h4>
															<div class="form-group">
																<label>Facebook URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Twitter URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Linkedin URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Instagram URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Dribbble URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Dropbox URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Google-plus URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Pinterest URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Skype URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Vine URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Save &amp; Update">
															</div>
														</li>
													</ul>
												</form>
											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="{{ asset('src/plugins/cropperjs/dist/cropper.js') }}"></script>
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
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});

    </script>

<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    {{-- <script>
        Echo.channel(`evt`)
        .listen('Evt', (e) => {
            console.log(e);
        });
    </script> --}}


<div class="datepickers-container" id="datepickers-container"><div class="datepicker -bottom-left- -from-bottom-"><i class="datepicker--pointer"></i><nav class="datepicker--nav"><div class="datepicker--nav-action" data-action="prev"><svg><path d="M 17,12 l -5,5 l 5,5"></path></svg></div><div class="datepicker--nav-title">May, <i>2021</i></div><div class="datepicker--nav-action" data-action="next"><svg><path d="M 14,12 l 5,5 l -5,5"></path></svg></div></nav><div class="datepicker--content"><div class="datepicker--days datepicker--body active"><div class="datepicker--days-names"><div class="datepicker--day-name -weekend-">Su</div><div class="datepicker--day-name">Mo</div><div class="datepicker--day-name">Tu</div><div class="datepicker--day-name">We</div><div class="datepicker--day-name">Th</div><div class="datepicker--day-name">Fr</div><div class="datepicker--day-name -weekend-">Sa</div></div><div class="datepicker--cells datepicker--cells-days"><div class="datepicker--cell datepicker--cell-day -weekend- -other-month-" data-date="25" data-month="3" data-year="2021">25</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="26" data-month="3" data-year="2021">26</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="27" data-month="3" data-year="2021">27</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="28" data-month="3" data-year="2021">28</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="29" data-month="3" data-year="2021">29</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="30" data-month="3" data-year="2021">30</div><div class="datepicker--cell datepicker--cell-day -weekend- -current-" data-date="1" data-month="4" data-year="2021">1</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="2" data-month="4" data-year="2021">2</div><div class="datepicker--cell datepicker--cell-day" data-date="3" data-month="4" data-year="2021">3</div><div class="datepicker--cell datepicker--cell-day" data-date="4" data-month="4" data-year="2021">4</div><div class="datepicker--cell datepicker--cell-day" data-date="5" data-month="4" data-year="2021">5</div><div class="datepicker--cell datepicker--cell-day" data-date="6" data-month="4" data-year="2021">6</div><div class="datepicker--cell datepicker--cell-day" data-date="7" data-month="4" data-year="2021">7</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="8" data-month="4" data-year="2021">8</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="9" data-month="4" data-year="2021">9</div><div class="datepicker--cell datepicker--cell-day" data-date="10" data-month="4" data-year="2021">10</div><div class="datepicker--cell datepicker--cell-day" data-date="11" data-month="4" data-year="2021">11</div><div class="datepicker--cell datepicker--cell-day" data-date="12" data-month="4" data-year="2021">12</div><div class="datepicker--cell datepicker--cell-day" data-date="13" data-month="4" data-year="2021">13</div><div class="datepicker--cell datepicker--cell-day" data-date="14" data-month="4" data-year="2021">14</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="15" data-month="4" data-year="2021">15</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="16" data-month="4" data-year="2021">16</div><div class="datepicker--cell datepicker--cell-day" data-date="17" data-month="4" data-year="2021">17</div><div class="datepicker--cell datepicker--cell-day" data-date="18" data-month="4" data-year="2021">18</div><div class="datepicker--cell datepicker--cell-day" data-date="19" data-month="4" data-year="2021">19</div><div class="datepicker--cell datepicker--cell-day" data-date="20" data-month="4" data-year="2021">20</div><div class="datepicker--cell datepicker--cell-day" data-date="21" data-month="4" data-year="2021">21</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="22" data-month="4" data-year="2021">22</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="23" data-month="4" data-year="2021">23</div><div class="datepicker--cell datepicker--cell-day" data-date="24" data-month="4" data-year="2021">24</div><div class="datepicker--cell datepicker--cell-day" data-date="25" data-month="4" data-year="2021">25</div><div class="datepicker--cell datepicker--cell-day" data-date="26" data-month="4" data-year="2021">26</div><div class="datepicker--cell datepicker--cell-day" data-date="27" data-month="4" data-year="2021">27</div><div class="datepicker--cell datepicker--cell-day" data-date="28" data-month="4" data-year="2021">28</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="29" data-month="4" data-year="2021">29</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="30" data-month="4" data-year="2021">30</div><div class="datepicker--cell datepicker--cell-day" data-date="31" data-month="4" data-year="2021">31</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="1" data-month="5" data-year="2021">1</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="2" data-month="5" data-year="2021">2</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="3" data-month="5" data-year="2021">3</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="4" data-month="5" data-year="2021">4</div><div class="datepicker--cell datepicker--cell-day -weekend- -other-month-" data-date="5" data-month="5" data-year="2021">5</div></div></div></div></div><div class="datepicker -bottom-left- -from-bottom-"><i class="datepicker--pointer"></i><nav class="datepicker--nav"><div class="datepicker--nav-action" data-action="prev"><svg><path d="M 17,12 l -5,5 l 5,5"></path></svg></div><div class="datepicker--nav-title">May, <i>2021</i></div><div class="datepicker--nav-action" data-action="next"><svg><path d="M 14,12 l 5,5 l -5,5"></path></svg></div></nav><div class="datepicker--content"><div class="datepicker--days datepicker--body active"><div class="datepicker--days-names"><div class="datepicker--day-name -weekend-">Su</div><div class="datepicker--day-name">Mo</div><div class="datepicker--day-name">Tu</div><div class="datepicker--day-name">We</div><div class="datepicker--day-name">Th</div><div class="datepicker--day-name">Fr</div><div class="datepicker--day-name -weekend-">Sa</div></div><div class="datepicker--cells datepicker--cells-days"><div class="datepicker--cell datepicker--cell-day -weekend- -other-month-" data-date="25" data-month="3" data-year="2021">25</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="26" data-month="3" data-year="2021">26</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="27" data-month="3" data-year="2021">27</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="28" data-month="3" data-year="2021">28</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="29" data-month="3" data-year="2021">29</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="30" data-month="3" data-year="2021">30</div><div class="datepicker--cell datepicker--cell-day -weekend- -current-" data-date="1" data-month="4" data-year="2021">1</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="2" data-month="4" data-year="2021">2</div><div class="datepicker--cell datepicker--cell-day" data-date="3" data-month="4" data-year="2021">3</div><div class="datepicker--cell datepicker--cell-day" data-date="4" data-month="4" data-year="2021">4</div><div class="datepicker--cell datepicker--cell-day" data-date="5" data-month="4" data-year="2021">5</div><div class="datepicker--cell datepicker--cell-day" data-date="6" data-month="4" data-year="2021">6</div><div class="datepicker--cell datepicker--cell-day" data-date="7" data-month="4" data-year="2021">7</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="8" data-month="4" data-year="2021">8</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="9" data-month="4" data-year="2021">9</div><div class="datepicker--cell datepicker--cell-day" data-date="10" data-month="4" data-year="2021">10</div><div class="datepicker--cell datepicker--cell-day" data-date="11" data-month="4" data-year="2021">11</div><div class="datepicker--cell datepicker--cell-day" data-date="12" data-month="4" data-year="2021">12</div><div class="datepicker--cell datepicker--cell-day" data-date="13" data-month="4" data-year="2021">13</div><div class="datepicker--cell datepicker--cell-day" data-date="14" data-month="4" data-year="2021">14</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="15" data-month="4" data-year="2021">15</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="16" data-month="4" data-year="2021">16</div><div class="datepicker--cell datepicker--cell-day" data-date="17" data-month="4" data-year="2021">17</div><div class="datepicker--cell datepicker--cell-day" data-date="18" data-month="4" data-year="2021">18</div><div class="datepicker--cell datepicker--cell-day" data-date="19" data-month="4" data-year="2021">19</div><div class="datepicker--cell datepicker--cell-day" data-date="20" data-month="4" data-year="2021">20</div><div class="datepicker--cell datepicker--cell-day" data-date="21" data-month="4" data-year="2021">21</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="22" data-month="4" data-year="2021">22</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="23" data-month="4" data-year="2021">23</div><div class="datepicker--cell datepicker--cell-day" data-date="24" data-month="4" data-year="2021">24</div><div class="datepicker--cell datepicker--cell-day" data-date="25" data-month="4" data-year="2021">25</div><div class="datepicker--cell datepicker--cell-day" data-date="26" data-month="4" data-year="2021">26</div><div class="datepicker--cell datepicker--cell-day" data-date="27" data-month="4" data-year="2021">27</div><div class="datepicker--cell datepicker--cell-day" data-date="28" data-month="4" data-year="2021">28</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="29" data-month="4" data-year="2021">29</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="30" data-month="4" data-year="2021">30</div><div class="datepicker--cell datepicker--cell-day" data-date="31" data-month="4" data-year="2021">31</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="1" data-month="5" data-year="2021">1</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="2" data-month="5" data-year="2021">2</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="3" data-month="5" data-year="2021">3</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="4" data-month="5" data-year="2021">4</div><div class="datepicker--cell datepicker--cell-day -weekend- -other-month-" data-date="5" data-month="5" data-year="2021">5</div></div></div></div></div><div class="datepicker -bottom-left- -from-bottom-"><i class="datepicker--pointer"></i><nav class="datepicker--nav"><div class="datepicker--nav-action" data-action="prev"><svg><path d="M 17,12 l -5,5 l 5,5"></path></svg></div><div class="datepicker--nav-title">May, <i>2021</i></div><div class="datepicker--nav-action" data-action="next"><svg><path d="M 14,12 l 5,5 l -5,5"></path></svg></div></nav><div class="datepicker--content"><div class="datepicker--days datepicker--body active"><div class="datepicker--days-names"><div class="datepicker--day-name -weekend-">Su</div><div class="datepicker--day-name">Mo</div><div class="datepicker--day-name">Tu</div><div class="datepicker--day-name">We</div><div class="datepicker--day-name">Th</div><div class="datepicker--day-name">Fr</div><div class="datepicker--day-name -weekend-">Sa</div></div><div class="datepicker--cells datepicker--cells-days"><div class="datepicker--cell datepicker--cell-day -weekend- -other-month-" data-date="25" data-month="3" data-year="2021">25</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="26" data-month="3" data-year="2021">26</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="27" data-month="3" data-year="2021">27</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="28" data-month="3" data-year="2021">28</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="29" data-month="3" data-year="2021">29</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="30" data-month="3" data-year="2021">30</div><div class="datepicker--cell datepicker--cell-day -weekend- -current-" data-date="1" data-month="4" data-year="2021">1</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="2" data-month="4" data-year="2021">2</div><div class="datepicker--cell datepicker--cell-day" data-date="3" data-month="4" data-year="2021">3</div><div class="datepicker--cell datepicker--cell-day" data-date="4" data-month="4" data-year="2021">4</div><div class="datepicker--cell datepicker--cell-day" data-date="5" data-month="4" data-year="2021">5</div><div class="datepicker--cell datepicker--cell-day" data-date="6" data-month="4" data-year="2021">6</div><div class="datepicker--cell datepicker--cell-day" data-date="7" data-month="4" data-year="2021">7</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="8" data-month="4" data-year="2021">8</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="9" data-month="4" data-year="2021">9</div><div class="datepicker--cell datepicker--cell-day" data-date="10" data-month="4" data-year="2021">10</div><div class="datepicker--cell datepicker--cell-day" data-date="11" data-month="4" data-year="2021">11</div><div class="datepicker--cell datepicker--cell-day" data-date="12" data-month="4" data-year="2021">12</div><div class="datepicker--cell datepicker--cell-day" data-date="13" data-month="4" data-year="2021">13</div><div class="datepicker--cell datepicker--cell-day" data-date="14" data-month="4" data-year="2021">14</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="15" data-month="4" data-year="2021">15</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="16" data-month="4" data-year="2021">16</div><div class="datepicker--cell datepicker--cell-day" data-date="17" data-month="4" data-year="2021">17</div><div class="datepicker--cell datepicker--cell-day" data-date="18" data-month="4" data-year="2021">18</div><div class="datepicker--cell datepicker--cell-day" data-date="19" data-month="4" data-year="2021">19</div><div class="datepicker--cell datepicker--cell-day" data-date="20" data-month="4" data-year="2021">20</div><div class="datepicker--cell datepicker--cell-day" data-date="21" data-month="4" data-year="2021">21</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="22" data-month="4" data-year="2021">22</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="23" data-month="4" data-year="2021">23</div><div class="datepicker--cell datepicker--cell-day" data-date="24" data-month="4" data-year="2021">24</div><div class="datepicker--cell datepicker--cell-day" data-date="25" data-month="4" data-year="2021">25</div><div class="datepicker--cell datepicker--cell-day" data-date="26" data-month="4" data-year="2021">26</div><div class="datepicker--cell datepicker--cell-day" data-date="27" data-month="4" data-year="2021">27</div><div class="datepicker--cell datepicker--cell-day" data-date="28" data-month="4" data-year="2021">28</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="29" data-month="4" data-year="2021">29</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="30" data-month="4" data-year="2021">30</div><div class="datepicker--cell datepicker--cell-day" data-date="31" data-month="4" data-year="2021">31</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="1" data-month="5" data-year="2021">1</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="2" data-month="5" data-year="2021">2</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="3" data-month="5" data-year="2021">3</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="4" data-month="5" data-year="2021">4</div><div class="datepicker--cell datepicker--cell-day -weekend- -other-month-" data-date="5" data-month="5" data-year="2021">5</div></div></div></div></div></div></body></html>
@endsection
