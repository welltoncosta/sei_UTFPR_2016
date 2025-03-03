<meta charset="utf8" />
<?php
	include("sessao.php");
	include("conexao.php");

	$id_participante = $_SESSION["id"];
	$email = $_SESSION["email"];
	$nome = $_SESSION["nome"];

	$tipo = $_POST["tipo"];
	$id_area = $_POST['id_area'];

	$autores =  $_POST["autor1"]."##".$_POST["autor2"]."##".$_POST["autor3"]."##".$_POST["autor4"]."##".$_POST["autor5"]."##".$_POST["autor6"]."##".$_POST["autor7"]."##".$_POST["autor8"]."##".$_POST["autor9"]."##" .$_POST["autor10"]."##".$_POST["autor11"]."##".$_POST["autor12"]."##".$_POST["autor13"]."##".$_POST["autor14"]."##".$_POST["autor15"]."##".$_POST["autor16"]."##".$_POST["autor17"]."##".$_POST["autor18"]."##".$_POST["autor19"]."##".$_POST["autor20"];

$orientador_nome = $_POST["orientador_nome"];
$orientador_email = $_POST["orientador_email"];

	$titulo = $_POST["titulo"];
	$titulo = str_replace("'", "\\'", $titulo);

	$resumo = $_POST["resumo"];
	$resumo = str_replace("'", "\\'", $resumo);

	$trabalho = $_FILES['trabalho'];
	$trabalho_sem_nome = $_FILES['trabalho_sem_nome'];

	$palavras_chave = $_POST['palavras_chave'];
	$data_envio = date("d/m/Y - H:i:s");
	$hash = md5(mysql_insert_id()."".$data_envio);

function remover_caracter($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}


	if($tipo=="RESUMO") $local = "resumos/";
	else $local = "artigos/";

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
		// O arquivo passou em todas as verificações, hora de tentar movê-lo para a área
		// Primeiro verifica se deve trocar o nome do arquivo
		if ($renomeia == true) {
			// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
			$nome_final = md5(time()).'.pdf';
		} else {
                // Mantém o nome original do arquivo
                //$nome_final = $trabalho['name'];
                $ext = explode('.', $trabalho['name']);
			$nome_final = remover_caracter($ext[0])." - " . date("d-m-Y H-i-s").".pdf";
		}
        
		// Depois verifica se é possível mover o arquivo para a área escolhida
		if (move_uploaded_file($trabalho['tmp_name'], "../trabalhos/".$local.$id_area."/".$nome_final)) {

             //PARADA PARADA PARADA

            // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
            // Faz a verificação da extensão do arquivo
            $extensao = strtolower(end(explode('.', $trabalho_sem_nome['name'])));

            if (array_search($extensao, $extensao_permitida) === false) {
                echo "Arquivo inválido! Envie em PDF";
            }else{
                // O arquivo passou em todas as verificações, hora de tentar movê-lo para a área
                // Primeiro verifica se deve trocar o nome do arquivo
                if ($renomeia == true) {
                    // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                    $nome_final_sem_nome = md5(time()).'.pdf';
                } else {
                    // Mantém o nome original do arquivo
                    //$nome_final_sem_nome = $trabalho_sem_nome['name'];
                    $ext = explode('.', $trabalho_sem_nome['name']);
                    $nome_final_sem_nome = remover_caracter($ext[0])."_semnome - " . date("d-m-Y H-i-s").".pdf";
                }
                
                // Depois verifica se é possível mover o arquivo para a área escolhida
                if (move_uploaded_file($trabalho_sem_nome['tmp_name'], "../trabalhos/".$local.$id_area."/".$nome_final_sem_nome)) {
                    //PARADA PARADA PARADA  
                              
                    $sql = "INSERT INTO 2016_trabalhos (id_participante, tipo,  id_area, autores, orientador_nome, orientador_email, titulo, resumo, trabalho, trabalho_sem_nome, palavras_chave, data_envio,  hash)VALUES('$id_participante', '$tipo','$id_area', '$autores', '$orientador_nome', '$orientador_email', '$titulo', '$resumo','".$local.$id_area."/".$nome_final."', '".$local.$id_area."/".$nome_final_sem_nome."', '$palavras_chave', '$data_envio', '$hash')";
            
                    //echo $sql;
            
                    if(mysql_query($sql)){
                        $_SESSION["mensagem"] = "SEU $tipo FOI ENVIADO COM SUCESSO!";
                        header("location: http://wellton.com.br/sei/trabalho_enviado.php?tipo=$tipo&nome=$nome&email=$email&titulo=$titulo");
                        //header("location: ../enviar_trabalho.php#trabalho");		
                    }else{
                        echo "Erro de servidor =(. Tente novamente.";
                    }
                 } else {
                 // Não foi possível fazer o upload, provavelmente a área está incorreta
                    echo "Não foi possível enviar o arquivo, tente novamente";
                 }
            }  
        } else {
            // Não foi possível fazer o upload, provavelmente a área está incorreta
            echo "Não foi possível enviar o arquivo, tente novamente";
        }
    }
    


	
	
