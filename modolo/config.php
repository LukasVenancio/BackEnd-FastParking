<?php

    define('SRC', $_SERVER['DOCUMENT_ROOT'] . '/FastPark/BackEndFastPark');

    /*Funções globais para o projeto*/

    /*Função para converter um array em um JSON */
    function toJSON($arrayDados){

        if($arrayDados != null){

            /*Configura o padrão da conversão para o formato JSON. */
            header('Content-Type: application/json');

            /*Converte um array para JSON.*/
            $jsonDados = json_encode($arrayDados);

            /*json_decode(): converte um JSON para array */

            return $jsonDados;
        
        }else{
            return false;
        }

    }

?>