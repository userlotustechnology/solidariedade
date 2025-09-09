(function($) {
    'use strict';
    $(function() {
    var tableIds = ['#order-listing2', '#order-listing3', '#modules-listing', '#users-listing'];

    tableIds.forEach(function(id) {
      // Verificar se a tabela existe e se já foi inicializada
      if ($(id).length && !$.fn.DataTable.isDataTable(id)) {
        $(id).DataTable({
        "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
        search: "Procurar",
        paginate: {
          previous: 'Anterior',
          next: 'Próximo'
        },
        "lengthMenu": "Mostrar _MENU_ registros por página",
        }
      });
      }
    });

    tableIds.forEach(function(id) {
      if ($(id).length && $.fn.DataTable.isDataTable(id)) {
        $(id).each(function() {
          var datatable = $(this);
          // SEARCH - Add the placeholder for Search and Turn this into in-line form control
          var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
          search_input.attr('placeholder', 'Procurar');
          search_input.removeClass('form-control-sm');
          // LENGTH - Inline-Form control
          var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
          length_sel.removeClass('form-control-sm');
        });
      }
    });
  })
})(jQuery);
