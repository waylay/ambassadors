@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-7 col-md-6">

            <div class="card card-about mt-4">
                <div class="card-header"><h5 class="card-title mb-0">HH Staffing Ambassador Program Overview</h5></div>
                <div class="card-body">
                    <p class="card-text mb-2">We want your great referrals!</p>
                    <h5 class="mb-4">Refer candidates, Get Rewarded, Simple as that! <i class="fas fa-money-bill-wave"></i></h5>
                    <h5>How to become an HH Staffing ambassador? <i class="fas fa-user-friends"></i></h5>
                    <p class="card-text">Anybody and everybody can be an ambassador, just refer great candidates to us!</p>
                </div>
            </div>

            <div class="card card-about mt-4">
                <div class="card-header"><h5 class="card-title mb-0">Get rewarded for your referrals!</h5></div>
                <div class="card-body">
                    <h5>1. Cash for referrals!</h5>
                    <div class="mt-3">
                    <p class="card-text d-flex align-items-center mb-2"><span class="d-inline-block w-25 text-center"><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i></span>= Refer 1-3 candidates = $100 per candidate</p>
                    <p class="card-text d-flex align-items-center mb-2"><span class="d-inline-block w-25 text-center text-white"><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><br><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i></span>= Refer 4-9 candidates = $200 per candidate</p>
                    <p class="card-text d-flex align-items-center mb-4"><span class="d-inline-block w-25 text-center"><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><br><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i></span>= Refer 10+ candidates = $300 per candidate</p>
                </div><!-- /.block -->
                    <h5>2. Quarterly cash drawing for top ambassadors</h5>
                    <p class="card-text mb-4"><i class="fas fa-money-bill-wave"></i> Eligible ambassadors included in $100 quarterly drawings. Note: 3 referral minimum to be eligible for drawing.</p>
                    <h5>3. Receive super cool HH Staffing branded items</h5>
                    <p class="card-text mb-4">After 3rd referral, receive a special gift from HH Staffing <i class="fas fa-cocktail"></i></p>
                    <h5 class="mb-4">4. All ambassador's eligible for year-end special cash drawing.</h5>
                    <h5 class="card-text">*Note: Above rewards are reset each calendar year.</h5>
                </div>
            </div>

            <div class="card card-about mt-4">
                <div class="card-header"><h5 class="card-title mb-0">Program Guidelines <i class="fas fa-clipboard-list"></i></h5></div>
                <div class="card-body">
                    <ol class="pl-3 mb-0">
                        <li><p class="card-text mb-1">Referred candidates need to be a new candidate that has never worked or interviewed with HH Staffing previously.</p></li>
                        <li><p class="card-text mb-1">Referral bonus subject to referred candidate being hired and candidate must complete 80 hours of work in a calendar year. All referrals hired on as Direct-Hire must work 60 consecutive days.</p></li>
                    </ol>
                </div>
            </div>

        </div>
        <div class="col-lg-5 col-md-6">
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

                <div class="card card-referral border-warning mb-3">
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
                                        <option value="Leasing Consultant/Property Management">Leasing Consultant/Property Management</option>
                                        <option value="Accounting, Finance, HR, Marketing">Accounting, Finance, HR, Marketing</option>
                                        <option value="Office Professional/Administrative">Office Professional/Administrative</option>
                                        <option value="Light Industrial/Warehouse">Light Industrial/Warehouse</option>
                                        <option value="Maintenance – HVAC">Maintenance – HVAC</option>
                                        <option value="Maintenance/General Labor">Maintenance/General Labor</option>
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
                                        <option value="Sarasota/Bradenton Area">Sarasota/Bradenton Area</option>
                                        <option value="Tampa Area">Tampa Area</option>
                                        <option value="Orlando Area">Orlando Area</option>
                                        <option value="Fort Lauderdale Area">Fort Lauderdale Area</option>
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
