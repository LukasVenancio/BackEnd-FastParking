<?php

   require_once('conexaoMySQL.php');

   function insertClienteVeiculo($dados)
   {
      // Abre a conexão com BD
      $conexao = conectarMysql();

      // Monta do script para enviar para o BD
      $sql = "insert into tbl_cliente_veiculo
         (id_cliente,
         id_veiculo)
      values(
      '".$dados["id_cliente"]."',
      '".$dados["id_veidulo"]."');";  
      
      if (mysqli_query($conexao, $sql))
      {
            if(mysqli_affected_rows($conexao)){
               $statusResultado = true;
         }else{
               $statusResultado = false;
         }
         
      }else{
         $statusResultado = false;
      }

      fecharConexaoMysql($conexao);
      return $statusResultado;

   }

      function selectAllClienteVeiculo()
    {
        $conexao = conectarMysql();

        $sql = "select * from tbl_cliente_veiculo order by id desc";

        $result = mysqli_query($conexao, $sql);

        if($result)
        {
            $cont =0;
            while($rsDados = mysqli_fetch_assoc($result))
            {
                $arrayDados[$cont] = array(
                    "id"            => $rsDados["id"],
                    "id_cliente"    => $rsDados["id_cliente"],
                    "id_veiculo"    => $rsDados["id_veiculo"]
                );
                $cont++;
            }   
            
            fecharConexaoMysql($conexao);

            if(empty($arrayDados)){
                return false;
            }else
            {
                return $arrayDados;
            }

            
        }

    }

    function selectByidClienteVeiculo($id)
    {
        $conexao = conectarMysql();

        $sql = "select * from tbl_cliente_veiculo where id =".$id;

        $result = mysqli_query($conexao, $sql);

        if($result)
        {
            if($rsDados = mysqli_fetch_assoc($result))
            {
                $arrayDados= array(
                    "id"            => $rsDados["id"],
                    "id_cliente"    => $rsDados["id_cliente"],
                    "id_veiculo"    => $rsDados["id_veiculo"]
                );
            }   
            
            fecharConexaoMysql($conexao);

            if(empty($arrayDados)){
                return false;
            }else
            {
                return $arrayDados;
            }

            
        }

    }

    function deleteClienteVeiculo($id)
    {
        // abre a conexão como BD
        $conexao = conectarMysql();

        
        $sql = "delete from tbl_cliente_veiculo where id =".$id;

       if(mysqli_query($conexao, $sql)){
            if(mysqli_affected_rows($conexao)){
                $statusResultado = true;
            }else{
                $statusResultado = false;
            }

        }else{
            $statusResultado = false;
        }

        fecharConexaoMysql($conexao);
        return $statusResultado;
    }

    function updateClienteVeiculo($dados)
    {
         $conexao = conectarMysql();

         $sql = "update tbl_cliente_veiculo set
             id_cliente    = '".$dados["id_cliente"]."',
             id_veiculo    = '".$dados["id_veiculo"]."'
             where id      = ".$dados["id"].";"
         ;  

         if (mysqli_query($conexao, $sql))
         {
             if(mysqli_affected_rows($conexao)){
                 $statusResultado = true;
             }else{
                 $statusResultado = false;
             }
            
         }else{
             $statusResultado = false;
         }
 
         fecharConexaoMysql($conexao);
         return $statusResultado;
    }


?>