$(document).ready(function () {
  var table = $('#dtbProfessores').DataTable({
    responsive: true,
    ajax: './model/lista_professores.php?opcao=',
    columns: [
      { "data": "idProfessor" },
      { "data": "professorNome" },
      { "data": "professorMateria" },
      { "data": "unidadeNome" },
      { "data": "professorLattes" },
      { "data": "professorInfo" },
      { "data": "idProfessor" }
    ],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    },
    responsive: {
      details: {
        display: $.fn.dataTable.Responsive.display.modal({
          header: function (row) {
            var data = row.data();
            return 'Detalhes de ' + data.professorNome;
          }
        }),
        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
          tableClass: 'table'
        })
      }
    },
    "columnDefs": [
      {
        targets: [4],
        searchable: false,
        render: function (data, type, row, meta) {
          return '<a href="' + data + '" target="_blank" class="btn btn-sm btn-outline-primary">Currículo Lattes</a>';
        }
      },
      {
        targets: [6],
        searchable: false,
        render: function (data, type, row, meta) {
          return '<a value="' + data + '" class="btn btn-sm btn-outline-warning btn-apoio">Solicitar Professor</a>';
        }
      }
    ]
  });
});




$(document).on('click', '.btn-apoio', function () {
  var idProf = $(this).attr("value");
  $.confirm({
    title: 'Atenção!',
    content: 'Você tem certeza que deseja realizar o pedido de plano de carreira para o professor selecionado?',
    buttons: {
      confirm: {
        text: 'Sim',
        btnClass: 'btn-blue',
        keys: ['enter', 'shift'],
        action: function () {
          console.log(idProf);
          $.ajax({
            url: "../model/cadastro.php?opcao=apoio",
            dataType: "json",
            type: "POST",
            data: $(this).attr("value"),
            contentType: false,
            processData: false,
            success: function (retorna) {
              if (retorna['sit']) {
                $("#msg-cad").html(retorna['msg']);
              } else {
                $("#msg-cad").html(retorna['msg']);
              }
            }
          });
        }
      },
      cancel: {
        text: 'Não',
        btnClass: 'btn-red',
        keys: ['enter', 'shift']
      }
    }
  });
});