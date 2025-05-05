<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGC</title>
</head>
<body>
<?php 
    if(!isset($_SESSION))
    {
        session_start();
    }

    require_once "../includes/class.php";

    $medic = new medic;
    $paciente = new paciente;
    $usuario = new usuario;
    $funcionario = new funcionario;
    $administracao = new administracao;

    require 'sidebar.php';
?>



<?php 

    require 'navbar.php';

?>

</body>
</html>