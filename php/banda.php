<?php
include("sessao.php");

$nome = $_POST["nome"];
$estilo = $_POST["estilo"];
$email = $_POST["email"];

include("conexao.php");

$sql = mysql_query("INSERT INTO 2016_banda(nome, estilo, email) VALUES('$nome', '$estilo', '$email')");

if($sql){
	session_start();
	$_SESSION["mensagem"]="<span class=verde>Banda ou artista cadastrado com sucesso!</span>";
	header("location: ../banda.php");

}else
	echo "Erro no servidor";