<?php
	session_start();
	session_destroy();
	$_SESSION['id'] = "";
	$_SESSION['nome'] = "";
	$_SESSION['cpf'] = "";
	$_SESSION['campus'] = "";
	$_SESSION['ra'] = "";
	$_SESSION['email'] = "";
	$_SESSION['senha'] = "";
	$_SESSION['tipo'] = "";
	header("location:../login.php");
?>
