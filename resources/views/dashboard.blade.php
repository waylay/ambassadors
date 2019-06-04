@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <ul class="nav nav nav-pills card-header-pills justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('dashboard') }}">Referrals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ambassadors') }}">Ambassadors</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="referrals-list dataTables_wrapper dt-bootstrap4">
                        @referrals
                        @endreferrals
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
