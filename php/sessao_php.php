<?php
@session_start();
if($_SESSION["id"]==""){
	$_SESSION["erro"]="";
	header("location: ../login.php#login");
}
