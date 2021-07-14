<?php
require_once('conn.php');
$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';
if (! empty($opcao)){
	switch ($opcao)
	{
		case 'unidade':
			{
				echo getUnidades();
				break;
			}
		case 'curso':
			{
				echo getCursos();
				break;
			}
	}
}

function getUnidades(){
	$pdo = Conectar();
	$sql = 'SELECT * FROM `unidade`';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	sleep(1);
	echo json_encode(['unidades' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
$pdo = null;
}

function getCursos(){
	$pdo = Conectar();
	$sql = 'SELECT * FROM `curso`';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	sleep(1);
	echo json_encode(['cursos' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
$pdo = null;
}
