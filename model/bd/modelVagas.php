<?php

    require_once('conexaoMySQL.php');

    function selectAllVagas (){

        $conexao = conectarMysql();
        $sql = "select * from tbl_vaga;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"                => $dadosArray['id'],
                    "ocupacao"          => $dadosArray['preferencial'],
                    "id_tipo"           => $dadosArray['id_tipo'],
                    "id_localizacao"    => $dadosArray['id_localizacao'],
                    "id_estacionamento" => $dadosArray['id_estacionamento']
                );

                $contator++;

            }

            fecharConexaoMysql($conexao);

            return $resultado;

        }

    }

    function selectVagaById ($id){

        $conexao = conectarMysql();
        $sql = "select * from tbl_vaga where id = " . $id . ";";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"                => $dadosArray['id'],
                    "ocupacao"          => $dadosArray['preferencial'],
                    "id_tipo"           => $dadosArray['id_tipo'],
                    "id_localizacao"    => $dadosArray['id_localizacao'],
                    "id_estacionamento" => $dadosArray['id_estacionamento']
                );
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;

    }

    function deleteVaga($id){

        $conexao = conectarMysql();
        $sql = "delete from tbl_vaga where id = " . $id . ";";

        $resultado = (boolean) false;

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;
    }

    function insertVaga($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "insert into tbl_vaga (ocupacao, preferencal, id_tipo, id_localizacao, id_estacionamento)
                        
                        values (". $dados['ocupacao'].",
                                ". $dados['preferencial'].",
                                ". $dados['id_tipo'].",
                                ". $dados['id_localizacao'].",
                                ". $dados['id_estacionamento'].");";

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;

            }

        }

        fecharConexaoMysql($conexao);
        
        return $resultado;

    }

    function updateVaga($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "update tbl_vaga set
                        ocupacao = ".           $dados['ocupacao'].",
                        preferencial = ".       $dados['preferencial'].",
                        id_tipo = ".            $dados['id_tipo'].",
                        id_localizacao = ".     $dados['id_localizacao'].",
                        id_estacionamento = ".  $dados['id_estacionamento'].
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