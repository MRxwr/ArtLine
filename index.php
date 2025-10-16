<?php
session_start();
ob_start();
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");
require_once('admin/includes/config.php');
require_once('admin/includes/functions.php');
require_once('admin/includes/translate.php');
require_once("api/storeDetails.php");
require_once('includes/checksouthead.php');
require_once("templates/saveOrder.php");
require_once("api/checkInvoice.php");

// check Maintenace
maintenanceMode();

require_once("templates/header.php");
// get viewed page from pages folder \\
if( isset($_GET["v"]) && searchFile("views","blade{$_GET["v"]}.php") ){
	require_once("views/".searchFile("views","blade{$_GET["v"]}.php"));
}else{
	require_once("views/bladeHome.php");
}
require_once("templates/footer.php");
?>