<div hidden="">
    <?php
        include 'principal.php';
        include '../includes/conexao.php';
    ?>
</div>
<form action="cadastrarConsulta.php" method="post" id="inicial" >
        <label for="nr_medic">Médico</label>
        <select name="nr_medic" id="nr_medic">
            <?php
                $query= "SELECT nr_medic, nome_medic FROM medic";
                $qry =  mysqli_query($conectar, $query);
                while ($data = mysqli_fetch_array($qry)) {
                
            
            ?>
            <option value="<?= $data['nr_medic']?>"><?= $data['nome_medic']?></option>
            <?php
                }
            ?>
        </select>
        <label for="dia">Dia da Consulta</label>
        <input type="date" name="dia" id="dia" required>
        <br>
        <label for="id">Produto</label>
    <?php
        
        $query3= "SELECT id_produto, titulo_imagem FROM product";
        
        $qry3 =  mysqli_query($conectar, $query3);
        
    
        
    ?>
    <select name="id" id="">
        <?php
            while ($data3 = mysqli_fetch_array($qry3)) {
                    
        ?>
                        <option value="<?= $data3['id_produto']?>"><?= $data3['titulo_imagem']?></option>
        <?php
                    }       

        
        ?>
    </select>
        <input type="submit" value="Verificar Disponibilidade">
</form>