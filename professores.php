<?php
include_once "header.php";
?>

<div class="col-md-12 align-content-center mt-5">

  <table id="dtbProfessores" class="display table-hover table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Materia</th>
        <th>Unidade</th>
        <th>Lattes</th>
        <th>Informação</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Materia</th>
        <th>Unidade</th>
        <th>Lattes</th>
        <th>Informação</th>
      </tr>
    </tfoot>
  </table>


  <?php
  include_once "footer.php";
  ?>
  <script src="./js/datatable.js"></script>