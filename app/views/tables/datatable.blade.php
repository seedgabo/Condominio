  $(".jtable tbody").after("<tfoot class='tfoot'><tr></tr></tfoot>");
              $('#table thead th').each( function () {
                    var title = $(this).text();
                    $("#table tfoot tr").append('<th><input id="'+ title +'-form" class="form-control input-sm" type="text" placeholder=" '+title+'"/></th>' );
                } );

 var tabla = $('table.jtable').DataTable(
                {
                    responsive: true,
                    "pagingType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                     "language":
                    {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "NingÃºn dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate":
                        {
                            "sFirst": "<<",
                            "sLast": ">>",
                            "sNext": ">",
                            "sPrevious": "<"
                        },
                        "oAria":
                        {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                    }
                });
    $(".jtable").addClass("table table-striped table-bordered table-hover display compact");
    $(".dataTables_paginate").removeClass("ui-buttonset");
    $(".dataTables_length").css("display", "inline").append('&nbsp;&nbsp;&nbsp;');
    $(".dataTables_filter").css("display", "inline");
    $("input[type='search']").before("&nbsp;");
    $('.dataTables_paginate').css("font-size","18px");


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
               
