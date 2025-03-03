<!DOCTYPE html>
<html>
<head>
    <title>Acesso - SEI 2016 - Câmpus Francisco Beltrão</title>

    <!-- META TAGS -->
    <?php include "inc/meta.php"; ?>
</head>

    <body>
      <!--TOPO -->
      <?php
          include "inc/topo.php";
      ?>
      <div class="clear"></div>

      <!-- CORPO -->
      <section class="corpo">
          <section class="conteudo">
              <!-- LOGIN -->
              <section class="login">
                  <h1>Acesso</h1><div class="detalhe"></div><br>
                  <!-- FORM LOGIN -->
                  <section class="form_login">
                      <form action="" method="post">
                          <input type="email" name="email" required placeholder="Email..." class="email" autofocus /><br><br>
                          <input type="password" name="senha" required placeholder="Senha..." class="senha" /><br><br>
                          <input type="submit" name="btn_logar" class="btn btn-logar" value="Logar" />
                      </form>
                  </section>
                  <!-- INFOS LOGIN -->
                  <section class="info_login">
                      <h3>Informações</h3><div class="detalhe"></div><br>
                      <a href="inscricoes.php">Não se inscreveu? Clique aqui para se inscrever-se!</a><br>
                      <a href="#">Esqueci minha senha</a>
                  </section>
              </section>
          </section>
      </section>
      <div class="clear"></div>

      <!-- RODAPÉ -->
      <?php
          include "inc/rodape.php";
      ?>
      <div class="clear"></div>
    </body>
</html>
