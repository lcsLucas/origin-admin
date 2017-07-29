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

function paginacao(
    $total_artigos = 0,
    $artigos_por_pagina = 10,
    $offset = 5
) {
    // Obtém o número total de página
    $numero_de_paginas = ceil( ($total_artigos) / $artigos_por_pagina )-1;

    // Atualiza a página atual se tiver o parâmetro pagina=n
    $pagina_atual = !(filter_input(INPUT_GET,"pagina",FILTER_VALIDATE_INT)) ? 0 : filter_input(INPUT_GET,"pagina",FILTER_VALIDATE_INT);

    if($pagina_atual > $numero_de_paginas) $pagina_atual = 0;
    // Vamos preencher essa variável com a paginação
    $paginas = null;

    /**
     * Só Mostrar 'Inicio' se tiver 1 ou mais paginas e pagina atual nao for a primeira
     */
    if($numero_de_paginas >= 1 && $pagina_atual > 0) {
        // Primeira página
        $paginas .=
            "<li class=\"page-item\">
            <a class=\"page-link\" href=\"?pagina=\" aria-label=\"Previous\">
            <span aria-hidden=\"true\">&laquo;</span>
            <span class=\"sr-only\">Previous</span>
            </a>
            </li>";
    } elseif($numero_de_paginas >= 1){
        $paginas .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">Início</a></li>";
    }
    // Faz o loop da paginação
    // $pagina_atual - 1 da a possibilidade do usuário voltar
    $i = ( $pagina_atual - 1 );
    while($i < ( $pagina_atual - 1 ) + $offset) {

        // Eliminamos a primeira página (que seria a home do site)
        if ( $i < $numero_de_paginas && $i > 0 ) {
            // A página atual
            $pagina = $i;

            // O estilo da página atual
            $estilo = '';

            // Verifica qual dos números é a página atual
            // E cria um estilo extremamente simples para diferenciar
            if ($i == $pagina_atual) {
                $estilo = 'active';
            }
            // Inclui os links na variável $paginas
            $paginas.=
                    "<li class=\"page-item ".$estilo."\"><a class=\"page-link\" href=\"?pagina=$pagina\">".$pagina."</a></li>";
        }
        $i++;
    } // while

    if($numero_de_paginas >= 1 && $pagina_atual < $numero_de_paginas) {
        $paginas.=
            "<li class=\"page-item\">
            <a class=\"page-link\" href=\"?pagina=".$numero_de_paginas."\" aria-label=\"Next\">
            <span aria-hidden=\"true\">&raquo;</span>
            <span class=\"sr-only\">Next</span>
            </a>
            </li>";
    } elseif($numero_de_paginas >= 1){
        $paginas .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">Último</a></li>";
    }
    // Retorna o que foi criado
    return $paginas;

}
