$(document).ready(function () {
  var table = $('#manageCurso').DataTable({
    responsive: true,
    ajax: './model/consulta.php?opcao=cursodata',
    columns: [
      { "data": "cursoNome" },
      { "data": "idCurso" },
      { "data": "idCurso" }
    ],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    },
    responsive: {
      details: {
        display: $.fn.dataTable.Responsive.display.modal({
          header: function (row) {
            var data = row.data();
            return 'Detalhes de ' + data.cursoNome;
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
          return '<a class="btn btn-sm btn-outline-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editaCurso" data-id="' + data + '">Editar Curso</a>';
        }
      },
      {
        targets: [2],
        searchable: false,
        render: function (data, type, row, meta) {
          return '<a value="' + data + '" nome-curso="' + row.cursoNome + '" class="btn btn-sm btn-outline-danger btn-delet">Excluir Curso</a>';
        }
      }
    ]
  });

  $('#editaCurso').on('show.bs.modal', function (e) {
    var idCur = $(e.relatedTarget).data('id');
    $.ajax({
      url: `../model/consulta.php?opcao=cur&valor=${idCur}`,
      dataType: "json",
      type: "GET",
      contentType: false,
      processData: false,
      success: function (obj) {
        if (obj != null) {
          var data = Object.values(obj);
          data = data[0];
          $("input[name='nomeCurso']").val(data[0].cursoNome);
          $("input[name='idCurso']").val(data[0].idCurso);
          $('#btn-save').prop('disabled', false);
          $(".formEditCurso").removeClass("visually-hidden");
          $("#loading-status").addClass("visually-hidden");
        }
      }
    });
  });

  $('#idCurso').on('hide.bs.modal', function () {
    $("input[name='nomeCurso']").val('');
    $("input[name='idCurso']").val('');
    $(".formEditCurso").addClass("visually-hidden");
    $("#loading-status").removeClass("visually-hidden");
  });

  $("#editarCurso").on("submit", function (event) {
    event.preventDefault();
    var idCurso = $("input[name='idCurso']").val();
    $.ajax({
      method: "POST",
      url: `../model/manage_curso.php?opcao=edit&valor=${idCurso}`,
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (retorna) {
        if (retorna['sit']) {
          $("#msg-cad").html(retorna['msg']);
          $('#editaCurso').modal('hide');
          $('#manageCurso').DataTable().ajax.reload();
        } else {
          $("#msg-cad").html(retorna['msg']);
        }
      }
    })
  });

  $("#addCurso").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
      method: "POST",
      url: `../model/manage_curso.php?opcao=add`,
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (retorna) {
        if (retorna['sit']) {
          $("#msg-cad").html(retorna['msg']);
          $('#cadastroCurso').modal('hide');
          $('#manageCurso').DataTable().ajax.reload();
        } else {
          $("#msg-cad").html(retorna['msg']);
        }
      }
    })
  });

});




$(document).on('click', '.btn-delet', function () {
  var idCurso = $(this).attr("value");
  var nomeCurso = $(this).attr("nome-curso");
  $.confirm({
    title: 'Atenção!',
    content: `Você tem certeza que deseja excluir a unidade ${nomeCurso}?`,
    buttons: {
      confirm: {
        text: 'Sim',
        btnClass: 'btn-blue',
        keys: ['enter', 'shift'],
        action: function () {
          $.ajax({
            url: `../model/manage_curso.php?opcao=delete&valor=${idCurso}`,
            dataType: "json",
            type: "POST",
            data: $(this).attr("value"),
            contentType: false,
            processData: false,
            success: function (retorna) {
              if (retorna['sit']) {
                $("#msg-cad").html(retorna['msg']);
                $('#manageCurso').DataTable().ajax.reload();
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