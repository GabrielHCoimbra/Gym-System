<?php
    include_once('../includes/conexao.php');

    if (isset($_FILES["url_foto"])) {
        function upload_imagem($file)
        {
            if (isset($file)) {
                $extensao=explode('.', $file["name"]);
                $novo_nome=rand().'.'.$extensao[1];
                $foto='../../img/'.$novo_nome;
                move_uploaded_file($file['tmp_name'],$foto);
                return $foto;
            }
        }
        
        $foto=upload_imagem($_FILES["url_foto"]);
        
    }
   
    $Nome = $_POST['nome'];
    $Preco = $_POST['preco'];
    
    $estoque = $_POST['estoque'];

    $inserir = "INSERT INTO product(url_foto, titulo_imagem, preco_produto)
                VALUES ('$foto', '$Nome', '$Preco')";

    $resultado = mysqli_query($conectar, $inserir)
    or die (mysqli_error());

    $cid = "SELECT LAST_INSERT_ID()";

    $id = mysqli_query($conectar, $cid)
    or die (mysqli_error());

    while ($data=mysqli_fetch_array($id)) {
        $id2 = $data['LAST_INSERT_ID()'];
    }

    $inserir = "INSERT INTO estoque(qte_produto, id_produto)
                VALUES ('$estoque', '$id2')";

    $resultado = mysqli_query($conectar, $inserir)
    or die (mysqli_error());

    header("location: produtos.php");

?>