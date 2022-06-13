<?php

    require_once('conexaoMySQL.php');

    function selectAllValores (){

        $conexao = conectarMysql();
        $sql = "select tbl_tipo.id as id_tipo, 
                        tbl_tipo.tipo,
                        tbl_valor.id as id_valor,
                        tbl_valor.hora_inicial,
                        tbl_valor.demais_horas
                    from tbl_valor
                        inner join tbl_tipo
                            on tbl_tipo.id_valor = tbl_valor.id 
                    order by tbl_tipo.id;";

        $dados = mysqli_query($conexao, $sql);

        if($dados){

            $contator = 0;

            while($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado[$contator] = array(

                    "id_tipo"           => $dadosArray['id_tipo'],
                    "tipo"              => $dadosArray['tipo'],
                    "id_valor"          => $dadosArray['id_valor'],
                    "hora_inicial"      => $dadosArray['hora_inicial'],
                    "demais_horas"      => $dadosArray['demais_horas']
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

    function selectValorById ($id){

        $conexao = conectarMysql();
        $sql = "select tbl_tipo.id as id_tipo, 
                        tbl_tipo.tipo,
                        tbl_valor.id as id_valor,
                        tbl_valor.hora_inicial,
                        tbl_valor.demais_horas
                    from tbl_valor
                        inner join tbl_tipo
                            on tbl_tipo.id_valor = tbl_valor.id 
                    where tbl_valor.id = ". $id."  
                    order by tbl_tipo.id;";
        

        $dados = mysqli_query($conexao, $sql);

        if($dados){


            if($dadosArray = mysqli_fetch_assoc($dados)){

                $resultado = array(

                    "id_tipo"           => $dadosArray['id_tipo'],
                    "tipo"              => $dadosArray['tipo'],
                    "id_valor"          => $dadosArray['id_valor'],
                    "hora_inicial"      => $dadosArray['hora_inicial'],
                    "demais_horas"      => $dadosArray['demais_horas']
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