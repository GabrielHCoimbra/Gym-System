<div hidden="">
<?php
require_once("principal.php");

?>
</div>

<?php 
if(isset($_POST['nome_paciente'])){
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
    $paciente->inserir_paciente($_POST['tipo_documento'], $_POST['nr_documento'],  $_POST['nome_paciente'], $_POST['apelido_paciente'], $_POST['data_nascimento_paciente'],  $_POST['sexo_paciente'], $_POST['bairro'], $_POST['cidade'], $_POST['casa'], $_POST['rua_avenida'], $_POST['telefone'], $_POST['telefone_alternativo'], $_POST['nome_do_pai'], $_POST['nome_da_mae'], $_POST['email'], $foto, $_POST['recibo'], $_POST['data_deposito'], $_POST['valor_inscricao'], $_POST['valor_mensalidade']);
    $usuario->inserir_usuario($_POST['nome_paciente'], $_POST['apelido_paciente'], '3', $_POST['nr_documento'],'0000');
}
header("location: paciente.php");
?>