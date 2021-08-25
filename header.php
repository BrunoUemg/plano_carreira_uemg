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
  <link href="./css/bootstrap.min.css" rel="stylesheet">

  <!-- Datatable -->
  <link rel="stylesheet" href="./css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="./css/fixedHeader.bootstrap5.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./css/all.min.css"/>

  <!-- Estilo customizado -->
  <link rel="stylesheet" href="./css/style.css">

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>

  <!-- DataTable JS -->
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.fixedHeader.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <!-- Consultas Ajax Popular -->
  <script src="./js/consultas.js"></script>
  <!-- Select2 -->
  <link href="./css/select2.min.css" rel="stylesheet" />
  <script src="./js/select2.min.js"></script>

  <!-- Responsive Datatable -->
  <script src="./js/dataTables.responsive.min.js"></script>
  <script src="./js/responsive.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="./css/responsive.bootstrap5.min.css">

  <!-- Jquery Confirm -->
  <link rel="stylesheet" href="./css/jquery-confirm.min.css">
  <script src="./js/jquery-confirm.min.js"></script>
  <script type="text/javascript">
    var user = <?php if(isset($_SESSION['id'])){
      echo json_encode($_SESSION['id']);
    }else{
      echo -1;
    } ?>;

    var prof = <?php if(isset($_SESSION['professor'])){
      echo json_encode($_SESSION['professor']);
    }else{
      echo -1;
    } ?>;
  </script>
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
              include_once "./model/coord.php";
            }
            if (isset($_SESSION['professor']) && $_SESSION['professor']) {
              echo '            <li class="nav-item">
              <a href="./solicitacoes.php" class="nav-link">Solicitações</a>
            </li>';
            }
            ?>
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