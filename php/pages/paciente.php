<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/form-css/bootstrap-duallistbox.css">
    <link rel="stylesheet" href="../../css/form-css/educate-custon-icon.css">
    <link rel="stylesheet" href="../../css/form-css/main.css">
    <link rel="stylesheet" href="../../css/form-css/manjolo.css">
    <link rel="stylesheet" href="../../css/form-css/sb-admin-2.css">
    <link rel="stylesheet" href="../../css/form-css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../../css/form-css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/form-css/util.css">
    <title></title>
</head>
<body>
<div hidden="">
<?php
require_once("principal.php");

?>

</div>
<div class="container-fluid">

    <div id='mensagem'></div>

    

                    <form class="" method="POST" id="" action="cadastrarpaciente.php" enctype="multipart/form-data">

                        <div class="row" style="">

                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

                                <div class="row">

                                    <div class="col-12">

                                        <img id="output" src="../../img/user.webp" class="img-responsive col-12" ></img>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12">

                                        <div class="col-12">

                                            <label for="url_foto" class="custom-file-label">Selecione a Foto</label>

                                            <input type="file" accept="image/*" class="form-control custom-file-input in" id="url_foto" name="url_foto" onchange="loadFile(event)">

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 " >

                                <div class="row">

                                    <label class="modal-title" style="margin-bottom: -20px;">Dados Pessoais</label>
                                    <hr style=" !important; height: 0px; background-color: #880f0f">
                                </div>
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

                                    <input type="text" autofocus="" readonly="" class="input-xs form-control in " name="nr_paciente" maxlength="20" data-validate="Este campo é obrigatório" value="<?=$paciente->ultimo_id(); ?>" placeholder="Nº do paciente" required="" >

                                </div>

                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">

                                    <input type="text" autofocus="" class="input-xs form-control in" name="nome_paciente" maxlength="70" value="" placeholder="Nome" required="" >

                                </div>

                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                                    <input type="text" class="input-xs form-control in" name="apelido_paciente" value="" maxlength="50" placeholder="Apelido" required="" >

                                </div>

                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                    <input type="text" onfocus="(this.type = 'date')" class="input-xs form-control in" id="dob" name="data_nascimento_paciente" value="" placeholder="Data de nascimento" rnb equired="" max="">

                                </div>

                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                    <input type="text" class="input-xs form-control in" name="nr_documento" value="" maxlength="13" placeholder="Número do documento" id="nr_documento" required="">

                                </div>

                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                    <select class="input-xs form-control in" name="tipo_documento" required="" id="tipo_documento" onkeyup="mask('tipo_documento')">

                                        <option readonly="">Tipo de documento</option>

                                        <option value="RG">RG</option> 

                                        <option value="CPF" >CPF</option> 

                                    </select>

                                </div>


                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                    <select class="input-xs form-control in" name="sexo_paciente" required="">

                                        <option >Sexo</option>

                                        <option value="Masculino" >Masculino</option> 

                                        <option value="Femenino" >Femenino</option> 

                                    </select>

                                </div>


                                <label class="modal-title" style="margin-bottom: -20px;">Pais</label>
                                <hr style=" !important; height: 0px; background-color: #880f0f">

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"> 

                                    <input type="text" class="input-xs form-control in" name="nome_do_pai" maxlength="70" value="" placeholder="Nome do pai" >

                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"> 

                                    <input type="text" class="input-xs form-control in" maxlength="70" name="nome_da_mae" value="" placeholder="Nome da Mãe" >

                                </div>
                                <label style="margin-bottom: -20px;">Endereço</label>
                                <hr style=" !important; height: 0px; background-color: #880f0f">
                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                    <input type="text" class="input-xs form-control in" id="bairro" name="bairro" maxlength="25" value="" placeholder="Bairro">

                                </div>

                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                    <input type="text" class="input-xs form-control in" id="cidade" maxlength="20" name="cidade" value="" placeholder="Cidade">

                                </div>

                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                    <input type="text" class="input-xs form-control in" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6" id="casa" name="casa" value="" placeholder="N°" >

                                </div>

                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

                                    <input type="text" class="input-xs form-control in" name="rua_avenida" maxlength="50" value="" placeholder="Rua/Avenida">

                                </div>

                                <label style="margin-bottom: -20px;">Contatos</label>
                                <hr style=" !important; height: 0px; background-color: #880f0f">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                    <input type="email" class="input-xs form-control in" id="email" name="email" value="" placeholder="Email" maxlength="100">

                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                    <input type="text" class="input-xs form-control in" id="telefone" name="telefone" value="" placeholder="Celular" onkeypress='return event.charCode >= 48 && event.charCode <= 57' riquired='' maxlength="9">

                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

                                    <input type="text" class="input-xs form-control in" id="telefone_alternativo" name="telefone_alternativo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="" placeholder="Celular alternativo" maxlength="9">

                                </div>

                            </div>
                            <label style="margin-bottom: 0px;">Dados da Inscrição</label>
                            <hr style="width: 100% !important; height: 1px; background-color: #880f0f">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <label>Recibo nº</label>
                                
                                <input type="text" class="input-xs form-control in" id="recibo" name="recibo" value="" required="" placeholder="Recibo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="15">

                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <label>Data Depósito</label>
                                
                                <input type="date" class="input-xs form-control in" id="data_deposito" required="" name="data_deposito" value="" min="<?=$validade_min?>" placeholder=""  >

                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <label>Valor de inscrição</label>
                                
                                <input type="number" class="input-xs form-control in" id="valor_inscricao" required="" name="valor_inscricao" value="" placeholder=""  >

                            </div>
                           
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <label>Valor da mensalidade que o aluno irá pagar</label>
                                
                                <input type="number" class="input-xs form-control in" id="valor_mensalidade" required="" name="valor_mensalidade" value="" placeholder=""  >

                            </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                    <button  class="btn btn-success btn-icon-split" type="submit" name="cadastrarpaciente">
                                        <span class="text">Gravar</span>
                                    </button>

                                </div>

                            </div>



                        </div>
                            

                        <br>

                    </form>

      








<?php
//include_once("rodape.php");
?>

<script type="text/javascript">

    var loadFile = function (event) {

        var output = document.getElementById('output');

        output.src = URL.createObjectURL(event.target.files[0]);

    };



    $(document).ready(function () {

        $('input[id="total_mensalidade"]').attr('readonly', true)

        $('input[id="descontos"]').on('keyup', function () {

            $('input[id="total_mensalidade"]').attr('value', $('input[id="mensalidade"]').val() - $('input[id="descontos"]').val())

        })

    })

    function mask($field) {
    if ($field=='CPF') {
        const input = document.getElementById($field);

        const result = document.getElementById('nr_documento');

        var v=input.target.value.replace(/\D/g,"");
        
        v=v.replace(/(\d{3})(\d)/,"$1.$2");
        
        v=v.replace(/(\d{3})(\d)/,"$1.$2");
        
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
        
        input.target.value = v;
        
    }
}

</script>

</body>
</html>


