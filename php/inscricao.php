<?php

   session_start();
   include("conexao.php");

   $_SESSION["nome"]=$nome=$_POST['nome'];
   $_SESSION["cpf"]=$cpf=$_POST['cpf'];
   $_SESSION["campus"]=$campus=$_POST['campus'];
   $_SESSION["instituicao"]=$instituicao=$_POST['instituicao'];
   $_SESSION["ra"]=$ra=$_POST['ra'];
   $_SESSION["papel"]=$papel=$_POST['papel'];
   $_SESSION["email"]=$email=$_POST['email'];
   $senha=crypt($_POST['senha']);
   $ids_areas = $_POST["ids_areas"];
   $tipo = $_POST["tipo"];
   $data_inscricao = date("d/m/Y - H:i:s");
   $hash = md5(mysql_insert_id()."".$data_inscricao);
   $navegador = $_SERVER['HTTP_USER_AGENT'];

   //verifica se existe algum participante com o mesmo CPF ou Email
   $sql = mysql_query("SELECT * FROM 2016_participantes WHERE cpf='$cpf' OR email='$email'");
   $existe = mysql_num_rows($sql);
   if($existe!=0){
       $_SESSION["mensagem"]="<div class='vermelho'>O CPF ou o Email informado já foi cadastrado anteriormente no 6º Seminário de extensão e inovação da UTFPR<br></div>";
       if($tipo=="parecerista") header("location: ../inscricao_parecerista.php#inscricao_parecerista");
       else header("location: ../inscricoes.php#inscricoes");
   }else{

       if($tipo=="parecerista"){
           //Verifica se o participante escolheu as áreas
           if(empty($ids_areas)){
               $_SESSION["mensagem2"] = "<span class='vermelho'>Cadastro NÃO realizado. <br> Você precisa escolher uma ou mais área(s) de interesse(s)</span>";
               header("location: ../inscricao_parecerista.php#escolha_area");
           }else{
               $areasbanco = "";
               $cont=0;
               while($cont<count($ids_areas)){

                   $q_area=mysql_query("SELECT * FROM 2016_areas WHERE id=".$ids_areas[$cont]);
                   $f_area=mysql_fetch_array($q_area);
                   $areasbanco.=$f_area["area"]."<br>";

                   $areas .= $ids_areas[$cont]. " ";
                   $cont++;
               }
               $sql = mysql_query("INSERT INTO 2016_participantes(nome, cpf, campus, papel, ra, email, senha, tipo, ids_areas, data_inscricao, hash, navegador) VALUES('$nome', '$cpf', '$campus',  '$papel', '$ra', '$email', '$senha', '$tipo', '$areas', '$data_inscricao', '$hash', '$navegador')") or die(mysql_error());
               $_SESSION["nome"]="";
               $_SESSION["cpf"]="";
               $_SESSION["campus"]="";
               $_SESSION["instituicao"]="";
               $_SESSION["papel"]="";
               $_SESSION["ra"]="";
               $_SESSION["email"]="";
               $_SESSION["mensagem"]="<div class='verde'>Seu cadastro como parecerista no 6º Seminário de extensão e inovação da UTFPR foi realizada com sucesso!!!</div>";

               $areasbanco = utf8_encode($areasbanco);
               header("location: http://wellton.com.br/sei/inscricao_parecerista_enviado.php?nome=$nome&email=$email&areas=$areasbanco");
               //header("location: ../inscricao_parecerista.php#inscricao_parecerista");
           }
       }else{
           $sql = mysql_query("INSERT INTO 2016_participantes(nome, cpf, campus, instituicao, papel, ra, email, senha, tipo, data_inscricao, hash, navegador) VALUES('$nome', '$cpf', '$campus', '$instituicao', '$papel', '$ra', '$email', '$senha', '$tipo', '$data_inscricao', '$hash', '$navegador')") or die(mysql_error());
           $_SESSION["nome"]="";
           $_SESSION["cpf"]="";
           $_SESSION["campus"]="";
           $_SESSION["instituicao"]="";
           $_SESSION["papel"]="";
           $_SESSION["ra"]="";
           $_SESSION["email"]="";
           $_SESSION["mensagem"]="<div class='verde'>Seu cadastro no 6º Seminário de extensão e inovação da UTFPR foi realizada com sucesso!!!</div>";

           header("location: http://wellton.com.br/sei/inscricao_enviado.php?nome=$nome&email=$email");
           //header("location: ../inscricoes.php#inscricoes");
    }
  }
?>
