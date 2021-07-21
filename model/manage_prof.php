<?php
require_once('conn.php');
$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';
if (!empty($opcao)) {
    switch ($opcao) {
        case 'edit': {
                echo editProf($valor);
                break;
            }
        case 'delete': {
                echo deletProf($valor);
                break;
            }
    }
}

function editProf($id)
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $query_professor = "UPDATE `professor` SET `professorNome`=:professorNome,`professorTel`=:professorTel,`professorDataNascimento`=:professorDataNascimento,`professorCPF`=:professorCPF,`professorEmail`=:professorEmail,`professorSenha`=:professorSenha,`professorMateria`=:professorMateria,`unidade_idUnidade`=:unidade_idUnidade,`professorLattes`=:professorLattes,`professorInfo`=:professorInfo,`professorCoord`=:professorCoord WHERE `idProfessor`=:idProfessor";
    if (!isset($dados['professorCoord'])) {
        $dados['professorCoord'] = '000';
    }
    $update_professor = $pdo->prepare($query_professor);
    $update_professor->bindParam(':professorNome', $dados['profNome']);
    $update_professor->bindParam(':professorTel', $dados['profTel']);
    $update_professor->bindParam(':professorDataNascimento', $dados['profDtaNascimento']);
    $update_professor->bindParam(':professorCPF', $dados['profCpf']);
    $update_professor->bindParam(':professorEmail', $dados['profEmail']);
    $update_professor->bindParam(':professorSenha', $dados['profSenha']);
    $update_professor->bindParam(':unidade_idUnidade', $dados['profUnidade']);
    $update_professor->bindParam(':professorMateria', $dados['profMateria']);
    $update_professor->bindParam(':professorLattes', $dados['profLattes']);
    $update_professor->bindParam(':professorInfo', $dados['profInfo']);
    $update_professor->bindParam(':professorCoord', $dados['professorCoord']);
    $update_professor->bindParam(':idProfessor', $id);
    if ($update_professor->execute()) {
        $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Professor alterado com sucesso!</div>'];
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Professor alterado com sucesso!</div>';
    } else {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel realizar alterar esse professor!</div>'];
    }
    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}

function deletProf($id)
{
    $pdo = Conectar();

    $query_professor = "DELETE FROM `professor` WHERE `idProfessor`=:idProfessor";

    $delete_professor = $pdo->prepare($query_professor);
    $delete_professor->bindParam(':idProfessor', $id);
    if ($delete_professor->execute()) {
        $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Professor excluido com sucesso!</div>'];
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Professor excluido com sucesso!</div>';
    } else {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel excluir o professor!</div>'];
    }
    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}
