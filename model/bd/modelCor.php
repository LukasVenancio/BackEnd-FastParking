<?php

   require_once('conexaoMySQL.php');

   function selectAllCor()
   {
      $conexao = conectarMysql();

      $sql = "select * from tbl_cor order by id asc";
      
      $result = mysqli_query($conexao, $sql);
      
      if($result)
      {
         $cont =0;
         while($rsDados = mysqli_fetch_assoc($result))
         {
               $arrayDados[$cont] = array(
                  "id"        => $rsDados["id"],
                  "cor"       => $rsDados["cor"]
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

   function selectByidCor($id)
   {
      $conexao = conectarMysql();

      $sql = "select * from tbl_cor where id =". $id;

      $result = mysqli_query($conexao, $sql);

      if($result)
      {
         if($rsDados = mysqli_fetch_assoc($result))
         {
               $arrayDados= array(
                  "id"        => $rsDados["id"],
                  "cor"       => $rsDados["cor"]
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