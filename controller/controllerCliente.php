<?php

   require_once(SRC."./model/bd/modelCliente.php");

   function listarClientes()
   {
       $dados = selectAllCliente();

       if(!empty($dados)){
           return $dados;
       
       }else{
           return false;
       }
   }

   function inserirCliente($dados)
    {
        if(!empty($dados['nome']))
        {
            if(insertCliente($dados))
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

    function excluirCliente($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            if(deleteCliente($id))
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

    function buscarCliente($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            $dados = selectByidCliente($id);

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

    function atualizarCliente($dados)
    {
        if(!empty($dados['id']) && is_numeric($dados['id']))
        {
            if(!empty($dados['nome']))
            {
                if(updateCliente($dados))
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