<?php

    require_once('conexaoMySQL.php');

    function selectAllValores (){

        $conexao = conectarMysql();
        $sql = "select * from tbl_valor;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"                => $dadosArray['id'],
                    "hora_inicial"      => $dadosArray['hora_inicial'],
                    "demais_horas"      => $dadosArray['demais_horas']
                );

                $contator++;

            }

            fecharConexaoMysql($conexao);

            return $resultado;

        }

    }

    function selectValorById ($id){

        $conexao = conectarMysql();
        $sql = "select * from tbl_valor where id = " . $id . ";";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"                => $dadosArray['id'],
                    "hora_inicial"      => $dadosArray['hora_inicial'],
                    "demais_horas"      => $dadosArray['demais_horas']
                );
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;

    }

    function deleteValor($id){

        $conexao = conectarMysql();
        $sql = "delete from tbl_valor where id = " . $id . ";";

        $resultado = (boolean) false;

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;
    }

    function insertValor($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "insert into tbl_valor (hora_inicial, demais_horas)
                        
                        values (". $dados['hora_inicial'].",
                                ". $dados['demais_horas'].");";

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;

            }

        }

        fecharConexaoMysql($conexao);
        
        return $resultado;

    }

    function updateValor($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "update tbl_valor set
                        hora_inicial = ".       $dados['hora_inicial'].",
                        demais_horas = ".       $dados['demais_horas'].
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