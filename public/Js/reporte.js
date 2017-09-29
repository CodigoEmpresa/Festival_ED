$(function() {

        /*var table =   $('#lista').DataTable({
            responsive: true,
          "language": {
                      "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
                  },
                   dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]

      });*/
       $('#lista tfoot th').each( function (i) {
        var title = $('#lista thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
    } );
  
    // DataTable
    var table = $('#lista').DataTable( {
        scrollY:        "700px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf']
    } );
 
    // Filter event handler
    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
});

