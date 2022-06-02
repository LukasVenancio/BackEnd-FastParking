<?php

    /*Arquivo principal que receberá a URL requisitada e irá redirecionar para as API's.*/

    /*Define quais endereços de sites poderão fazer requisições.*/
    header('Access-Control-Allow-Origin: *');

    /*Define quais métodos poderão ser utilizados na API.*/
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

    /*Ativa a opção de definir quais content-type's serão permitidos.*/
    header('Access-Control-Allow-Header: Content-Type');

    /*Define quais content-type's serão permitidos.*/
    header('Content-Type: application/json');

    /*Recebe a URL passada pelo SLIM.*/
    $urlHTTP = (string) $_GET['url'];

    /*Separa a URL quando encontra o caracter informado.*/
    $url = explode('/', $urlHTTP);

    if(strtolower($url[0]) == 'produtos'){

        require_once('produtosAPI/index.php');

    }elseif(strtolower($url[0]) == 'categorias'){

        
    }




?>