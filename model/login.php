<?php
include_once './conn.php';

session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $query = "select * from professor where professorEmail='$email' and professorSenha='$pass'";
    $select_data = mysqli_query($con,$query);
    if ($row = mysqli_fetch_array($select_data, MYSQLI_ASSOC)) {
        $_SESSION['email'] = $row['professorEmail'];
        echo "success";
    } else {
        echo 'fail';
    }
    mysqli_close($con);
    exit();
}
