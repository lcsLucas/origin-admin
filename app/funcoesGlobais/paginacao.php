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
    $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'd-inline' : 'd-none';

    /* Verifica se vai exibir o botão "Anterior" e "Último" */
    $exibir_botao_final = ($range_final > $pagina_atual) ? 'd-inline' : 'd-none';

/* Loop para montar a páginação central com os números */
?>

    <div class='box-paginacao'>
        <a class='box-navegacao <?=$exibir_botao_inicio?>' href="index.php?page=<?=$primeira_pagina?>" title="Primeira Página">Primeira</a>
        <a class='box-navegacao <?=$exibir_botao_inicio?>' href="index.php?page=<?=$pagina_anterior?>" title="Página Anterior">Anterior</a>

        <?php
        /* Loop para montar a páginação central com os números */
        for ($i=$range_inicial; $i <= $range_final; $i++):
            $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;
            ?>
            <a class='box-numero <?=$destaque?>' href="index.php?page=<?=$i?>"><?=$i?></a>
        <?php endfor; ?>

        <a class='box-navegacao <?=$exibir_botao_final?>' href="index.php?page=<?=$proxima_pagina?>" title="Próxima Página">Próxima</a>
        <a class='box-navegacao <?=$exibir_botao_final?>' href="index.php?page=<?=$ultima_pagina?>" title="Última Página">Último</a>
    </div>

    <?php
}