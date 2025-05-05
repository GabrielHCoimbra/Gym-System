<?php

if (!isset($_SESSION)) {
    session_start();
}





/**
 **/



abstract class conexao {
    public function connect(){
        require_once (__DIR__.'\..\..\vendor\autoload.php');

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $db   = $_ENV['DB_NAME'];
        try {

            $pdo = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e){
            echo "Connection Error ! ".$e->getMessage();
        }
    }
}

class sessao extends conexao {

    public function valida_login($usuario,$senha) {
        $query = "SELECT *,`tabela_nivel_acesso`.`nome_nivel_acesso` FROM tabela_usuarios JOIN tabela_nivel_acesso ON `tabela_usuarios`.`id_nivel_acesso` = `tabela_nivel_acesso`.`id_nivel_acesso` WHERE `tabela_usuarios`.`usuario`= ? AND `tabela_usuarios`.`senha`= ? LIMIT 1";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$usuario,$senha]);
        $flag=0;
        while($rs = $stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['ultimo_acesso']      = Date('Y-m-d');
            $_SESSION['idUsuario']      = $rs['id_usuario'];
            $_SESSION['usuarioNome']    = $rs['nome'];
            $_SESSION['usuarioSenha']     = $rs['senha'];
            $_SESSION['usuarioLogin']     = $rs['usuario'];
            $_SESSION['usuarioNivelAcesso'] = $rs['id_nivel_acesso'];
            $_SESSION['nome_nivel_acesso'] = $rs['nome_nivel_acesso'];
            $_SESSION['f_key'] = $rs['f_key'];
            
            if($_SESSION['usuarioNivelAcesso'] > 0){
              $flag++;
              header("Location: ../pages/initial-panel.php");
              echo "teste";
            }   
        }
        if ($flag>0) {
            $_SESSION['activa']=1;
        }else{
            $_SESSION['loginErro'] = "<p id='erro' style='color: red' align='center'>Usuário ou Senha Inválido</p><br><br>";
            header("Location: ../../index.php");
        }
          
    }

}

class paciente extends conexao {

    public function inserir_consulta($dia,$horario,$nr_paciente,$nr_medic,$id,$qte){
        $query = "INSERT INTO `consultas`(`id_consulta`,`dia`, `horario`,  `nr_paciente`, `nr_medic`,`Id_Produto`,`Qte_produto`) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute(['DEFAULT', $dia,$horario,$nr_paciente,$nr_medic,$id,$qte])) {  
            return 1;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }

    }

    public function total_pacientes() {
        $query = "SELECT COUNT(nr_paciente ) AS total_pacientes FROM paciente";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_pacientes'];
    }

    public function ultimo_id() {
        $query = "SELECT max(nr_paciente ) AS ultimo FROM paciente";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }


    public function actualizar_foto_paciente($url_foto, $nr_paciente)
    {
        $query = "UPDATE `paciente` SET url_foto = ? where nr_paciente = ?"; 
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$url_foto, $nr_paciente]);
        
    }


    public function actualizar_paciente($nr_paciente, $tipo_documento, $nr_documento, $nome_paciente, $apelido_paciente,  $data_nascimento_paciente, $sexo_paciente, $bairro, $cidade, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $nr_turno) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `paciente` SET tipo_documento = ?, nr_documento = ?, nome_paciente=?, apelido_paciente=?, data_nascimento_paciente = ?, validade_documento_inicial_paciente=?, sexo_paciente=?, bairro = ?, cidade = ?, casa = ?, rua_avenida=?, telefone=?, telefone_alternativo = ?, email = ?, modificado_por=? where nr_paciente = ?"; 
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $nome_paciente, $apelido_paciente,  $data_nascimento_paciente, $sexo_paciente, $bairro, $cidade, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $usuario_logado, $nr_paciente])) {
            $url="pacientes.php";
            
            echo "<p class='text-center alert alert-success'>Dados actualizados com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function pegar_dados_pacientes($nr_paciente) {
        $query = "SELECT * FROM `paciente` WHERE `nr_paciente` = ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_paciente]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }

    public function matricula($nr_paciente, $horario_turno) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `matricula`(`nr_paciente`, `nr_turno`, `ano`, `criado_por`) VALUES(?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nr_paciente, $horario_turno, date('Y'), $usuario_logado])) {
            return 1;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function actualizar_matricula($nr_paciente, $nr_turno) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `matricula` SET `nr_turno` = ?, `modificado_por` = ? WHERE nr_paciente = ? ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nr_turno, $usuario_logado, $nr_paciente])) {
            if ($stmt->rowCount()<1) {
                $this->matricula($nr_paciente, $nr_turno);
            }
            return 1;
        } else {

            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }


    public function q_matricula($nr_paciente) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "SELECT * FROM `matricula` JOIN turno ON turno.nr_turno= matricula.nr_turno JOIN horario ON horario.nr_horario= turno.horario_turno WHERE `nr_paciente`= ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_paciente]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }


    public function listar_pacientes() {/*
        $query = "SELECT * FROM paciente JOIN matricula ON paciente.nr_paciente= matricula.nr_paciente JOIN turno ON turno.nr_turno= matricula.nr_turno JOIN horario ON horario.nr_horario= turno.horario_turno";*/
        $query = "SELECT * FROM paciente";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rs2=$this->q_matricula($rs['nr_paciente']);
                $out .= "<tr>";
                $out .= "<td>" . $rs['nome_paciente'] .' '. $rs['apelido_paciente'] . "</td>";
                $out .= "<td>" . $rs['nr_documento'] . "</td>";
                $out .= "<td>" . $rs['telefone'] . "</td>";
                $out .= "<td>" . @$rs2['nome_horario'] . ' ' . @$rs2['nome_turno'] . "</td>";
                $out .= "<td>
                                
                                 <a href='paciente-ver.php?q=". $rs['nr_paciente'] ."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a>
                            </td>";
                $out .= "</tr>

                ";
        }
        return $out;
    }

    public function inserir_paciente($tipo_documento, $nr_documento, $nome_paciente, $apelido_paciente,  $data_nascimento_paciente, $sexo_paciente, $bairro, $cidade, $casa, $rua_avenida, $telefone, $telefone_alternativo, $nome_do_pai, $nome_da_mae, $email, $url_foto, $recibo, $data_deposito, $valor_inscricao, $valor_mensalidade) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `paciente`(`tipo_documento`, `nr_documento`,  `nome_paciente`, `apelido_paciente`, `data_nascimento_paciente`, `sexo_paciente`, `bairro`, `cidade`, `casa`, `rua_avenida`, `telefone`, `telefone_alternativo`, `nome_do_pai`, `nome_da_mae`, `email`, `url_foto`, `criado_por`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $nome_paciente, $apelido_paciente,  $data_nascimento_paciente, $sexo_paciente, $bairro, $cidade, $casa, $rua_avenida, $telefone, $telefone_alternativo, $nome_do_pai, $nome_da_mae, $email, $url_foto, $usuario_logado])) {
            $query_incricao="INSERT INTO `inscricao_detalhes`(`nr_paciente`, `recibo`, `valor_inscricao`, `valor_mensalidade`, `data_deposito`, `criado_por`) VALUES (?,?,?,?,?,?)";
            $stmt_incricao = $this->connect()->prepare($query_incricao);
            $stmt_incricao->execute([$this->ultimo_id()-1, $recibo, $valor_inscricao, $valor_mensalidade, $data_deposito, $usuario_logado]);
            
            return 1;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }
}

class medic extends conexao {
    public function verifica_existencia($nr_documento , $telefone, $email)
    {
        $query = "SELECT * FROM medic WHERE `nr_documento`='$nr_documento'";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            $query = "SELECT * FROM medic WHERE `telefone`='$telefone'";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() == 0){
                $query = "SELECT * FROM medic WHERE `email`='$email'";
                $stmt = $this->connect()->prepare($query);
                $stmt->execute();
                if($stmt->rowCount() == 0){

                    return 1;
                    
                } else{
                    echo "<p class='text-center alert alert-danger'>Erro: O email inserido já existe no sistema </p>";
                }

            } else{
                echo "<p class='text-center alert alert-danger'>Erro: O celular inserido já existe no sistema </p>";
            }
        } else{
            echo "<p class='text-center alert alert-danger'>Erro: O médico com este número de documento já existe no sistema </p>";
        }
    }
    public function ultimo_id() {
        $query = "SELECT max(nr_medic ) AS ultimo FROM medic";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }

    public function total_medic() {
        $query = "SELECT COUNT(nr_medic ) AS total_medices FROM medic";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_medices'];
    }


    // update data
    public function mudar_estado($nr_medic) {
        $query = "SELECT * FROM medic WHERE nr_medic = ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_medic]);
        $estado='';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $estado= $row['estado'];
        }
        if ($estado=='0') {
            $estado='1';
        }else{
            $estado='0';
        }
        $query1 = "UPDATE medic SET estado = ? where nr_medic = ? ";
        $stmt1 = $this->connect()->prepare($query1);
        if ($stmt1->execute([$estado])) {
            $url="medic.php";
            
            echo "<p class='text-center alert alert-success'>Estado altera!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function listar_medic() {
        $query = "SELECT * FROM medic ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<div class='col-xl-3 col-md-4 mb-4'>
            <div class='card shadow mb-4 h-100'>
                <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                    <h6 class='m-0 font-weight-bold text-primary'>" . $rs['nome_medic'].' '.$rs['apelido_medic']. "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='medic-ver.php?q=". $rs['nr_medic'] ."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a></span>
                                                    
                </div> 
                <div class='card-body'>
                    <img src=" . $rs['url_foto'] . " class='img-fluid card-img card-' alt=''>
                    <div class='row no-gutters align-items-center'>
                        <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Disciplina(s) :<b>" . '' . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Celular :<b>" . $rs['telefone'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>E-mail :<b>" . $rs['email'] . "</b> </div>";
                $out .= "   </div>
                        </div>
                    </div>
                    
                </div> 
            </div>";

        }
        return $out;
    }



    public function pegar_dados_medic($nr_medic) {
        $query = "SELECT * FROM `medic` WHERE `nr_medic` = ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_medic]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }

    public function inserir_medic($tipo_documento, $nr_documento, $nome_medic, $data_nascimento_medic,  $sexo_medic, $bairro, $casa, $cidade, $rua_avenida, $telefone, $telefone_alternativo, $email, $url_foto) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `medic`(`tipo_documento`, `nr_documento`, `nome_medic`, `data_nascimento_medic`, `sexo_medic`, `bairro`,  `casa`, `cidade`,`rua_avenida`, `telefone`, `telefone_alternativo`, `email`, `url_foto`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $nome_medic,  $data_nascimento_medic,  $sexo_medic, $bairro, $casa, $cidade, $rua_avenida, $telefone, $telefone_alternativo, $email, $url_foto])) {
            return 1;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function actualizar_foto_medic($url_foto, $nr_medic)
    {
        $query = "UPDATE `medic` SET url_foto = ? where nr_medic = ?"; 
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$url_foto, $nr_medic]);
        
    }



    public function select_medic () {
        $query = "SELECT * FROM  medic";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_medic'] ."'>". $linhas['nome_medic'] ."</option>";
        }
        return $out;
    }


    public function actualizar_medic($nr_medic, $tipo_documento, $nr_documento, $nome_medic, $apelido_medic, $data_nascimento_medic,  $sexo_medic, $bairro, $cidade, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `medic` SET tipo_documento = ?, nr_documento = ?, nome_medic=?, apelido_medic=?, nacionalidade_medic = ?, naturalidade_medic = ?, data_nascimento_medic = ?, validade_documento_inicial_medic=?, sexo_medic=?, bairro = ?, cidade = ?, casa = ?, rua_avenida=?, telefone=?, telefone_alternativo = ?, email = ?, modificado_por=? where nr_medic = ?"; 
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $nome_medic, $apelido_medic, $data_nascimento_medic,  $sexo_medic, $bairro, $cidade, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $usuario_logado, $nr_medic])) {
            $url="medic.php";
            
            echo "<p class='text-center alert alert-success'>Dados actualizados com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }
}

class funcionario extends conexao {

    public function ultimo_id() {
        $query = "SELECT max(nr_funcionario ) AS ultimo FROM funcionario";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }

    public function total_funcionarios() {
        $query = "SELECT COUNT(nr_funcionario ) AS total_funcionarios FROM funcionario";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_funcionarios'];
    }

    public function listar_funcionarios() {
        $query = "SELECT * FROM funcionario JOIN funcao ON `funcionario`.`id_funcao` = `funcao`.`id_funcao`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<div class='col-xl-3 col-md-4 mb-4'>
            <div class='card shadow h-100'>
                <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                    <h6 class='m-0 font-weight-bold text-primary'>" . $rs['nome_funcionario'].' '.$rs['apelido_funcionario']. "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='funcionario-ver.php?q=". $rs['nr_funcionario'] ."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a></span>
                </div> 
                <div class='card-body'>
                    <img src=" . $rs['url_foto'] . " class='img-fluid card-img card-' alt=''>
                    <div class='row no-gutters align-items-center'>
                        <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Função :<b>" . $rs['funcao'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Celular :<b>" . $rs['telefone'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>E-mail :<b>" . $rs['email'] . "</b> </div>";
                $out .= "   </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
        return $out;
    }

    public function inserir_funcionario($tipo_documento, $nr_documento, $nome_funcionario,  $data_nascimento_funcionario,  $sexo_funcionario, $bairro, $cidade, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email,  $id_funcao, $url_foto) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `funcionario`(`tipo_documento`, `nr_documento`, `nome_funcionario`,  `data_nascimento_funcionario`, `sexo_funcionario`, `bairro`, `cidade`, `casa`, `rua_avenida`, `telefone`, `telefone_alternativo`, `email`, `id_funcao`, `url_foto`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $nome_funcionario,  $data_nascimento_funcionario,  $sexo_funcionario, $bairro, $cidade, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $id_funcao, $url_foto])) {
            return 1;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }
}

class administracao extends conexao {

   
    public function select_turnos() {
        $query = "SELECT nr_turno,nome_turno FROM turno";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_turno'] ."'>". $linhas['nome_turno'] ."</option>";
        }
        return $out;
    }

    public function select_horario_turno() {
        $query = "SELECT * FROM turno JOIN horario ON turno.nr_horario = horario.nr_horario";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_turno'] ."'>". $linhas['nome_horario'] .' '. $linhas['nome_turno'] ."</option>";
        }
        return $out;
    }

   public function select_sessoes($q) {
        $query = "SELECT numero_sessoes_formato, formato_turno FROM turno WHERE nr_turno = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $rs = $stmt->fetch(PDO::FETCH_ASSOC);
        $numero_sessoes_formato = $rs['numero_sessoes_formato'];
        $formato_turno="";
        if ($rs['formato_turno']=="Semestral") {
                $formato_turno="Semestre";
            }elseif ($rs['formato_turno']=="Trimestral") {
                $formato_turno="Trimestre";
            }elseif ($rs['formato_turno']=="Modular") {
                $formato_turno="Modulo";
            }
        $out = "";
        $count=1;
        while ($numero_sessoes_formato>=$count) {
            $out .= "<option value='". $count ."'>". $count ."</option>";
            $count++;
        }
        return $out;
    }

    public function formato_turno($nr_turno) {
        $query = "SELECT formato_turno FROM turno WHERE $nr_turno = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_turno]);
        $rs = $stmt->fetch(PDO::FETCH_ASSOC);
        $formato_turno="";
        if ($rs['formato_turno']=="Semestral") {
                $formato_turno="Semestre";
            }elseif ($rs['formato_turno']=="Trimestral") {
                $formato_turno="Trimestre";
            }elseif ($rs['formato_turno']=="Modular") {
                $formato_turno="Modulo";
            }
        return $formato_turno;
    }

    public function ultimo_id_turno() {
        $query = "SELECT max(nr_turno) AS ultimo FROM turno";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }

    public function total_turnos() {
        $query = "SELECT COUNT(nr_turno) AS total_turnos FROM turno";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_turnos'];
    }

    public function listar_turnos($q) {
        if($q=="" OR $q==null){
            $query = "SELECT * FROM turno JOIN horario ON `turno`.`horario_turno` = `horario`.`nr_horario`";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
        }else{

            $query = "SELECT * FROM turno JOIN horario ON `turno`.`horario_turno` = `horario`.`nr_horario` WHERE `turno`.`horario_turno` = ? ";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$q]);
        }
        
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            $out .= "<div class='col-xl-4 col-md-4 mb-4'>
                        <div class='card shadow mb-4'>
                            <div class='card-header  d-flex flex-row '>
                                <p><div class='col m-0 p-0 font-weight-bold text-primary align-items-start' >" . $rs['nome_turno'] . "</div><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='' class='text-warning' title='Editar' data-toggle='modal' data-target='#editar_turno". $rs['nr_turno'] ."' ><i class='fas fa-pen fa-fw'></i></a></span></p>
                            </div> 
                            <div class='card-body'>
                            
                                <div class='row no-gutters align-items-center'>
                                    <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>horario: <b>" . $rs['nome_horario'] . "</b> </div>"; 
            $out .= "
                                    </div>
                                </div>     
                            </div>
                            
                        </div>
                    </div>
                <div class='modal fade' id='editar_turno". $rs['nr_turno']. "' tabindex='-1' role='dialog' aria-labelledby='edit' aria-hidden='true'>
                    <div class='modal-dialog ' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header ' style='background-color: #880f0f;'>
                                <h5 class='modal-title' style='color: #fff;' id='exampleModalLabel'>Editar turno</h5>
                                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true' style='color:#fff;'>×</span>
                                </button>
                            </div>
                            <form class='turno_submit_edicao' method='POST' accept-charset='utf-8'>
                                <div class='modal-body'>

                                    <input type='hidden' id='controlador' name='edicao_turno'>
                                    <div class='row'>
                                        <div class='col-md-3'>

                                            <label>#</label>
                                            <input type='number' readonly='' class='input-xs form-control in' name='nr_turno' maxlength='70' value='". $rs['nr_turno']. "' placeholder='Codigo' required='' >
                                        </div>  
                                        <div class='col-md-9'>
                                            <label>turno</label>
                                            <input type='text' class='input-xs form-control in' required='' name='nome_turno' maxlength='70' value='". $rs['nome_turno']. "' placeholder='Nome do turno' required='' >
                                        </div> 

                                    </div> 
                                    <div class='row' hidden>
                                        <div class='col-md-9'>
                                            <label>horario</label>
                                            <select name='horario_turno' id='horario_turno1' required='' class='input-xs form-control in' style=''>
                                                <option value='". $rs['nr_horario']. "'>". $rs['nome_horario']. "</option>
                                                ".$this->select_horarios()."
                                            </select>
                                        </div>  

                                        <div class='col-md-3'>

                                            <label>Duração</label>
                                            <input type='' class='input-xs form-control in' required='' name='duracao_turno' maxlength='1' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='". $rs['duracao_turno']. "' placeholder='Duração' >
                                        </div>  
                                    </div> 
                                    <div class='row' hidden>
                                        <div class='col-md-9'>
                                            <label>Formato do turno</label>
                                            <select name='formato_turno' required='' class='input-xs form-control in' style=''>
                                                <option value='". $rs['formato_turno']. "'>". $rs['formato_turno']. "</option>
                                                <option value='Modular'>Modular</option>
                                                <option value='Semestral'>Semestral</option>
                                                <option value='Trimestral'>Trimestral</option>
                                            </select>
                                        </div>  

                                        <div class='col-md-3'>
                                            <label>Sessões</label>
                                            <input type='text' required='' class='input-xs form-control in' name='numero_sessoes_formato' id='numero_sessoes_formato1' maxlength='2' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='". $rs['numero_sessoes_formato']. "' placeholder='Sessões' >
                                        </div>  
                                    </div> 
                                </div>
                                <div class='modal-footer'>
                                    <button class='btn btn-primary btn-sm' id='ok1' name='ok1' type='submit' data-dismiss=''><i class='fas fa-edit'></i> Editar</button>
                                </div> 
                            </form> 
                        </div>
                    </div>
                </div>
                ";
        }
        return $out;
    }

    public function verifica_recibo($q) {
        $query = "SELECT * FROM conf_mensalidades WHERE recibo = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        if($stmt->rowCount() == 0){
            $query = "SELECT * FROM inscricao_detalhes WHERE recibo = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$q]);
            if($stmt->rowCount() == 0){
                return 1;
            } else {
                echo "<p class='text-center text-capitalize alert alert-danger'>Erro: Este número de recibo já foi usado no sistema!</p>";
            }
        } else {
            echo "<p class='text-center text-capitalize alert alert-danger'>Erro: Este número de recibo já foi usado no sistema!</p>";
        }
    }
    public function criar_paciente_mensalidade($q) {
        $query = "SELECT * FROM mensalidades WHERE nr_paciente = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        if($stmt->rowCount() == 0){
            $query = "INSERT INTO `mensalidades`(`nr_paciente`, `Jan`, `Fev`, `Mar`, `Abr`, `Mai`, `Jun`, `Jul`, `Ago`, `Sete`, `Outu`, `Nov`, `Dez`, `Ano`) VALUES ('$q',0,0,0,0,0,0,0,0,0,0,0,0,?)";
            $stmt = $this->connect()->prepare($query);
            if($stmt->execute([date('y')])){
                return 1;
            } else {
                echo "<p class='text-center text-capitalize alert alert-danger'>Erro: " . $stmt->error . "!</p>";
            }
        } 
    }
    public function fazer_pagamento($nr_paciente, $Mes, $recibo, $data_deposito) {
        
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "INSERT INTO `conf_mensalidades`(`nr_paciente`, `mes`, `recibo`, `data_deposito`, `ano`, `criado_por`) VALUES (?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($query);
            if ($stmt->execute([$nr_paciente, $Mes, $recibo, $data_deposito, date('Y'), $usuario_logado])) {
                $this->criar_paciente_mensalidade($nr_paciente);
                
                $query = "UPDATE mensalidades SET $Mes = 1 WHERE mensalidades.nr_paciente = '$nr_paciente' AND Ano=?";
                $stmt = $this->connect()->prepare($query);
                if ($stmt->execute([date('Y')])) {
                    echo "<p class='text-center alert alert-success'>Pagamento efectuado com sucesso!</p>";
                } else {
                    echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
                }
            } else {
                echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
            }
        
    }

    public function anular_pagamento($nr_paciente, $Mes, $recibo) {
        
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "DELETE FROM `conf_mensalidades` WHERE nr_paciente = ? AND recibo = ?";
            $stmt = $this->connect()->prepare($query);
            if ($stmt->execute([$nr_paciente, $recibo])) {
                $query = "UPDATE mensalidades SET $Mes = 0 WHERE mensalidades.nr_paciente = '$nr_paciente' AND Ano=?";
                $stmt = $this->connect()->prepare($query);
                if ($stmt->execute([date('Y')])) {
                    echo "<p class='text-center alert alert-success'>Pagamento anulado com sucesso!</p>";
                } else {
                    echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
                }
            } else {
                echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
            } 
    }
    public function coleta_mes($Mes) {
        
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "SELECT SUM( `inscricao_detalhes`.`valor_mensalidade`) as total_mes FROM `conf_mensalidades` JOIN inscricao_detalhes ON conf_mensalidades.nr_paciente=inscricao_detalhes.nr_paciente WHERE mes=?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$Mes]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total_mes'];
    }

    public function coleta_ano() {
        
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "SELECT SUM( `inscricao_detalhes`.`valor_inscricao`) as total_ano FROM inscricao_detalhes";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total_ano'];
    }
    public function coleta_mensalidades() {
        
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "SELECT SUM( `inscricao_detalhes`.`valor_mensalidade`) as total_ano FROM `conf_mensalidades` JOIN inscricao_detalhes ON conf_mensalidades.nr_paciente=inscricao_detalhes.nr_paciente";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total_ano'];
    }

    public function inserir_turno($a, $b, $c, $d, $e) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `turno`(`nome_turno`, `horario_turno`, `duracao_turno`, `formato_turno`, `numero_sessoes_formato`,  `criado_por`) VALUES(?,?,?,?,?,?) ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$a, $b, $c, $d, $e, $usuario_logado])) {
            echo "<p class='text-center alert alert-success'>turno adicionada com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
        echo "<meta http-equiv='refresh' content='3'>";
    }



    public function actualizar_turno($nr_turno, $nome_turno, $horario_turno, $duracao_turno, $formato_turno, $numero_sessoes_formato) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `turno` SET `nome_turno` = ?, `horario_turno` = ?, `duracao_turno` = ?, `formato_turno` = ?, `numero_sessoes_formato` = ?,  `modificado_por` = ? WHERE `nr_turno` = ? ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nome_turno, $horario_turno, $duracao_turno, $formato_turno, $numero_sessoes_formato, $usuario_logado, $nr_turno])) {
            echo "<p class='text-center alert alert-success'>Actualização dos dados do turno efectuadas com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }



    public function pesquisa_horarios($q) {
        $query = "SELECT nr_horario,nome_horario FROM horario WHERE nr_horario=?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_horario'] ."'>". $linhas['nome_horario'] ."</option>";
        }
        return $out;
    }


    public function select_horarios() {
        $query = "SELECT nr_horario,nome_horario FROM horario";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_horario'] ."'>". $linhas['nome_horario'] ."</option>";
        }
        return $out;
    }

    public function ultimo_id_horario() {
        $query = "SELECT max(nr_horario) AS ultimo FROM horario";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }

    public function total_horarios() {
        $query = "SELECT COUNT(nr_horario) AS total_horarios FROM horario";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_horarios'];
    }

    public function listar_horarios() {
        $query = "SELECT * FROM horario";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $query1="SELECT COUNT(nr_turno) as total_turnos FROM `turno` WHERE `horario_turno` = ?";
            $stmt1 = $this->connect()->prepare($query1);
            $stmt1->execute(([$rs['nr_horario']]));
            $row = $stmt1->fetch(PDO::FETCH_ASSOC);
            $out .= "<div class='col-xl-4 col-md-4 mb-4'>
                        <div class='card shadow mb-4'>
                            <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                                <h6 class='m-0 font-weight-bold text-primary'>" . $rs['nome_horario'] . "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a type='button' class='text-warning btn' title='Editar' data-title='Editar horario' data-toggle='modal' data-target='#editar_horario". $rs['nr_horario'] ."' ><i class='fas fa-pen fa-fw'></i></a></span>
                            </div> 
                            <div class='card-body'>
                            
                                <div class='row no-gutters align-items-center'>
                                    <div class='col mr-2'>";/*
            $out .= "<div class='h6 mb-0  text-gray-800'>Codigo: <b>" . $rs['nr_horario'] . "</b> </div>";*/
            $out .= "<div class='h6 mb-0  text-gray-800'>Número de turnos: <b>" .  $row['total_turnos'] . "</b> 
                            <a href='horarios.php?q=".$rs['nr_horario']."' title='Ver'>
                                <button type='button' class='btn btn-light btn-xs'>
                                    <i class='text-danger fas fa-eye aria-hidden='true'></i> 
                                </button>                               
                            </a> </div>";
            $out .= "
                                    </div>
        						</div>     
                            </div>
                           
                        </div>
                    </div>
                <div class='modal fade' id='editar_horario". $rs['nr_horario']. "' tabindex='-1' role='dialog' aria-labelledby='edit' aria-hidden='true'>
                    <div class='modal-dialog ' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header ' style='background-color: #880f0f;'>
                                <h5 class='modal-title' style='color: #fff;' id='exampleModalLabel'>Editar horario</h5>
                                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true' style='color:#fff;'>×</span>
                                </button>
                            </div>
                            <form class='horario_submit_edicao' method='POST' accept-charset='utf-8'>
                                <div class='modal-body'>

                                    <input type='hidden' name='horario_edicao'>
                                    <div class='row'>
                                        <div class='col-md-3'>
                                            <input type='text' readonly='' class='input-xs form-control in' name='nr_horario' maxlength='70' value='". $rs['nr_horario'] ."' placeholder='Codigo' required='' >
                                        </div>  
                                        <div class='col-md-9'>
                                            <input type='text' class='input-xs form-control in' name='nome_horario' maxlength='70' value='". $rs['nome_horario'] ."' placeholder='Nome da horario' required='' >
                                        </div> 

                                    </div>  
                                </div>
                                <div class='modal-footer'>
                                    <button class='btn btn-primary btn-sm' name='editar' type='submit' data-dismiss=''><i class='fas fa-edit'></i> Editar</button>
                                </div> 
                            </form> 
                        </div>
                    </div>
                </div>
                ";
        }
        return $out;
    }

    public function inserir_horario($f) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `horario`(`nome_horario`, `criado_por`) VALUES(?,?) ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$f, $usuario_logado])) {
            echo "<p class='text-center alert alert-success'>Turno adicionado com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function actualizar_horario($nr_horario,$nome_horario) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `horario` SET `nome_horario`= ? , `modificado_por`= ? WHERE `nr_horario`= ?";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nome_horario, $usuario_logado, $nr_horario])) {
            echo "<p class='text-center alert alert-success'>Actualização efetuada com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

}

class usuario extends conexao {


    public function total_usuarios() {
        $query = "SELECT COUNT(id_usuario) AS total_usuarios FROM tabela_usuarios";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_usuarios'];
    }

    public function select_nivel_acesso() {
        $query = "SELECT `id_nivel_acesso`,`nome_nivel_acesso` FROM `tabela_nivel_acesso` ORDER BY `id_nivel_acesso`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($linhas['id_nivel_acesso']>1) {
                if ($linhas['id_nivel_acesso']!=5) {
                    $out .= "<option value='". $linhas['id_nivel_acesso'] ."'>". $linhas['nome_nivel_acesso'] ."</option>";
                } 
                
                
            }
        }
        return $out;
    }

    public function inserir_usuario($nome, $usuario, $id_nivel_acesso, $senha, $f_key) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO tabela_usuarios(nome, usuario, id_nivel_acesso, senha, f_key, criado_por) VALUES(?, ?, ?, ?, ?, ?) ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nome, $usuario, $id_nivel_acesso, md5($senha), $f_key, $usuario_logado])) {
            $url="usuarios.php";
            
            echo "<p class='text-center alert alert-success'>Operação efetuada com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }


    public function actualizar_usuario($id_usuario, $nome, $usuario, $id_nivel_acesso, $senha) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE tabela_usuarios SET nome = ? , usuario = ? , id_nivel_acesso = ? , senha = ? , modificado_por = ?  WHERE `id_usuario` = ? ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nome, $usuario, $id_nivel_acesso, md5($senha), $usuario_logado, $id_usuario])) {
            $url="usuarios.php";
            
            echo "<p class='text-center alert alert-success'>Dados do Usuário actualizados com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function get_row($id) {
        $query = "SELECT * FROM users WHERE id = ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$id]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }

    public function listar_usuarios() {
        $query = "SELECT *,`tabela_nivel_acesso`.`nome_nivel_acesso` FROM tabela_usuarios JOIN tabela_nivel_acesso ON `tabela_usuarios`.`id_nivel_acesso` = `tabela_nivel_acesso`.`id_nivel_acesso`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $out .= "<tr>";
                $out .= "<td>" . $rs['usuario'] . "</td>";
                $out .= "<td>" . $rs['nome'] . "</td>";
                $out .= "<td>" . $rs['nome_nivel_acesso'] . "</td>";
                $out .= "<td>" . $rs['estado'] . "</td>";
                $out .= "</tr>";
        }
        return $out;
    }

    // update data
    public function update($f, $l, $w, $c, $e, $id) {
        $query = "UPDATE users SET first = ?,last = ?,work = ?,city=?,email=? where id = ? ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$f, $l, $w, $c, $e, $id])) {
            echo "Data updated! <a href='index.php'>view</a>";
        }
    }

    //user search results
    public function search($text) {
        $text = strtolower($text);
        $query = "SELECT * FROM users WHERE first LIKE ? OR last LIKE ? OR work LIKE ? OR email LIKE ? or city LIKE ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$text, $text, $text, $text, $text]);
        $out = "";
        $out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ID</th><th>First Name</th><th>Last Name</th><th>Occupation</th><th>City</th><th>Email</th><th colspan='2'>Option</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $first = $row['first'];
            $last = $row['last'];
            $work = $row['work'];
            $city = $row['city'];
            $email = $row['email'];
            $out .= "<tr><td>$id</td><td>$first</td><td>$last</td><td>$work</td><td>$city</td><td>$email</td>";
            $out .= "<td><a href='edit.php?id=$id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
            $out .= "<td><span id='$id' class='del btn btn-sm btn-danger' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
        }
        $out .= "</table>";
        if ($stmt->rowCount() == 0) {
            $out = "";
            $out .= "<p class='alert alert-danger text-center col-sm-3 mx-auto'>Not Found.</p>";
        }
        return $out;
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$id])) {
            echo "1 record deleted.";
        }
    }

//end of class
}

?>