@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">My Referrals</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="referrals-list dataTables_wrapper dt-bootstrap4">
                        <table id="referrals-list-table" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Ambassador</th>
                                    </tr>
                                </thead>
                            </table>

                            @push('scripts')
                                <script>
                                    $(document).ready(function() {
                                        function format ( d ) {

                                            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">'+
                                                '<tr>'+
                                                    '<td>Referred by:</td>'+
                                                    '<td>'+d[3]+'</td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<td>Email:</td>'+
                                                    '<td>'+d[1]+'</td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<td>Referred on:</td>'+
                                                    '<td>' + d[4] + '</td>'+
                                                '</tr>'+
                                            '</table>';
                                        }

                                        var table = $('#referrals-list-table').DataTable({
                                            iDisplayLength: 25,
                                            serverSide: true,
                                            processing: true,
                                            responsive: true,
                                            ajax: "{{ route('referrals_list') }}",
                                            columns: [
                                                {
                                                    name: 'name',
                                                },
                                                {
                                                    name: 'email',
                                                    visible: false
                                                },
                                                {
                                                    name: 'address',

                                                },
                                                {
                                                    name: 'user.name',
                                                    orderable: false,
                                                    visible: false
                                                },
                                                {
                                                    name: 'created_at',
                                                    orderable: false,
                                                    visible: false
                                                },
                                            ],
                                        });

                                        $('#referrals-list-table tbody').on('click', 'td', function () {
                                            var tr = $(this).closest('tr');
                                            var row = table.row( tr );

                                            if ( row.child.isShown() ) {
                                                // This row is already open - close it
                                                row.child.hide();
                                                tr.removeClass('shown');
                                            }
                                            else {
                                                // Open this row
                                                row.child( format(row.data()) ).show();
                                                tr.addClass('shown');
                                            }
                                        } );
                                    });


                                </script>
                            @endpush
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Add new referral</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
