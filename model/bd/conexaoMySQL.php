<?php

/*Arquivo para estabelecer a conexão com o data base. */

const SERVER = 'localhost';
const USER = 'root';
const PASSWORD = 'bcd127';
const DATABASE = 'fast_parking';

function conectarMysql(){
    $conexao = array();

    /*O método mysqli_connect retorna um array de informações caso a conexão dê certo */
    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    /*Se houver conteúdo na variável, retornaremos o array sobre a conexão. */
    if($conexao){
        return $conexao;
    }else{
        return false;
    }
}

function fecharConexaoMysql($conexao){
    mysqli_close($conexao);
}

?>