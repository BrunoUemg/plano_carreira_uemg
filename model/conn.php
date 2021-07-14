<?php
$host = "127.0.0.1";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "uemg_carreira";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die('Could not connect to the database server' . mysqli_connect_error());

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password, [
	\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
	\PDO::ATTR_EMULATE_PREPARES => false
]);

function Conectar()
{
	$host = "127.0.0.1";
	$user = "root";
	$password = "";
	$dbname = "uemg_carreira";
	try {
		$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
		$con = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password, $opcoes);
		return $con;
	} catch (Exception $e) {
		echo 'Erro: ' . $e->getMessage();
		return null;
	}
}
//$con->close();
