<?php

    require_once('../model/bd/modelTipo.php');

    function listarTipos(){

        $dados = selectAllTipos();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function inserirTipos($dados){

        if(!empty($dados['tipo']) && !empty($dados['id_valor']) && is_numeric($dados['id_valor'])){

            if(insertTipo($dados)){

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

    function excluirTipos($id){

        if(!empty($id) && is_numeric($id)){

            if(deleteTipo($id)){
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

    function buscarTipos($id){

        if(!empty($id) && is_numeric($id)){

            $dados = selectTipoById($id);

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

    function atualizarTipos($dados){

        if(!empty($dados['id']) && is_numeric($dados['id'])){

            if(!empty($dados['tipo']) && !empty($dados['id_valor']) && is_numeric($dados['id_valor'])){

                if(updateTipo($dados)){

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