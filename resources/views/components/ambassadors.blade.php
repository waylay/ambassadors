<table id="ambassadors-list-table" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Referrals</th>
                <th>Join date</th>
            </tr>
        </thead>
    </table>

    @push('scripts')
        <script>
            $(document).ready(function() {
                function format ( d ) {
                    var referrals = '';
                    d[3].split("|").forEach(function(referral){
                        referrals = referrals + '<a href="' + '{{ route("dashboard") }}?search=' + referral.trim() + '">' + referral.trim() + '</a><br>';
                    });
                    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">'+
                        '<tr>'+
                            '<td style="white-space:nowrap;">Referrals:</td>'+
                            '<td>'+ referrals +'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td style="white-space:nowrap; min-width: 100px; width: 25%;">Join date:</td>'+
                            '<td>'+ d[4] +'</td>'+
                        '</tr>'+
                    '</table>';
                }
                var currentdate = new Date();
                var formatDate = currentdate.getFullYear() + "-" + (currentdate.getMonth()+1)  + "-" + currentdate.getDate();
                function getSearchParam(){
                    return decodeURI(window.location.href.slice(window.location.href.indexOf('?') + 1).split('=')[1]);
                }
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

                if(getSearchParam() != 'undefined') {
                    table.search(getSearchParam()).draw();
                }

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
