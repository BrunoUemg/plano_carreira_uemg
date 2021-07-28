<?php
include_once "header.php";
?>
<script src="./js/manage_unidade.js"></script>
<div class="col-md-12 align-content-center">

  <div class="align-self-center">
    <h1 class="display-4">Gerenciar Unidade</h1>
  </div>

  <!-- Modal Cadastro Unidade -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroUnidade">Cadastrar Nova Unidade</button>
  <div class="modal fade" id="cadastroUnidade" tabindex="-1" aria-labelledby="cadastroUnidadeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelNovaUnidade">Nova Unidade</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addUnidade">
            <div class="mb-3">
              <label for="nomeUnidade" class="col-form-label">Nome:</label>
              <input type="text" class="form-control" name="nomeUnidade">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Cadastro Unidade -->

  <!-- Modal Edição Unidade -->
  <div class="modal fade" id="editaUnidade" tabindex="-1" aria-labelledby="editaUnidadeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelEditaUnidade">Editar Unidade</h5>
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
          <form class="formEditUnidade visually-hidden" id="editarUnidade">
            <div class="mb-3">
              <label for="nomeUnidade" class="col-form-label">Nome:</label>
              <input type="text" class="form-control" name="nomeUnidade">
              <input type="hidden" class="form-control" name="idUnidade">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-success">Salvar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Edição Unidade -->
</div>

<div class="col-md-12 align-content-center mt-5">

  <table id="manageUnidade" class="display table table-striped dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th>Unidade</th>
        <th>Editar</th>
        <th>Excluir</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Unidade</th>
        <th>Editar</th>
        <th>Excluir</th>
      </tr>
    </tfoot>
  </table>
  <?php
  include_once "footer.php";
  ?>