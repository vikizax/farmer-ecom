@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row py-5 align-items-center">
        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <h1>User Login</h1>

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <div class="row form-row">
                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email"
                            class="form-control bg-white border-left-0 border-md @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Email Address">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password"
                            class="form-control bg-white border-left-0 border-md @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <!-- Check remeber -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class="btn btn-primary btn-block py-2">
                            <span class="font-weight-bold">Login</span>
                        </button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Forget Password -->

                    <div class="form-group col-lg-12 mx-auto">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link btn-block py-2 btn-facebook" href="{{ route('password.request') }}">
                            <i class="fas fa-ggogle mr-2"></i>
                            <span class="font-weight-bold">Forget Password</span>
                        </a>
                        @endif
                    </div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Dont Have Account ? <a href="{{ url('/register') }}"
                                class="text-primary ml-2">Register</a></p>

                        <p class="text-muted font-weight-bold">
                            Return to
                            <a href="{{ url('/') }}" class="text-primary ml-2">Home</a>
                        </p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
