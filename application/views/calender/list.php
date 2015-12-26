<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

<div class="container">
<div class="table-responsive">
<table id="booking-list" class="table table-striped table-bordered responsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Phone</th>
                <th>Room</th>
                <th>Day</th>
                <th>Hour</th>
                <th>Period</th>
                <th>Booking Date</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>id</th>
                <th>Phone</th>
                <th>Room</th>
                <th>Day</th>
                <th>Hour</th>
                <th>Period</th>
                <th>Booking Date</th>
            </tr>
        </tfoot>
        <tbody>

        </tbody>
    </table>
</div>
</div>


<script type="text/javascript">

var bookingList;

$(function(){

    $(window).bind('focus', function() {
        bookingList.fnFilter('',0);
    });

	bookingList = $('#booking-list').dataTable({
		"responsive": true,
		"bProcessing": true,
		'bServerSide': true,
		'sAjaxSource': '/calender/index/getList/',
		"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col col-sm-6'p>>",
		"iDisplayLength": 15,
		"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
		"sPaginationType": "full_numbers",
		"aaSorting": [[ 0, "desc" ]],
		"aoColumnDefs": [
			 { "bSortable": false, "aTargets": [1] }
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
		},
		"fnServerParams": function(aoData) {
		},
		"fnDrawCallback": function( oSettings ) {
		}
	});

});


</script>