<?php
require_once('conn.php');
$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';
if (!empty($opcao)) {
    switch ($opcao) {
        case 'add': {
                echo addUni();
                break;
            }
        case 'edit': {
                echo editUni($valor);
                break;
            }
        case 'delete': {
                echo deletUni($valor);
                break;
            }
    }
}

function addUni()
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $query_dup = "SELECT * FROM `unidade` WHERE `unidadeNome` = :unidadeNome";
    $select_dup = $pdo->prepare($query_dup);
    $select_dup->bindParam(':unidadeNome', $dados['nomeUnidade']);

    if ($select_dup->execute() && $select_dup->rowCount() > 0) {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Unidade já cadastrada!</div>'];
    } else {
        $query_unidade = "INSERT INTO `unidade`(`unidadeNome`) VALUES (:unidadeNome)";
        $update_unidade = $pdo->prepare($query_unidade);
        $update_unidade->bindParam(':unidadeNome', $dados['nomeUnidade']);
        if ($update_unidade->execute()) {
            $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Unidade cadastrada com sucesso!</div>'];
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Unidade cadastrada com sucesso!</div>';
        } else {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel cadastrada essa Unidade!</div>'];
        }
    }

    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}
function editUni($id)
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $query_dup = "SELECT * FROM `unidade` WHERE `unidadeNome` = :unidadeNome";
    $select_dup = $pdo->prepare($query_dup);
    $select_dup->bindParam(':unidadeNome', $dados['nomeUnidade']);
    if ($select_dup->execute() && $select_dup->rowCount() > 0) {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Unidade já cadastrada!</div>'];
    } else {
        $query_unidade = "UPDATE `unidade` SET `unidadeNome`=:unidadeNome WHERE idUnidade = :idUnidade";
        $update_unidade = $pdo->prepare($query_unidade);
        $update_unidade->bindParam(':unidadeNome', $dados['nomeUnidade']);
        $update_unidade->bindParam(':idUnidade', $id);
        if ($update_unidade->execute()) {
            $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Unidade alterada com sucesso!</div>'];
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Unidade alterada com sucesso!</div>';
        } else {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel realizar alterar essa Unidade!</div>'];
        }
    }


    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}

function deletUni($id)
{
    $pdo = Conectar();

    $query_unidade = "DELETE FROM `unidade` WHERE `idUnidade`=:idUnidade";

    $delete_unidade = $pdo->prepare($query_unidade);
    $delete_unidade->bindParam(':idUnidade', $id);
    if ($delete_unidade->execute()) {
        $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Unidade excluida com sucesso!</div>'];
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Unidade excluida com sucesso!</div>';
    } else {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel excluir a Unidade!</div>'];
    }
    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}
