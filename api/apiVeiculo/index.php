<?php

   //import do arquivo autoload, que fará as instancias do slim
   require_once('vendor/autoload.php'); 

   //Criando um objeto do slim chamado app, para coonfigurar os endpoints(rotas)
   $app = new \Slim\App();

   //Endpoint Requisição para listar todos os Veiculos
   $app->get('/veiculos', function($request, $response, $args)
   {
      require_once('../modolo/config.php');
      require_once('../controller/controllerVeiculo.php');

      if($dados = listarVeiculos())
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
                          ->write('{"message" : "Nenhum veiculo encontrado"}');
      }

   });

   //Endpoint Requisição para listar veiculos pela placa
   $app->get('/veiculos/placa/{placa}', function($request, $response, $args)
   {
      
      require_once('../modolo/config.php');
      require_once('../controller/controllerVeiculo.php');
  
      $placa = $args['placa'];

      $dados = buscarVeiculoPlaca($placa);
  
      if($dados)
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
                          ->write('{"message" : "Nenhum veiculo encontrado"}');
      }
      
   }); 

   //Endpoint Requisição para listar veiculos pelo id
   $app->get('/veiculos/{id}', function($request, $response, $args)
   {
      
      require_once('../modolo/config.php');
      require_once('../controller/controllerVeiculo.php');
  
      $id = $args['id'];
  
      if($dados = buscarVeiculo($id))
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
                          ->write('{"message" : "Nenhum veiculo encontrado"}');
      }
      
   });

   //Endpoint Requisição para deletar Veiculo por id
   $app->delete('/veiculos/{id}', function($request, $response, $args)
   {

      if(is_numeric($args['id']))
      {
         require_once('../modolo/config.php');
         require_once('../controller/controllerVeiculo.php');

      $id =$args['id'];

      if(buscarVeiculo($id))
      {

         $resposta = excluirVeiculo($id);

         if(is_bool($resposta) && $resposta == true)
         {
            return  $response   ->withStatus(200)
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

   //Endpoint Requisição para inserir um novo veiculo
   /*****   Terminar o Inserir pelo JSON  *****/
   $app->post('/veiculos', function($request, $response, $args)
   {

      $contentTypeHeader = $request -> getHeaderLine('Content-Type');

      $contentType = explode(";", $contentTypeHeader);

      switch($contentType[0])
      {
         case 'multipart/form-data':

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

   //Endpoint Requisição para alterar um veiculo, simulando o PUT
   /*****   Ainda precisa terminar e resolver problemas *****/
   $app->post('/veiculos/id}', function($request, $response, $args)
   {
      if(is_numeric($args['id']))
      {
         //Recebe o id enviado no Endpoint atraves da vareavel ID
         $id =$args['id'];

         //Recebe do header a requisição qual será o content type 
         $contentTypeHeader = $request -> getHeaderLine('Content-Type');

         //Cria um array, pois dependendo do content-Type temos mais informações separadas por (;)
         $contentType = explode(";", $contentTypeHeader);

         switch($contentType[0])
         {
            case 'multipart/form-data':

               require_once('../modolo/config.php');
               require_once('../controller/controllerVeiculo.php');

               //Chama a função para buscar a foto que já esta salva no BD
               if(buscarVeiculo($id))
               {
                  //Recebe os dados comuns enviados pelo corpo da requisição
                  $dadosBody = $request->getParsedBody();

                  //Cria um array com todos os dados comuns e do arquivo que será enviado para o servidor
                  $arrayDados = array (
                                       $dadosBody,
                                       "id"   => $id,
                  );
   
                  $resposta = atualizarVeiculo($arrayDados);

                  if(is_bool($resposta) && $resposta == true)
                  {
                     return  $response ->withStatus(200)
                                       ->withHeader('Content-Type', 'application/json')
                                       ->write('{"message" : "registro atualizado com sucesso"}');
                  }elseif(is_array($resposta) && $resposta['Erro'])
                  {
                     $dadosJSON = toJSON($resposta);

                     return  $response ->withStatus(404)
                                       ->withHeader('Content-Type', 'application/json')
                                       ->write('{"message" : "Ouve um problema no processo de atualizar",
                                                "Erro" : '.$dadosJSON.'}');
                  }

               }else
               {
                  return  $response    ->withStatus(404)
                                       ->withHeader('Content-Type', 'application/json')
                                       ->write('{"message" : "O ID informado não existe na base de dados"}');
               }  

            break;

            case 'application/json':

               $dadosBody = $request->getParsedBody();
               var_dump($dadosBody);
               die;

               return  $response ->withStatus(200)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('{"message" : "formato selecionado foi JSON"}');
               break;

            default:
               return  $response ->withStatus(400)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('{"message" : "formato do Content-Type não é valida para esta requisição"}');
               break;
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