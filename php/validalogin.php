<?php
	include("conexao.php");
	include("sessao.php");

$link = $_GET["link"];

	$email = $_POST["email"];
	$senha = $_POST["senha"];

	$sql = mysql_query("SELECT * FROM 2016_participantes WHERE email='$email'") or die (mysql_error());
	$mostra=mysql_fetch_array($sql);
	$senhadecrypt = crypt($senha, $mostra["senha"]);

	if($mostra["senha"]==$senhadecrypt)
	{
		$_SESSION['id'] 	= $mostra["id"];
		$_SESSION['nome']	= $mostra["nome"];
		$_SESSION['cpf']	= $mostra["cpf"];
		$_SESSION['campus']	= $mostra["campus"];
		$_SESSION['ra']		= $mostra["ra"];
  		$_SESSION['papel']	= $mostra["papel"];
		$_SESSION['email']	= $mostra["email"];
		$_SESSION['tipo'] 	= $mostra["tipo"];
		$_SESSION['ids_areas'] 	= $mostra["ids_areas"];
		$_SESSION['data_inscricao']=$mostra["data_inscricao"];
        $_SESSION['hash'] = $mostra['hash'];

		if($_GET["pg"]==""){
            if($link==""){
                header("location:../painel.php#cabecalho");
            }else{
                header("location: ../avaliar_trabalho.php?hashtrab=$link");
            }   
		}else if($_GET["pg"]=="resumos"){
			header("location:../painel.php#editado");
		}
	}else{
		$_SESSION["erro"]=1;
        header("location: ../login.php?email=".$email."&link=$link#login");

	}

?>
