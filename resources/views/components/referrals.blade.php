<table id="referrals-list-table" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th class="select-filter">Job</th>
            <th class="select-filter">Location</th>
            <th>Ambassador</th>
            <th>Date</th>
        </tr>
    </thead>
</table>

@push('scripts')
    <script>
        $(document).ready(function() {
            function format ( d ) {

                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">'+
                    '<tr>'+
                        '<td>Phone:</td>'+
                        '<td>'+d[2]+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Ambassador:</td>'+
                        '<td>' +
                            '<a href="' + '{{ route("ambassadors") }}?search=' + d[5] + '">' + d[5] + '</a>' +
                        '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td style="white-space:nowrap; min-width: 100px; width: 25%;">Referred date:</td>'+
                        '<td>' + d[6] + '</td>'+
                    '</tr>'+
                '</table>';
            }
            var currentdate = new Date();
            var formatDate = currentdate.getFullYear() + "-" + (currentdate.getMonth()+1)  + "-" + currentdate.getDate();

            function getSearchParam(){
                return decodeURI(window.location.href.slice(window.location.href.indexOf('?') + 1).split('=')[1]);
            }
            var table = $('#referrals-list-table').DataTable({
                lengthMenu: [ [10, 25, 50, 100000], [10, 25, 50, "All"] ],
                scrollY: 500,
                dom: 'Bflrtip',
                serverSide: true,
                processing: false,
                deferRender: false,
                order: [[ 6, "desc" ]],
                ajax: "{{ route('referrals_list') }}",
                buttons: [
                    'copy',
                    {
                        extend: 'csv',
                        title: 'Referrals-' + formatDate,
                    },
                    {
                        extend: 'pdf',
                        title: 'Referrals-' + formatDate,
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
                        orderable: false,
                        visible: false

                    },
                    {
                        name: 'job',
                    },
                    {
                        name: 'location',
                    },
                    {
                        name: 'ambassador.name',
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
                initComplete: function () {
                    this.api().columns([3,4]).every( function () {
                        var column = this;
                        var select = $('<select><option value="">'+ $(this.header()).text() +'</option></select>')
                                .appendTo( $(column.header()).empty() )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                    );

                                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                                } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            });
            if(getSearchParam() != 'undefined') {
                table.search(getSearchParam()).draw();
            }


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

            table.columns( '.select-filter' ).every( function () {
                var that = this;

                // Create the select list and search operation
                var select = $('<select />')
                    .appendTo(
                        this.footer()
                    )
                    .on( 'change', function () {
                        that
                            .search( $(this).val() )
                            .draw();
                    } );

                // Get the search data for the first column and add to the select list
                this
                    .cache( 'search' )
                    .sort()
                    .unique()
                    .each( function ( d ) {
                        select.append( $('<option value="'+d+'">'+d+'</option>') );
                    } );
            } );
        });


    </script>
@endpush
