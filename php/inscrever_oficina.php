<?php

include("conexao.php");

session_start();

$id_oficina = $_POST["oficina"];
$id_participante = $_SESSION["id"];

//echo "INSERT INTO 2016_oficinas_inscritos (id_oficina, id_participante) VALUES ($id_oficina, $id_participante)";


$sql = mysql_query("INSERT INTO 2016_oficinas_inscritos (id_oficina, id_participante) VALUES ($id_oficina, $id_participante)") or die (mysql_error());


if($sql){
    $_SESSION["mensagem"]="<span class='verde'>Inscrição na oficina realizada com sucesso</span><br><br>";
    header("location: ../oficinas.php");
}else{
    echo "ERRO banco";
}

?>
