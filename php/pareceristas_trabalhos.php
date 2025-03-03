<meta charset="utf8" />
<?php
include("conexao.php");

function atribuirCampus(){
    $p1 = mysql_query("SELECT id, campus FROM 2016_participantes");
    while($p = mysql_fetch_array($p1)){
        $t = mysql_query("UPDATE 2016_trabalhos set id_campus=".$p["campus"]." WHERE id_participante=".$p["id"]);
        if($t){
            echo "Feito... ";
        }else{
            echo "nao";
        }
    }
}

function atribuirParecerista(){
    $p1 = mysql_query("SELECT id, campus, ids_areas FROM 2016_participantes WHERE tipo='parecerista' ORDER BY ids_areas");
    while($p = mysql_fetch_array($p1)){
        $id = $p["id"];
        $ids_areas = explode(" ", $p["ids_areas"]);
        for($i = 0; $i < sizeof($ids_areas)-1; $i++){
            //mostra ids das areas
            echo "id_parecerista = " .$id. "/ ids_areas=" . $ids_areas[$i]." - ";

            $t1 = mysql_query("SELECT id, id_campus, id_area FROM 2016_trabalhos WHERE id_area=". $ids_areas[$i] . " AND id_campus!=".$p["campus"] . " AND id_parecerista=0");
            $t = mysql_fetch_array($t1);
     
            
            echo "Esse " . $ids_areas[$i] . " é igual a esse " . $t["id_area"] . ": Trabalho " . $t["id"]  ."- Campus do Trabalho: " .$t["id_campus"]. " <> Campus Parecerista: " . $p["campus"]."<> <br>";

    
                   mysql_query("UPDATE 2016_trabalhos SET id_parecerista=$id WHERE id=" . $t["id"] ) ;
        }
        
    }
}

atribuirParecerista();
?>