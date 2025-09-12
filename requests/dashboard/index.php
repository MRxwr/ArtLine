<?php 
header("Content-Type: application/json; charset=UTF-8");
require_once("../../admin/includes/config.php");
require_once("../../admin/includes/functions.php");

if( isset($_SERVER['HTTP_AUTHORIZATION']) && !empty($_SERVER['HTTP_AUTHORIZATION']) ){
    $token = str_replace("Bearer ","",$_SERVER["HTTP_AUTHORIZATION"]);
	if ( $settings = selectDB("settings","`id` = '1'") ){
		$checkToken = $settings[0]["whatsappToken"];
		if( $token != $checkToken ){
			echo outputError(array("msg" => "Unauthorized"));
			exit;
		}
	}
}

// get viewed page from pages folder \\
if( isset($_GET["a"]) && searchFile("views","api{$_GET["a"]}.php") ){
	require_once("views/".searchFile("views","api{$_GET["a"]}.php"));
}else{
	echo outputError(array("msg" => "404 api Not Found"));
}
?>