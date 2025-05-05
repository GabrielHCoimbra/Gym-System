<div hidden="">
<?php
require_once("principal.php");

?>

</div>

<div class="container-fluid">
        <div id='mensagem'></div>
          <!-- DataTales Example -->
          <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Usuários do sistema</h1>
            
        </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="dataTable" cellspacing="0">
                  <thead >
                    <tr class="filters">
                      <th>Usuário</th>
                      <th>Nome</th>
                      <th>Nível de Acesso</th>
                      <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="searchable" class="searchable">
                    <?php
                        echo $usuario->listar_usuarios();
                    ?>

                </tbody>
                </table>
              </div>
            </div>
          </div>

</div>

