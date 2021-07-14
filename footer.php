</div>
</div>
</section>
<!--fim secao -->

</body>

</html>

<script type="text/javascript">
    function login() {
        var email = $("#loginEmail").val();
        var pass = $("#loginPassword").val();
        if (email != "" && pass != "") {
            $.ajax({
                type: 'post',
                url: './model/login.php',
                data: {
                    login: "login",
                    email: email,
                    password: pass
                },
                success: function(response) {
                    if (response == "success") {
                        window.location.href = "index.php";
                        alert('Ok');
                    } else {
                        document.getElementById("loginPassword").className += " is-invalid";
                        document.getElementById("loginEmail").className += " is-invalid";
                        alert('Errouuu');
                    }
                }
            });
        } else {
            alert("Preencha todos os dados.");
        }

        return false;
    }

    $(document).ready(function() {
        $("#profCadastro").on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                method: "POST",
                url: "./model/cadastro.php?opcao=professor",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(retorna) {
                    if (retorna['sit']) {
                        $("#msg-cad").html(retorna['msg']);
                        $('#criarContaProfessor').modal('hide');
                    } else {
                        $("#msg-cad").html(retorna['msg']);
                    }
                }
            })
        });
    });
    $(document).ready(function() {
        $("#alunoCadastro").on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                method: "POST",
                url: "./model/cadastro.php?opcao=aluno",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(retorna) {
                    if (retorna['sit']) {
                        $("#msg-cad").html(retorna['msg']);
                        $('#criarContaAluno').modal('hide');
                    } else {
                        $("#msg-cad").html(retorna['msg']);
                    }
                }
            })
        });
    });
</script>