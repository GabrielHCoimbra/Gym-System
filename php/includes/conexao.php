<?php
	
	require_once (__DIR__.'\..\..\vendor\autoload.php');

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$host = $_ENV['DB_HOST'];
	$user = $_ENV['DB_USER'];
	$pass = $_ENV['DB_PASS'];
	$db   = $_ENV['DB_NAME'];


	try {
		$conectar = mysqli_connect($host,$user,$pass,$db);	
	} catch (Exception $e) {
		echo "Erro na conexao com o banco de dados!".PHP_OEL;
		echo "Deteccao do erro: ".mysqli_connect_errno().PHP_OEL;
	}
?>
