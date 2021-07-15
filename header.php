<?php
session_start();
if (isset($_SESSION['login'])) {
  //login ok!
  //  echo $_SESSION['nome'];
} else {
  // echo 'não loguei';
}
?>
<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Datatable -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.bootstrap5.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Estilo customizado -->
  <link rel="stylesheet" href="./css/style.css">

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
  <!-- Consultas Ajax Popular -->
  <script src="./js/consultas.js"></script>
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <title>UEMG - Plano de Carreira</title>
</head>

<body>

  <!--inicio header -->
  <header>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
      <div class="container">
        <a href="./index.php" class="navbar-brand">
          <img src="./img/LOGO-UEMG2020.png">
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav-principal">
          <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="nav-principal">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="./index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="./professores.php" class="nav-link">Professores</a>
            </li>
            <li class="nav-item">
              <a href="./unidades.php" class="nav-link">Unidades</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Cursos</a>
            </li>
            <li class="nav-item">
              <div class="dropdown dropstart">
                <a href="" class="btn btn-outline-primary ms-4 " data-bs-toggle="dropdown">Entrar</a>

                <!-- Dropdown Login -->
                <div class="dropdown-menu">
                  <form class="px-4 py-3" method="post" action="./model/login.php" onsubmit="return login();">
                    <div class="mb-3">
                      <label for="Email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="loginEmail" required name="loginEmail" placeholder="email@exemplo.com">
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Senha</label>
                      <input type="password" class="form-control" id="loginPassword" required name="loginPassword" placeholder="Senha">
                    </div>
                    <div class="mb-3">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck">
                        <label class="form-check-label" for="dropdownCheck">
                          Lembrar
                        </label>
                      </div>
                    </div>
                    <button type="submit" id="btnEntrar" class="btn btn-primary">Entrar</button>
                  </form>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#criarContaAluno" href="#">Aluno novo
                    por aqui? Cadastre-se</a>
                  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#criarContaProfessor" id="openCadProf" href="#">Professor novo
                    por aqui? Cadastre-se</a>
                  <a class="dropdown-item" href="#">Esqueceu a senha?</a>
                </div>
                <!-- Dropdown login fim -->
                <!-- Modal Cadastro Professor inicio -->
                <div class="modal fade" id="criarContaProfessor" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title">Cadastro Professor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="profCadastro" method="POST" enctype="multipart/form-data" onload="return consultaUnidade()">
                          <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" required  class="form-control" id="profNome" name="profNome">
                          </div>

                          <div class="mb-3">
                            <label for="tel" class="form-label">Telefone</label>
                            <input type="tel"  required class="form-control" id="profTel" name="profTel">
                          </div>

                          <div class="mb-3">
                            <label for="dtaNascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" required class="form-control" id="profDtaNascimento" name="profDtaNascimento">
                          </div>

                          <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" required  class="form-control" id="profCpf" name="profCpf">
                          </div>

                          <div class="mb-3">
                            <label for="emailcad" class="form-label">Email</label>
                            <input type="email" required class="form-control" id="profEmail" name="profEmail">
                          </div>


                          <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" required class="form-control" id="profSenha" name="profSenha">
                          </div>

                          <div class="mb-3">
                            <label for="unidade" class="form-label">Unidade</label>
                            <select class="form-control" required  name="profUnidade" id="profUnidade">
                              <option value="">Selecione uma Unidade</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="materia" class="form-label">Materia</label>
                            <input type="text" required class="form-control" id="profMateria" name="profMateria">
                          </div>

                          <div class="mb-3">
                            <label for="lattes" class="form-label">Link Lattes</label>
                            <input type="url" class="form-control" id="profLattes" name="profLattes">
                          </div>


                          <div class="mb-3">
                            <label for="lattes" class="form-label">Descrição</label>
                            <textarea class="form-control" required name="profInfo" id="profInfo" rows="3"></textarea>
                          </div>



                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- Modal Cadastro Professor fim -->

                <!-- Modal Cadastro Aluno inicio -->
                <div class="modal fade" id="criarContaAluno" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title">Cadastro Aluno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <form method="POST" enctype="multipart/form-data" id="alunoCadastro">
                          <div class="mb-3">
                            <label for="nomeAluno" class="form-label">Nome</label>
                            <input type="text" required class="form-control" id="nomeAluno" name="nomeAluno">
                          </div>

                          <div class="mb-3">
                            <label for="telAluno" class="form-label">Telefone</label>
                            <input type="tel" required class="form-control" id="telAluno" name="telAluno">
                          </div>

                          <div class="mb-3">
                            <label for="dtaNascimentoAluno" class="form-label">Data de Nascimento</label>
                            <input type="date" required class="form-control" id="dtaNascimentoAluno" name="dtaNascimentoAluno">
                          </div>

                          <div class="mb-3">
                            <label for="cpfAluno" class="form-label">CPF</label>
                            <input type="text" required class="form-control" id="cpfAluno" name="cpfAluno">
                          </div>

                          <div class="mb-3">
                            <label for="emailcadAluno" class="form-label">Email</label>
                            <input type="text" required class="form-control" id="emailcadAluno" name="emailcadAluno">
                          </div>


                          <div class="mb-3">
                            <label for="senhaAluno" class="form-label">Senha</label>
                            <input type="password" required class="form-control" id="senhaAluno" name="senhaAluno">
                          </div>

                          <div class="mb-3">
                            <label for="unidadeAluno" class="form-label">Unidade</label>
                            <select class="form-control" required id="unidadeAluno" name="unidadeAluno">
                              <option>Selecione uma Unidade</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="cursoAluno" class="form-label">Curso</label>
                            <select class="form-control" required id="cursoAluno" name="cursoAluno">
                              <option>Selecione um curso</option>
                            </select>
                          </div>

                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Modal Cadastro Aluno fim -->

              </div>
            </li>
          </ul>
        </div>

      </div>
    </nav>
  </header>
  <!--fim header -->

  <section id="home">
    <!--inicio secao -->

    <div class="container">

      <div class="row">
        <span id="msg-cad"></span>