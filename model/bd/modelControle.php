<?php

    require_once('conexaoMySQL.php');

    function selectAllControles (){

        $conexao = conectarMysql();
        $sql = "select * from tbl_controle;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"            => $dadosArray['id'],
                    "data_entrada"  => $dadosArray['data_entrada'],
                    "data_saida"    => $dadosArray['data_saida'],
                    "id_veiculo"    => $dadosArray['id_veiculo'],
                    "id_vaga"       => $dadosArray['id_vaga']
                );

                $contator++;

            }

            fecharConexaoMysql($conexao);

            return $resultado;

        }

    }

    function selectControleById ($id){

        $conexao = conectarMysql();
        $sql = "select * from tbl_controle where id = " . $id . ";";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"            => $dadosArray['id'],
                    "data_entrada"  => $dadosArray['data_entrada'],
                    "data_saida"    => $dadosArray['data_saida'],
                    "id_veiculo"    => $dadosArray['id_veiculo'],
                    "id_vaga"       => $dadosArray['id_vaga']
                );
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;

    }

    /*Função para recuperar os dados de controle através do ID do veicúlo */
    function selectControleByIdVeiculo ($id){

        $conexao = conectarMysql();
        $sql = "select * from tbl_controle where id_veiculo = " . $id . ";";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"            => $dadosArray['id'],
                    "data_entrada"  => $dadosArray['data_entrada'],
                    "data_saida"    => $dadosArray['data_saida'],
                    "id_veiculo"    => $dadosArray['id_veiculo'],
                    "id_vaga"       => $dadosArray['id_vaga']
                );
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;

    }

    /*Função para recuperar os dados de controle através do ID da vaga.*/
    function selectControleByIdVaga ($id){

        $conexao = conectarMysql();
        $sql = "select * from tbl_controle where id_vaga = " . $id . ";";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"            => $dadosArray['id'],
                    "data_entrada"  => $dadosArray['data_entrada'],
                    "data_saida"    => $dadosArray['data_saida'],
                    "id_veiculo"    => $dadosArray['id_veiculo'],
                    "id_vaga"       => $dadosArray['id_vaga']
                );
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;

    }

    function deleteControle($id){

        $conexao = conectarMysql();
        $sql = "delete from tbl_controle where id = " . $id . ";";

        $resultado = (boolean) false;

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;
            }
        }

        fecharConexaoMysql($conexao);

        return $resultado;
    }

    function insertControle($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "insert into tbl_controle (data_entrada, data_saida, id_veiculo, id_vaga)
                        
                        values (". $dados['data_entrada'].",
                                ". $dados['data_saida'].",
                                ". $dados['id_veiculo'].",
                                ". $dados['id_vaga'].");";

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){

                $resultado = true;

            }

        }

        fecharConexaoMysql($conexao);
        
        return $resultado;

    }

    function updateControle($dados){

        $resultado = (boolean) false;

        $conexao = conectarMysql();

        $sql = "update tbl_controle set
                        data_entrada = ".   $dados['data_entrada'].",
                        data_saida = ".     $dados['data_saida'].",
                        id_veiculo = ".     $dados['id_veiculo'].",
                        id_vaga = ".        $dados['id_vaga'].
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