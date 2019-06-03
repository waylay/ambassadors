<table id="ambassadors-list-table" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Referrals</th>
            </tr>
        </thead>
    </table>

    @push('scripts')
        <script>
            $(document).ready(function() {
                function format ( d ) {
                    console.log(d);

                    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">'+
                        '<tr>'+
                            '<td>Date:</td>'+
                            '<td>'+d[4]+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Referrals:</td>'+
                            '<td>'+ d[3] +'</td>'+
                        '</tr>'+
                    '</table>';
                }
                var currentdate = new Date();
                var formatDate = currentdate.getFullYear() + "-" + (currentdate.getMonth()+1)  + "-" + currentdate.getDate();
                var table = $('#ambassadors-list-table').DataTable({
                    lengthMenu: [ [10, 25, 50, 100000], [10, 25, 50, "All"] ],
                    scrollY: 500,
                    dom: 'Bflrtip',
                    serverSide: true,
                    processing: true,
                    deferRender: false,
                    order: [[ 4, "desc" ]],
                    ajax: "{{ route('ambassadors_list') }}",
                    buttons: [
                        'copy',
                        {
                            extend: 'csv',
                            title: 'Ambassadors-' + formatDate,
                        },
                        {
                            extend: 'pdf',
                            title: 'Ambassadors-' + formatDate,
                            orientation: 'landscape',
                            pageSize: 'LEGAL'
                        }
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
                        },
                        {
                            name: 'phone',
                        },
                        {
                            name: 'referrals',
                            orderable: false,
                            visible: false,
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

                $('#ambassadors-list-table').on('click', '.top-level-row', function () {
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
