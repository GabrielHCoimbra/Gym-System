<?php
    include_once('../includes/conexao.php');

        $exibicao = mysqli_query($conectar, "SELECT id_produto, url_foto, texto_imagem, titulo_imagem, preco_produto
        FROM product");

        while ($linha = mysqli_fetch_array($exibicao)){
            ?>
            <div class="product-img">
                <img src="<?=$linha['url_foto'] ?>" alt="">
            </div>
            <div class="product-title">
                <h3><?= $linha['titulo_imagem'] ?></h3>
            </div>
            <div class="price">
                <span>R$<?= $linha['preco_produto'] ?></span>
            </div>


<?php
    }
?>