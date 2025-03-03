<?php
@session_start();

$link = $_GET["hashtrab"];

if($_SESSION["id"]==""){
	$_SESSION["erro"]="";

    if($link=="")
        header("location: login.php#login");
    else
        header("location: login.php?link=$link#login");
}
