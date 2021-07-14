<?php
include_once './conn.php';
session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $query = "SELECT * FROM professor WHERE professorEmail='$email' AND professorSenha='$pass'";
    $query2 = "SELECT * FROM aluno WHERE alunoEmail='$email' AND alunoSenha='$pass'";
    $select_data = mysqli_query($con, $query);
    $select_data2 = mysqli_query($con, $query2);

    if ($row = mysqli_fetch_array($select_data, MYSQLI_ASSOC)) {
        $_SESSION['email'] = $row['professorEmail'];
        $_SESSION['login'] = true;
        $_SESSION['nome'] = $row['professorNome'];
        echo "success";
    } elseif ($row2 = mysqli_fetch_array($select_data2, MYSQLI_ASSOC)) {
        $_SESSION['email'] = $row2['alunoEmail'];
        $_SESSION['login'] = true;
        $_SESSION['nome'] = $row2['alunoNome'];
        echo "success";
    } else {
        echo 'fail';
    }

    mysqli_close($con);
    exit();
}
