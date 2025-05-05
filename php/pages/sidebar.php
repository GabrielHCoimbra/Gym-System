<link rel="stylesheet" href="../../css/sidebar.css">
<!-- Sidebar -->
<ul class="ul-sidebar" style="background-color: #06003a;"  >

<!-- Sidebar - Brand -->
<a class="" href="initial-panel.php">
  <div class="">
    <!-- <i class="fas fa-laugh-wink"></i> -->
    <i style="font-size:36pt">LOGO</i>
  </div>
  
</a>

<!-- Divider -->
<hr class="">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="initial-panel.php" >
    <i class=""></i>
    <span>Painel principal</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">



<?php if($_SESSION['usuarioNivelAcesso'] <= 1){ ?>
<!-- Divider -->

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="ExibicaoProdutos.php" target="result">
    <i class=""></i>
    <span>Produtos</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="produtos.php" target="result">
    <i class=""></i>
    <span>Cadastrar Produtos</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="usuarios.php" target="result">
    <i class=""></i>
    <span>Usuários</span></a>
</li>
<!--
<li class="nav-item" >
  <a class="nav-link" href="funcionarios.php" target="result">
    <i class=""></i>
    <span>Funcionários</span></a>
</li>
<li class="nav-item" >
  <a class="nav-link" href="administracao.php" target="result">
    <i class=""></i>
    <span>Administração</span></a>-->
</li>
<!-- Nav Item - Paciente -->
<li class="nav-item">
  <a class="nav-link" href="paciente.php" target="result">
    <i class=""></i>
    <span>Pacientes</span></a>
</li>
<!-- Nav Item - Medico -->
<li class="nav-item" >
  <a class="nav-link" href="medic.php" target="result">
    <i class=""></i>
    <span>Médicos</span></a>
</li>

<?php } ?>


<?php if($_SESSION['usuarioNivelAcesso'] <= 2){ ?>

<li class="nav-item" >
  <a class="nav-link" href="consultas.php" target="result">
    <i class=""></i>
    <span>Consultas</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">


<?php } ?>
<?php if($_SESSION['usuarioNivelAcesso'] == 3){ ?>

<li class="nav-item">
  <a class="nav-link" href="mensalidades.php" target="result">
    <i class=""></i>
    <span>Mensalidades</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block" target="result">
<?php } ?>

<?php
/*
if ($_SESSION['usuarioNivelAcesso'] == 5) {
 echo @$administracao->menu_disciplinas($_SESSION['f_key']);
}      
if ($_SESSION['usuarioNivelAcesso'] == 6) {

 echo @$administracao-> menu_disciplinas_aluno($_SESSION['f_key']);
} 


*/
?>
<!-- End of Sidebar -->