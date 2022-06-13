<?php
   require_once(SRC."./model/bd/modelCor.php"); 

   function listarCor()
   {
        $dados = selectAllCor();

       if(!empty($dados)){
           return $dados;
       
       }else{
           return false;
       }
    }


    function buscarCor($id)
    {
        if(!empty($id) && is_numeric($id))
        {
            $dados = selectByidCor($id);

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