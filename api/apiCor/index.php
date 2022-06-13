<?php

   //import do arquivo autoload, que fará as instancias do slim
   require_once('vendor/autoload.php'); 

   require_once('../modolo/config.php');
   require_once('../controller/controllerCor.php');

   //Criando um objeto do slim chamado app, para coonfigurar os endpoints(rotas)
   $app = new \Slim\App();

   //Endpoint Requisição para listar todas as Cores de Veiculos
   $app->get('/cor', function($request, $response, $args)
   {

      if($dados = listarCor())
      {

         if($dadosJSON = toJSON($dados))
         {
            return  $response ->withStatus(200)
                              ->withHeader('Content-Type', 'application/json')
                              ->write($dadosJSON);
         }
      }else
      {

        return  $response ->withStatus(404)
                          ->withHeader('Content-Type', 'application/json')
                          ->write('{"message" : "Nenhuma cor encontrado"}');
      }

   });

   $app->run();

?>