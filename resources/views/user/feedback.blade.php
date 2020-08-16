@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card feedback-card my-3">
                    <h3 class="card-title text-center feedback_form_h2">Enter Your Feedback</h3>
                    <div class="card-body py-md-4">
                        <form _lpchecked="1" method="POST" action="{{ route('contactus.store') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text"
                                       class="form-control feedback-form @error('name') is-invalid @enderror"
                                       name="name" placeholder="Name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email"
                                       class="form-control feedback-form @error('contact_email') is-invalid @enderror"
                                       name="contact_email" placeholder="Email" required>
                                @error('contact_email')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="number"
                                       class="form-control feedback-form @error('contact_number') is-invalid @enderror"
                                       name="contact_number" placeholder="Phone Number" required>
                                @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="feedback"
                                          class="form-control feedback-form @error('feedback') is-invalid @enderror"
                                          cols="28"
                                          rows="8" placeholder="Please Enter Your Message" required></textarea>
                                @error('feedback')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col d-flex align-items-center justify-content-start">
                                    <button class="btn btn-primary feedback-button " type="submit">Submit</button>
                                </div>
                                <div class="col d-flex align-items-center justify-content-end">
                                    <a class="btn btn-info feedback-button-default"
                                       href="{{ route('home') }}">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
