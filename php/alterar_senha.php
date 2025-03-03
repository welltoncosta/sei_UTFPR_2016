<?php
	include("conexao.php");

	$email = $_POST["email"];

	$sql = mysql_query("SELECT nome, hash FROM 2016_participantes WHERE email='$email'") or die (mysql_error());
	$cont=mysql_num_rows($sql);

	if($cont==0){
		session_start();
		$_SESSION["m"]="O Email fornecido não está cadastrado. Tente outro ou cadastre-se ao lado.";
		header("location: ../alterar_senha.php#reiniciar_senha");
	}else{
		$mostra=mysql_fetch_array($sql);
		header("location: http://wellton.com.br/sei/senha_enviado.php?email=$email&nome=".$mostra["nome"]."&hash=".$mostra["hash"]);
	}
?>
