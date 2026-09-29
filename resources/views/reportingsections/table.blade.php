<!-- @section('content') -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<section id="dashboard-page" class="wrap">
	<div class="container-fluid" id="data_table">
	<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th style="width:10px;"></th>
                <th style="width: 100px">Date</th>

                @foreach($allLocations as $key=>$val)

                <th style="width: 100px">{{$val->location}}</th>
                @endforeach
            </tr>
        </thead>
    </table>
</section>



<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>



<script type="text/javascript">
function format ( d ) {
     // var temp = JSON.stringify(d);

     // var date = d.dt;

 // var temp = JSON.stringify(d);
  var html = '';
  html = '<table border="0"  class="display" style="width:100%">';
  html += '<tr>';
  html += ' <th></th><th style="font-size:12px;">Department</th>';
                @foreach($allLocations as $key=>$val)
  html += '<th style="font-size:12px;">{{$val->location}}</th>';
                @endforeach
  html += '<tr>';

        @foreach($departmentArr as $dep)

    html += '<tr><td></td>';
    html += '<td colspan="6" style="font-weight:bold;font-size:12px;">{{$dep}}</td>';
    html += '     <td ></td>';
    html += ' </tr>';

    <?php if(!empty($$dep)){?>


         @foreach($$dep as $k=> $sd)
       html +=  '<tr>';
      html +=       '<td></td>';
       html +=      '<td style="font-size:12px;">{{$sd}}</td>';
                 <?php foreach($allLocations as $key=>$val) {
                    $locVar = "location_".$val->id."_".$dep.".".$k;
                ?>
           var val =      d.{{$locVar}};

          if(val == undefined) {
				 html +='<td style="font-size:12px;">$0.00</td>';

        } else {
        html +='<td style="font-size:12px;">'+d.{{$locVar}}+'</td>';

        }
              <?php } ?>
       html +=      '</tr>';
             @endforeach
             <?php }?>
         @endforeach

     html +=    '</table>';

     return html;
}
$(document).ready(function() {
    var table = $('#example').DataTable( {
         "scrollX": true,
          "scrollY": 220,
					processing: false,
							 serverSide: true,
        "ajax": "{{ url('/') }}/reportSectionData.txt",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "sortBy" },
             @foreach($allLocations as $key=>$val)
             { "data": "location_{{$val->id}}" },
             @endforeach
        ],
        "order": [[1, 'desc']]
    } );

    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
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
} );
</script>
