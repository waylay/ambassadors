<div class="card">
    <div class="card-header">{{ $title }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="referrals-list dataTables_wrapper dt-bootstrap4">
            <table id="referrals-list-table" class="table table-bordered table-stripe" style="width:100%">
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
                                iDisplayLength: 10,
                                dom: 'Bflrtip',
                                serverSide: true,
                                processing: true,
                                responsive: true,
                                ajax: "{{ route($data_url) }}",
                                buttons: [
                                    'copy', 'csv', 'pdf'
                                ],
                                select: {
                                    style: 'multi'
                                },
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
                                createdRow: function (row, data, index) {
                                    $(row).addClass("top-level-row");
                                },
                            });

                            $('#referrals-list-table').on('click', '.top-level-row', function () {
                                var tr = $(this);
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