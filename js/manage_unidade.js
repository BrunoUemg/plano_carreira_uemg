$(document).ready(function () {
  var table = $('#manageUnidade').DataTable({
    responsive: true,
    ajax: './model/consulta.php?opcao=unidadedata',
    columns: [
      { "data": "unidadeNome" },
      { "data": "idUnidade" },
      { "data": "idUnidade" }
    ],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    },
    responsive: {
      details: {
        display: $.fn.dataTable.Responsive.display.modal({
          header: function (row) {
            var data = row.data();
            return 'Detalhes de ' + data.unidadeNome;
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
        searchable: false,
        render: function (data, type, row, meta) {
          return '<a class="btn btn-sm btn-outline-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editaUnidade" data-id="' + data + '">Editar Unidade</a>';
        }
      },
      {
        targets: [2],
        searchable: false,
        render: function (data, type, row, meta) {
          return '<a value="' + data + '" nome-unidade="' + row.unidadeNome + '" class="btn btn-sm btn-outline-danger btn-delet">Excluir Unidade</a>';
        }
      }
    ]
  });

  $('#editaUnidade').on('show.bs.modal', function (e) {
    var idUni = $(e.relatedTarget).data('id');
    $.ajax({
      url: `./model/consulta.php?opcao=uni&valor=${idUni}`,
      dataType: "json",
      type: "GET",
      contentType: false,
      processData: false,
      success: function (obj) {
        if (obj != null) {
          var data = Object.values(obj);
          data = data[0];
          $("input[name='nomeUnidade']").val(data[0].unidadeNome);
          $("input[name='idUnidade']").val(data[0].idUnidade);
          $('#btn-save').prop('disabled', false);
          $(".formEditUnidade").removeClass("visually-hidden");
          $("#loading-status").addClass("visually-hidden");
        }
      }
    });
  });

  $('#editaUnidade').on('hide.bs.modal', function () {
    $("input[name='nomeUnidade']").val('');
    $("input[name='idUnidade']").val('');
    $(".formEditUnidade").addClass("visually-hidden");
    $("#loading-status").removeClass("visually-hidden");
  });

  $("#editarUnidade").on("submit", function (event) {
    event.preventDefault();
    var idUnidade = $("input[name='idUnidade']").val();
    $.ajax({
      method: "POST",
      url: `../model/manage_unidade.php?opcao=edit&valor=${idUnidade}`,
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (retorna) {
        if (retorna['sit']) {
          $("#msg-cad").html(retorna['msg']);
          $('#editaUnidade').modal('hide');
          $('#manageUnidade').DataTable().ajax.reload();
        } else {
          $("#msg-cad").html(retorna['msg']);
        }
      }
    })
  });

  $("#addUnidade").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
      method: "POST",
      url: `../model/manage_unidade.php?opcao=add`,
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (retorna) {
        if (retorna['sit']) {
          $("#msg-cad").html(retorna['msg']);
          $('#cadastroUnidade').modal('hide');
          $('#manageUnidade').DataTable().ajax.reload();
        } else {
          $("#msg-cad").html(retorna['msg']);
        }
      }
    })
  });

});




$(document).on('click', '.btn-delet', function () {
  var idUnidade = $(this).attr("value");
  var nomeUnidade = $(this).attr("nome-unidade");
  $.confirm({
    title: 'Atenção!',
    content: `Você tem certeza que deseja excluir a unidade ${nomeUnidade}?`,
    buttons: {
      confirm: {
        text: 'Sim',
        btnClass: 'btn-blue',
        keys: ['enter', 'shift'],
        action: function () {
          $.ajax({
            url: `../model/manage_unidade.php?opcao=delete&valor=${idUnidade}`,
            dataType: "json",
            type: "POST",
            data: $(this).attr("value"),
            contentType: false,
            processData: false,
            success: function (retorna) {
              if (retorna['sit']) {
                $("#msg-cad").html(retorna['msg']);
                $('#manageUnidade').DataTable().ajax.reload();
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