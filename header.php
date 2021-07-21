<?php
session_start();
$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
if (!isset($_SESSION['professorCoord']) && $curPageName === 'manage.php') {
  header("location: index.php");
  exit;
} elseif ($curPageName === 'manage.php' && $_SESSION['professorCoord'] === '000') {
  header("location: index.php");
  exit;
}
if (isset($_SESSION['login'])) {
  //login ok!
  // echo $_SESSION['nome'];
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
  <link rel="icon" href="img/uemgImagem.ico" type="image/x-icon" /> 
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

  <!-- DataTable JS -->
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
  <!-- Consultas Ajax Popular -->
  <script src="./js/consultas.js"></script>
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Responsive Datatable -->
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

  <!-- Jquery Confirm -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
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
            <?php
            if (isset($_SESSION['professorCoord']) && $_SESSION['professorCoord'] === '001') {
              echo '            <li class="nav-item">
              <a href="./manage.php" class="nav-link">Gerenciar</a>
            </li>';
            }

            ?>
            <li class="nav-item">
              <a href="./unidades.php" class="nav-link">Unidades</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Cursos</a>
            </li>
            <li class="nav-item">
              <div class="dropdown dropstart">
                <?php
                if (isset($_SESSION['login'])) {
                  include_once "./model/dropdown_menu.php";
                  echo '
                  <a href="" class="btn btn-outline-primary ms-4" id="btnSair"><i class="far fa-user mx-1"></i>Sair</a>';
                } else {
                  include_once "./model/dropdown_login.php";
                }
                ?>
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
        <?php
        if (!empty($_SESSION['msglogin'])) {
          echo $_SESSION['msglogin'];
          unset($_SESSION['msglogin']);
        }
        ?>