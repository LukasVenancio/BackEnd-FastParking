<?php

    require_once('conexaoMySQL.php');

    function selectAllVagas (){

        $conexao = conectarMysql();
        $sql = "select tbl_vaga.id as id_vaga, 
                        tbl_vaga.ocupacao, 
                        tbl_vaga.preferencial, 
                        tbl_vaga.id_tipo, 
                        tbl_vaga.id_estacionamento, 
                        tbl_tipo.tipo, 
                        tbl_tipo.id_valor, 
                        tbl_valor.hora_inicial,
                        tbl_valor.demais_horas, 
                        tbl_vaga.sigla, 
                        tbl_vaga.corredor, 
                        tbl_vaga.piso
                from tbl_vaga
                    inner join tbl_tipo 
                        on tbl_vaga.id_tipo = tbl_tipo.id 
                    inner join tbl_valor 
                        on tbl_tipo.id_valor = tbl_valor.id 
                order by tbl_vaga.id;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"                => $dadosArray['id_vaga'],
                    "ocupacao"          => $dadosArray['ocupacao'],
                    "preferencial"      => $dadosArray['preferencial'],
                    "id_estacionamento" => $dadosArray['id_estacionamento'],
                    "tbl_tipo"          => array(
                                                    "id_tipo"       => $dadosArray['id_tipo'],
                                                    "tipo"          => $dadosArray['tipo'],
                                                    "id_valor"      => $dadosArray['id_valor'],
                                                    "hora_inicial"  => $dadosArray['hora_inicial'],
                                                    "demais_horas"  => $dadosArray['demais_horas']
                    ),
                    "localizacao" => array(
                                                    "sigla"           => $dadosArray['sigla'],
                                                    "corredor"        => $dadosArray['corredor'],
                                                    "piso"            => $dadosArray['piso'],
                    )
                    

                );

                $contator++;

            }

            fecharConexaoMysql($conexao);

            if(isset($resultado)){
                return $resultado;
            
            }else{
                return false;
            }
        }

    }

    function selectVagaById ($id){

        $conexao = conectarMysql();
        $sql = "select tbl_vaga.id as id_vaga, 
                        tbl_vaga.ocupacao, 
                        tbl_vaga.preferencial, 
                        tbl_vaga.id_tipo, 
                        tbl_vaga.id_estacionamento, 
                        tbl_tipo.tipo, 
                        tbl_tipo.id_valor, 
                        tbl_valor.hora_inicial,
                        tbl_valor.demais_horas, 
                        tbl_vaga.sigla, 
                        tbl_vaga.corredor, 
                        tbl_vaga.piso
                from tbl_vaga
                    inner join tbl_tipo 
                        on tbl_vaga.id_tipo = tbl_tipo.id 
                    inner join tbl_valor 
                        on tbl_tipo.id_valor = tbl_valor.id 
                where tbl_vaga.id =". $id ." ;";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id"                => $dadosArray['id_vaga'],
                    "ocupacao"          => $dadosArray['ocupacao'],
                    "preferencial"      => $dadosArray['preferencial'],
                    "id_estacionamento" => $dadosArray['id_estacionamento'],
                    "tbl_tipo"              => array(
                                                    "id_tipo"       => $dadosArray['id_tipo'],
                                                    "tipo"          => $dadosArray['tipo'],
                                                    "id_valor"      => $dadosArray['id_valor'],
                                                    "hora_inicial"  => $dadosArray['hora_inicial'],
                                                    "demais_horas"  => $dadosArray['demais_horas']
                    ),
                    "localizacao" => array(
                                                    "sigla"           => $dadosArray['sigla'],
                                                    "corredor"        => $dadosArray['corredor'],
                                                    "piso"            => $dadosArray['piso'],
                    )
                    

                
                );
            }
        }

        fecharConexaoMysql($conexao);

        if(isset($resultado)){
            return $resultado;
        
        }else{
            return false;
        }

    }

    function selectVagaByOcupacao ($ocupacao){

        $conexao = conectarMysql();
        $sql = "select tbl_vaga.id as id_vaga, 
                        tbl_vaga.ocupacao, 
                        tbl_vaga.preferencial, 
                        tbl_vaga.id_tipo, 
                        tbl_vaga.id_estacionamento, 
                        tbl_tipo.tipo, 
                        tbl_tipo.id_valor, 
                        tbl_valor.hora_inicial,
                        tbl_valor.demais_horas, 
                        tbl_vaga.sigla, 
                        tbl_vaga.corredor, 
                        tbl_vaga.piso
                from tbl_vaga
                    inner join tbl_tipo 
                        on tbl_vaga.id_tipo = tbl_tipo.id 
                    inner join tbl_valor 
                        on tbl_tipo.id_valor = tbl_valor.id 
                where tbl_vaga.ocupacao =". $ocupacao ." 
                order by tbl_vaga.id;";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"                => $dadosArray['id_vaga'],
                    "ocupacao"          => $dadosArray['ocupacao'],
                    "preferencial"      => $dadosArray['preferencial'],
                    "id_estacionamento" => $dadosArray['id_estacionamento'],
                    "tbl_tipo"          => array(
                                                    "id_tipo"       => $dadosArray['id_tipo'],
                                                    "tipo"          => $dadosArray['tipo'],
                                                    "id_valor"      => $dadosArray['id_valor'],
                                                    "hora_inicial"  => $dadosArray['hora_inicial'],
                                                    "demais_horas"  => $dadosArray['demais_horas']
                    ),
                    "localizacao" => array(
                                                    "sigla"           => $dadosArray['sigla'],
                                                    "corredor"        => $dadosArray['corredor'],
                                                    "piso"            => $dadosArray['piso'],
                    )
                    

                );

                $contator++;

            }
        }

        fecharConexaoMysql($conexao);

        if(isset($resultado)){
            return $resultado;
        
        }else{
            return false;
        }

    }

    function selectVagaByPreferencial ($preferencial){

        $conexao = conectarMysql();
        $sql = "select tbl_vaga.id as id_vaga, 
                        tbl_vaga.ocupacao, 
                        tbl_vaga.preferencial, 
                        tbl_vaga.id_tipo, 
                        tbl_vaga.id_estacionamento, 
                        tbl_tipo.tipo, 
                        tbl_tipo.id_valor, 
                        tbl_valor.hora_inicial,
                        tbl_valor.demais_horas, 
                        tbl_vaga.sigla, 
                        tbl_vaga.corredor, 
                        tbl_vaga.piso
                from tbl_vaga
                    inner join tbl_tipo 
                        on tbl_vaga.id_tipo = tbl_tipo.id 
                    inner join tbl_valor 
                        on tbl_tipo.id_valor = tbl_valor.id 
                where tbl_vaga.preferencial =". $preferencial ." 
                order by tbl_vaga.id;";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id"                => $dadosArray['id_vaga'],
                    "ocupacao"          => $dadosArray['ocupacao'],
                    "preferencial"      => $dadosArray['preferencial'],
                    "id_estacionamento" => $dadosArray['id_estacionamento'],
                    "tbl_tipo"              => array(
                                                    "id_tipo"       => $dadosArray['id_tipo'],
                                                    "tipo"          => $dadosArray['tipo'],
                                                    "id_valor"      => $dadosArray['id_valor'],
                                                    "hora_inicial"  => $dadosArray['hora_inicial'],
                                                    "demais_horas"  => $dadosArray['demais_horas']
                    ),
                    "localizacao" => array(
                                                    "sigla"           => $dadosArray['sigla'],
                                                    "corredor"        => $dadosArray['corredor'],
                                                    "piso"            => $dadosArray['piso'],
                    )
                    

                );

                $contator++;

            }
        }

        fecharConexaoMysql($conexao);

        if(isset($resultado)){
            return $resultado;
        
        }else{
            return false;
        }

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

        $sql = "insert into tbl_vaga (ocupacao, preferencial, id_tipo, id_estacionamento, piso, corredor, sigla)
                        
                        values (". $dados['ocupacao'].",
                                ". $dados['preferencial'].",
                                ". $dados['id_tipo'].",
                                ". $dados['id_estacionamento'].",
                                ". $dados['piso'].",
                                ". $dados['corredor'].",
                                '". strtoupper( $dados['sigla'])."');";

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
                        id_estacionamento = ".  $dados['id_estacionamento'].",
                        piso = ".               $dados['piso'].",
                        corredor = ".           $dados['corredor'].",
                        sigla = '".              $dados['sigla'].
                "' where id = ". $dados['id'].";";

        if(mysqli_query($conexao, $sql)){

            if(mysqli_affected_rows($conexao)){
        
                $resultado = true;
        
            }
        
        }
        
        fecharConexaoMysql($conexao);
                
        return $resultado;

    }

?>