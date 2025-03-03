<?php
	include("conexao.php");
	session_start();

	$senha = $_POST["senha"];
	$r_senha = $_POST["r_senha"];
	$hash = $_GET["hash"];

	if($senha == $r_senha){
		$senha = crypt($senha);
		if(mysql_query("UPDATE 2016_participantes SET senha='$senha' WHERE hash='$hash'")){
			$_SESSION["mensagem"]="Senha alterada com sucesso!";			
			header("location: ../login.php#login");
		}else{
			echo "Erro no servidor =(. Tente novamente.";
		}
	}
