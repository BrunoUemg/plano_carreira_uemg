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
		case 'unidadedata':
			{
				echo getUnidadesData();
				break;
			}
		case 'curso':
			{
				echo getCursos();
				break;
			}
		case 'cursodata':
			{
				echo getCursosData();
				break;
			}
		case 'solicitacaodata':
			{
				echo getSolicitacaoData($valor);
				break;
			}
		case 'solicitacaoaceita':
			{
				echo getSolicitacaoAceita($valor);
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
function getUnidadesData(){
	$pdo = Conectar();
	$sql = 'SELECT * FROM `unidade`';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
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
function getCursosData(){
	$pdo = Conectar();
	$sql = 'SELECT * FROM `curso`';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
$pdo = null;
}

function getSolicitacaoData($id){
	$pdo = Conectar();
	$sql = 'SELECT * FROM `planocarreira` INNER JOIN professor ON professor_idProfessor = idProfessor INNER JOIN aluno ON aluno_idAluno = idAluno WHERE professor_idProfessor = :idProfessor';
	$stm = $pdo->prepare($sql);
	$stm->bindParam(':idProfessor', $id);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
$pdo = null;
}

function getSolicitacaoAceita($id){
	$pdo = Conectar();
	$sql = 'SELECT * FROM `planocarreira` INNER JOIN professor ON professor_idProfessor = idProfessor INNER JOIN aluno ON aluno_idAluno = idAluno WHERE professor_idProfessor = :idProfessor && planoCarreiraStatus = 001';
	$stm = $pdo->prepare($sql);
	$stm->bindParam(':idProfessor', $id);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
$pdo = null;
}
