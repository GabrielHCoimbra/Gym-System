<div hidden="">
<?php
require_once("principal.php");

?>
</div>

<?php 
if(isset($_POST['nome_medic'])){
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
    $medic->inserir_medic($_POST['tipo_documento'], $_POST['nr_documento'],  $_POST['nome_medic'], $_POST['data_nascimento_medic'],  $_POST['sexo_medic'], $_POST['bairro'], $_POST['casa'], $_POST['cidade'],  $_POST['rua_avenida'], $_POST['telefone'], $_POST['telefone_alternativo'], $_POST['email'], $foto);
    $usuario->inserir_usuario($_POST['nome_medic'], $_POST['nome_medic'], '2', $_POST['nr_documento'],'0000');
}
header("location: medic.php");
?>