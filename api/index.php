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

    if(strtolower($url[0]) == 'vagas'){

        require_once('apiVagas/index.php');

    }elseif(strtolower($url[0]) == 'veiculos'){

        require_once('apiVeiculo/index.php');
        
    }elseif(strtolower($url[0]) == 'controle'){
        
        require_once('apiControle/index.php');
    
    }elseif(strtolower($url[0]) == 'valor'){

        require_once('apiValor/index.php');
    
    }elseif(strtolower($url[0]) == 'clientes'){

        require_once('apiCliente/index.php');

    }elseif(strtolower($url[0]) == 'cor'){

        require_once('apiCor/index.php');

    }

?>