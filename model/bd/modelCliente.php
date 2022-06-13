<?php

    require_once('conexaoMySQL.php');

   function insertCliente($dadosCliente)
   {
      $conexao = conectarMysql();

      $sql = "insert into tbl_cliente
            (nome, 
            telefone)
        values(
        '".$dadosCliente["nome"]."',
        '".$dadosCliente["telefone"]."');";

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

   function selectAllCliente()
    {
        $conexao = conectarMysql();

        $sql = "select * from tbl_cliente order by id desc";

        $result = mysqli_query($conexao, $sql);

        if($result)
        {
            $cont =0;
            while($rsDados = mysqli_fetch_assoc($result))
            {
                $arrayDados[$cont] = array(
                    "id"        => $rsDados["id"],
                    "nome"      => $rsDados["nome"],
                    "telefone"  => $rsDados["telefone"]
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

    function selectByidCliente($id)
    {
        $conexao = conectarMysql();

        $sql = "select * from tbl_cliente where id =".$id;

        $result = mysqli_query($conexao, $sql);

        if($result)
        {
            if($rsDados = mysqli_fetch_assoc($result))
            {
                $arrayDados= array(
                    "id"        => $rsDados["id"],
                    "nome"      => $rsDados["nome"],
                    "telefone"  => $rsDados["telefone"]
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

    function deleteCliente($id)
    {
        // abre a conexão como BD
        $conexao = conectarMysql();

        
        $sql = "delete from tbl_cliente where id =".$id;

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

    function updateCliente($dadosCliente)
    {
         // Abre a conexão com BD
         $conexao = conectarMysql();

         // Monta do script para enviar para o BD
         $sql = "update tbl_cliente set
             nome            = '".$dadosCliente["nome"]     ."', 
             telefone        = '".$dadosCliente["telefone"] ."' 
             where id        =  ".$dadosCliente["id"]       .";"
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