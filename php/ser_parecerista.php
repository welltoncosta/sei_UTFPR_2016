<?php

include("sessao_php.php");
include("conexao.php");

$id = $_GET["hash"];

//echo "UPDATE 2016_participantes SET tipo='parecerista' WHERE id=$id";

$sql = mysql_query("UPDATE 2016_participantes SET tipo='parecerista' WHERE hash='$id'");

if($sql){
    //$_SESSION["tipo"]="parecerista";
    $_SESSION["mudou"]="s";
    header("location: ../inscricoes_parecerista_editar.php#cabecalho");
}else{
    echo "erro de servidor =(";
}



?>
