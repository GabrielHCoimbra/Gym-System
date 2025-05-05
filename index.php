<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="./css/main.css">
    <title>SGC</title>
</head>
<body>
<div class="container">
		<div class="container-login">
			<div class="wrap-login">
				<form class="login-form" name="form_login" method="post" action="php/includes/valida-login.php">
                <?php
                    if(isset($_SESSION['loginErro'])){
                        echo $_SESSION['loginErro'];
                        unset($_SESSION['loginErro']);
                    }
                ?>
					<span class="login-form-title">
						Faça o login
					</span>

					<div class="wrap-input margin-top-35 margin-bottom-35">
                        <input type="hidden" name="valida_login">
						<input class="input-form" type="text" name="usuario" autocomplete="off">
						<span class="focus-input-form" data-placeholder="Usuário"></span>
					</div>

					<div class="wrap-input margin-bottom-35">
						<input class="input-form" type="password" name="senha">
						<span class="focus-input-form" data-placeholder="Senha"></span>
					</div>

					<div class="container-login-form-btn">
						<button class="login-form-btn">
							Login
						</button>
					</div>

					<ul class="login-utils">
						<li class="margin-bottom-8 margin-top-8">
							<span class="text1">
								Esqueceu sua
							</span>

							<a href="#" class="text2">
								senha?
							</a>
						</li>
					</ul>
				</form>
			</div>
			<img src="images/login.png" width="300" height="300" class="margin-left-50" />
		</div>
	</div>
	
	<script>
		let inputs = document.getElementsByClassName('input-form');
		for (let input of inputs) {
			input.addEventListener("blur", function() {
				if(input.value.trim() != ""){
					input.classList.add("has-val");
				} else {
					input.classList.remove("has-val");
				}
			});
		}
	</script>


    <form name="form_login" method="post" action="php/includes/valida-login.php">
        <?php
                    if(isset($_SESSION['loginErro'])){
                        echo $_SESSION['loginErro'];
                        unset($_SESSION['loginErro']);
                    }
                ?>
        <div>
            
            <input type="hidden" name="valida_login">
            <input type="text" name="usuario">
            
        </div>

        <div data-validate="Digite a senha">
            
            <input type="password" name="senha">
            
        </div>

        <div class="container-login100-form-btn">
            
                <button >
                    Login
                </button>
            
        </div>

        <div >
            <span >
                Esqueceu a sua senha?
            </span>

            <a href="recuperacao-de-senha.php">
                Clique aqui
            </a>
        </div>
    </form>

</body>
</html>