<?php
	@session_start();

	$id_trabalho = $_GET["id_trabalho"];
	$page = $_GET["page"];

	include("conexao.php");
	$query = mysql_query("DELETE FROM 2016_trabalhos WHERE id=$id_trabalho") or die("erro no servidor");

	if($query){
		
		$_SESSION["mensagem"]="<strong>Trabalho #$id_trabalho excluído!</strong><br><br>";
		
		if($page=="") header("location:../ver_trabalhos.php#cabecalho");
		else header("location:../$page.php#cabecalho");
	}else echo "Erro no servidor =( tente novamente";
?>
