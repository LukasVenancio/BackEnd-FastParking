<?php

    require_once('vendor/autoload.php');

    require_once('../modolo/config.php');
    require_once('../controller/controllerValor.php');

    $app = new \Slim\App();

    $app->get('/valor', function($request, $response, $args){

        $dados = listarValores();

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

    $app->get('/valor/{id}', function($request, $response, $args){

        $id = $args['id'];

        $dados = buscarValores($id);

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

    $app->delete('/valor/{id}', function($request, $response, $args){

        $id = $args['id'];

        $dados = excluirValores($id);

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

    $app->post('/valor', function($request, $response, $args){

        /*Recupera o formato de dados do header da requisição.*/
        $contentTypeHeader = $request->getHeaderLine('Content-Type');

        /*Separa a variável em um array, contendo somente o formData */
        $contentType = explode(";", $contentTypeHeader);

        if($contentType[0] == 'application/json'){

            $bodyData = $request->getParsedBody();

            $resposta = inserirValores($bodyData);

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

    $app->put('/valor/{id}', function($request, $response, $args){

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
                    "hora_inicial"      => $bodyData['hora_inicial'],
                    "demais_horas"      => $bodyData['demais_horas']
                );

                $resposta = atualizarValores($dados);

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