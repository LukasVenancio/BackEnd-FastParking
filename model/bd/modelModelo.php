<?php

    require_once('conexaoMySQL.php');

   function insertModelo($dadosModelo)
   {
      $conexao = conectarMysql();

      $sql = "insert into tbl_modelo
            (modelo
            )
      value(
      '".$dadosModelo["modelo"]."');";

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

   function selectAllModelo()
   {
       $conexao = conectarMysql();

       $sql = "select * from tbl_modelo order by id desc";

       $result = mysqli_query($conexao, $sql);

       if($result)
       {
           $cont =0;
           while($rsDados = mysqli_fetch_assoc($result))
           {
               $arrayDados[$cont] = array(
                   "id"        => $rsDados["id"],
                   "modelo"    => $rsDados["modelo"]
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

   function selectByidModelo($id)
   {
       $conexao = conectarMysql();

       $sql = "select * from tbl_modelo where id =". $id;

       $result = mysqli_query($conexao, $sql);

       if($result)
       {
           if($rsDados = mysqli_fetch_assoc($result))
           {
               $arrayDados= array(
                   "id"        => $rsDados["id"],
                   "modelo"    => $rsDados["modelo"]
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

   function deleteModelo($id)
   {
       // abre a conexão como BD
       $conexao = conectarMysql();

       
       $sql = "delete from tbl_modelo where id =".$id;

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

   function updateModelo($dadosModelo)
   {
        // Abre a conexão com BD
        $conexao = conectarMysql();

        // Monta do script para enviar para o BD
        $sql = "update tbl_modelo set
            modelo        = '".$dadosModelo["modelo"] ."' 
            where idContato =  ".$dadosModelo["id"]   .";"
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