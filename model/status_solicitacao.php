<?php
require_once('conn.php');
$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';
if (!empty($opcao)) {
    switch ($opcao) {
        case 'aceita': {
                echo aceita();
                break;
            }
        case 'edit': {
                echo editInfo();
                break;
            }
    }
}

function aceita()
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $query_aceita = "UPDATE `planocarreira` SET `planoCarreiraStatus`=001 WHERE idPlanoCarreira = :idPlanoCarreira";
    $update_aceita = $pdo->prepare($query_aceita);
    $update_aceita->bindParam(':idPlanoCarreira', $dados['idPlanoCarreira']);
    if ($update_aceita->execute()) {
        $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Solicitação aceita com sucesso!</div>'];
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Solicitação aceita com sucesso!</div>';
    } else {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel aceitar a solicitação!</div>'];
    }
    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}

function editInfo()
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $query_solicitacao = "UPDATE `planocarreira` SET `planoCarreiraInfo`=:planoCarreiraInfo WHERE idPlanoCarreira = :idPlanoCarreira";
    $update_solicitacao = $pdo->prepare($query_solicitacao);
    $update_solicitacao->bindParam(':planoCarreiraInfo', $dados['infoAlunoText']);
    $update_solicitacao->bindParam(':idPlanoCarreira', $dados['planoEdit']);
    if ($update_solicitacao->execute()) {
        $retorna = ['sit' => true, 'msg' =>'<div class="alert alert-success" role="alert">Informações salvas com sucesso!</div>'];
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Informações salvas com sucesso!</div>';
    } else {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel salvar as alterações!</div>'];
    }
    sleep(1);
    header('Content-Type: application/json');
    echo json_encode($retorna);
    $pdo = null;
}