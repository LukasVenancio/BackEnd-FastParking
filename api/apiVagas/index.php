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

            require_once('../controller/controllerTipo.php');
            require_once('../controller/controllerLocalizacao.php');
            require_once('../controller/controllerPiso.php');
            require_once('../controller/controllerCorredor.php');

            $cont = 0;

            while($cont < count($dados)){


                $tipo = buscarTipos($dados[$cont]['id_tipo'])['tipo'];
                $localizaçao = buscarLocalizacoes($dados[$cont]['id_localizacao']);
                $piso = buscarPisos($localizaçao['id_piso'])['piso'];
                $corredor = buscarCorredores($localizaçao['id_corredor'])['corredor'];
                
                $dadosConvertidos[$cont] = array(

                    $dados[$cont],
                    "tipo"       => $tipo,
                    "sigla"      => $localizaçao['sigla'],
                    "piso"      =>$piso,
                    "corredor"  =>$corredor
                ); 

                $cont++;

            }

            // var_dump($dadosConvertidos);
            // die;
            
            $dadosJson = toJSON($dadosConvertidos);

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

    $app->get('/vagas/ocupacao/{valorOcupacao}', function($request, $response, $args){

        $valorOcupacao = $args['valorOcupacao'];

        $dados = buscarVagasPorOcupacao($valorOcupacao);

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