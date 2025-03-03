<?php
   session_start();
   if($_SESSION["id"]=="") header("location:index.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- TÍTULO DA PÁGINA -->
        <title>6º Seminário de extensão e inovação da UTFPR</title>

        <!-- FAVICON -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- TAGS -->
        <meta charset="UTF-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta http-equiv="content-language" content="pt-br">
        <meta name="generator" content="NetBeans 8.x">
        <meta name="author" content="Marcos Marcolin e Wellton Costa de Oliveira">

        <!-- ESTILOS CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="css/footer.css" rel="stylesheet" type="text/css" />
        <link href="css/nivo-slider.css" rel="stylesheet" type="text/css" />

        <!-- JAVASCRIPT/JQUERY -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/script.js" type="text/javascript"></script>
        <script src="js/nivo.slider.js" type="text/javascript"></script>
    	<script src="js/jquery.anchor.js" type="text/javascript"></script>

        <!-- FONTES EXTERNAS -->
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
      <!-- CABECALHO -->
      <section class="cabecalho">
         <section class="conteudo">
	    <section class="logo">
	       <a href="painel.php"><img src="img/logo.png" alt="IV Semana Acadêmica de licenciatura em Informática - ColinCamp 2016" title="IV Semana Acadêmica de licenciatura em Informática - ColinCamp 2016" /></a>
	    </section>
	    <!-- MENU -->
	    <nav class="menu">
	       <ul>
	          <li><a href="#editado" class="sobre">Ver Meus Resumos</a></li>
		  <li><a href="#envia"  class="programacao">Enviar Resumo</a></li>
                  <?php
    		     $tipo = $_SESSION["tipo"];
  		     if($tipo=="2" || $tipo=="3")
  		        echo "<li><a href='todosresumos.php' target='_blank' class='minicursos'>TODOS OS TRABALHOS</a></li>";
		   ?>
                   <li><a href="logout.php" class="minicursos">Sair</a></li>
		</ul>
	    </nav>
	 </section>
      </section>
      <!-- CORPO -->
      <section class="corpo">
         <section class="conteudo">
            <center> <br> <hr>
	       <?php
	          include 'dados.php';
		  echo "<br><br><hr><br>";
		  //include 'paineloficinas.php';
		  echo "<br><br><hr><br>";
		  include 'meusresumos.php';
		  echo "<br><br><hr><br>";
		  if($_GET["trabalho"]==""){
		     //include 'enviarresumo.php';
		     echo "<h3><span class='vermelho'>
		     SUBMISSÕES DE TRABALHOS ENCERRADAS
		     </span></h3><br><br><br>";
		  }else{
		     $_SESSION["trabalho"]=$_GET["trabalho"];
		     include 'editarresumo.php';
		  }
		?>
	 </section>
      </section>

      <!-- RODAPE -->
      <?php include 'footer.php'; ?>
      <div class="clear"></div>
    </div>
  </body>
</html>
