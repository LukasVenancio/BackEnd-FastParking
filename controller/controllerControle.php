<?php

    require_once('../model/bd/modelControle.php');

    function listarControles(){

        $dados = selectAllControles();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function listarRendimentosAnuais(){

        $dados = annualReturns();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function listarRendimentosMensais(){

        $dados = monthlyReturns();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function listarRendimentosDiarios(){

        $dados = dailyReturns();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function listarControlesSemDataSaida(){

        $dados = selectControleByDataSaidaNull();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function inserirControles($dados){

        if(!empty($dados['data_entrada']) && !empty($dados['id_veiculo']) && is_numeric($dados['id_veiculo']) &&
            !empty($dados['id_vaga']) && is_numeric($dados['id_vaga'])){

            if(insertControle($dados)){

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

    function excluirControles($id){

        if(!empty($id) && is_numeric($id)){

            if(deleteControle($id)){
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

    function buscarControles($id){

        if(!empty($id) && is_numeric($id)){

            $dados = selectControleById($id);

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

    function buscarControlesPorIdVeiculo($id){

        if(!empty($id) && is_numeric($id)){

            $dados = selectControleByIdVeiculo($id);

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

    function buscarControlesPorPlacaVeiculo($placa){

        if(!empty($placa)){

            $dados = selectControleByPlacaVeiculo($placa);

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

    function buscarControlesPorIdVaga($id){

        if(!empty($id) && is_numeric($id)){

            $dados = selectControleByIdVaga($id);

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

    function atualizarControles($dados){

        if(!empty($dados['id']) && is_numeric($dados['id'])){

            if(!empty($dados['data_entrada']) && !empty($dados['id_veiculo']) && is_numeric($dados['id_veiculo']) &&
                !empty($dados['id_vaga']) && is_numeric($dados['id_vaga'])){

                if(updateControle($dados)){

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