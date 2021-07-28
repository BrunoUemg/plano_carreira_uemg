<?php
include_once "header.php";
?>
<?php if($_SESSION['professor'] == false || $_SESSION['professorCoord'] != 001){
 echo "<script>window.location='index.php'</script>";

} ?>
<script src="./js/manage_curso.js"></script>
<div class="col-md-12 align-content-center">

  <div class="align-self-center">
    <h1 class="display-4">Gerenciar Curso</h1>
  </div>

  <!-- Modal Cadastro Curso -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroCurso">Cadastrar Nova Curso</button>
  <div class="modal fade" id="cadastroCurso" tabindex="-1" aria-labelledby="cadastroCursoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelNovaCurso">Nova Curso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addCurso">
            <div class="mb-3">
              <label for="nomeCurso" class="col-form-label">Nome:</label>
              <input type="text" class="form-control" name="nomeCurso" required>
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
  <!-- Modal Cadastro Curso -->

  <!-- Modal Edição Curso -->
  <div class="modal fade" id="editaCurso" tabindex="-1" aria-labelledby="editaCursoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelEditaCurso">Editar Curso</h5>
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
          <form class="formEditCurso visually-hidden" id="editarCurso">
            <div class="mb-3">
              <label for="nomeCurso" class="col-form-label">Nome:</label>
              <input type="text" class="form-control" name="nomeCurso" required>
              <input type="hidden" class="form-control" name="idCurso">
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
  <!-- Modal Edição Curso -->
</div>

<div class="col-md-12 align-content-center mt-5">

  <table id="manageCurso" class="display table table-striped dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th>Curso</th>
        <th>Editar</th>
        <th>Excluir</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Curso</th>
        <th>Editar</th>
        <th>Excluir</th>
      </tr>
    </tfoot>
  </table>
  <?php
  include_once "footer.php";
  ?>