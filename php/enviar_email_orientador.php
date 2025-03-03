<?php

$hash = $_GET["hash"];

include("conexao.php");

$m = mysql_query("SELECT * FROM 2016_trabalhos WHERE hash='$hash'") or die (mysql_error());
$m = mysql_fetch_array($m)or die(mysql_error());

$titulo = $m["titulo"];
$orientador = $m["orientador_nome"];
$email = $m["orientador_email"];
$trabalho_sem_nome = $m["trabalho_sem_nome"];
$trabalho = $m["trabalho"];


$texto = $titulo . " - " . $orientador . " - ". $email;

$query = mysql_query("UPDATE 2016_trabalhos SET envio_orientador='sim' WHERE hash='$hash'");

if($query){
    header("location: http://wellton.com.br/sei/enviar_orientador.php?nome=$orientador&email=$email&link=$trabalho_sem_nome&trabalho=$trabalho");
}

//mail($email, "teste", $texto);
//enviar esse link por email do trabalho sem nome
/*
echo "ANTES: <a href='https://sei.fb.utfpr.edu.br/trabalhos/$trabalho_sem_nome'>https://sei.fb.utfpr.edu.br/trabalhos/".$trabalho_sem_nome."</a><br><br>";

if(copy("../trabalhos/$trabalho_sem_nome", "../trabalhos/todos/$hash.pdf")){

    echo "teste";
}


echo "DEPOIS: <a href='../trabalhos/todos/$hash.pdf'>https://sei.fb.utfpr.edu.br/trabalhos/todos/".$hash.".pdf</a><br><br>";

//header("location: ../painel.php");
*/
?>