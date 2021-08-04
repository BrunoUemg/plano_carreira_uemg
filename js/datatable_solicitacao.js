$(document).ready(function () {

  var table1 = $('#dtbAceito').DataTable({
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
        render: function (data, type, row) {
          return '<button type="submit" class="btn btn-sm btn-success btn-status"><i class="far fa-check-circle"></i></i></button>';
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
          return '<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#infoAluno" data-id="' + row.idPlanoCarreira + '" data-nome="' + row.alunoNome + '">Informações</button>';
        }
      }
    ]
  });

  var table2 = $('#dtbSolicitacoes').DataTable({
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
        render: function (data, type, row) {
          return '<form class="formApoioStatus"> <input type="hidden" value="' + row.idPlanoCarreira + '" name="idPlanoCarreira"> <input type="hidden" value="' + row.alunoNome + '"name="alunoNome"><button type="submit" class="btn btn-sm btn-warning btn-status"><i class="fas fa-spinner"></i></i></button></form>';
        }
      }
    ]
  });

  $('#infoAluno').on('show.bs.modal', function (e) {
    var idPlano = $(e.relatedTarget).data('id');
    var nomeAluno = $(e.relatedTarget).data('nome');
    $.ajax({
      url: `./model/consulta.php?opcao=info&valor=${idPlano}`,
      dataType: "json",
      type: "GET",
      contentType: false,
      processData: false,
      success: function (obj) {
        if (obj != null) {
          var data = Object.values(obj);
          data = data[0];
          $(".nome-aluno").text(`Informações Aluno ${nomeAluno}`);
          $("#infoAlunoText").val(data[0].planoCarreiraInfo);
          $("#planoEdit").val(data[0].idPlanoCarreira);
          $('#btn-save').prop('disabled', false);
          $("#FormInfoAluno").removeClass("visually-hidden");
          $("#loading-status").addClass("visually-hidden");
        }
      }
    });
  });

  $('#infoAluno').on('hide.bs.modal', function () {
    $("#planoEdit").val('');
    $("#infoAlunoText").val('');
    $(".nome-aluno").text(`Informações Aluno`);
    $("#FormInfoAluno").addClass("visually-hidden");
    $("#loading-status").removeClass("visually-hidden");
  });

  $("#FormInfoAluno").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
      method: "POST",
      url: `./model/status_solicitacao.php?opcao=edit`,
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (retorna) {
        if (retorna['sit']) {
          $("#msg-cad").html(retorna['msg']);
          $('#infoAluno').modal('hide');
          $('#dtbAceito').DataTable().ajax.reload();
        } else {
          $("#msg-cad").html(retorna['msg']);
        }
      }
    })
  });

});


$(document).on('submit', '.formApoioStatus', function (e) {
  e.preventDefault();
  var dataApoio = new FormData(this);
  $.confirm({
    title: 'Atenção!',
    content: `Você tem certeza que deseja aceitar o pedido de aluno ${dataApoio.get('alunoNome')}? `,
    buttons: {
      confirm: {
        text: 'Aceitar',
        btnClass: 'btn-success',
        keys: ['enter', 'shift'],
        action: function () {
          $.ajax({
            url: "./model/status_solicitacao.php?opcao=aceita",
            type: "POST",
            data: dataApoio,
            contentType: false,
            processData: false,
            success: function (retorna) {
              if (retorna['sit']) {
                $("#msg-cad").html(retorna['msg']);
                $('#dtbSolicitacoes').DataTable().ajax.reload();
                $('#dtbAceito').DataTable().ajax.reload();
              } else {
                $("#msg-cad").html(retorna['msg']);
              }
            }
          });
        }
      },
      cancel: {
        text: 'Recusar',
        btnClass: 'btn-red',
        keys: ['enter', 'shift']
      },
      sair: {
        text: 'Sair',
        btnClass: 'btn-light',
        keys: ['enter', 'shift']
      }
    }
  });
});