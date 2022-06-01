<?php

    require_once('conexaoMySQL.php');

    function selectAllTipos (){

        $conexao = conectarMysql();
        $sql = "select * from tbl_tipo;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"            => $dadosArray['id'],
                    "tipo"          => $dadosArray['tipo'],
                    "id_valor"      => $dadosArray['id_valor']
                );

                $contator++;

            }

            fecharConexaoMysql($conexao);

            return $resultado;

        }

    }

    function selectTipoById ($id){

        $conexao = conectarMysql();
        $sql = "select * from tbl_tipo where id = " . $id . ";";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"            => $dadosArray['id'],
                    "tipo"          => $dadosArray['tipo'],
                    "id_valor"      => $dadosArray['id_valor']
                );
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;

    }

    function deleteTipo($id){

        $conexao = conectarMysql();
        $sql = "delete from tbl_tipo where id = " . $id . ";";

        $resultado = (boolean) false;

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;
    }

    function insertTipo($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "insert into tbl_tipo (tipo, id_valor)
                        
                        values (". $dados['tipo'].",
                                ". $dados['id_valor'].");";

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;

            }

        }

        fecharConexaoMysql($conexao);
        
        return $resultado;

    }

    function updateTipo($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "update tbl_tipo set
                        tipo = ".        $dados['tipo'].",
                        id_valor = ".    $dados['id_valor'].
                " where id = ". $dados['id'].";";

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){
        
                $resultado = true;
        
            }
        
        }
        
        fecharConexaoMysql($conexao);
                
        return $resultado;

    }

?>