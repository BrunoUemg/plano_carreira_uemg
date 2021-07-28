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
          return '<form class="formApoio"> <input type="hidden" value="' + data + '" name="idProfApoio"> <input type="hidden" value="' + user + '"name="idAlunoApoio"><button type="submit" class="btn btn-sm btn-outline-warning btn-apoio">Solicitar Professor</button></form>';
        }
      }
    ]
  });

});


$(document).on('submit', '.formApoio', function (e) {
  e.preventDefault();
  if (user === -1 || prof) {
    $('.dtr-bs-modal').modal('hide');
    $("#msg-cad").html('<div class="alert alert-danger" role="alert">Você não tem permissão para solicitar apoio a professores!</div>');
  } else {
    var dataApoio = new FormData(this);
    $.confirm({
      title: 'Atenção!',
      content: 'Você tem certeza que deseja realizar o pedido de plano de carreira para o professor selecionado?',
      buttons: {
        confirm: {
          text: 'Sim',
          btnClass: 'btn-blue',
          keys: ['enter', 'shift'],
          action: function () {
            $.ajax({
              url: "../model/cadastro.php?opcao=apoio",
              type: "POST",
              data: dataApoio,
              contentType: false,
              processData: false,
              success: function (retorna) {
                if (retorna['sit']) {
                  $(".modal").modal('hide');
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
  }
});