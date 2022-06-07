<?php

    require_once('vendor/autoload.php');

    require_once('../modolo/config.php');
    require_once('../controller/controllerControle.php');

    $app = new \Slim\App();

    $app->get('/controle', function($request, $response, $args){

        $dados = listarControles();

        if($dados){

            $dadosJson = toJSON($dados);

            if($dadosJson){

                return $response    ->withHeader('Content-Type', 'application/json')
                                    ->write($dadosJson)
                                    ->withStatus(200);
            }
        
        }else{

            return $response     ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('[{"message" : "Item não encontrado"}]');
        }

    });

    $app->run();

?>