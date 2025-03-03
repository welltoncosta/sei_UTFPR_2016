<?php

include("conexao.php");
session_start();

$id = $_SESSION["id"];

$sql = mysql_query("INSERT INTO 2016_palestra_inpi (id_participante) VALUES ('$id')");

if($sql){
    $_SESSION["mensagem"] = "<span class='verde'>VOCÊ SE INSCREVEU NESTA PALESTRA.</verde><br>";
    header("location: ../palestra_inpi.php");
}else{
    echo "erro servidor!";
}
?>