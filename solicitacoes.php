<?php
include_once "header.php";
?>
<?php if ($_SESSION['professor'] == false) {
  echo "<script>window.location='index.php'</script>";
} ?>
<script src="./js/moment.min.js"></script>
<script src="./js/datetime.js"></script>
<script src="./js/pt-br.js"></script>
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

  <!-- Modal Edição Info inicio -->
  <div class="modal fade" id="infoAluno" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title nome-aluno">Informações Aluno</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <!-- loading -->
          <div class="d-flex justify-content-center" id="loading-status">
            <div class="spinner-grow text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
          <!-- loading -->

          <form id="FormInfoAluno" class="visually-hidden" method="POST" enctype="multipart/form-data" onload="return consultaUnidade()">
            <div class="mb-3">
              <label for="infoAluno" class="form-label">Informação Plano de Carreira</label>
              <textarea class="form-control" id="infoAlunoText" name="infoAlunoText" rows="15" required></textarea>
              <input type="hidden" required class="form-control" id="planoEdit" name="planoEdit">
            </div>



        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-success" id="btn-save" disabled>Salvar</button>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Modal Edição Info fim -->

  <?php
  include_once "footer.php";
  ?>