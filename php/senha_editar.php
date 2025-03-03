<?php
	include("conexao.php");
	include("sessao.php");	

	$senha = $_POST["senha"];
	$r_senha = $_POST["r_senha"];
	$id = $_SESSION["id"];

	if($senha == $r_senha){
		$senha = crypt($senha);
		if(mysql_query("UPDATE 2016_participantes SET senha='$senha' WHERE id=$id")){
			$_SESSION["mensagem"]="Senha alterada com sucesso!";			
			header("location: ../painel.php#dados");
		}else{
			echo "Erro no servidor =(. Tente novamente.";
		}
	}
