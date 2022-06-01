<?php

    require_once('conexaoMySQL.php');

    function selectAllLocalizacoes (){

        $conexao = conectarMysql();
        $sql = "select * from tbl_localizacao;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"            => $dadosArray['id'],
                    "id_piso"       => $dadosArray['id_piso'],
                    "id_corredor"   => $dadosArray['id_corredor'],
                    "sigla"         => $dadosArray['sigla']
                );

                $contator++;

            }

            fecharConexaoMysql($conexao);

            return $resultado;

        }

    }

    function selectLocalizacaoById ($id){

        $conexao = conectarMysql();
        $sql = "select * from tbl_localizacao where id = " . $id . ";";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"            => $dadosArray['id'],
                    "id_piso"       => $dadosArray['id_piso'],
                    "id_corredor"   => $dadosArray['id_corredor'],
                    "sigla"         => $dadosArray['sigla']
                    
                );
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;

    }

    function deleteLocalizacao($id){

        $conexao = conectarMysql();
        $sql = "delete from tbl_localizacao where id = " . $id . ";";

        $resultado = (boolean) false;

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;
    }

    function insertLocalizacao($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "insert into tbl_localizacao (id_piso, id_corredor, sigla)
                        
                        values (". $dados['id_piso'].",
                                ". $dados['id_corredor'].",
                                ". $dados['sigla'].");";

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;

            }

        }

        fecharConexaoMysql($conexao);
        
        return $resultado;

    }

    function updateLocalizacao($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "update tbl_localizacao set
                        id_piso = ".           $dados['id_piso'].",
                        id_corredor = ".       $dados['id_corredor'].",
                        sigla = ".            $dados['sigla'].
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