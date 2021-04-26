@extends('layouts.Auth')
@section('title','Mot de passe oublié')
@section('content')
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="{{ asset('vendors/images/forgot-password.png') }}" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						@if (session('status'))
						<div class="modal-body text-center font-18">
							<h3 class="mb-20">Email Envoyé!</h3>
							<div class="mb-30 text-center"><img src="{{ asset('vendors/images/success.png') }}"></div>
							votre lien de réinitialisation de mot de passe est envoyé par e-mail!
						</div>
						@else
						<div class="login-title">
							<h2 class="text-center text-primary">Mot de passe oublié</h2>
						</div>
						<h6 class="mb-20">Entrez votre adresse e-mail pour réinitialiser votre mot de passe</h6>
						<form  method="POST" action="{{ route('password.email') }}">
						    @csrf
							<div class="input-group custom">

								<input id="email" type="email" class="form-control form-control-lg  @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
								@error('email')
                                    <span class="invalid-feedback pl-2" role="alert">
                                        <strong style="font-family: 'Inter',sans-serif; font-weight: 400;">{{ $message }}</strong>
                                    </span>
								@else
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o"
											aria-hidden="true"></i></span>
								</div>
                                @enderror
		
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<input type="submit" class="btn btn-primary btn-lg btn-block">
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">OU</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('login') }}">Login</a>
									</div>
								</div>
							</div>
						</form>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection