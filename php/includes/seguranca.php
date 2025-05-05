<?php

ob_start();

if(!isset($_SESSION)){

    unset($_SESSION['idUsuario'], $_SESSION['usuarioNome'], $_SESSION['usuarioId'], $_SESSION['usuarioSenha'], $_SESSION['usuarioNivelAcesso']);
	//Mensagem de Erro

	$_SESSION['loginErro'] = "	<div id='erro' class='alert alert-danger' role='alert'> 
								<p><strong>Erro:</strong> Área restrita para usuários cadastrados</p>
							</div>";

	

	//Manda o usuário para a tela de login

	header("Location: ../../index.php");
}