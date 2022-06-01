<?php

    require_once('conexaoMySQL.php');

    function selectAllPisos (){

        $conexao = conectarMysql();
        $sql = "select * from tbl_piso;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"                => $dadosArray['id'],
                    "piso"          => $dadosArray['piso']
                );

                $contator++;

            }

            fecharConexaoMysql($conexao);

            return $resultado;

        }
    }

    function selectPisoById ($id){

        $conexao = conectarMysql();
        $sql = "select * from tbl_piso where id = " . $id . ";";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"            => $dadosArray['id'],
                    "piso"          => $dadosArray['piso']
                );
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;

    }

    function deletePiso ($id){

        $conexao = conectarMysql();
        $sql = "delete from tbl_piso where id = " . $id . ";";

        $resultado = (boolean) false;

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;
    }

    function insertPiso ($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "insert into tbl_piso (piso)
                        
                        values (". $dados['piso'].");";

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;

            }

        }

        fecharConexaoMysql($conexao);
        
        return $resultado;

    }

    function updatePiso($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "update tbl_piso set
                        piso = ". $dados['piso'].
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