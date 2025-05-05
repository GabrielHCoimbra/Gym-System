<div hidden="">
    <?php
        include 'principal.php';
        include '../includes/conexao.php';
    ?>
</div>

<?php


    $dia=$_POST['dia'];
    $horario=$_POST['horario'];
    $nr_paciente=$_POST['nr_paciente'];
    $nr_medic=$_POST['nr_medic'];
    
    $id=$_POST['id'];
    $qte=$_POST['qte'];

    $paciente->inserir_consulta($dia,$horario,$nr_paciente,$nr_medic,$id,$qte);

    header("location: consultas.php");
?>