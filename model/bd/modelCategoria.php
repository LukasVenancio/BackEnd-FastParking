<?php

   require_once('conexaoMySQL.php');

   function selectAllCategoria()
   {
      $conexao = conectarMysql();

      $sql = "select * from tbl_categoria order by id desc";

      $result = mysqli_query($conexao, $sql);

      if($result)
      {
         $cont =0;
         while($rsDados = mysqli_fetch_assoc($result))
         {
               $arrayDados[$cont] = array(
                  "id"           => $rsDados["id"],
                  "categoria"    => $rsDados["categoria"]
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

   function selectByidCategoria($id)
   {
      $conexao = conectarMysql();

      $sql = "select * from tbl_categoria where id =". $id;

      $result = mysqli_query($conexao, $sql);

      if($result)
      {
         if($rsDados = mysqli_fetch_assoc($result))
         {
               $arrayDados= array(
                  "id"           => $rsDados["id"],
                  "categoria"    => $rsDados["categoria"]
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
?>