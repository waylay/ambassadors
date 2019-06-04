@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-6">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="mb-0"><strong>Done!</strong> Thank you for referring <strong class="alert-link">{{ session('success') }}</strong>!</h4>
            </div>
            @endif
            <form method="POST" action="{{ route('refer') }}">
                @csrf
                <div class="card card-ambassador border-success mt-4 mb-4">
                    <div class="card-header text-white bg-success"><h5 class="mb-0">Ambassador  <span class="small float-right">your details</span></h5></div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="ambassador_name" class="col-md-4 col-form-label text-md-right">Your Name</label>
                            <div class="col-md-6">
                                <input id="ambassador_name" type="text" class="form-control @error('ambassador_name') is-invalid @enderror" name="ambassador_name" value="{{ old('ambassador_name') }}" required autocomplete="name" autofocus>

                                @error('ambassador_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ambassador_email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="ambassador_email" type="email" class="form-control @error('ambassador_email') is-invalid @enderror" name="ambassador_email" value="{{ old('ambassador_email') }}" required autocomplete="email">

                                @error('ambassador_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ambassador_phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                            <div class="col-md-6">
                                <input id="ambassador_phone" type="text" class="form-control @error('ambassador_phone') is-invalid @enderror" name="ambassador_phone" value="{{ old('ambassador_phone') }}" required autocomplete="tel">

                                @error('ambassador_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-referral border-warning">
                        <div class="card-header text-white bg-warning"><h5 class="mb-0 w-100">Referral <span class="small float-right">person you are referring</span></h5></div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="referral_name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="referral_name" type="text" class="form-control @error('referral_name') is-invalid @enderror" name="referral_name" value="{{ old('referral_name') }}" required autocomplete="disabled">

                                    @error('referral_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="referral_email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="referral_email" type="email" class="form-control @error('referral_email') is-invalid @enderror" name="referral_email" value="{{ old('referral_email') }}" required autocomplete="disabled">

                                    @error('referral_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="referral_phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                                <div class="col-md-6">
                                    <input id="referral_phone" type="text" class="form-control @error('referral_phone') is-invalid @enderror" name="referral_phone" value="{{ old('referral_phone') }}" required autocomplete="disabled">

                                    @error('referral_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="referral_job" class="col-md-4 col-form-label text-md-right">Job Field</label>
                                <div class="col-md-6">
                                    <select id="referral_job"class="form-control @error('referral_job') is-invalid @enderror" name="referral_job" value="{{ old('referral_job') }}" required autocomplete="disabled">
                                        <option value="" selected disabled hidden>Select</option>
                                        <option value="Property Management">Property Management</option>
                                        <option value="Accounting, Finance, HR">Accounting, Finance, HR</option>
                                        <option value="Office Professional">Office Professional</option>
                                        <option value="Light Industrial/Maintenance">Light Industrial/Maintenance</option>
                                    </select>

                                    @error('referral_job')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="referral_location" class="col-md-4 col-form-label text-md-right">Location</label>
                                <div class="col-md-6">
                                    <select id="referral_location"class="form-control @error('referral_location') is-invalid @enderror" name="referral_location" value="{{ old('referral_location') }}" required autocomplete="disabled">
                                        <option value="" selected disabled hidden>Select</option>
                                        <option value="Sarasota">Sarasota</option>
                                        <option value="Tampa">Tampa</option>
                                        <option value="Orlando">Orlando</option>
                                        <option value="Fort Lauderdale">Fort Lauderdale</option>
                                    </select>

                                    @error('referral_location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row my-4">
                                <div class="col-md-6 offset-md-4">
                                    {!! NoCaptcha::display() !!}

                                    @error('g-recaptcha-response')
                                        <span class="invalid-feedback" role="alert" style="display: block">
                                            <strong>Invalid reCAPTCHA</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-4 mb-1">
                                <div class="col-md-6 offset-md-4 text-right">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>


            </form>
        </div>
    </div>
</div>
@endsection
