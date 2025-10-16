<?php
session_start();
ob_start();
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");
require_once('admin/includes/config.php');
require_once('admin/includes/functions.php');
require_once('admin/includes/translate.php');
require_once('includes/checksouthead.php');
require_once("templates/saveOrder.php");
require_once("api/checkInvoice.php");

if( isset($orderId) && !empty($orderId) ){
	header("LOCATION: ?v=Details&orderId={$orderId}");die();
}

if( !isset($_GET["storeCode"]) || empty($_GET["storeCode"]) ){
	header ("LOCATION: default.php");die();
}

if( $storeDetails = selectDBNew("stores",[$_GET["storeCode"]],"`storeCode` = ?","") ){
	$storeID = $storeDetails[0]["id"];
	$storeCode = $storeDetails[0]["storeCode"];
	$headerButton = $storeDetails[0]["headerButton"];
	$websiteColor = $storeDetails[0]["websiteColor"];
	$settingsEmail = $storeDetails[0]["email"];
	$settingsPhone = $storeDetails[0]["phone"];
	$settingsTitle = $storeDetails[0]["title"];
	$settingsImage = $storeDetails[0]["bgImage"];
	$settingslogo = $storeDetails[0]["logo"];
	$showLogo = $storeDetails[0]["showLogo"];
	$settingsShippingMethod = $storeDetails[0]["shippingMethod"];
	$defaultCountry = $storeDetails[0]["country"];
	$settingsLang = (isset($storeDetails[0]["language"]) && $storeDetails[0]["language"] == "0") ? "ENG" : "AR";
	$productView = $storeDetails[0]["productView"];
	$showCategoryTitle = $storeDetails[0]["showCategoryTitle"];
	$categoryView = $storeDetails[0]["categoryView"];
	$theme = $storeDetails[0]["theme"];
}else{
	header ("LOCATION: default.php");die();
}

if ( $maintenace = selectDB("maintenance","`id` = '1'") ){
	if( $maintenace[0]["status"] == 1 ){
		if( !isset($_GET["v"]) || ( isset($_GET["v"]) && $_GET["v"] != "Maintenance" ) ){
			// Allow access to maintenance page only \\
			header ("LOCATION: ?v=Maintenance");die();
		}
	}elseif ( $maintenace[0]["status"] == 2 ){
		// Allow access to busy page only \\
		if( !isset($_GET["v"]) || ( isset($_GET["v"]) && $_GET["v"] != "Busy" ) ){
			header ("LOCATION: ?v=Busy");die();
		}
	}
}

require_once("templates/header.php");
// get viewed page from pages folder \\
if( isset($_GET["v"]) && searchFile("views","blade{$_GET["v"]}.php") ){
	require_once("views/".searchFile("views","blade{$_GET["v"]}.php"));
}else{
	require_once("views/bladeHome.php");
}
require_once("templates/footer.php");
?>