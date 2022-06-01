<?php

    require_once('../model/bd/modelLocalizacao.php');

    function listarLocalizacoes(){

        $dados = selectAllLocalizacoes();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function inserirLocalizacoes($dados){

        if(!empty($dados['sigla']) && !empty($dados['id_piso']) && is_numeric($dados['id_piso']) && !empty($dados['id_corredor']) && is_numeric($dados['id_corredor'])){

            if(insertLocalizacao($dados)){

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

    function excluirLocalizacoes($id){

        if(!empty($id) && is_numeric($id)){

            if(deleteLocalizacao($id)){
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

    function buscarLocalizacoes($id){

        if(!empty($id) && is_numeric($id)){

            $dados = selectLocalizacaoById($id);

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

    function atualizarLocalizacoes($dados){

        if(!empty($dados['id']) && is_numeric($dados['id'])){

            if(!empty($dados['sigla']) && !empty($dados['id_piso']) && is_numeric($dados['id_piso']) && !empty($dados['id_corredor']) && is_numeric($dados['id_corredor'])){

                if(updateLocalizacao($dados)){

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