<?php

    require_once('../model/bd/modelPiso.php');

    function listarPisos(){

        $dados = selectAllPisos();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function inserirPisos($dados){

        if(!empty($dados['piso']) && is_numeric($dados['piso'])){

            if(insertPiso($dados)){

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

    function excluirPisos($id){

        if(!empty($id) && is_numeric($id)){

            if(deletePiso($id)){
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

    function buscarPisos($id){

        if(!empty($id) && is_numeric($id)){

            $dados = selectPisoById($id);

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

    function atualizarPisos($dados){

        if(!empty($dados['id']) && is_numeric($dados['id'])){

            if(!empty($dados['piso']) && is_numeric($dados['piso'])){

                if(updatePiso($dados)){

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