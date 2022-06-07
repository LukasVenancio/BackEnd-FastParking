<?php

    require_once('vendor/autoload.php');

    require_once('../modolo/config.php');
    require_once('../controller/controllerVaga.php');

    /*Criando uma instância do Slim para configurar os EndPoints */
    $app = new \Slim\App();

    /*EndPoint para buscar todas as vagas.*/
    $app->get('/vagas', function($request, $response, $args){

        $dados = listarVagas();

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

    /*EndPoint para buscar vagas pelo ID. */
    $app->get('/vagas/{id}', function($request, $response, $args){

        $id = $args['id'];

        $dados = buscarVagas($id);

        if($dados){

            $dadosJson = toJSON($dados);

            if($dadosJson){

                if(!isset($dados['Erro'])){

                    return $response ->withHeader('Content-Type', 'application/json')
                                    ->write($dadosJson)
                                    ->withStatus(200);
                
                }else{
                    
                    return $response    ->withStatus(404)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write($dadosJson);
                }
            }
        
        }else{

            return $response     ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('[{"message" : "Item não encontrado"}]');
        }


    });

    $app->get('/vagas/ocupacao/{valorOcupacao}', function($request, $response, $args){

        $valorOcupacao = $args['valorOcupacao'];

        $dados = buscarVagasPorOcupacao($valorOcupacao);

        if($dados){

            $dadosJson = toJSON($dados);

            if($dadosJson){

                if(!isset($dados['Erro'])){

                    return $response ->withHeader('Content-Type', 'application/json')
                                    ->write($dadosJson)
                                    ->withStatus(200);
                
                }else{
                    
                    return $response    ->withStatus(404)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write($dadosJson);
                }
            }
        
        }else{

            return $response     ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('[{"message" : "Item não encontrado"}]');
        }


    });

    $app->get('/vagas/preferencial/{valorPreferencial}', function($request, $response, $args){

        $valorPreferencial = $args['valorPreferencial'];

        $dados = buscarVagasPorPreferencial($valorPreferencial);

        if($dados){

            $dadosJson = toJSON($dados);

            if($dadosJson){

                if(!isset($dados['Erro'])){

                    return $response ->withHeader('Content-Type', 'application/json')
                                    ->write($dadosJson)
                                    ->withStatus(200);
                
                }else{
                    
                    return $response    ->withStatus(404)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write($dadosJson);
                }
            }
        
        }else{

            return $response     ->withStatus(404)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('[{"message" : "Item não encontrado"}]');
        }


    });

    $app->delete('/vagas/{id}', function($request, $response, $args){

        $id = $args['id'];

        $dados = excluirVagas($id);

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

    $app->post('/vagas', function($request, $response, $args){

        /*Recupera o formato de dados do header da requisição.*/
        $contentTypeHeader = $request->getHeaderLine('Content-Type');

        /*Separa a variável em um array, contendo somente o formData */
        $contentType = explode(";", $contentTypeHeader);

        if($contentType[0] == 'application/json'){

            $bodyData = $request->getParsedBody();

            $resposta = inserirVagas($bodyData);

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

    $app->put('/vagas/{id}', function($request, $response, $args){

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
                    "ocupacao"          => $bodyData['ocupacao'],
                    "preferencial"      => $bodyData['preferencial'],
                    "id_tipo"           => $bodyData['id_tipo'],
                    "id_estacionamento" => $bodyData['id_estacionamento'],
                    "piso"              => $bodyData['piso'],
                    "corredor"          => $bodyData['corredor'],
                    "sigla"             => $bodyData['sigla']
                );

                $resposta = atualizarVagas($dados);

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