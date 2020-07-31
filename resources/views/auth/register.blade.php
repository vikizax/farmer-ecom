@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row py-5 align-items-center">
        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <h1>Create an Account</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row form-row">
                    <!-- First Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="name" type="text"
                            class="form-control bg-white border-left-0 border-md @error('first_name') is-invalid @enderror"
                            placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required
                            autocomplete="name" autofocus>

                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <input id="name" type="text" class="form-control bg-white border-left-0 border-md"
                            placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required
                            autocomplete="name" autofocus>
                    </div>

                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email"
                            class="form-control bg-white border-left-0 border-md @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>

                        <input id="phoneNumber" type="tel" name="phone_no" placeholder="Phone Number" value="{{ old('phone_no') }}"
                            class="form-control bg-white border-md border-left-0 pl-3  @error('phone_no') is-invalid @enderror" />
                        @error('phone_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="address" type="text" name="address" placeholder="Address" value="{{ old('address') }}"
                            class="form-control bg-white border-left-0 border-md @error('address') is-invalid @enderror" />
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!--PinCode -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="address" type="text" name="pin_code" placeholder="Pincode" value="{{ old('pin_code') }}"
                            class="form-control bg-white border-left-0 border-md @error('pin_code') is-invalid @enderror" />

                        @error('pin_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>

                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid bg-white border-left-0 border-md @enderror "
                            name="password" required autocomplete="new-password" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="input-group col-lg-6 mb-4">
                        <input id="password-confirm" type="text" placeholder="Confirm Password"
                            class="form-control bg-white border-left-0 border-md" name="password_confirmation" required
                            autocomplete="new-password" />
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class="btn btn-primary btn-block py-2">
                            <span class="font-weight-bold">{{ __('Register') }}</span>
                        </button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">
                            Already Registered?
                            <a href="{{ url('/login') }}" class="text-primary ml-2">Login</a>
                        </p>

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
