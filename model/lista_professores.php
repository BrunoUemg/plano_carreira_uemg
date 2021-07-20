<?php
require_once('conn.php');
$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';
if (!empty($opcao)) {
    switch ($opcao) {
        case 'unidade': {
                echo getUnidades();
                break;
            }
        case 'curso': {
                echo getCursos();
                break;
            }
        default: {
                echo getAll();
                break;
            }
    }
} else {
    echo getAll();
}

function getAll()
{
    $pdo = Conectar();
    $sql = 'SELECT * FROM professor INNER JOIN unidade ON professor.unidade_idUnidade = unidade.idUnidade';
    $stm = $pdo->prepare($sql);
    $stm->execute();
    sleep(1);
    echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
    $pdo = null;
}

function getUnidades()
{
    $pdo = Conectar();
    $sql = 'SELECT * FROM professor INNER JOIN unidade ON professor.unidade_idUnidade = unidade.idUnidade WHERE unidade.idUnidade = 1';
    $stm = $pdo->prepare($sql);
    $stm->execute();
    sleep(1);
    echo json_encode(['unidades' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
    $pdo = null;
}

function getCursos()
{
    $pdo = Conectar();
    $sql = 'SELECT * FROM professor INNER JOIN unidade ON professor.unidade_idUnidade = unidade.idUnidade WHERE unidade.idUnidade = 1';
    $stm = $pdo->prepare($sql);
    $stm->execute();
    sleep(1);
    echo json_encode(['cursos' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
    $pdo = null;
}
