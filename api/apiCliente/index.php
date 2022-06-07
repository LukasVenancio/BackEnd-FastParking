<?php

   //import do arquivo autoload, que fará as instancias do slim
   require_once('vendor/autoload.php'); 

   //Criando um objeto do slim chamado app, para coonfigurar os endpoints(rotas)
   $app = new \Slim\App();

   //Endpoint Requisição para listar todos os clientes
   $app->get('/clientes', function($request, $response, $args)
   {
      require_once('../modolo/config.php');
      require_once('../controller/controllerCliente.php');

      if($dados = listarClientes())
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
                          ->write('{"message" : "Nenhum cliente encontrado"}');
      }

   });

   //Endpoint Requisição para listar clientes pelo id
   $app->get('/clientes/{id}', function($request, $response, $args)
   {
      
      require_once('../modolo/config.php');
      require_once('../controller/controllerCliente.php');
  
      $id = $args['id'];
  
      if($dados = buscarCliente($id))
      {
        if(!isset($dados["Erro"])){
          if($dadosJSON = toJSON($dados))
          {
            return  $response ->withStatus(200)
                              ->withHeader('Content-Type', 'application/json')
                              ->write($dadosJSON);
          }
        }else
        {
          $dadosJSON=toJSON($dados);
  
          return  $response ->withStatus(404)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message" : "Dados invalidos",
                                    "Erro" : '.$dadosJSON.'}');
        }    
      }else
      {
        return  $response ->withStatus(404)
                          ->withHeader('Content-Type', 'application/json')
                          ->write('{"message" : "Nenhum cliente encontrado"}');
      }
      
   });

   //Endpoint Requisição para inserir um novo cliente
   /*****   Terminar o Inserir pelo JSON  *****/
   $app->post('/clientes', function($request, $response, $args)
   {

      $contentTypeHeader = $request -> getHeaderLine('Content-Type');

      $contentType = explode(";", $contentTypeHeader);

      switch($contentType[0])
      {
         case 'multipart/form-data':

            $dadosBody = $request->getParsedBody();

            require_once('../modolo/config.php');
            require_once('../controller/controllerCliente.php');

            $resposta = inserirCliente($dadosBody);

            if(is_bool($resposta) && $resposta == true)
            {
               return  $response ->withStatus(201)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('{"message" : "registro inserido com sucesso"}');
            }elseif(is_array($resposta) && $resposta['Erro'])
            {
               $dadosJSON = toJSON($resposta);

               return  $response ->withStatus(404)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('{"message" : "Ouve um problema no processo de inserir",
                                          "Erro" : '.$dadosJSON.'}');
            }

            break;

         case 'application/json':

            $dadosBody = $request->getParsedBody();
         
            require_once('../modolo/config.php');
            require_once('../controller/controllerVeiculo.php');

            $resposta = inserirVeiculos($dadosBody);

            if(is_bool($resposta) && $resposta == true)
            {
               return  $response ->withStatus(201)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('{"message" : "registro inserido com sucesso"}');
            }elseif(is_array($resposta) && $resposta['Erro'])
            {
               $dadosJSON = toJSON($resposta);

               return  $response ->withStatus(404)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('{"message" : "Ouve um problema no processo de inserir",
                                          "Erro" : '.$dadosJSON.'}');
            }
                              
            break;

         default:
            return  $response ->withStatus(400)
                              ->withHeader('Content-Type', 'application/json')
                              ->write('{"message" : "formato do Content-Type não é valida para esta requisição"}');
 
            break;
      }
   

   });

   //Endpoint Requisição para deletar cliente por id
   $app->delete('/clientes/{id}', function($request, $response, $args)
   {
   
         if(is_numeric($args['id']))
         {
            require_once('../modolo/config.php');
            require_once('../controller/controllerCliente.php');
   
         $id =$args['id'];
   
         if(buscarCliente($id))
         {
   
            $resposta = excluirCliente($id);
   
            if(is_bool($resposta) && $resposta == true)
            {
               return  $response    ->withStatus(200)
                                    ->withHeader('Content-Type', 'application/json')
                                    ->write('{"message" : "Registro excluido com sucesso"}');
            }else
            {   
               $dadosJSON=toJSON($resposta);
   
               return  $response ->withStatus(404)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('{"message" : "Ouve um problema no processo de excluir",
                                          "Erro" : '.$dadosJSON.'}');                            
            }
         }else
         {
            return  $response   ->withStatus(404)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('{"message" : "O ID informado não existe na base de dados"}');
         }
         }else
         {
         return  $response   ->withStatus(404)
                              ->withHeader('Content-Type', 'application/json')
                              ->write('{"message" : "É obrigatorio informar um ID com formato valido (número)"}');
         }
   
   });



   $app->run();
?>