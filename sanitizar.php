<?php

/***********
 * sanitizar()
 * ----------
 *  Faz uma limpeza nos dados do array ou string para evitar ataques de injection e XSS (Cross-Site Scripting
 *   - O parâmetro de entrada pode ser um array ou uma string    
 *   - Retorna um array ou uma string, dependendo da entrada
 */

function sanitizar($dados)
{

    if (is_array($dados)) {
        foreach ($dados as $chave => $valor) {
            $valor = filter_var($valor, FILTER_SANITIZE_STRING); //Remove HTML TAGS
            $valor = str_replace("&#x", '', $valor); //Remove início hexadecimal
            $valor = stripslashes($valor);  //Remove \
            $dados[$chave] = trim($valor);
        }
    } else {
        $dados = filter_var($dados, FILTER_SANITIZE_STRING);
        $dados = str_replace("&#x", '', $dados);    // --- replace o prefixo Hexadecimal com nada
        $dados = stripslashes($dados);
        $dados = trim($dados);
    }
    return $dados;
}//Fim sanitizar()