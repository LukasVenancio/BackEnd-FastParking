<?php

    require_once('conexaoMySQL.php');

   function insertVeiculo($dadosVeiculo)
   {
      // Abre a conexão com BD
      $conexao = conectarMysql();

      // Monta do script para enviar para o BD
      $sql = "insert into tbl_veiculo
         (placa, 
         id_cor,
         id_categoria,
         id_modelo)
      values(
      '".$dadosVeiculo["placa"]."', 
      '".$dadosVeiculo["id_cor"]."',
      '".$dadosVeiculo["id_categoria"]."',
      '".$dadosVeiculo["id_modelo"]."');";  
      
      //Executa o script no BD
      //Validação para verificar se o script esta certo
      if (mysqli_query($conexao, $sql))
      {
         // Validação para verificar se uma linha foi acrescentada no BD 
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

   function selectAllVeiculo()
    {
        $conexao = conectarMysql();

        $sql = "select * from tbl_veiculo order by id desc";

        $result = mysqli_query($conexao, $sql);

        if($result)
        {
            $cont =0;
            while($rsDados = mysqli_fetch_assoc($result))
            {
                $arrayDados[$cont] = array(
                    "id"            => $rsDados["id"],
                    "placa"         => $rsDados["placa"],
                    "id_cor"        => $rsDados["id_cor"],
                    "id_categoria"  => $rsDados["id_categoria"],
                    "id_modelo"     => $rsDados["id_modelo"]
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

    function selectByidVeiculo($id)
    {
        $conexao = conectarMysql();

        $sql = "select * from tbl_veiculo where id =".$id;

        $result = mysqli_query($conexao, $sql);

        if($result)
        {
            if($rsDados = mysqli_fetch_assoc($result))
            {
                $arrayDados= array(
                    "id"            => $rsDados["id"],
                    "placa"         => $rsDados["placa"],
                    "id_cor"        => $rsDados["id_cor"],
                    "id_categoria"  => $rsDados["id_categoria"],
                    "id_modelo"     => $rsDados["id_modelo"]
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

    function selectByplacaVeiculo($placa)
    {
        $conexao = conectarMysql();

        $sql = "select * from tbl_veiculo where placa ='". $placa. "';"; 

        $result = mysqli_query($conexao, $sql);

        if($result)
        {
            if($rsDados = mysqli_fetch_assoc($result))
            {
                $arrayDados= array(
                    "id"            => $rsDados["id"],
                    "placa"         => $rsDados["placa"],
                    "id_cor"        => $rsDados["id_cor"],
                    "id_categoria"  => $rsDados["id_categoria"],
                    "id_modelo"     => $rsDados["id_modelo"]
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

    function deleteVeiculo($id)
    {
        // abre a conexão como BD
        $conexao = conectarMysql();

        
        $sql = "delete from tbl_veiculo where id =".$id;

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

    function updateVeiculo($dadosVeiculo)
    {
         // Abre a conexão com BD
         $conexao = conectarMysql();

         // Monta do script para enviar para o BD
         $sql = "update tbl_veiculo set
             placa            = '".$dadosVeiculo["placa"]       ."',  
             id_cor           = '".$dadosVeiculo["id_cor"]      ."',
             id_categoria     = '".$dadosVeiculo["id_categoria"]."',
             id_modelo        = '".$dadosVeiculo["id_modelo"]   ."'
             where id         =  ".$dadosVeiculo["id"]          .";"
         ;  
         
         //Executa o script no BD
         //Validação para verificar se o script esta certo

         if (mysqli_query($conexao, $sql))
         {
             // Validação para verificar se uma linha foi acrescentada no BD 
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