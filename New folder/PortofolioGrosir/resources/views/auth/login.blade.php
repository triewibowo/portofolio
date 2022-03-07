@extends('layouts.--app')

@section('content')
    <div class="container" style="height: 100px;"></div>
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Grosir Avicena</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account
                                    </h5>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="form2Example17"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" autocomplete="email" autofocus />
                                        <label class="form-label" for="form2Example17">Email address</label>

                                        @error('email')
                                            <span class="small invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="form2Example27"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            name="password" autocomplete="current-password" />
                                        <label class="form-label" for="form2Example27">Password</label>

                                        @error('password')
                                            <span class="small invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="small text-muted form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a class="small text-muted" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif

                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                            href="{{ route('register') }}" style="color: #393f81;">Register here</a></p>
                                    <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
