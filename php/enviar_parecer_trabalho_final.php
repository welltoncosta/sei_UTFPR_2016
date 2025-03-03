<meta charset="utf8" />
<?php
//include("sessao.php");
include("conexao.php");

echo "teste";
$hashuser = $_GET["hashuser"];
$hashtrab = $_GET["hashtrab"];

$avaliacao_final = $_POST["avaliacao_final"];

$sql = mysql_query("UPDATE 2016_trabalhos SET reavaliacao='1', parecer='$avaliacao_final'  WHERE hash='$hashtrab'");
//echo "UPDATE 2016_trabalhos SET reavaliacao='1', parecer='$avaliacao_final'  WHERE hash='$hashtrab'";


	$_SESSION["mensagem"]="Parecer final enviado com sucesso";
	header("location: ../ver_trabalhos_para_avaliar.php?hash=$hashuser#cabecalho");



?>
