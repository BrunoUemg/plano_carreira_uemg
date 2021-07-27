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
          <form>
            <div class="mb-3">
              <label for="nomeUnidade" class="col-form-label">Nome:</label>
              <input type="text" class="form-control" id="nomeUnidade">
            </div>
          </form>
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

  <!-- Modal Edição Professor inicio -->
  <div class="modal fade" id="editarContaProfessor" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Edição Professor</h5>
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

          <form id="profEditCadastro" class="visually-hidden" method="POST" enctype="multipart/form-data" onload="return consultaUnidade()">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" required class="form-control" id="profNomeEdit" name="profNomeEdit">
              <input type="hidden" required class="form-control" disabled id="profIdEdit" name="profIdEdit">
            </div>

            <div class="mb-3">
              <label for="tel" class="form-label">Telefone</label>
              <input type="tel" required class="form-control" id="profTelEdit" name="profTelEdit">
            </div>

            <div class="mb-3">
              <label for="dtaNascimento" class="form-label">Data de Nascimento</label>
              <input type="date" required class="form-control" id="profDtaNascimentoEdit" name="profDtaNascimentoEdit">
            </div>

            <div class="mb-3">
              <label for="cpf" class="form-label">CPF</label>
              <input type="text" required class="form-control" id="profCpfEdit" name="profCpfEdit">
            </div>

            <div class="mb-3">
              <label for="emailcad" class="form-label">Email</label>
              <input type="email" required class="form-control" id="profEmailEdit" name="profEmailEdit">
            </div>


            <div class="mb-3">
              <label for="senha" class="form-label">Senha</label>
              <input type="password" required class="form-control" id="profSenhaEdit" name="profSenhaEdit">
            </div>

            <div class="mb-3">
              <label for="unidade" class="form-label">Unidade</label>
              <select class="form-control" required name="profUnidadeEdit" id="profUnidadeEdit">
                <option value="">Selecione uma Unidade</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="materia" class="form-label">Materia</label>
              <input type="text" required class="form-control" id="profMateriaEdit" name="profMateriaEdit">
            </div>

            <div class="mb-3">
              <label for="lattes" class="form-label">Link Lattes</label>
              <input type="url" class="form-control" id="profLattesEdit" name="profLattesEdit">
            </div>


            <div class="mb-3">
              <label for="lattes" class="form-label">Descrição</label>
              <textarea class="form-control" required name="profInfoEdit" id="profInfoEdit" rows="3"></textarea>
            </div>

            <div class="mb-3">
              <label class="form-check-label">Professor Coordenador</label>
              <input class="form-check-input" type="checkbox" id="professorCoordEdit" name="professorCoordEdit" value='001'>
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
  <!-- Modal Cadastro Professor fim -->
  <?php
  include_once "footer.php";
  ?>