<?php
session_start();
echo "<h4 style='text-align: center; color:#008F44'>".$_SESSION["mensagem"]."</h4><br />";
$_SESSION["mensagem"]="";
?>

<script>
var iguais=true;
function vsenha(senha, repitasenha){
  if(senha!=repitasenha){
    document.getElementById("vsenhared").innerHTML="senhas diferentes";
    document.getElementById("vsenhagreen").innerHTML="";
    iguais=false;
  }else{
    document.getElementById("vsenhagreen").innerHTML="Senhas iguais";
    document.getElementById("vsenhared").innerHTML="";
    iguais=true;
  }
}

</script>

<form method="POST" action="inscricao.php" id="formulario">

        <input type="text" name="nome" class="nome" placeholder="NOME COMPLETO" required/><br><br>
                    
        <input type="number" name="ra" class="nome" placeholder="RA, CASO ALUNO - EM BRANCO, CASO VISITANTE"/><br><br>
        
        <input type="text" name="cpf" class="cpf" placeholder="CPF" onBlur="ValidarCPF(formulario.cpf);"
onKeyPress="MascaraCPF(formulario.cpf);" maxlength="14" required /><br><br>
         
        <input type="email" name="email" class="email" placeholder="EMAIL" required /><br><br>
        
        <input  value="" type="password" id="senha" name="senha" class="email" placeholder="Senha..." onkeyup="vsenha(document.getElementById('repitasenha').value, this.value)" required /><br><br>
        
        <input  value="" type="password" id="repitasenha" name="repitasenha" class="email" placeholder="Repita Senha..." onkeyup="vsenha(document.getElementById('senha').value, this.value)" required  />
        
        <span id='vsenhared' class='vermelho'></span>
        <span id='vsenhagreen' class='verde'></span><br><br>

        <input type="text" name="instituicao" class="instituicao" placeholder="CAMPUS" required /><br /><br>

        <input type="text" name="cidade" class="cidade" placeholder="CIDADE" required /><br>

        <select name="estado" class="estado" required>
    <option value="AC">Acre</option>
    <option value="AL">Alagoas</option>
    <option value="AM">Amazonas</option>
    <option value="AP">Amapá</option>
    <option value="BA">Bahia</option>
    <option value="CE">Ceará</option>
    <option value="DF">Distrito Federal</option>
    <option value="ES">Espirito Santo</option>
    <option value="GO">Goiás</option>
    <option value="MA">Maranhão</option>
    <option value="MG">Minas Gerais</option>
    <option value="MS">Mato Grosso do Sul</option>
    <option value="MT">Mato Grosso</option>
    <option value="PA">Pará</option>
    <option value="PB">Paraíba</option>
    <option value="PE">Pernambuco</option>
    <option value="PI">Piauí</option>
    <option value="PR" selected>Paraná</option>
    <option value="RJ">Rio de Janeiro</option>
    <option value="RN">Rio Grande do Norte</option>
    <option value="RO">Rondônia</option>
    <option value="RR">Roraima</option>
    <option value="RS">Rio Grande do Sul</option>
    <option value="SC">Santa Catarina</option>
    <option value="SE">Sergipe</option>
    <option value="SP">São Paulo</option>
    <option value="TO">Tocantins</option>
</select>

<br><br>
<!--h3>Escolha sua oficina abaixo:</h3-->
	<?php
		//include("oficinas.php");
	?>
  <br><br>

  <center><input onclick="if(cpferrado){ alert('CPF inválido'); return false; }" type="submit" name="btn_cadastrar" class="btn_cadastrar" value="Cadastrar" /></center><br />
                </form>
