<table id="referrals-list-table" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Job</th>
            <th>Location</th>
            <th>Ambassador</th>
            <th>Hired</th>
            <th>Hours</th>
            <th>Notes</th>
            <th>Date</th>
        </tr>
    </thead>
</table>

@push('scripts')
    <script>

        function show_notes( notes ) {
            var output = '';
            if (notes.length) {
                output += '<ul>';
                notes.forEach(function(note) {
                    output += '<li><p>' + note.note + '</p>' + '<em><small>By <strong>' + note.user.name + '</strong>, on ' + note.created_at +'</small></em></li>';
                });
                output += '</ul>';
            }
            return output;
        }

        $(document).ready(function() {
            function format ( d ) {
                return '<div class="details"><form class="details-form">' +
                    '<div class="row">' +
                    '<div class="col-md-8">' +
                        '<input type="hidden" name="id" value="' + d[10] + '">' +
                        '<h5><strong>Ambassador:</strong> ' + d[5] + '</h5><br>' +
                        '<strong>Phone:</strong> ' + d[2] + '<br>' +
                        '<strong>Date:</strong> ' + d[6] + '<br>' +
                        '<br><label class="form-check-label"><strong>Notes:</strong></label>' +
                        show_notes(d[9]) +
                        '<textarea name="note" class="form-control" placeholder="Add note"></textarea>' +
                        '<button class="btn btn-success btn-claim btn-md text-uppercase save mt-3" type="submit">SAVE</button>' +
                        '<div class="response"></div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                        '<div class="form-group row mt-3 mb-1"><div class="col-5">Hired</div><div class="col-7"><input class="form-check-input" type="checkbox" id="hired" name="hired" ' + ( d[7] ? ' checked ' : '' ) + '"></div></div>' +
                        '<div class="form-group row"><label class="col-5 col-form-label">Total Hours</label><div class="col-7"><input class="form-control" type="text" id="hours" name="hours" value="' + d[8] + '"' + '"></div></div>' +
                    '</div>' +
                    '</div>' +
                '</form></div>';
            }
            function format2 ( d ) {


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
                iDisplayLength: 25,
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
                    {
                        name: 'hired',
                        orderable: false,
                        visible: false
                    },
                    {
                        name: 'hours',
                        orderable: false,
                        visible: false
                    },
                    {
                        name: 'notes',
                        orderable: false,
                        visible: false
                    },
                    {
                        name: 'id',
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
            });



            $( '#referrals-list-table tbody' ).on('click', 'tr', function (event) {
                var tr = $(this);
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    if (row.data()) {
                        row.child( format(row.data()) ).show();
                        tr.addClass('shown');
                    }
                }
            });

            $( '#referrals-list-table tbody' ).on( "submit", ".details-form", function( event ) {
                event.preventDefault();

                var tr = $(this).closest("tr").prev()[0];
                var row = table.row( tr );
                var data = {};
                $.each( $(this).serializeArray(), function(i, field) {
                    data[field.name] = field.value;
                });

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/dashboard/api/referrals/' + data.id,
                    data: data,
                    success: function( response ) {
                        var numeric_array = new Array();
                        for (var items in response.data){
                            numeric_array.push( response.data[items] );
                        }

                        console.log(row.data());
                        console.log(numeric_array);
                        var idx = row.index();
                        row.data( numeric_array ).draw( 'page' );
                        table.row(idx).child( format( row.data() ) ).show();

                    }
                });
            });


        });


    </script>
@endpush
