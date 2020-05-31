<?php
	if (! defined('ABSPATH'))
		die;

$retorno = null;

if (!empty($this->dados->retorno))
    $retorno = $this->dados->retorno;

?>

    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= URL ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Página</li>
    </ol>

    <div class="animated fadeIn">

        <div id="conteudo" class="container">

			<?php include_once PATH_VIEWS . 'shared/mensagens-retorno.php' ?>

            <div class="card border-0">

                <div class="card-header bg-primary">
                    <h5 class="text-uppercase m-0">Página</h5>
                </div>

                <div class="card-body border border-top-0 border-primary">



                </div>

            </div>

            <div class="card border-primary">

                <div class="card-header bg-primary py-3">
                    <h5 class="text-uppercase m-0 text-white text-center text-md-left">Cadastrados</h5>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover m-0">

                            <thead>

                            <tr class="bg-gray-100">

                                <th class="border-0 font-weight-bold text-uppercase text-dark">Nome</th>
                                <th class="border-0 font-weight-bold text-uppercase text-dark">Email</th>
                                <th class="border-0 text-center font-weight-bold text-uppercase text-dark">Criado</th>
                                <th class="border-0 text-center font-weight-bold text-uppercase text-dark">Ativado</th>
                                <th class="border-0 text-center font-weight-bold text-uppercase text-dark min-180">Ação</th>

                            </tr>

                            </thead>

                            <tbody class="px-2">



                            </tbody>

                        </table>

                    </div>

                    <?php
                    //paginacao($paginacao->total_registros,$paginacao->registros_paginas,$paginacao->pagina_atual,$paginacao->range_paginas)
                    ?>

                </div>

            </div>

        </div>

    </div>