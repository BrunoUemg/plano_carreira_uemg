<?php
include_once "header.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.19/dataRender/datetime.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/pt-br.js"></script>
<script src="./js/datatable_solicitacao.js"></script>
<div class="col-md-12 align-content-center">

  <div class="align-self-center">
    <h1 class="display-4">Aceitos</h1>
  </div>
</div>

<div class="col-md-12 align-content-center mt-5">

  
  <table id="dtbAceito" class="display table table-striped dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th>Aluno</th>
        <th>Data do Pedido</th>
        <th>Status</th>
        <th>WhatsApp</th>
        <th>Informações</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Aluno</th>
        <th>Data do Pedido</th>
        <th>Status</th>
        <th>WhatsApp</th>
        <th>Informações</th>
      </tr>
    </tfoot>
  </table>
<hr>
<h1 class="display-4">Solicitações</h1>
  <table id="dtbSolicitacoes" class="display table table-striped dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th>Aluno</th>
        <th>Data do Pedido</th>
        <th>Status</th>
        <th>Curso</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Aluno</th>
        <th>Data do Pedido</th>
        <th>Status</th>
        <th>Curso</th>
      </tr>
    </tfoot>
  </table>

  <?php
  include_once "footer.php";
  ?>