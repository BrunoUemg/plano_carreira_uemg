<?php
include_once "header.php";
?>
<script src="./js/datatable.js"></script>

<div class="col-md-12 align-content-center mt-5">

  <table id="dtbUsers" class="display table table-striped dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th class="none">ID</th>
        <th>Nome</th>
        <th>Materia</th>
        <th>Unidade</th>
        <th>Lattes</th>
        <th class="none">Informação</th>
        <th class="none">Solicitar Apoio</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th class="none">ID</th>
        <th>Nome</th>
        <th>Materia</th>
        <th>Unidade</th>
        <th>Lattes</th>
        <th class="none">Informação</th>
        <th class="none">Solicitar Apoio</th>
      </tr>
    </tfoot>
  </table>

  <?php
  include_once "footer.php";
  ?>