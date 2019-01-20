<?php
/**
 * Paginação
 *
 * Cria uma paginação simples.
 *
 * @author Luiz Otávio Miranda Figueiredo
 * @link   https://www.todoespacoonline.com/w/2014/10/paginacao-em-php/
 * @param int $total_artigos Número total de artigos da sua consulta
 * @param int $artigos_por_pagina Número de artigos a serem exibidos nas páginas
 * @param int $offset Número de páginas a serem exibidas para o usuário
 *
 * @return string A paginação montada
 */

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

function paginacao($total_registros, $registros_por_paginas, $pagina_atual, $range_paginas)
{

    /* Idêntifica a primeira página */
    $primeira_pagina = 1;

    /* Cálcula qual será a última página */
    $ultima_pagina  = ceil($total_registros / $registros_por_paginas);

    /* Cálcula qual será a página anterior em relação a página atual em exibição */
    $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual -1 :  1;

    /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
    $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual +1 : 1;

    /* Cálcula qual será a página inicial do nosso range */
    $range_inicial  = (($pagina_atual - $range_paginas) >= 1) ? $pagina_atual - $range_paginas : 1 ;

    /* Cálcula qual será a página final do nosso range */
    $range_final   = (($pagina_atual + $range_paginas) <= $ultima_pagina ) ? $pagina_atual + $range_paginas : $ultima_pagina ;

    /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
    $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? '' : 'd-none d-md-none d-lg-none';

    /* Verifica se vai exibir o botão "Anterior" e "Último" */
    $exibir_botao_final = ($range_final > $pagina_atual) ? '' : 'd-none d-md-none d-lg-none';

/* Loop para montar a páginação central com os números */

    $pos = strpos($_SERVER["REQUEST_URI"],"?");
    $url = substr($_SERVER["REQUEST_URI"],0,$pos);
    ?>

    <nav aria-label="navigation" class="mt-5">
        <ul class="pagination justify-content-center flex-wrap">
            <li class="page-item">
                <a class="page-link d-none d-md-inline-block <?=$exibir_botao_inicio?>" href="<?= $url ?>?page=<?=$primeira_pagina?>" title="Primeira Página">Primeira</a>
            </li>
            <li class="page-item">
                <a class="page-link <?=$exibir_botao_inicio?>" href="<?= $url ?>?page=<?=$pagina_anterior?>" title="Página Anterior">Anterior</a>
            </li>

            <?php
            /* Loop para montar a páginação central com os números */
            for ($i=$range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'active d-inline' : '' ;
                ?>
                <li class="page-item d-none d-md-inline <?=$destaque?>"><a class="page-link" href="<?= $url ?>?page=<?=$i?>"><?=$i?></a></li>
            <?php endfor; ?>

            <li class="page-item">
                <a class="page-link <?=$exibir_botao_final?>" href="<?= $url ?>?page=<?=$proxima_pagina?>" title="Próxima Página">Próxima</a>
            </li>
            <li class="page-item">
                <a class="page-link d-none d-md-inline-block <?=$exibir_botao_final?>" href="<?= $url ?>?page=<?=$ultima_pagina?>" title="Última página">Última</a>
            </li>
        </ul>
    </nav>

    <?php
}