<?php
include 'conn.php';

$query_prof = "SELECT * FROM professor INNER JOIN unidade WHERE professor.unidade_idUnidade = unidade.idUnidade;";
$resultado_prof = $pdo->prepare($query_prof);
$resultado_prof->execute();

$prof = [];

while($row_prof = $resultado_prof->fetch(PDO::FETCH_ASSOC)){
    $idProfessor = $row_prof['idProfessor'];
    $professorNome = $row_prof['professorNome'];
    $professorMateria = $row_prof['professorMateria'];
    $unidadeNome = $row_prof['unidadeNome'];
    $professorLattes = $row_prof['professorLattes'];
    $professorInfo = $row_prof['professorInfo'];
    
    $prof[] = [
        'id' => $idProfessor, 
        'professorNome' => $professorNome,
        'professorMateria' => $professorMateria,
        'unidadeNome' => $unidadeNome,
        'professorLattes' => $professorLattes,
        'professorInfo' => $professorInfo
        ];
}

// echo json_encode($prof);
echo json_encode(['data' => $prof]);