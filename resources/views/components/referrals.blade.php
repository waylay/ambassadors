<table id="referrals-list-table" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Job</th>
            <th>Location</th>
            <th>Ambassador</th>
            <th>Date</th>
            <th>Hired</th>
            <th>Hours</th>
            <th class="no-export">Notes</th>
            <th class="no-export">ID</th>
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
                    output += '<li><p>' + note.note + '</p>' + '<em><small><strong>' + note.user.name + '</strong> on ' + note.created_at +'</small></em></li>';
                });
                output += '</ul>';
            }
            return output;
        }

        $(document).ready(function() {
            function format ( d ) {
                return '<div class="details"><form class="details-form">' +
                    '<div class="row">' +
                    '<div class="col-md-7" style="line-height: 1.9em;">' +
                        '<h5><strong>Ambassador:</strong> ' + '<a href="' + '{{ route("ambassadors") }}?search=' + d[5] + '">' + d[5] + '</a>' + '</h5><br>' +
                        '<input type="hidden" name="id" value="' + d[10] + '">' +
                        '<strong>Name:</strong> ' + d[0] + '<br>' +
                        '<strong>Email:</strong> ' + d[1] + '<br>' +
                        '<strong>Phone:</strong> ' + d[2] + '<br>' +
                        '<strong>Job:</strong> ' + d[3] + '<br>' +
                        '<strong>Location:</strong> ' + d[4] + '<br>' +
                        '<strong>Date:</strong> ' + d[6] + '<br>' +
                        '<div class="form-group row mt-2"><div class="col-12"><button class="btn btn-sm btn-primary btn-claim text-uppercase save mr-3" type="submit">Update</button><a href="/dashboard/api/delete_referrals/'+ d['DT_RowId'].replace(/\D/g, '') +'" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete referral: '+  d[0] +'\');">DELETE</a></div></div>' +
                    '</div>' +
                    '<div class="col-md-5">' +
                        '<div class="form-group row mb-2"><div class="col-12"><strong class="mr-1">Hired? </strong> <input type="checkbox" id="hired" name="hired" ' + ( d[7] ? ' checked ' : '' ) + '"></div></div>' +
                        '<div class="form-group row"><div class="col-12"><label class="form-label d-inline"><strong class="mr-1">Hours</strong></label><input class="form-control d-inline" type="number" id="hours" name="hours" value="' + d[8] + '"' + '" style="width: 75px;"></div></div>' +
                        '<label class="form-check-label"><strong class="ml-1">Notes:</strong></label>' +
                        show_notes(d[9]) +
                        '<textarea name="note" class="form-control" placeholder="Add note"></textarea>' +
                        '' +
                        '<div class="response"></div>' +


                    '</div>' +
                    '</div>' +
                '</form></div>';
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
                processing: true,
                deferRender: true,
                order: [[ 6, "desc" ]],
                ajax: "{{ route('referrals_list') }}",
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(.no-export)'
                        }
                    },
                    {
                        extend: 'csv',
                        title: 'Referrals-' + formatDate,
                        exportOptions: {
                            columns: ':not(.no-export)',
                            format: {
                                header: function ( data, columnIdx ) {
                                    if(columnIdx == 3) {
                                        return 'Job';
                                    }
                                    if(columnIdx == 4) {
                                        return 'Location';
                                    }
                                    return data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Referrals-' + formatDate,
                        exportOptions: {
                            columns: ':not(.no-export)',
                            format: {
                                header: function ( data, columnIdx ) {
                                    if(columnIdx == 3) {
                                        return 'Job';
                                    }
                                    if(columnIdx == 4) {
                                        return 'Location';
                                    }
                                    return data;
                                }
                            }
                        },
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
                        visible: false,
                        searchable: false
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
                    this.api().columns([3,4]).every( function (index) {
                        var column = this;
                        var select = $('<select><option value="">'+ $(this.header()).text() +'</option></select>')
                                .appendTo( $(column.header()).empty() )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    table.column(index).search(val, true, false).draw();
                                } )
                                .on( 'click', function (e) {
                                    e.stopPropagation();
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



            $( '#referrals-list-table tbody' ).on('click', 'tr', function (event) {
                var tr = $(this);
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    $('.details', row.child()).slideUp( function () {
                        row.child.hide();
                        tr.removeClass('shown');
                    });
                }
                else {
                    // Open this row
                    if (row.data()) {
                        row.child( format( row.data() ) ).show();
                        $('.details', row.child()).slideDown();
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
                        var correct_data = [];

                        correct_data[0] = response.data.name;
                        correct_data[1] = response.data.email;
                        correct_data[2] = response.data.phone;
                        correct_data[3] = response.data.job;
                        correct_data[4] = response.data.location;
                        correct_data[5] = response.data.ambassador.name;
                        correct_data[6] = response.data.created_at;
                        correct_data[7] = response.data.hired;
                        correct_data[8] = response.data.hours;
                        correct_data[9] = response.data.notes;
                        correct_data[10] = response.data.id;
                        correct_data['DT_RowId'] = response.data.DT_RowId;



                        var idx = row.index();
                        row.data( correct_data );
                        table.row(idx).child( format( row.data() ) ).show();
                        $('.details', row.child()).show();
                        $('.details', row.child()).find('button').text('Updated').toggleClass('btn-success').attr('disabled','disabled');


                        setTimeout(function () {
                            $('.details', row.child()).find('button').text('Update').toggleClass('btn-success').removeAttr('disabled');
                        }, 1000);

                    }
                });
            });


        });


    </script>
@endpush
