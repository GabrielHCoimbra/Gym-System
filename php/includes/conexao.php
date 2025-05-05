<?php
	
	try {
		$conectar = mysqli_connect("localhost","root","","sigma");	
	} catch (Exception $e) {
		echo "Erro na conexao com o banco de dados!".PHP_OEL;
		echo "Deteccao do erro: ".mysqli_connect_errno().PHP_OEL;
	}
?>
