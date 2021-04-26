@extends('layouts.Auth')
@section('title','Réinitialiser le mot de passe')
@section('content')
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="{{ asset('vendors/images/forgot-password.png') }}" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Réinitialiser le mot de passe</h2>
						</div>
						<h6 class="mb-20">Entrez votre nouveau mot de passe, confirmez et soumettez</h6>
						<form method="POST" action="{{ route('password.update') }}">
							@csrf

                        	<input type="hidden" name="token" value="{{ $token }}">

							<div class="input-group custom">
								<input id="email" type="email" class="form-control form-control-lg  @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
								@error('email')
                                    <span class="invalid-feedback pl-2" role="alert">
                                        <strong style="font-family: 'Inter',sans-serif; font-weight: 400;">{{ $message}}</strong>
                                    </span>
								@else
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o"
											aria-hidden="true"></i></span>
								</div>
                                @enderror
							</div>
							<div class="input-group custom">
								<input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
									placeholder="nouveau mot de passe" name="password" required autocomplete="new-password">

									@error('password')
                                    <span class="invalid-feedback pl-2" role="alert">
                                        <strong style="font-family: 'Inter',sans-serif; font-weight: 400;">{{ $message }}</strong>
                                    </span>
								@else
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
									</div>
                                @enderror
									
							</div>
							<div class="input-group custom">
								<input id="password-confirm" type="password" class="form-control form-control-lg"
									placeholder="Confirmer le nouveau mot de passe" name="password_confirmation" required autocomplete="new-password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Confirmer">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection