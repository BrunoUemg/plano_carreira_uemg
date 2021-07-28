$(document).ready(function () {

  var table = $('#dtbAceito').DataTable({
    responsive: true,
    ajax: './model/consulta.php?opcao=solicitacaoaceita&valor=' + user + '',
    columns: [
      { "data": "alunoNome" },
      { "data": "planoCarreiraDtaPedido" },
      { "data": "planoCarreiraStatus" },
      { "data": "alunoTel" },
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
            return 'Detalhes de ' + data.alunoNome;
          }
        }),
        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
          tableClass: 'table'
        })
      }
    },
    "columnDefs": [
      {
        targets: [1],
        searchable: true,
        render: function (data) {
          return moment(data).format('DD MMMM YYYY HH:mm:ss');
        }
      },
      {
        targets: [2],
        searchable: true,
        render: function (data) {
            return '<a target="_blank" class="btn btn-sm btn-success"><i class="far fa-check-circle"></i></a>';
        }
      },
      {
        targets: [3],
        searchable: false,
        render: function (data, type, row, meta) {
          return '<a href="https://api.whatsapp.com/send?phone=55' + data + '" target="_blank" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i></a>';
        }
      },
      {
        targets: [4],
        searchable: false,
        render: function (data, type, row, meta) {
          return '<a class="btn btn-sm btn-outline-primary btn-apoio">Informações</a>';
        }
      }
    ]
  });

  var table = $('#dtbSolicitacoes').DataTable({
    responsive: true,
    ajax: './model/consulta.php?opcao=solicitacaodata&valor=' + user + '',
    columns: [
      { "data": "alunoNome" },
      { "data": "planoCarreiraDtaPedido" },
      { "data": "planoCarreiraStatus" },
      { "data": "cursoNome" }
    ],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    },
    responsive: {
      details: {
        display: $.fn.dataTable.Responsive.display.modal({
          header: function (row) {
            var data = row.data();
            return 'Detalhes de ' + data.alunoNome;
          }
        }),
        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
          tableClass: 'table'
        })
      }
    },
    "columnDefs": [
      {
        targets: [1],
        searchable: true,
        render: function (data) {
          return moment(data).format('DD MMMM YYYY HH:mm:ss');
        }
      },
            {
        targets: [2],
        searchable: true,
        render: function (data) {
            return '<a target="_blank" class="btn btn-sm btn-warning"><i class="fas fa-spinner"></i></i></a>';
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