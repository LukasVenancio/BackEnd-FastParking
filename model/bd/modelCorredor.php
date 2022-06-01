<?php

    require_once('conexaoMySQL.php');

    function selectAllCorredores (){

        $conexao = conectarMysql();
        $sql = "select * from tbl_corredor;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"                => $dadosArray['id'],
                    "corredor"          => $dadosArray['corredor']
                );

                $contator++;

            }

            fecharConexaoMysql($conexao);

            return $resultado;

        }
    }

    function selectCorredorById ($id){

        $conexao = conectarMysql();
        $sql = "select * from tbl_corredor where id = " . $id . ";";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"            => $dadosArray['id'],
                    "corredor"      => $dadosArray['corredor']
                );
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;

    }

    function deleteCorredor ($id){

        $conexao = conectarMysql();
        $sql = "delete from tbl_corredor where id = " . $id . ";";

        $resultado = (boolean) false;

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;
    }

    function insertCorredor ($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "insert into tbl_corredor (corredor)
                        
                        values (". $dados['corredor'].");";

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;

            }

        }

        fecharConexaoMysql($conexao);
        
        return $resultado;

    }

    function updateCorredor($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "update tbl_corredor set
                        corredor = ". $dados['corredor'].
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