@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            @table(['title' => 'My Referrals','data_url' => 'referrals_list'])
            @endtable
        </div>
        <div class="col-md-3">
            <div class="card bg-dark text-white">
                <div class="card-header">Information</div>
                <div class="card-body">
                    <p>Administrator: <strong>{{ Auth::user()->name }}</strong> </p>
                    <p>Ambassadors: <strong>22</strong></p>
                    <p>Referrals: <strong>185</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
