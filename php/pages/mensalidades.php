 <!--  -->
 <head>
  <link rel="stylesheet" href="../../css/mensalidades.css">
 </head>
 <div hidden="">
    <?php
        include 'principal.php';
    ?>
 </div>
 <?php 
  

  include '../includes/conexao.php';

 
  if(isset($_SESSION['mensagem'])){
    echo $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
  }
  
                    
                    if (isset($_GET['ok'])) {
                      $nr_horario=@$_GET['nr_horario'];
                      $resultado = mysqli_query($conectar,"SELECT * FROM paciente where nr_horario='$nr_horario' ORDER BY 'nr_paciente'");
                    }else{
                      $resultado = mysqli_query($conectar,"SELECT * FROM paciente ORDER BY 'nr_paciente'");
                    }
                   
                    

  
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="">
            <div class="">
              <div class="pagamento">
                <a href="pagar.php" target="result" class="pagamento2">Realizar Pagamento</a>
              </div>

              <div class="mensalidade"><label>Mensalidades</label></div>

            
            <!-- Content Row --> 
          <div class="row">
            <?php
            $mes = date('d/m/Y');
            $mes = substr($mes, 3, 2);
            switch ($mes) {
                case '01':
                    $mes= 'Jan';
                    break;
                case '02':
                    $mes= 'Fev';
                    break;
                case '03':
                    $mes= 'Mar';
                    break;
                case '04':
                    $mes= 'Abr';
                    break;
                case '05':
                    $mes= 'Mai';
                    break;
                case '06':
                    $mes= 'Jun';
                    break;
                case '07':
                    $mes= 'Jul';
                    break;
                case '08':
                    $mes= 'Ago';
                    break;
                case '09':
                    $mes= 'Sete';
                    break;
                case '10':
                    $mes= 'Outu';
                    break;
                case '11':
                    $mes= 'Nov';
                    break;
                case '12':
                    $mes= 'Dez';
                    break;
                
                default:
                    
                    break;
            }
            if ($_SESSION['usuarioNivelAcesso']==1): ?>
              
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 ganhos">Ganhos (Mensal)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="" readonly="" style="border: 0;" size="5" id="ganhos_mensal" value="" name=""><?=number_format($administracao->coleta_mes($mes),2);?> BRL</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-upper case mb-1 ganhos">Ganhos (Anual) em inscrições</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id=""><input type="" readonly="" style="border: 0;" size="5" id="ganhos_anual" value="" name=""><?=number_format($administracao->coleta_ano(),2); ?>  BRL</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-upper case mb-1 ganhos">Ganhos (Anual) em Mensalidade</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id=""><input type="" readonly="" style="border: 0;" size="5" id="ganhos_anual" value="" name=""><?=number_format($administracao->coleta_mensalidades(),2); ?> BRL</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-upper case mb-1 ganhos">Total</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id=""><input type="" readonly="" style="border: 0;" size="5" id="ganhos_anual" value="" name=""><?=number_format($administracao->coleta_mensalidades()+$administracao->coleta_ano(),2); ?> BRL</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <?php endif ?>
            <!-- Pending Requests Card Example 
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pedidos pendentes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->
          </div>
            <div class="">
              <div class="tabela">
                
              <table class="tabela2" id="" style="font-size: 14px" >
                  <thead>
              
                    <th class="th">Nome do Paciente</th>
                    <th class="th">Matrícula</th>
                    <th class="th">Jan</th>
                    <th class="th">Fev</th>
                    <th class="th">Mar</th>
                    <th class="th">Abr</th>
                    <th class="th">Mai</th>
                    <th class="th">Jun</th>
                    <th class="th">Jul</th>
                    <th class="th">Ago</th>
                    <th class="th">Sep</th>
                    <th class="th">Out</th>
                    <th class="th">Nov</th>
                    <th class="th">Dez</th>
                    <th>Coleta</th>
                    
                    </tr>
                  </thead>
                </div>
                  <tbody class="searchable">
                  
                <?php 
                
                if ($_SESSION['usuarioNivelAcesso'] == 1) {
                  while($linhas = mysqli_fetch_array($resultado)){
                    echo "<tr>";
                      $nr_paciente=$linhas['nr_paciente'];
                      echo "<td>".$linhas['nome_paciente']."</td>";
                                  
                      $Mensal = @mysqli_query($conectar,"SELECT * FROM mensalidades WHERE nr_paciente='$nr_paciente'");
                      $Est = mysqli_fetch_array($Mensal);
                      $taxas = @mysqli_query($conectar,"SELECT * FROM inscricao_detalhes WHERE nr_paciente='$nr_paciente'");
                      $taxas = mysqli_fetch_assoc($taxas);
                      $mes=0;
                      ?>
                      
                      <td>
                        <button type="button" href="#" class="btn btn-xs btn-success btn-block" style="background:green" ><i class="" data-toggle="tooltip" title="Detalhes do pagamento"></i><?= $taxas['valor_inscricao'] ?></button>
                      </td>
                      <td><?php if(empty($Est['Jan'])){ ?>
                          
                          <button type="button" href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = @mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Fev'");
                            $rs = mysqli_fetch_array($MensalDetalhes);
                            $mes++;
                          ?>
                          
                          <button type="button" href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>
                      <td><?php if(empty($Est['Fev'])){ ?>
                          
                          <button type="button" href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = @mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Fev'");
                            $rs = mysqli_fetch_array($MensalDetalhes);
                            $mes++;
                          ?>
                          
                          <button type="button" href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Mar'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Fev'])){ ?> disabled="" <?php } ?>  href="#fazerPagamento"  class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Mar" data-whatever2="<?php echo $Est['Mar'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Mar'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          
                          <button type="button" <?php if(empty($Est['Fev'])) echo "Disabled" ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Mar" data-whatever2="<?php echo $Est['Mar'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Abr'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Mar'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Abr" data-whatever2="<?php echo $Est['Abr'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Abr'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Mar'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Abr" data-whatever2="<?php echo $Est['Abr'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>
                                  
                      <td><?php if(empty($Est['Mai'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Abr'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Mai" data-whatever2="<?php echo $Est['Mai'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Mai'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Abr'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Mai" data-whatever2="<?php echo $Est['Mai'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Jun'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Mai'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Jun" data-whatever2="<?php echo $Est['Jun'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Jun'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Mai'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Jun" data-whatever2="<?php echo $Est['Jun'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Jul'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Jun'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Jul" data-whatever2="<?php echo $Est['Jul'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Jul'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Jun'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Jul" data-whatever2="<?php echo $Est['Jul'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Ago'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Jul'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Ago" data-whatever2="<?php echo $Est['Ago'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Ago'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Jul'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Ago" data-whatever2="<?php echo $Est['Ago'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Sete'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Ago'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Sete" data-whatever2="<?php echo $Est['Sete'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Sete'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Ago'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Sete" data-whatever2="<?php echo $Est['Sete'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Outu'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Sete'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Outu" data-whatever2="<?php echo $Est['Outu'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Outu'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Sete'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Outu" data-whatever2="<?php echo $Est['Outu'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>     

                      <td><?php if(empty($Est['Nov'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Outu'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Nov" data-whatever2="<?php echo $Est['Nov'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Nov'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Outu'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class=" btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Nov" data-whatever2="<?php echo $Est['Nov'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>
                      <td><?php if(empty($Est['Dez'])){ ?>
                          
                          <button type="button" href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = @mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Fev'");
                            $rs = mysqli_fetch_array($MensalDetalhes);
                            $mes++;
                          ?>
                          
                          <button type="button" href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>      
                      <td>
                        <input type="button" class=" btn btn-xs btn-success btn-block" style="background:green" id="colecta" value="<?=$taxas['valor_inscricao']+$mes*$taxas['valor_mensalidade']; ?>"></input>
                      </td>                 

                                              
                      <?php
                    
                    echo "</tr>";
                  }
                }elseif ($_SESSION['usuarioNivelAcesso'] == 3) {
                  while($linhas = mysqli_fetch_array($resultado)){
                    echo "<tr>";
                      $nr_paciente=$linhas['nr_paciente'];
                      echo "<td>".$linhas['nome_paciente']."</td>";
                                  
                      $Mensal = @mysqli_query($conectar,"SELECT * FROM mensalidades WHERE nr_paciente='$nr_paciente'");
                      $Est = mysqli_fetch_array($Mensal);
                      $taxas = @mysqli_query($conectar,"SELECT * FROM inscricao_detalhes WHERE nr_paciente='$nr_paciente'");
                      $taxas = mysqli_fetch_assoc($taxas);
                      $mes=0;
                      ?>
                      
                      <td>
                        <button type="button" href="#" class="btn btn-xs btn-success btn-block" style="background:green" ><i class="" data-toggle="tooltip" title="Detalhes do pagamento"></i><?= $taxas['valor_inscricao'] ?></button>
                      </td>
                      <td><?php if(empty($Est['Jan'])){ ?>
                          
                          <button type="button" href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = @mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Fev'");
                            $rs = mysqli_fetch_array($MensalDetalhes);
                            $mes++;
                          ?>
                          
                          <button type="button" href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>
                      <td><?php if(empty($Est['Fev'])){ ?>
                          
                          <button type="button" href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = @mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Fev'");
                            $rs = mysqli_fetch_array($MensalDetalhes);
                            $mes++;
                          ?>
                          
                          <button type="button" href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Mar'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Fev'])){ ?> disabled="" <?php } ?>  href="#fazerPagamento"  class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Mar" data-whatever2="<?php echo $Est['Mar'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Mar'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          
                          <button type="button" <?php if(empty($Est['Fev'])) echo "Disabled" ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Mar" data-whatever2="<?php echo $Est['Mar'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Abr'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Mar'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Abr" data-whatever2="<?php echo $Est['Abr'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Abr'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Mar'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Abr" data-whatever2="<?php echo $Est['Abr'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>
                                  
                      <td><?php if(empty($Est['Mai'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Abr'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Mai" data-whatever2="<?php echo $Est['Mai'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Mai'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Abr'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Mai" data-whatever2="<?php echo $Est['Mai'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Jun'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Mai'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Jun" data-whatever2="<?php echo $Est['Jun'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Jun'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Mai'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Jun" data-whatever2="<?php echo $Est['Jun'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Jul'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Jun'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Jul" data-whatever2="<?php echo $Est['Jul'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Jul'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Jun'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Jul" data-whatever2="<?php echo $Est['Jul'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Ago'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Jul'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Ago" data-whatever2="<?php echo $Est['Ago'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Ago'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Jul'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Ago" data-whatever2="<?php echo $Est['Ago'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Sete'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Ago'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Sete" data-whatever2="<?php echo $Est['Sete'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Sete'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Ago'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Sete" data-whatever2="<?php echo $Est['Sete'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Outu'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Sete'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Outu" data-whatever2="<?php echo $Est['Outu'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Outu'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Sete'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Outu" data-whatever2="<?php echo $Est['Outu'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>     

                      <td><?php if(empty($Est['Nov'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Outu'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Nov" data-whatever2="<?php echo $Est['Nov'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Nov'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Outu'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class=" btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Nov" data-whatever2="<?php echo $Est['Nov'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>
                      <td><?php if(empty($Est['Dez'])){ ?>
                          
                          <button type="button" href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = @mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_paciente='$nr_paciente' AND mes='Fev'");
                            $rs = mysqli_fetch_array($MensalDetalhes);
                            $mes++;
                          ?>
                          
                          <button type="button" href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_paciente'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_paciente'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>      
                      <td>
                        <input type="button" class=" btn btn-xs btn-success btn-block" style="background:green" id="colecta" value="<?=$taxas['valor_inscricao']+$mes*$taxas['valor_mensalidade']; ?>"></input>
                      </td>                 

                                              
                      <?php
                  } 
                } 
                ?>
              </tbody>
              </table>
              </div>
          </div>

        </div>
        <!-- /.container-fluid -->

  <!-- Footer -->
<?php 
  include 'rodape.php';
?>
  
<div hidden="">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Pagamento</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>
      <form name="form" id="cadastrar_professor" enctype="multipart/form-data">
        <input type="hidden" name="anular_pagamento" class="form-control" >
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="nr_paciente" class="form-control" id="nr_paciente">
          </div>
          <div class="form-group">

            <input type="hidden" name="Mes" class="form-control" id="Mes">
          </div>
          <div class="form-group">
            <label>Numero do recibo</label>
            <input type="text" readonly="" name="recibo" class="form-control" id="recibo">
          </div>
          <div class="form-group">
          <label>Data do depósito</label>
            <input type="text" readonly="" name="data_deposito" class="form-control" id="data_deposito">
          </div>
          <div class="form-group">
          <label>Data da confirmação</label>
            <input type="text" readonly="" name="data" class="form-control" id="data">
          </div>
          <div class="form-group">
          <label>Pagamento confirmado pr</label>
            <input type="text" readonly="" name="usuario_conf" id="usuario_conf" class="form-control">
          </div>
          <div class="form-group">  
            <input type="hidden" name="Estado" class="form-control" id="Estado">
          </div>
          <div class="alert alert-danger hidden " hidden><span class=""></span> Tens a certeza que desejas anular o pagamento da Mensalidade deste mês?</div>
        </div>
        <div class="modal-footer ">
        <?php if ($_SESSION['usuarioNivelAcesso']=='5' or $_SESSION['usuarioNivelAcesso']=='1') { ?>
          <button type="submit"  class="btn btn-danger left" name="Save"><span class="glyphicon glyphicon-ok-sign"></span> Anular </button>
        <?php } ?>
        </div>
      </form>
    </div> 
  </div>
</div> 
<!-- Fim Modal anularPagamento -->




<div hidden="">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="exampleModalLabel">Confirmação do pagamento</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>
      <form name="form" method="POST" id="cadastrarpaciente" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <input type="hidden" name="nr_paciente" class="form-control" id="nr_paciente">
            <input type="hidden" name="fazer_pagamento" class="form-control" >
          </div>
          <div class="form-group">
            <input type="hidden" name="Mes" class="form-control" id="Mes">
          </div>
          <div class="form-group">  
            <input type="hidden" name="Estado" class="form-control" id="Estado">
          </div>
          <div class="form-group">
          <label>Número do recibo</label>  
            <input type="number"  size="50px" autofocus="" required maxlength="13" name="recibo" class="form-control" id="recibo">
          </div>
          <div class="form-group">
          <label>Data do depósito</label>  
            <input type="date"  size="50px"  required  name="data_deposito" class="form-control" id="data_deposito">
          </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" class="btn btn-success" name="Confirmar"><span class="fas fa-save"></span> Ok </button>
        </div>
      </form>
    </div> 
  </div>
</div> 
<!-- Fim Modal fazerPagamento -->
