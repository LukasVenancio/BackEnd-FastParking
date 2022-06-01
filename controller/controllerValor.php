<?php

    require_once('../model/bd/modelValor.php');

    function listarValores(){

        $dados = selectAllValores();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function inserirValores($dados){

        if(!empty($dados['hora_inicial']) && is_numeric($dados['hora_inicial']) && !empty($dados['demais_horas']) && is_numeric($dados['demais_horas'])){

            if(insertValor($dados)){

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

    function excluirValores($id){

        if(!empty($id) && is_numeric($id)){

            if(deleteValor($id)){
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

    function buscarValores($id){

        if(!empty($id) && is_numeric($id)){

            $dados = selectValorById($id);

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

    function atualizarValores($dados){

        if(!empty($dados['id']) && is_numeric($dados['id'])){

            if(!empty($dados['hora_inicial']) && is_numeric($dados['hora_inicial']) && !empty($dados['demais_horas']) && is_numeric($dados['demais_horas'])){

                if(updateValor($dados)){

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