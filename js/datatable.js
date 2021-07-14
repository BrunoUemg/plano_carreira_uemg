function getParam() {
  return window.location.href.slice(window.location.href.indexOf('?') + 1).split('=')[1];
}

$(document).ready(function () {
  // Setup - add a text input to each footer cell
  $('#dtbProfessores thead tr').clone(true).appendTo('#dtbProfessores thead');
  $('#dtbProfessores thead tr:eq(1) th').each(function (i) {
    var title = $(this).text();
    if (title != 'Lattes') {
      $(this).html('<input type="text" class="form-control" id=' + title + ' placeholder="Pesquisar ' + title + '" />');
    } else {
      $(this).html('<input type="text" disabled class="form-control" placeholder="Pesquisar ' + title + '" />');
    }


    $('input', this).on('keyup change', function () {
      if (table.column(i).search() !== this.value) {
        table
          .column(i)
          .search(this.value)
          .draw();
      }
    });
  });

  var table = $('#dtbProfessores').DataTable({
    ajax: './model/lista_professores.php',
    columns: [
      { "data": "id" },
      { "data": "professorNome" },
      { "data": "professorMateria" },
      { "data": "unidadeNome" },
      { "data": "professorLattes" },
      { "data": "professorInfo" }
    ],
    orderCellsTop: true,
    fixedHeader: true,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    },
    "columnDefs": [
      {
        "targets": [0],
        "visible": false
      },
      {
        "targets": [4],
        "searchable": false,
        "render": function (data, type, row, meta) {
          return '<a href="' + data + '" target="_blank">Currículo Lattes</a>';
        }
      }
    ],
    "initComplete": function (settings, json) {
      if (getParam()) {
        document.getElementById('Unidade').value = getParam();
        // document.getElementById('Unidade').enterKeyHint();
      }
    }
  });
});