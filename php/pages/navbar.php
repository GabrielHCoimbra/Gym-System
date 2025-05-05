<?php 
    require '../includes/seguranca.php';
 ?>

<ul class="navbar-nav ml-auto">


            <!-- Nav Item - User Information -->
            <li class="">
              <a class="" href="#" >
                <span class=" "><b><?=$_SESSION['usuarioNome']  ?></b></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="" >
                <!--<a class="" href="#"  >
                  Perfil
                </a>-->
                <div class=""></div>
                <a href="../includes/logout.php?token=<?=md5(session_id())?>">Sair</a>
              </div>
            </li>

</ul>