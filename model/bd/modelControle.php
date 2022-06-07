<?php

    require_once('conexaoMySQL.php');

    function selectAllControles (){

        $conexao = conectarMysql();
        $sql = "select tbl_controle.id, 
                        tbl_controle.data_entrada,
                        tbl_controle.data_saida,
                        tbl_veiculo.id as id_veiculo,
                        tbl_veiculo.placa,
                        tbl_cliente.id as id_cliente,
                        tbl_cliente.nome,
                        tbl_vaga.id as id_vaga,
                        tbl_vaga.sigla,
                        tbl_vaga.piso,
                        tbl_vaga.corredor,
                        tbl_valor.hora_inicial, 
                        tbl_valor.demais_horas,
                        tbl_tipo.id as id_tipo,
                        tbl_tipo.tipo
                    from tbl_controle
                        inner join tbl_veiculo
                            on tbl_controle.id_veiculo = tbl_veiculo.id
                        inner join tbl_cliente_veiculo
                            on tbl_veiculo.id = tbl_cliente_veiculo.id_veiculo
                        inner join tbl_cliente
                            on tbl_cliente_veiculo.id_cliente = tbl_cliente.id
                        inner join tbl_vaga
                            on tbl_controle.id_vaga = tbl_vaga.id
                        inner join tbl_tipo
                            on tbl_vaga.id_tipo = tbl_tipo.id
                        inner join tbl_valor
                            on tbl_tipo.id_valor = tbl_valor.id;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"            => $dadosArray['id'],
                    "data_entrada"  => $dadosArray['data_entrada'],
                    "data_saida"    => $dadosArray['data_saida'],
                    "veiculo"   => array(
                                                "id_veiculo" => $dadosArray['id_veiculo'],
                                                "placa"      => $dadosArray['placa'],
                                                "id_cliente" => $dadosArray['id_cliente'],
                                                "nome"       => $dadosArray['nome']
                    ),
                    "vaga"       => array(
                                            "id_vaga" => $dadosArray['id_vaga'],
                                            "sigla"   => $dadosArray['sigla'],
                                            "piso"    => $dadosArray['piso'],
                                            "corredor"=> $dadosArray['corredor'],
                                            "id_tipo" => $dadosArray['id_tipo'],
                                            "tipo"    => $dadosArray['tipo'],
                                            "valor"   => array(
                                                                "hora_inicial" => $dadosArray['hora_inicial'],
                                                                "demais_horas" => $dadosArray['demais_horas']
                                            )    
                    )
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