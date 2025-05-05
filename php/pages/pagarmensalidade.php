<div hidden="">
<?php
require_once("principal.php");
?>
</div>

<?php
$nr_paciente = $_POST['nr_paciente'];
$Mes = $_POST['mes'];
$recibo = $_POST['recibo'];
$data_deposito =  $_POST['data_deposito'];

$administracao->fazer_pagamento($nr_paciente, $Mes, $recibo, $data_deposito);
header("location: mensalidades.php");