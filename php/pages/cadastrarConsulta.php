<head>
    
</head>
<body >
<div hidden="">
    <?php
        include 'principal.php';
        include '../includes/conexao.php';
    ?>
</div>

<form action="registrarConsulta.php" method="post" id="final" >
    <?php
        $nrmedic = $_POST['nr_medic'];
        $dia = $_POST['dia'];
        $id = $_POST['id'];
    
    ?>
    <label for="nr_paciente">Paciente</label>
    <select name="nr_paciente" id="" class="input-xs form-control in" >
        <?php
            $query= "SELECT nr_paciente, nome_paciente FROM paciente";
            $qry =  mysqli_query($conectar, $query);
            while ($data = mysqli_fetch_array($qry)) {
            
        
        ?>
        <option value="<?= $data['nr_paciente']?>"><?= $data['nome_paciente']?></option>
        <?php
            }
        ?>
    </select>
    <label for="nr_medic">Médico</label>
    <select name="nr_medic" id="nr_medic" readonly class="input-xs form-control in" >
        <?php
            $query= "SELECT nr_medic, nome_medic FROM medic where nr_medic = '$nrmedic'";
            $qry =  mysqli_query($conectar, $query);
            while ($data = mysqli_fetch_array($qry)) {
            
        
        ?>
        <option value="<?= $data['nr_medic']?>"><?= $data['nome_medic']?></option>
        <?php
            }
        ?>
    </select>
    <label for="dia">Dia da Consulta</label>
    <input type="date" class="input-xs form-control in"  name="dia" id="dia" value="<?= $dia ?>" readonly>

    <label for="horario">Horário</label>
    <?php
        
        $query1= "SELECT horarios.horario, horarios.nome_horario FROM horarios INNER JOIN consultas ON horarios.horario = consultas.horario where consultas.dia = '$dia' 
        AND consultas.nr_medic = '$nrmedic'";
        $query2= "SELECT horarios.horario, horarios.nome_horario FROM horarios ";
        $qry1 =  mysqli_query($conectar, $query1);
        $qry2 =  mysqli_query($conectar, $query2);
        $i = 0;
        while ($data1 = mysqli_fetch_array($qry1)) {
            $indisponiveis[$i] = $data1['horario'];
            $i++;
        }
    ?>
    <select name="horario" id="">
        <?php
            while ($data2 = mysqli_fetch_array($qry2)) {
                if($indisponiveis[0]!= NULL){
                    if(!in_array($data2['horario'], $indisponiveis)){
        ?>
                        <option value="<?= $data2['horario']?>"><?= $data2['nome_horario']?></option>
        <?php
                    }       
                }else{
                ?>
                    <option value="<?= $data2['horario']?>"><?= $data2['nome_horario']?></option>
        <?php
                }
        }
        
        ?>
    </select>
    <label for="id">Produto</label>
    
    <select name="id" id="" readonly>
                        <option value="<?= $id ?>"><?= $id ?></option>
    </select>
    <label for="qte">Quantidade</label>
    <?php
        $query4= "SELECT qte_produto FROM estoque where Id_Produto = $id";
        
        $qry4 =  mysqli_query($conectar, $query4);
    ?>
    <input type="number" name="qte" id="" min="1" max="">
    <input type="submit" value="Marcar">
    <a href="verificaDisp.php">Verificar nova disponibilidade</a>
    
    
    
    
    
</form>

</body>



