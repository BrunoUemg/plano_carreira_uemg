<?php
require_once('conn.php');
$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';
if (!empty($opcao)) {
    switch ($opcao) {
        case 'add': {
                echo addCurso();
                break;
            }
        case 'edit': {
                echo editCur($valor);
                break;
            }
        case 'delete': {
                echo deletCur($valor);
                break;
            }
    }
}

function addCurso()
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $query_dup = "SELECT * FROM `curso` WHERE `cursoNome` = :cursoNome";
    $select_dup = $pdo->prepare($query_dup);
    $select_dup->bindParam(':cursoNome', $dados['nomeCurso']);

    if ($select_dup->execute() && $select_dup->rowCount() > 0) {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Curso já cadastrado!</div>'];
    } else {
        $query_cursos = "INSERT INTO `curso`(`cursoNome`) VALUES (:cursoNome)";
        $update_curso = $pdo->prepare($query_cursos);
        $update_curso->bindParam(':cursoNome', $dados['nomeCurso']);
        if ($update_curso->execute()) {
            $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Curso cadastrado com sucesso!</div>'];
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Curso cadastrado com sucesso!</div>';
        } else {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel cadastradar esse Curso!</div>'];
        }
    }

    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}

function editCur($id)
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $query_dup = "SELECT * FROM `curso` WHERE `cursoNome` = :cursoNome";
    $select_dup = $pdo->prepare($query_dup);
    $select_dup->bindParam(':cursoNome', $dados['nomeCurso']);

    if ($select_dup->execute() && $select_dup->rowCount() > 0) {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Curso já cadastrado!</div>'];
    } else {
        $query_cursos = "UPDATE `curso` SET `cursoNome`=:cursoNome WHERE idCurso = :idCurso";
        $update_curso = $pdo->prepare($query_cursos);
        $update_curso->bindParam(':cursoNome', $dados['nomeCurso']);
        $update_curso->bindParam(':idCurso', $id);
        if ($update_curso->execute()) {
            $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Curso alterado com sucesso!</div>'];
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Curso alterado com sucesso!</div>';
        } else {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel alterar esse Curso!</div>'];
        }
    }

    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}

function deletCur($id)
{
    $pdo = Conectar();

    $query_cursos = "DELETE FROM `curso` WHERE `idCurso`=:idCurso";

    $delete_cursos = $pdo->prepare($query_cursos);
    $delete_cursos->bindParam(':idCurso', $id);
    if ($delete_cursos->execute()) {
        $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Curso excluido com sucesso!</div>'];
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Curso excluido com sucesso!</div>';
    } else {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel excluir o Curso!</div>'];
    }
    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}
