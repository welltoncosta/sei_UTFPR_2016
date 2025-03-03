<meta charset="utf8" />
<?php
include("sessao.php");
include("conexao.php");

$id = $_GET["id_trabalho"];
$hash = $_GET["hash"];
$tipo = $_GET["tipo"];
$id_area = $_GET["id_area"];
$id_participante = $_SESSION["id"];
$nome = $_SESSION["nome"];
$email = $_SESSION["email"];
$titulo = $_SESSION["titulo"];

function remover_caracter($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}


$orientador_nome = $_POST["nomeorientador"];
$orientador_email = $_POST["emailorientador"];
$trabalho_sem_nome = $_FILES['trabalhosemnome'];

$data_envio = date("d/m/Y - H:i:s");

if($tipo=="RESUMO") $local = "resumos/";
else $local = "artigos/";

if($trabalho_sem_nome["name"]!=""){
    // Array com as extensões permitidas
    $extensao_permitida = "pdf";

    // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $renomeia = false;
    
    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
    // Faz a verificação da extensão do arquivo
    $extensao = strtolower(end(explode('.', $trabalho['name'])));
    
    
    if (array_search($extensao, $extensao_permitida) === false) {
	echo "Arquivo inválido! Envie em PDF";
    }else{
	
	// Mantém o nome original do arquivo
	//$nome_final = $trabalho['name'];
	$ext = explode('.', $trabalho_sem_nome['name']);
	$nome_final = remover_caracter($ext[0])."_semnome - " . date("d-m-Y H-i-s").".pdf";
	
	// Depois verifica se é possível mover o arquivo para a área escolhida
	if (move_uploaded_file($trabalho_sem_nome['tmp_name'], "../trabalhos/".$local.$id_area."/".$nome_final)) {
	    
        /*	    if($orientador_nome=='' && $orientador_email=='')
            $sql = "UPDATE 2016_trabalhos SET trabalho_sem_nome='".$local.$id_area."/".$nome_final."', trabalho_sem_nome_enviado='$data_envio' WHERE id=$id";
	    else if($orientador_nome=='')
            $sql = "UPDATE 2016_trabalhos SET orientador_email='$orientador_email', trabalho_sem_nome='".$local.$id_area."/".$nome_final."', trabalho_sem_nome_enviado='$data_envio' WHERE id=$id";
	    else if($orientador_email=='')
            $sql = "UPDATE 2016_trabalhos SET orientador_nome='$orientador_nome', trabalho_sem_nome='".$local.$id_area."/".$nome_final."', trabalho_sem_nome_enviado='$data_envio' WHERE id=$id";
	    else if($orientador_nome!="" && $orientador_email!="")
            $sql = "UPDATE 2016_trabalhos SET orientador_nome='$orientador_nome', orientador_email='$orientador_email', trabalho_sem_nome='".$local.$id_area."/".$nome_final."', trabalho_sem_nome_enviado='$data_envio' WHERE id=$id";
        */

          $sql = "UPDATE 2016_trabalhos SET orientador_nome='$orientador_nome', orientador_email='$orientador_email', trabalho_sem_nome='".$local.$id_area."/".$nome_final."', trabalho_sem_nome_enviado='$data_envio' WHERE hash='$hash'";
          
	    if(mysql_query($sql)){
            $_SESSION["mensagem"] = "SEU TRABALHO SEM NOME FOI ENVIADO COM SUCESSO!";
            header("location: http://wellton.com.br/sei/trabalhosemnome_modificado.php?tipo=$tipo&nome=$nome&email=$email&titulo=$titulo&id_trabalho=$id");
		//header("location: ../enviar_trabalho.php#trabalho");		
	    }else
	echo "Erro de servidor =(. Tente novamente.";
	} else {
	    // Não foi possível fazer o upload, provavelmente a área está incorreta
	    echo "Não foi possível enviar o arquivo, tente novamente";
	}
	
    }
}else{
    /*    if($orientador_nome=='' && $orientador_email=='')
	$sql = "UPDATE 2016_trabalhos SET orientador_nome='', orientador_email=''  WHERE id=$id";
    
    if($orientador_nome=='')
	$sql = "UPDATE 2016_trabalhos SET orientador_email='$orientador_email'  WHERE id=$id";
    else if($orientador_email=='')
        $sql = "UPDATE 2016_trabalhos SET orientador_nome='$orientador_nome' WHERE id=$id";
    else
	$sql = "UPDATE 2016_trabalhos SET orientador_nome='$orientador_nome', orientador_email='$orientador_email' WHERE id=$id";*/
    
      $sql = "UPDATE 2016_trabalhos SET orientador_nome='$orientador_nome', orientador_email='$orientador_email', trabalho_sem_nome='".$local.$id_area."/".$nome_final."', trabalho_sem_nome_enviado='$data_envio' WHERE id=$id";
      
    if(mysql_query($sql)){
        
	$_SESSION["mensagem"] = "EDITADO COM SUCESSO!";
	//header("location: http://wellton.com.br/sei/trabalhosemnome_modificado.php?tipo=$tipo&nome=$nome&email=$email&titulo=$titulo&id_trabalho=$id");
	header("location: ../editar_trabalho.php?id_trabalho=$id#trabalho");		
    }
}

?>
