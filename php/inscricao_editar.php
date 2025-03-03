<?php
   
   include("conexao.php");
   include("sessao.php");
  
   $hash =     $_GET["hash"];
   $nome =   $_POST['nome'];
   $cpf =    $_POST['cpf'];
   $campus = $_POST['campus'];
   $papel =     $_POST['papel'];
   $ra =     $_POST['ra'];
   $email =  $_POST['email'];
   $ids_areas = $_POST["ids_areas"];
   $data_inscricao = $_SESSION["data_inscricao"];
   $sqlupdate="";

   if(empty($ids_areas)){

	$sqlupdate = "UPDATE 2016_participantes SET nome='$nome', cpf='$cpf', campus='$campus', papel='$papel', ra='$ra', email='$email' WHERE hash='$hash'";
    
	if(mysql_query($sqlupdate)){
  // 		$_SESSION['id']   = $hash;
   		$_SESSION['nome']   = $nome;
   		$_SESSION['cpf']    = $cpf;
   		$_SESSION['campus'] = $campus;
  		$_SESSION['papel']  = $papel;
   		$_SESSION['ra']	    = $ra;
   		$_SESSION['email']  = $email;
   		$_SESSION['data_inscricao']=$data_inscricao;

   		$_SESSION["mensagem"]="Seus dados foram atualizados com sucesso.";
      		header("location: ../painel.php#painel");
   	}else{
		echo "Falha no servidor =(, tente novamente.";
   	}

   }else{

	$areas="";
	$cont=0;

	while($cont<count($ids_areas)){
        	$areas .= $ids_areas[$cont]. " ";
        	$cont++;
   	}
	
	$sqlupdate = "UPDATE 2016_participantes SET nome='$nome', cpf='$cpf', campus='$campus', papel='$papel', ra='$ra', email='$email', ids_areas='$areas' WHERE hash='$hash'";
	
	if(mysql_query($sqlupdate)){
//   		$_SESSION['id']   = $hash;
   		$_SESSION['nome']   = $nome;
   		$_SESSION['cpf']    = $cpf;
   		$_SESSION['campus'] = $campus;
   		$_SESSION['ra']	    = $ra;
  		$_SESSION['papel']  = $papel;
   		$_SESSION['email']  = $email;
		$_SESSION['ids_areas'] 	= $areas;
   		$_SESSION['data_inscricao']=$data_inscricao;

   		$_SESSION["mensagem"]="Seus dados foram atualizados com sucesso.";
      		header("location: ../painel.php#painel");
   	}else{
		echo "Falha no servidor =(, tente novamente.";
   	}
			
   }
   
   

?>
