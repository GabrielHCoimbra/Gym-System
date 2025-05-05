<div hidden="">
    <?php
        include 'principal.php';
        include_once('../includes/conexao.php');
    ?>
 </div>


<form action="pagarmensalidade.php" method="post">

    <label for="nr_paciente">Paciente</label>
    <select name="nr_paciente" id="">
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
    <label for="mes">Mês referente ao pagamento</label>
    <select name="mes" id="">
        <option value="Jan">Janeiro</option>
        <option value="Fev">Fevereiro</option>
        <option value="Mar">Março</option>
        <option value="Abr">Abril</option>
        <option value="Mai">Maio</option>
        <option value="Jun">Junho</option>
        <option value="Jul">Julho</option>
        <option value="Ago">Agosto</option>
        <option value="Sete">Setembro</option>
        <option value="Outu">Outubro</option>
        <option value="Nov">Novembro</option>
        <option value="Dez">Dezembro</option>
    </select>
    <label for="recibo">N° do recibo</label>
    <input type="number" name="recibo">
    <label for="data_deposito">Data de Pagamento</label>
    <input type="date" name="data_deposito" id="">
    <br>
    <input type="submit" value="Registrar">
</form>