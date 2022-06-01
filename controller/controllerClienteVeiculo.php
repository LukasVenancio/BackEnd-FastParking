<?php

   require_once("./model/bd/modelClienteVeiculo.php");

   function listarClienteVeiculo()
   {
       $dados = selectAllClienteVeiculo();

       if(!empty($dados)){
           return $dados;
       
       }else{
           return false;
       }
   }

   function inserirClienteVeiculo($dados)
    {
        if(!empty($dados['idcliente']) && is_numeric($dados['idcliente']) && !empty($dados['idveiculo']) && is_numeric($dados['idveiculo']))
        {
            if(insertClienteVeiculo($dados))
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

    function excluirClienteVeiculo($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            if(deleteClienteVeiculo($id))
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

    function buscarClienteVeiculo($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            $dados = selectByidClienteVeiculo($id);

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

    function atualizarClienteVeiculo($dados)
    {
        if(!empty($dados['idcliente']) && is_numeric($dados['idcliente']) && !empty($dados['idveiculo']) && is_numeric($dados['idveiculo']))
        {
            if(!empty($dados['modelo']))
            {
                if(updateClienteVeiculo($dados))
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