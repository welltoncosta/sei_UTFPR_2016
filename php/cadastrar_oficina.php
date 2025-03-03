<?php

$nome = $_POST["nome"];
$coordenador = $_POST["coordenador"];
$extensionistas = $_POST["extensionistas"];
$sala = $_POST["sala"];
$vagas = $_POST["vagas"];

include("conexao.php");
$sql = mysql_query("INSERT INTO 2016_oficinas (nome, coordenador, extensionistas, sala, vagas) VALUES ('$nome', '$coordenador', '$extensionistas', '$sala', '$vagas')");

if($sql){

    header("location: ../oficinas.php");

}else{

    echo "erro";
    
}

?>