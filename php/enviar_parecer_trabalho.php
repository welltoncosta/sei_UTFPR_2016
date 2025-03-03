<meta charset="utf8" />
<?php
include("sessao.php");
include("conexao.php");

$hashuser = $_SESSION["hashuser"];
$hashtrab = $_SESSION["hashtrab"];
$id_parecerista = $_SESSION["id"];
$id_trabalho = $_SESSION["id_trabalho"];

$nome_parecerista = $_SESSION["nome_parecerista"];
$email_parecerista = $_SESSION["email_parecerista"];

$titulo = $_SESSION["titulo"];

$nota = $_POST["nota"];
$planilha = $_FILES['planilha'];

$parecer = $_POST['avaliacoes'];
$parecer = str_replace("'", "\\'", $parecer);
$avaliacao_final = $_POST["avaliacao_final"];

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

// Array com as extensões permitidas
$extensao_permitida = "pdf";

// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$renomeia = false;

// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
// Faz a verificação da extensão do arquivo
$extensao = strtolower(end(explode('.', $planilha['name'])));

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
        $ext = explode('.', $planilha['name']);
	$nome_final = remover_caracter($ext[0])." - " . date("d-m-Y H-i-s").".pdf";
    }
    
    // Depois verifica se é possível mover o arquivo para a área escolhida
    if (move_uploaded_file($planilha['tmp_name'], "../avaliacoes/".$nome_final)) {
	//PARADA PARADA PARADA
        $sql = "INSERT INTO 2016_avaliacoes_trabalhos (id_trabalho, id_parecerista, nota, planilha, avaliacao, parecer, datahora, hash) VALUES ('$id_trabalho', '$id_parecerista','$nota', 'avaliacoes/".$nome_final."', '$parecer', '$avaliacao_final', '$data_envio', '$hash')";
	
        //        echo $sql;
        
         if(mysql_query($sql)){
            $_SESSION["mensagem"] = "SEU PARECER FOI ENVIADO COM SUCESSO!";
            header("location: https://wellton.com.br/sei/parecer_trabalho_enviado.php?hash=$hashuser&nome=$nome_parecerista&email=$email_parecerista&titulo=$titulo");
//	    header("location: https://sei.fb.utfpr.edu.br/ver_trabalhos_para_avaliar.php?hash=$hashuser&nome=$nome_parecerista&email=$email_parecerista&titulo=$titulo#cabecalho");		

            //header("location: ../enviar_trabalho.php#trabalho");		
        }else{
            echo "Erro de servidor =(. Tente novamente.";
        }
        
    } else {
        // Não foi possível fazer o upload, provavelmente a área está incorreta
        echo "Não foi possível enviar o arquivo, tente novamente";
    }
}  

