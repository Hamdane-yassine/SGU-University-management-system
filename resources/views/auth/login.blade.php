@extends('layouts.auth')
@section('title','Login')
@section('content')
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login</h2>
						</div>
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<div class="input-group custom">
								<input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
								
								@error('email')
                                    <span class="invalid-feedback pl-2" role="alert">
                                        <strong style="font-family: 'Inter',sans-serif; font-weight: 400;">{{ $message }}</strong>
                                    </span>
								@else
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
                                @enderror

							</div>
							<div class="input-group custom">
								<input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror " placeholder="**********" name="password" required autocomplete="current-password">
								@error('password')
									<span class="invalid-feedback pl-2" role="alert">
										<strong style="font-family: 'Inter',sans-serif; font-weight: 400;">{{ $message}}</strong>
									</span>
								@else
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
									</div>
								@enderror
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
										<label class="custom-control-label" for="remember">Mémoriser</label>
									</div>
								</div>
								<div class="col-6">
									@if (Route::has('password.request'))
									<div class="forgot-password"><a href="{{ route('password.request') }}">Mot de passe oublié</a></div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Se connecter">
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