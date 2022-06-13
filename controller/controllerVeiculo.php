<?php
    require_once(SRC."./model/bd/modelVeiculo.php");

    function listarVeiculos()
    {
        $dados = selectAllVeiculo();

        if(!empty($dados)){
            return $dados;
        
        }else{
            return false;
        }
    }

    function inserirVeiculos($dados)
    {
        if(!empty($dados['placa']) && !empty($dados['id_cor']) && is_numeric($dados['id_cor']) && !empty($dados['id_categoria']) && is_numeric($dados['id_categoria']) && !empty($dados['id_modelo']) && is_numeric($dados['id_modelo']))
        {
            if(insertVeiculo($dados))
            {
                return true;
            }else
            {
                return array(
                    'Erro' => 'Não foi possivel inserir os dados no Banco de Dados'
                );
            }
        }else
        {
            return array(
                'Erro' => 'Existem campos obrigatorios que não foram preenchidos!!!'
            );
        }
    }

    function excluirVeiculo($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            if(deleteVeiculo($id))
            {
                return true;
            }else
            {
                return array(
                    'Erro' => 'Não foi possível excluir o registro do Banco de Dados'
                );
            }
        }else
        {
            return array(
                'Erro' => 'Não é possivel excluir um registro sem informar um id valido'
            );
        }
    }

    function buscarVeiculo($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            $dados = selectByidVeiculo($id);

            if(!empty($dados))
            {
                return $dados;
            }else
            {
                return array(
                    'Erro' => 'Registro não encontrado no Banco de Dados'
                );
            }

        }else
        {
            return array(
                'Erro' => 'Não é possivel buscar um registro sem informar um id valido'
            );
        }
    }

    function buscarVeiculoPlaca($placa)
    {
        if(!empty($placa))
        {
            require_once(SRC."./model/bd/modelVeiculo.php");

            $dados = selectByplacaVeiculo($placa);

            if(!empty($dados))
            {
                return $dados;
            }else
            {
                return array(
                    'Erro' => 'Registro não encontrado no Banco de Dados'
                );
            }
        }else
        {
            return array(
                'Erro' => 'Não é possivel buscar um registro sem informar uma placa valido'
            );
        }
    }

    function atualizarVeiculo($dados)
    {

        if(!empty($dados['id']) && is_numeric($dados['id']))
        {
            if(!empty($dados['placa']) && !empty($dados['id_cor']) && is_numeric($dados['id_cor']) && !empty($dados['id_categoria']) && is_numeric($dados['id_categoria']) && !empty($dados['id_modelo']) && is_numeric($dados['id_modelo']))
            {
                if(updateVeiculo($dados))
                {
                    return true;
                }else
                {
                    return array(
                        'Erro' => 'Não foi possível atualizar os dados no Banco de Dados'
                    );
                }
            }else
            {
                return array(
                    'Erro' => 'Existem campos obrigatorios que não foram preenchidos!!!'
                );
            }
        }else
        {
            return array(
                'Erro' => 'Não é possivel atualizar um registro sem informar um id valido'
            );
        }
    }

?>