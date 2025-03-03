<?php

include("conexao.php");

$sql = mysql_query("SELECT * FROM 2016_trabalhos");
while($m = mysql_fetch_array($sql)){
    $source = "../trabalhos/".$m["trabalho_sem_nome"];

    $hashnovo = md5($source . date());
    $target = explode("/", $source);
    $target = "../trabalhos/".$target[2]."/".$target[3]."/".$hashnovo.".pdf";

    echo $source."<br>";
    echo $target."<br>";

    echo "hash antigo: ". $m["hash"] . "<br>";
    echo "hash novo: ". $hashnovo . "<br>";

    if($m["hash"]!=$hashnovo) echo "igual<br><br><br>";
    else "ERRROOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO";
    
/*    $insere = mysql_query("UPDATE 2016_trabalhos SET trab_cript_novo='$target' WHERE id=".$m["id"]);
    if($insere){
        echo "Step 1 - Passed<br><br>";
        $co = copy($source, $target);
        echo $co;
    }
    */
}
?>
