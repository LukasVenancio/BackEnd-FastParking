<?php

    require_once('../model/bd/modelCorredor.php');

    function listarCorredores(){

        $dados = selectAllCorredores();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function inserirCorredores($dados){

        if(!empty($dados['corredor']) && is_numeric($dados['corredor'])){

            if(insertCorredor($dados)){

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

    function excluirCorredores($id){

        if(!empty($id) && is_numeric($id)){

            if(deleteCorredor($id)){
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

    function buscarCorredores($id){

        if(!empty($id) && is_numeric($id)){

            $dados = selectCorredorById($id);

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

    function atualizarCorredores($dados){

        if(!empty($dados['id']) && is_numeric($dados['id'])){

            if(!empty($dados['corredor']) && is_numeric($dados['corredor'])){

                if(updateCorredor($dados)){

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