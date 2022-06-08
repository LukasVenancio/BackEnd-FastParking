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

    /*End Point para buscar por controles sem data de saída.*/
    $app->get('/controle/abertos', function($request, $response, $args){

        $dados = listarControlesSemDataSaida();

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

    /*End Point para buscar um controle pelo id.*/
    $app->get('/controle/{id}', function($request, $response, $args){

        $id = $args['id'];

        $dados = buscarControles($id);

        if($dados){

            $dadosJson = toJSON($dados);

            if(!isset($dados['Erro'])){

                return $response ->withHeader('Content-Type', 'application/json')
                                ->write($dadosJson)
                                ->withStatus(200);
            
            }else{
                
                return $response    ->withStatus(404)
                                    ->withHeader('Content-Type', 'application/json')
                                    ->write($dadosJson);
            }
        
        }else{

            return $response     ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('[{"message" : "Item não encontrado"}]');
        }

    });

    /*End Point para buscar um controle pela placa do veículo.*/
    $app->get('/controle/placa/{placa}', function($request, $response, $args){

        $placa = $args['placa'];

        $dados = buscarControlesPorPlacaVeiculo($placa);

        if($dados){

            $dadosJson = toJSON($dados);

            if(!isset($dados['Erro'])){

                return $response ->withHeader('Content-Type', 'application/json')
                                ->write($dadosJson)
                                ->withStatus(200);
            
            }else{
                
                return $response    ->withStatus(404)
                                    ->withHeader('Content-Type', 'application/json')
                                    ->write($dadosJson);
            }
        
        }else{

            return $response     ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('[{"message" : "Item não encontrado"}]');
        }

    });

    /*End Point para buscar um controle pelo ID do veículo.*/
    $app->get('/controle/veiculo/{id}', function($request, $response, $args){

        $id = $args['id'];

        $dados = buscarControlesPorIdVeiculo($id);

        if($dados){

            $dadosJson = toJSON($dados);

            if(!isset($dados['Erro'])){

                return $response ->withHeader('Content-Type', 'application/json')
                                ->write($dadosJson)
                                ->withStatus(200);
            
            }else{
                
                return $response    ->withStatus(404)
                                    ->withHeader('Content-Type', 'application/json')
                                    ->write($dadosJson);
            }
        
        }else{

            return $response     ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('[{"message" : "Item não encontrado"}]');
        }

    });

    /*End Point para buscar um controle pelo ID da vaga.*/
    $app->get('/controle/vaga/{id}', function($request, $response, $args){

        $id = $args['id'];

        $dados = buscarControlesPorIdVaga($id);

        if($dados){

            $dadosJson = toJSON($dados);

            if(!isset($dados['Erro'])){

                return $response ->withHeader('Content-Type', 'application/json')
                                ->write($dadosJson)
                                ->withStatus(200);
            
            }else{
                
                return $response    ->withStatus(404)
                                    ->withHeader('Content-Type', 'application/json')
                                    ->write($dadosJson);
            }
        
        }else{

            return $response     ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('[{"message" : "Item não encontrado"}]');
        }

    });

    $app->delete('/controle/{id}', function($request, $response, $args){

        $id = $args['id'];

        $dados = excluirControles($id);

        if(isset($dados['Erro'])){

            $dadosJson = toJSON($dados);

            return $response     ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($dadosJson);
        
        }elseif($dados){

            return $response    ->withHeader('Content-Type', 'application/json')
                                ->write('[{"message " : "Registro excluído com sucesso!"}]')
                                ->withStatus(200);
        }

    });

    $app->post('/controle', function($request, $response, $args){

        /*Recupera o formato de dados do header da requisição.*/
        $contentTypeHeader = $request->getHeaderLine('Content-Type');

        /*Separa a variável em um array, contendo somente o formData */
        $contentType = explode(";", $contentTypeHeader);

        if($contentType[0] == 'application/json'){

            $bodyData = $request->getParsedBody();

            $resposta = inserirControles($bodyData);

            if(is_bool($resposta) && $resposta){

                return $response    ->withStatus(201)
                                    ->withHeader('Content-Type', 'application/json')
                                    ->write('[{"message" : "Registro inserido com sucesso!"}]');
            
            }elseif(is_array($resposta) && isset($resposta['Erro'])){

                $dadosJson = toJSON($resposta);
                return $response  ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($dadosJson);

            }
        }
    });

    $app->put('/controle/{id}', function($request, $response, $args){

        if(is_numeric($args['id'])){

            $id = $args['id'];

            /*Recupera o formato de dados do header da requisição.*/
            $contentTypeHeader = $request->getHeaderLine('Content-Type');

            /*Separa a variável em um array, contendo somente o formData */
            $contentType = explode(";", $contentTypeHeader);

            if($contentType[0] == 'application/json'){

                $bodyData = $request->getParsedBody();

                $dados = array(
                    "id"                => $id,
                    "data_entrada"      => $bodyData['data_entrada'],
                    "data_saida"        => $bodyData['data_saida'],
                    "id_veiculo"        => $bodyData['id_veiculo'],
                    "id_vaga"           => $bodyData['id_vaga']
                );

                $resposta = atualizarControles($dados);

                if(is_bool($resposta) && $resposta){

                    return $response    ->withStatus(201)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write('[{"message" : "Registro atualizado com sucesso!"}]');
                
                }elseif(is_array($resposta) && isset($resposta['Erro'])){

                    $dadosJson = toJSON($resposta);
                    return $response ->withStatus(404)
                                    ->withHeader('Content-Type', 'application/json')
                                    ->write($dadosJson);

                }
            }
        }
    });

    

    $app->run();

?>