<div hidden="">
<?php
require_once("principal.php");
include_once('../includes/conexao.php');
?>
</div>


<?php if($_SESSION['usuarioNivelAcesso'] == 1){ ?>
    <a href="verificaDisp.php">Cadastrar Consulta</a>
    <div class="table">
        <table>
            <tr>
                <th>Nome Paciente</th>
                <th>Nome Médico</th>
                <th>Dia</th>
                <th>Horário</th>
            </tr>
            <?php
            $exibicao = mysqli_query($conectar, "SELECT paciente.nome_paciente, medic.nome_medic, consultas.dia, consultas.horario FROM consultas 
            INNER JOIN paciente ON consultas.nr_paciente = paciente.nr_paciente
            INNER JOIN medic ON medic.nr_medic = consultas.nr_medic
            ");
            while ($data = mysqli_fetch_array($exibicao)) { 
                $date = date_create($data['dia']);
                ?>
                <tr>
                    <td><?= $data['nome_paciente'] ?></td>
                    <td><?= $data['nome_medic'] ?></td>
                    <td><?= date_format($date,"d/m/Y") ?></td>
                    <td><?= date('H:i', strtotime($data['horario'])) ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>

<?php if($_SESSION['usuarioNivelAcesso'] == 2){ 
        $nome = $_SESSION['usuarioNome'];
        $exibicao = mysqli_query($conectar, "SELECT medic.nr_medic FROM medic
        INNER JOIN tabela_usuarios ON medic.nome_medic = tabela_usuarios.nome WHERE medic.nome_medic = '$nome'
        ");
        $nrMedic = mysqli_fetch_array($exibicao);
        $nrMedic = $nrMedic['nr_medic'];
    ?>
    

    <div class="table">
        <table>
            <tr>
                <th>Nome Paciente</th>
                <th>Nome Médico</th>
                <th>Dia</th>
                <th>Horário</th>
            </tr>
            <?php
            $exibicao = mysqli_query($conectar, "SELECT paciente.nome_paciente, medic.nome_medic, consultas.dia, consultas.horario FROM consultas 
            INNER JOIN paciente ON consultas.nr_paciente = paciente.nr_paciente
            INNER JOIN medic ON medic.nr_medic = consultas.nr_medic WHERE consultas.nr_medic = '$nrMedic'
            ");
            while ($data = mysqli_fetch_array($exibicao)) { 
                $date = date_create($data['dia']);
                ?>
                <tr>
                    <td><?= $data['nome_paciente'] ?></td>
                    <td><?= $data['nome_medic'] ?></td>
                    <td><?= date_format($date,"d/m/Y") ?></td>
                    <td><?= date('H:i', strtotime($data['horario'])) ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

<?php } ?>
