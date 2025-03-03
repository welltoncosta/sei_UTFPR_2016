<meta charset="utf8" />
<?php
include("sessao.php");
include("conexao.php");

$id = $_GET["id_trabalho"];
$hash1 = $_GET["hash"];
$id_participante = $_SESSION["id"];
$orientador_nome = $_POST["orientador_nome"];
$orientador_email = $_POST["orientador_email"];

$email = $_SESSION["email"];
$nome = $_SESSION["nome"];

$tipo = $_POST["tipo"];
$id_area = $_POST['id_area'];

function remover_caracter($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}

$autores =  $_POST["autor1"]."##".$_POST["autor2"]."##".$_POST["autor3"]."##".$_POST["autor4"]."##".$_POST["autor5"]."##".$_POST["autor6"]."##".$_POST["autor7"]."##".$_POST["autor8"]."##".$_POST["autor9"]."##" .$_POST["autor10"]."##".$_POST["autor11"]."##".$_POST["autor12"]."##".$_POST["autor13"]."##".$_POST["autor14"]."##".$_POST["autor15"]."##".$_POST["autor16"]."##".$_POST["autor17"]."##".$_POST["autor18"]."##".$_POST["autor19"]."##".$_POST["autor20"];

$titulo = $_POST["titulo"];
$titulo = str_replace("'", "\\'", $titulo);

$resumo = $_POST["resumo"];
$resumo = str_replace("'", "\\'", $resumo);

$trabalho = $_FILES['trabalho'];
$trabalho_sem_nome = $_FILES['trabalho_sem_nome'];

$palavras_chave = $_POST['palavras_chave'];
$data_envio = date("d/m/Y - H:i:s");
$hash = md5(mysql_insert_id()."".$data_envio);

if($tipo=="RESUMO") $local = "resumos/";
else $local = "artigos/";

if($trabalho["name"]=="" && $trabalho_sem_nome["name"]==""){
    //********************************************************
    //*** NÃO ALTERA TRABALHO COM NOME E TRABALHO SEM NOME ***
    //********************************************************

    $sql = "UPDATE 2016_trabalhos SET tipo='$tipo', id_area='$id_area', autores='$autores', orientador_nome='$orientador_nome', orientador_email='$orientador_email', titulo='$titulo', resumo='$resumo', palavras_chave='$palavras_chave', modificado='1' WHERE hash='$hash1'";
    
    if(mysql_query($sql)){
        $_SESSION["mensagem"] = "SEU $tipo FOI EDITADO COM SUCESSO!";
        //header("location: http://wellton.com.br/sei/trabalho_modificado.php?tipo=$tipo&nome=$nome&email=$email&titulo=$titulo&id_trabalho=$id");
        header("location: ../editar_trabalho.php?id_trabalho=$id&hash=$hash1");
    }else
    echo "Erro de servidor =(. Tente novamente.";
    
}else if($trabalho_sem_nome["name"]==""){

    //***************************************************************
    //*** ALTERA TRABALHO COM NOME E NÃO ALTERA TRABALHO SEM NOME ***
    //***************************************************************

    $extensao_permitida = "pdf";
    $renomeia = false;
    $extensao = strtolower(end(explode('.', $trabalho['name'])));
    if (array_search($extensao, $extensao_permitida) === false) {
        echo "Arquivo inválido! Envie em PDF";
    }else{			
        $ext = explode('.', $trabalho['name']);
        $nome_final =remover_caracter($ext[0])." - " . date("d-m-Y H-i-s").".pdf";
        
	if (move_uploaded_file($trabalho['tmp_name'], "../trabalhos/".$local.$id_area."/".$nome_final)){		$sql = "UPDATE 2016_trabalhos SET tipo='$tipo', id_area='$id_area', autores='$autores', orientador_nome='$orientador_nome', orientador_email='$orientador_email', titulo='$titulo', resumo='$resumo', trabalho='".$local.$id_area."/".$nome_final."', palavras_chave='$palavras_chave', modificado='1' WHERE hash='$hash1'";
	    if(mysql_query($sql)){
		$_SESSION["mensagem"] = "SEU $tipo FOI EDITADO COM SUCESSO!";
		header("location: http://wellton.com.br/sei/trabalho_modificado.php?tipo=$tipo&nome=$nome&email=$email&titulo=$titulo&id_trabalho=$id");
	    }else echo "Erro de servidor =(. Tente novamente.";
	} else {
	    echo "Não foi possível enviar o arquivo, tente novamente";
        }
    }    
}else if($trabalho["name"]==""){

    //***************************************************************
    //*** ALTERA TRABALHO SEM NOME E NÃO ALTERA TRABALHO COM NOME ***
    //***************************************************************

    $extensao_permitida = "pdf";
    $renomeia = true;
    $extensao = strtolower(end(explode('.', $trabalho_sem_nome['name'])));
    
    if (array_search($extensao, $extensao_permitida) === false) {
        echo "Arquivo inválido! Envie em PDF";
    }else{			
        $ext = explode('.', $trabalho_sem_nome['name']);
        $nome_final = md5(remover_caracter($ext[0])."_semnome - " . date("d-m-Y H-i-s")).".pdf";
        if (move_uploaded_file($trabalho_sem_nome['tmp_name'], "../trabalhos/".$local.$id_area."/".$nome_final)) {
            
            $sql = "UPDATE 2016_trabalhos SET tipo='$tipo', id_area='$id_area', autores='$autores', orientador_nome='$orientador_nome', orientador_email='$orientador_email', titulo='$titulo', resumo='$resumo', trabalho_sem_nome='".$local.$id_area."/".$nome_final."', palavras_chave='$palavras_chave', modificado='1' WHERE hash='$hash1'";
            if(mysql_query($sql)){
                $_SESSION["mensagem"] = "SEU $tipo FOI EDITADO COM SUCESSO!";
                //header("location: http://wellton.com.br/sei/trabalho_modificado.php?tipo=$tipo&nome=$nome&email=$email&titulo=$titulo&id_trabalho=$id");
		//header("location: ../todos_trabalhos.php#cabecalho");
		echo  "ok";
		echo "../trabalhos/$local$id_area/$nome_final <br>";

		echo "<iframe width=100% height=100% src='../trabalhos/$local$id_area/$nome_final'></iframe>";
            }else
                echo "Erro de servidor =(. Tente novamente.";
        } else {
            echo "Não foi possível enviar o arquivo, tente novamente";
        }
        
    }
    
}else{


    //***********************************************************
    //*** ALTERA TRABALHO COM NOME E ALTERA TRABALHO SEM NOME ***
    //***********************************************************

    
    $extensao_permitida = "pdf";
    $renomeia = false;
    $extensao = strtolower(end(explode('.', $trabalho_sem_nome['name'])));            
    if (array_search($extensao, $extensao_permitida) === false) {
        echo "Arquivo inválido! Envie em PDF";
    }else{			
        $ext = explode('.', $trabalho_sem_nome['name']);
        $nome_final_sem = remover_caracter($ext[0])."_semnome - " . date("d-m-Y H-i-s").".pdf";
        if (move_uploaded_file($trabalho_sem_nome['tmp_name'], "../trabalhos/".$local.$id_area."/".$nome_final_sem)) {
            $extensao = strtolower(end(explode('.', $trabalho['name'])));            
            if (array_search($extensao, $extensao_permitida) === false) {
                echo "Arquivo inválido! Envie em PDF";
            }else{			
                $ext = explode('.', $trabalho['name']);
                $nome_final = $ext[0]." - " . date("d-m-Y H-i-s").".pdf";
                if (move_uploaded_file($trabalho['tmp_name'], "../trabalhos/".$local.$id_area."/".$nome_final)) {                    
                    $sql = "UPDATE 2016_trabalhos SET tipo='$tipo', id_area='$id_area', autores='$autores', orientador_nome='$orientador_nome', orientador_email='$orientador_email', titulo='$titulo', resumo='$resumo', trabalho='".$local.$id_area."/".$nome_final."', trabalho_sem_nome='".$local.$id_area."/".$nome_final_sem."', palavras_chave='$palavras_chave', modificado='1' WHERE hash='$hash1'";
                    if(mysql_query($sql)){
                        $_SESSION["mensagem"] = "SEU $tipo FOI EDITADO COM SUCESSO!";
                        header("location: http://wellton.com.br/sei/trabalho_modificado.php?tipo=$tipo&nome=$nome&email=$email&titulo=$titulo&id_trabalho=$id");
                    }else
                        echo "Erro de servidor =(. Tente novamente.";
                } else {
                    echo "Não foi possível enviar o arquivo, tente novamente";
                }
            }
        }
    }
}
?>
