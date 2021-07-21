$(document).ready(function () {
  var table = $('#manageProfessores').DataTable({
    responsive: true,
    ajax: './model/lista_professores.php?opcao=',
    columns: [
      { "data": "professorNome" },
      { "data": "professorMateria" },
      { "data": "unidadeNome" },
      { "data": "idProfessor" },
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
        targets: [3],
        searchable: false,
        render: function (data, type, row, meta) {
          return '<a class="btn btn-sm btn-outline-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editarContaProfessor" data-id="' + data + '">Editar Professor</a>';
        }
      },
      {
        targets: [4],
        searchable: false,
        render: function (data, type, row, meta) {
          return '<a value="' + data + '" nome-prof="' + row.professorNome + '" class="btn btn-sm btn-outline-danger btn-delet">Excluir Professor</a>';
        }
      }
    ]
  });

  $('#editarContaProfessor').on('show.bs.modal', function (e) {
    var idProf = $(e.relatedTarget).data('id');
    $.ajax({
      url: `../model/lista_professores.php?opcao=id&valor=${idProf}`,
      dataType: "json",
      type: "GET",
      contentType: false,
      processData: false,
      success: function (obj) {
        if (obj != null) {
          var data = Object.values(obj);
          data = data[0];
          $("#profId").val(data[0].idProfessor);
          $("#profNome").val(data[0].professorNome);
          $("#profTel").val(data[0].professorTel);
          $("#profDtaNascimento").val(data[0].professorDataNascimento);
          $("#profCpf").val(data[0].professorCPF);
          $("#profEmail").val(data[0].professorEmail);
          $("#profSenha").val(data[0].professorSenha);
          $("#profUnidade").val(data[0].unidade_idUnidade);
          $("#profMateria").val(data[0].professorMateria);
          $("#profLattes").val(data[0].professorLattes);
          $("#profInfo").val(data[0].professorInfo);
          if (data[0].professorCoord === '001') {
            $('#professorCoord').prop('checked', true);
          } else {
            $('#professorCoord').prop('checked', false);
          }
          $('#btn-save').prop('disabled', false);
          $("#profEditCadastro").removeClass("visually-hidden");
          $("#loading-status").addClass("visually-hidden");
        }
      }
    });
  });

  $('#editarContaProfessor').on('hide.bs.modal', function () {
    $("#profId").val('');
    $("#profNome").val('');
    $("#profTel").val('');
    $("#profDtaNascimento").val('');
    $("#profCpf").val('');
    $("#profEmail").val('');
    $("#profSenha").val('');
    $("#profUnidade").val('');
    $("#profMateria").val('');
    $("#profLattes").val('');
    $("#profInfo").val('');
    $('#professorCoord').prop('checked', false);
    $("#profEditCadastro").addClass("visually-hidden");
    $("#loading-status").removeClass("visually-hidden");
  });

  $("#profEditCadastro").on("submit", function (event) {
    event.preventDefault();
    var idProf = $("#profId").val();
    console.log(idProf);
    $.ajax({
      method: "POST",
      url: `../model/manage_prof.php?opcao=edit&valor=${idProf}`,
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (retorna) {
        if (retorna['sit']) {
          $("#msg-cad").html(retorna['msg']);
          $('#editarContaProfessor').modal('hide');
          $('#manageProfessores').DataTable().ajax.reload();
        } else {
          $("#msg-cad").html(retorna['msg']);
        }
      }
    })
  });
});




$(document).on('click', '.btn-delet', function () {
  var idProf = $(this).attr("value");
  var nomeProf = $(this).attr("nome-prof");
  $.confirm({
    title: 'Atenção!',
    content: `Você tem certeza que deseja excluir o professor ${nomeProf}?`,
    buttons: {
      confirm: {
        text: 'Sim',
        btnClass: 'btn-blue',
        keys: ['enter', 'shift'],
        action: function () {
          $.ajax({
            url: `../model/manage_prof.php?opcao=delete&valor=${idProf}`,
            dataType: "json",
            type: "POST",
            data: $(this).attr("value"),
            contentType: false,
            processData: false,
            success: function (retorna) {
              if (retorna['sit']) {
                $("#msg-cad").html(retorna['msg']);
                $('#manageProfessores').DataTable().ajax.reload();
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