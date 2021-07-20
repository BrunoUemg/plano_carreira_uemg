<?php
if ($_GET["opcao"]=='sair'){
    if(session_id() == '') {
        session_start();
    }
    session_unset();
    session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    $link = "http://$host/index.php";
    echo $link; 
}