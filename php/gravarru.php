<?php

include("conexao.php");

$participar = $_POST["participar"];
$almocar = $_POST["almocar"];
$hash = $_GET["hash"];


$sql = "UPDATE 2016_participantes SET participar='$participar', almocar='$almocar' WHERE hash='$hash'";
$inserir = mysql_query($sql);

echo $sql;
if($inserir){
    session_start();
    $_SESSION["mensagem2"]="<span class='verde'>Obrigado por preencher!! </span>";
    header("location: ../painel.php#cabecalho");
}else{
    echo "erro de servidor, volte e tente novamente.";
}