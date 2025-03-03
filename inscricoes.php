<!DOCTYPE html>
<html>
<head>
    <title>Inscrições - SEI 2016 - Câmpus Francisco Beltrão</title>

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
              <!-- INSCRIÇÕES -->
              <section class="inscricoes">
                  <h1>Inscrições</h1><div class="detalhe"></div><br>
                  <!-- FORM INSCRIÇÕES -->
                  <section class="form_inscricoes">
                      <form action="" method="post">
                          <input type="text" name="nome" required placeholder="Nome completo..." class="nome" autofocus /><br><br>
                          <input type="email" name="email" required placeholder="Email..." class="email" autofocus /><br><br>
                          <input type="number" name="ra" required placeholder="RA..." class="ra" autofocus /><br><br>
                          <input type="password" name="senha" required placeholder="Senha..." class="ra" /><br><br>
                          <input type="password" name="r_senha" required placeholder="Repita a Senha..." class="r_senha" /><br><br>
                          <input type="text" name="campus" required placeholder="Em qual Câmpus da UTFPR você estuda?..." class="campus" /><br><br>
                          <input type="submit" name="btn_cad" class="btn btn-cad" value="Inscrever-se" />
                      </form>
                  </section>
                  <!-- INFOS INSCRIÇÕES -->
                  <section class="info_inscricoes">
                      <h3>Informações</h3><div class="detalhe"></div><br>
                      Os nomes e endereços informados neste seminário serão usados exclusivamente para os serviços prestados por este evento, não sendo disponibilizados para outras finalidades ou a terceiros.<br><br>
                      <a href="login.php">Já se increveu? Clique aqui para fazer Login!</a><br>
                      <a href="submissao.php">Submeter trabalho</a>
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
