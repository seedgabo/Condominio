  $(".jtable tbody").after("<tfoot class='tfoot'><tr></tr></tfoot>");
              $('#table thead th').each( function () {
                    var title = $(this).text();
                    $("#table tfoot tr").append('<th><input id="'+ title +'-form" class="form-control input-sm" type="text" placeholder=" '+title+'"/></th>' );
                } );

 var tabla = $('table.jtable').DataTable({
     "language": {
         "sProcessing":     "Procesando...",
         "sLengthMenu":     "Mostrar _MENU_ registros",
         "sZeroRecords":    "No se encontraron resultados",
         "sEmptyTable":     "Ningún dato disponible en esta tabla",
         "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
         "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
         "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
         "sInfoPostFix":    "",
         "sSearch":         "Buscar:",
         "sUrl":            "",
         "sInfoThousands":  ",",
         "sLoadingRecords": "Cargando...",
         "oPaginate": {
             "sFirst":    "Primero",
             "sLast":     "Último",
             "sNext":     "Siguiente",
             "sPrevious": "Anterior"
         },
         "oAria": {
             "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
             "sSortDescending": ": Activar para ordenar la columna de manera descendente"
         },
         "decimal": ",",
         "thousands": ".",
         buttons: {
         'copy' : 'Copiar', 'excel' :'Exportar a Excel', 'pdf': 'Exportar a Pdf' ,'print' :'Imprimir', 'colvis':'Ver'
         }
     },
     responsive: true,
     ordering: false,
     "lengthMenu": [ [10, 25, 50,100 ,-1], [10, 25, 50, 100 ,"Todos"] ],
     stateSave: true,
     dom: 'rtlip',
     buttons: [
         {
             extend:    'copyHtml5',
             text:      '<i class="fa fa-files-o text-info"></i>',
             titleAttr: 'Copiar',
             className: "btn btn-default",
             exportOptions: {
                 columns: ':visible:not(:last-child):not(:nth-last-child(2))',
                 modifier: {
                    page: 'current',
                    search: 'applied',
                    order:  'current'
                },
                 modifier: {
                    page: 'current'
                }
             }
         },
         {
             extend:    'excel',
             text:      '<i class="fa fa-file-excel-o text-success"></i>',
             titleAttr: 'Excel',
             className: "btn btn-default",
             exportOptions: {
                 columns: ':visible:not(:last-child):not(:nth-last-child(2))',
                 modifier: {
                    page: 'current',
                    search: 'applied',
                    order:  'current'
                }
             }
         },
         {
             extend:    'print',
             text:      '<i class="fa fa-print text-warning"></i>',
             titleAttr: 'Imprimir',
             className: "btn btn-default",
             exportOptions: {
                 columns: ':visible:not(:last-child):not(:nth-last-child(2))',
                 modifier: {
                    page: 'current',
                    search: 'applied',
                    order:  'current'
                }
             }
         },
         {
             extend:    'pdfHtml5',
             text:      '<i class="fa fa-file-pdf-o text-danger"></i>',
             titleAttr: 'PDF',
             className: "btn btn-default",
             exportOptions: {
                 columns: ':visible:not(:last-child):not(:nth-last-child(2))',
                 modifier: {
                    page: 'current',
                    search: 'applied',
                    order:  'current'
                }
             },
             orientation: 'landscape'
         },
         {
             extend:    'colvis',
             text:      '<i class="fa fa-eye text-primary"></i>',
             className: "btn btn-default",
             titleAttr: 'Mostrar/Ocultar Columnas',
             columns: ':not(:last-child):not(:nth-last-child(2))',
         },
     ]
 });

    tabla.buttons().container().insertBefore( '.jtable-toolbar' );
    $(".jtable").addClass("table table-striped table-bordered table-hover display compact");
    $(".dataTables_length").addClass("pull-right");
    $(".dt-buttons.btn-group");
// Apply the search
tabla.columns().every( function ()
{
    var that = this;
    $('input', this.footer() ).on( 'keyup change', function ()
{
        that
            .search( this.value )
            .draw();
    });
});
