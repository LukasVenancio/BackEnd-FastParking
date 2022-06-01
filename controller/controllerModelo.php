<?php

   require_once("./model/bd/modelModelo.php");

   function listarModelos()
   {
       $dados = selectAllModelo();

       if(!empty($dados)){
           return $dados;
       
       }else{
           return false;
       }
   }

   function inserirModelo($dados)
    {
        if(!empty($dados['modelo']))
        {
            if(insertModelo($dados))
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

    function excluirModelo($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            if(deleteModelo($id))
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

    function buscarModelo($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            $dados = selectByidModelo($id);

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

    function atualizarModelo($dados)
    {
        if(!empty($dados['id']) && is_numeric($dados['id']))
        {
            if(!empty($dados['modelo']))
            {
                if(updateModelo($dados))
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