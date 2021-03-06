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
		case 'unidadedata': {
				echo getUnidadesData();
				break;
			}
		case 'uni': {
				echo getUnidade($valor);
				break;
			}
		case 'cur': {
				echo getCurso($valor);
				break;
			}
		case 'curso': {
				echo getCursos();
				break;
			}
		case 'cursodata': {
				echo getCursosData();
				break;
			}
		case 'solicitacaodata': {
				echo getSolicitacaoData($valor);
				break;
			}
		case 'solicitacaoaceita': {
				echo getSolicitacaoAceita($valor);
				break;
			}
		case 'info': {
				echo getInfo($valor);
				break;
			}
	}
}

function getUnidades()
{
	$pdo = Conectar();
	$sql = 'SELECT * FROM `unidade`';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	sleep(1);
	echo json_encode(['unidades' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
	$pdo = null;
}

function getUnidadesData()
{
	$pdo = Conectar();
	$sql = 'SELECT * FROM `unidade`';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
	$pdo = null;
}

function getUnidade($id)
{
	$pdo = Conectar();
	$sql = 'SELECT * FROM `unidade` WHERE idUnidade = :idUnidade';
	$stm = $pdo->prepare($sql);
	$stm->bindParam(':idUnidade', $id);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
	$pdo = null;
}

function getCursos()
{
	$pdo = Conectar();
	$sql = 'SELECT * FROM `curso`';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	sleep(1);
	echo json_encode(['cursos' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
	$pdo = null;
}
function getCursosData()
{
	$pdo = Conectar();
	$sql = 'SELECT * FROM `curso`';
	$stm = $pdo->prepare($sql);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
	$pdo = null;
}

function getCurso($id)
{
	$pdo = Conectar();
	$sql = 'SELECT * FROM `curso` WHERE idCurso = :idCurso ';
	$stm = $pdo->prepare($sql);
	$stm->bindParam(':idCurso', $id);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
	$pdo = null;
}

function getSolicitacaoData($id)
{
	$pdo = Conectar();
	$sql = 'SELECT * FROM `planocarreira` INNER JOIN professor ON professor_idProfessor = idProfessor INNER JOIN aluno ON aluno_idAluno = idAluno INNER JOIN curso ON curso_idCurso = idCurso WHERE professor_idProfessor = :idProfessor && planoCarreiraStatus = 000';
	$stm = $pdo->prepare($sql);
	$stm->bindParam(':idProfessor', $id);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
	$pdo = null;
}

function getSolicitacaoAceita($id)
{
	$pdo = Conectar();
	$sql = 'SELECT * FROM `planocarreira` INNER JOIN professor ON professor_idProfessor = idProfessor INNER JOIN aluno ON aluno_idAluno = idAluno INNER JOIN curso ON curso_idCurso = idCurso WHERE professor_idProfessor = :idProfessor && planoCarreiraStatus = 001';
	$stm = $pdo->prepare($sql);
	$stm->bindParam(':idProfessor', $id);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
	$pdo = null;
}

function getInfo($id)
{
	$pdo = Conectar();
	$sql = 'SELECT * FROM `planocarreira` WHERE idPlanoCarreira = :idPlano';
	$stm = $pdo->prepare($sql);
	$stm->bindParam(':idPlano', $id);
	$stm->execute();
	sleep(1);
	echo json_encode(['data' => $stm->fetchAll(PDO::FETCH_ASSOC)]);
	$pdo = null;
}
