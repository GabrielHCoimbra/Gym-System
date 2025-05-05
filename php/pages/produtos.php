<head>
    <link rel="stylesheet" href="../../css/form-css/bootstrap-duallistbox.css">
    <link rel="stylesheet" href="../../css/form-css/educate-custon-icon.css">
    <link rel="stylesheet" href="../../css/form-css/main.css">
    <link rel="stylesheet" href="../../css/form-css/manjolo.css">
    <link rel="stylesheet" href="../../css/form-css/sb-admin-2.css">
    <link rel="stylesheet" href="../../css/form-css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../../css/form-css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/form-css/util.css">
</head>
<div class="container-fluid">
<form class="" method="POST" id="" action="RegistroProdutos.php" enctype="multipart/form-data">

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
        <br><br>
        <input type="text" name="nome" placeholder="Nome do Produto" class="input-xs form-control in" >
        
        
        <input type="number" name="preco" placeholder="Preço do Produto" class="input-xs form-control in" >

        <input type="number" name="estoque" placeholder="Estoque" class="input-xs form-control in" >

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                <button  class="btn btn-success btn-icon-split" type="submit" name="cadastrarpaciente">
                    <span class="text">Gravar</span>
                </button>

            </div>

        </div>

</form>
</div>
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

</script>