<link rel="stylesheet" href="../../css/initial-panel.css">
<body class="initial-panel-body">

<div class="menu">
<?php 
  include 'principal.php';
?>
</div>


<!-- Begin Page Content -->
<div class="main" style="">
          <?php
            
            if(isset($_SESSION['mensagem'])){
                echo $_SESSION['mensagem'];
                unset($_SESSION['mensagem']);
            }
            if (!isset($_SESSION['usuarioNome'])) {
              $token = md5(session_id());
                header('location: ../includes/logout.php?token='.$token);
            }
          ?>
      <?php 
        if($_SESSION['usuarioNivelAcesso'] > 4){
      ?>
          <p class="">
            Seja vem vindo
          </p>
      <?php 
        }else{        
       ?>
         
    <!-- Content Row -->
    <div class="row">
      
        <div class="col-12"><p class="" style="color: black;">Seja bem Vindo <b><?=$_SESSION['usuarioNome'] ?></b></p>
        <?php 
        }        
       ?>
    <!-- Main Content -->
      <iframe src="mensalidades.php" frameborder="0" name="result" class="iframe"></iframe>
      </div>

    </div>
</div>
</body>

