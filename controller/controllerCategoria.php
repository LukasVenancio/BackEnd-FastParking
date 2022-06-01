<?php
   require_once("./model/bd/modelCategoria.php"); 

   function listarCategorias()
   {
       $dados = selectAllCategoria();

       if(!empty($dados)){
           return $dados;
       
       }else{
           return false;
       }
   }


    function buscarCategoria($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            $dados = selectByidCategoria($id);

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

?>