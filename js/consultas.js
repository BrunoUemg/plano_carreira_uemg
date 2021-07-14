$(document).ready(function(){
    $.ajax({
        type: "get",
        url: "../model/consulta.php?opcao=unidade",
        data: { unidades: $("#unidades").val() },
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        success: function (obj) {
            if (obj != null) {             
                var data = Object.values(obj);
                data = data[0];                
                var selectbox = $('#profUnidade');
                var selectbox2 = $('#unidadeAluno');
                $.each(data, function (i, d) {
                    $('<option>').val(d.idUnidade).text(d.unidadeNome).appendTo(selectbox);
                    $('<option>').val(d.idUnidade).text(d.unidadeNome).appendTo(selectbox2);
                });
            }
            $.ajax({
                type: "get",
                url: "../model/consulta.php?opcao=curso",
                data: { cursos: $("#cursos").val() },
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                success: function (obj) {
                    if (obj != null) {             
                        var data = Object.values(obj);
                        data = data[0];                
                        var selectbox = $('#cursoAluno');
                        $.each(data, function (i, d) {
                            $('<option>').val(d.idCurso).text(d.cursoNome).appendTo(selectbox);
                        });
                    }
                }
            });
        }
    });
});