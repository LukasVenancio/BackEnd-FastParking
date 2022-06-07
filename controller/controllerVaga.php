<?php

    require_once(SRC . '/model/bd/modelVagas.php');

    function listarVagas(){

        $dados = selectAllVagas();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function inserirVagas($dados){

        // var_dump(!empty($dados['ocupacao']));
        // die;

        if(is_numeric($dados['ocupacao']) && is_numeric($dados['preferencial']) &&
            !empty($dados['id_tipo']) && is_numeric($dados['id_tipo']) && !empty($dados['id_estacionamento']) && is_numeric($dados['id_estacionamento']) &&
            !empty($dados['piso']) && is_numeric($dados['piso']) && !empty($dados['corredor']) && is_numeric($dados['corredor']) &&
            !empty($dados['sigla'])){

            if(insertVaga($dados)){

                return true;
            
            }else{

                return array(
                            'Erro' => 'Não foi possível inserir os dados no Data Base.');
            }
        
        }else{

            return array(
                        'Erro' => 'Dados inválidos.');
        }
    }

    function excluirVagas($id){

        if(!empty($id) && is_numeric($id)){

            if(deleteVaga($id)){
                return true;
            
            }else{

                return array(
                            'Erro' => 'Não foi possível excluir os dados no Data Base.');
            }
        
        }else{

            return array(
                        'Erro' => 'ID inválido.');
        }
    
    }

    function buscarVagas($id){

        if(!empty($id) && is_numeric($id)){

            $dados = selectVagaById($id);

            if(!empty($dados)){
                return $dados;
            
            }else{
                return array(
                    'Erro' => 'ID não encontrado na base de dados.');
            }
        
        }else{

            return array(
                        'Erro' => 'ID inválido.');
        }
    }

    function buscarVagasPorOcupacao($ocupacao){

        if(is_numeric($ocupacao)){

            $dados = selectVagaByOcupacao($ocupacao);

            if(!empty($dados)){
                return $dados;
            
            }else{
                return array(
                            'Erro' => 'Vagas não encontradas.');
            }
        
        }else{

            return array(
                        'Erro' => 'Valor inválido.');
        }
    }

    function buscarVagasPorPreferencial($preferencial){

        if(is_numeric($preferencial)){

            $dados = selectVagaByPreferencial($preferencial);

            if(!empty($dados)){
                return $dados;
            
            }else{
                return array(
                            'Erro' => 'Vagas não encontradas.');
            }
        
        }else{

            return array(
                        'Erro' => 'Valor inválido.');
        }
    }

    function atualizarVagas($dados){

        if(!empty($dados['id']) && is_numeric($dados['id'])){

            if(is_numeric($dados['ocupacao']) && is_numeric($dados['preferencial']) &&
                    !empty($dados['id_tipo']) && is_numeric($dados['id_tipo']) && !empty($dados['id_estacionamento']) && is_numeric($dados['id_estacionamento']) &&
                    !empty($dados['piso']) && is_numeric($dados['piso']) && !empty($dados['corredor']) && is_numeric($dados['corredor']) &&
                    !empty($dados['sigla'])){

                if(updateVaga($dados)){

                    return true;
                
                }else{

                    return array(
                                'Erro' => 'Não foi possível atualizar os dados no Data Base.');
                }

            }else{

                return array(
                            'Erro' => 'Dados inválidos.');
            }
        
        }else{

            return array(
                        'Erro' => 'ID inválido.');
        }
    }
?>