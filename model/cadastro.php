<?php
session_start();
require_once('conn.php');
$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';
if (!empty($opcao)) {
    switch ($opcao) {
        case 'professor': {
                echo cadProfessor();
                break;
            }
        case 'aluno': {
                echo cadAluno();
                break;
            }
        case 'apoio': {
                echo cadApoio();
                break;
            }
    }
}

function cadProfessor()
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $query_dup = "SELECT * FROM `aluno`,`professor` WHERE `alunoEmail` = :emailcadAluno OR `professorEmail` = :professorEmail";
    $select_dup = $pdo->prepare($query_dup);
    $select_dup->bindParam(':emailcadAluno', $dados['profEmail']);
    $select_dup->bindParam(':professorEmail', $dados['profEmail']);

    if ($select_dup->execute() && $select_dup->rowCount() > 0) {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: E-mail já cadastrado!</div>'];
    } else {
        $query_professor = "INSERT INTO `professor` (`idProfessor`, `professorNome`, `professorTel`, `professorDataNascimento`, `professorCPF`, `professorEmail`, `professorSenha`, `professorMateria`, `unidade_idUnidade`, `professorLattes`, `professorInfo`, `professorCoord`) VALUES (NULL, :professorNome, :professorTel, :professorDataNascimento, :professorCPF, :professorEmail, :professorSenha, :professorMateria, :unidade_idUnidade, :professorLattes, :professorInfo, 0)";

        $insert_professor = $pdo->prepare($query_professor);
        $insert_professor->bindParam(':professorNome', $dados['profNome']);
        $insert_professor->bindParam(':professorTel', $dados['profTel']);
        $insert_professor->bindParam(':professorDataNascimento', $dados['profDtaNascimento']);
        $insert_professor->bindParam(':professorCPF', $dados['profCpf']);
        $insert_professor->bindParam(':professorEmail', $dados['profEmail']);
        $insert_professor->bindParam(':professorSenha', $dados['profSenha']);
        $insert_professor->bindParam(':unidade_idUnidade', $dados['profUnidade']);
        $insert_professor->bindParam(':professorMateria', $dados['profMateria']);
        $insert_professor->bindParam(':professorLattes', $dados['profLattes']);
        $insert_professor->bindParam(':professorInfo', $dados['profInfo']);

        if ($insert_professor->execute()) {
            $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>'];
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>';
        } else {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel realizar seu cadastro!</div>'];
        }
    }


    $pdo = null;
    header('Content-Type: application/json');
    echo json_encode($retorna);
}

function cadAluno()
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $query_dup = "SELECT * FROM `aluno`,`professor` WHERE `alunoEmail` = :emailcadAluno OR `professorEmail` = :professorEmail";
    $select_dup = $pdo->prepare($query_dup);
    $select_dup->bindParam(':emailcadAluno', $dados['emailcadAluno']);
    $select_dup->bindParam(':professorEmail', $dados['emailcadAluno']);

    if ($select_dup->execute() && $select_dup->rowCount() > 0) {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: E-mail já cadastrado!</div>'];
    } else {
        $query_aluno = "INSERT INTO `aluno` (`idAluno`, `alunoNome`, `alunoTel`, `alunoDataNascimento`, `alunoCPF`, `alunoEmail`, `alunoSenha`, `unidade_idUnidade`, `curso_idCurso`) VALUES (NULL, :nomeAluno, :telAluno, :dtaNascimentoAluno, :cpfAluno, :emailcadAluno, :senhaAluno, :unidadeAluno, :cursoAluno)";

        $insert_aluno = $pdo->prepare($query_aluno);
        $insert_aluno->bindParam(':nomeAluno', $dados['nomeAluno']);
        $insert_aluno->bindParam(':telAluno', $dados['telAluno']);
        $insert_aluno->bindParam(':dtaNascimentoAluno', $dados['dtaNascimentoAluno']);
        $insert_aluno->bindParam(':cpfAluno', $dados['cpfAluno']);
        $insert_aluno->bindParam(':emailcadAluno', $dados['emailcadAluno']);
        $insert_aluno->bindParam(':senhaAluno', $dados['senhaAluno']);
        $insert_aluno->bindParam(':unidadeAluno', $dados['unidadeAluno']);
        $insert_aluno->bindParam(':cursoAluno', $dados['cursoAluno']);

        if ($insert_aluno->execute()) {
            $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>'];
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>';
        } else {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel realizar seu cadastro!</div>'];
        }
    }

    $pdo = null;
    header('Content-Type: application/json');
    echo json_encode($retorna);
}

function cadApoio()
{
    $pdo = Conectar();
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $query_dup = "SELECT * FROM `planocarreira` WHERE `professor_idProfessor` = :professor_idProfessor AND `aluno_idAluno` = :aluno_idAluno";
    $select_dup = $pdo->prepare($query_dup);
    $select_dup->bindParam(':professor_idProfessor', $dados['idProfApoio']);
    $select_dup->bindParam(':aluno_idAluno', $dados['idAlunoApoio']);

    if ($select_dup->execute() && $select_dup->rowCount() > 0) {
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Você já solicitou esse professor!</div>'];
    } else {
        $query_apoio = "INSERT INTO `planocarreira`(`professor_idProfessor`, `aluno_idAluno`, `planoCarreiraDtaPedido`) VALUES (:professor_idProfessor,:aluno_idAluno,NOW())";

        $insert_apoio = $pdo->prepare($query_apoio);
        $insert_apoio->bindParam(':professor_idProfessor', $dados['idProfApoio']);
        $insert_apoio->bindParam(':aluno_idAluno', $dados['idAlunoApoio']);

        if ($insert_apoio->execute()) {
            $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Pedido realizado com sucesso!</div>'];
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Pedido realizado com sucesso!</div>';
        } else {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Não foi possivel realizar seu pedido!</div>'];
        }
    }

    $pdo = null;
    header('Content-Type: application/json');
    echo json_encode($retorna);
}
