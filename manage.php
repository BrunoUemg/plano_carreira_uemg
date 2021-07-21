<?php
include_once "header.php";
?>
<script src="./js/manage.js"></script>
<div class="col-md-12 align-content-center mt-5">

  <table id="manageProfessores" class="display table table-striped dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Materia</th>
        <th>Unidade</th>
        <th>Editar</th>
        <th>Excluir</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Nome</th>
        <th>Materia</th>
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
              <input type="text" required class="form-control" id="profNome" name="profNome">
              <input type="hidden" required class="form-control" disabled id="profId" name="profId">
            </div>

            <div class="mb-3">
              <label for="tel" class="form-label">Telefone</label>
              <input type="tel" required class="form-control" id="profTel" name="profTel">
            </div>

            <div class="mb-3">
              <label for="dtaNascimento" class="form-label">Data de Nascimento</label>
              <input type="date" required class="form-control" id="profDtaNascimento" name="profDtaNascimento">
            </div>

            <div class="mb-3">
              <label for="cpf" class="form-label">CPF</label>
              <input type="text" required class="form-control" id="profCpf" name="profCpf">
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
              <select class="form-control" required name="profUnidade" id="profUnidade">
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

            <div class="mb-3">
              <label class="form-check-label">Professor Coordenador</label>
              <input class="form-check-input" type="checkbox" id="professorCoord" name="professorCoord" value='001'>
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