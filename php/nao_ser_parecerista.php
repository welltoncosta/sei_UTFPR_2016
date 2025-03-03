<?php
include("sessao_php.php");
include("conexao.php");

//$id = $_SESSION["id"];
$id = $_GET["hash"];
//echo "UPDATE 2016_participantes SET tipo='parecerista' WHERE id=$id";

$sql = mysql_query("UPDATE 2016_participantes SET tipo='participante' WHERE hash='$id'");

if($sql){
    //$_SESSION["tipo"]="participante";
    //   $_SESSION["mudou"]="s";

    header("location: ../ver_inscritos.php#cabecalho");
}else{
    echo "erro de servidor =(";
}
