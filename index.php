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
		header ("LOCATION: maintenance.php");die();
	}elseif ( $maintenace[0]["status"] == 2 ){
		header ("LOCATION: busy");die();
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


/* session_start(); ?>
<?php require 'templates/header.php'; ?>
<?php require 'templates/saveOrder.php'; ?>
<style>
.marginingTheSearchBar{
	bottom: 10px;
    position: absolute;
}

@media only screen and (max-width: 1025px) {
	  .marginingTheSearchBar{
		bottom: 0px;
		position: relative;
		margin-top: 800px;
	}
	ul.social-icons {
		margin-top: 100px;
	}
}

@media only screen and (max-width: 768px) {
	  .marginingTheSearchBar{
		bottom: 0px;
		position: relative;
		margin-top: 0px;
	}
	ul.social-icons {
		margin-top: 150px;
		
	}
}

@media only screen and (max-width: 430px) {
	  .marginingTheSearchBar{
		bottom: 0px;
		position: relative;
		margin-top: 0px;
	}
	ul.social-icons {
		margin-top: 0px;
		
	}
}

@media only screen and (max-width: 380px) {
	  .marginingTheSearchBar{
		bottom: 0px;
		position: relative;
		margin-top: 0px;
	}
	ul.social-icons {
		margin-top: 20px;
		
	}
}

@media only screen and (max-width: 330px) {
	  .marginingTheSearchBar{
		bottom: 0px;
		position: relative;
		margin-top: 0px;
	}
	ul.social-icons {
		margin-top: 20px;
	}
}

.glow {
  font-size: 30px;
  color: #fff;
  text-align: center;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #000, 0 0 20px #000, 0 0 25px #000, 0 0 30px #000, 0 0 35px #000;
  }
  
  to {
    text-shadow: 0 0 10px #fff, 0 0 15px #000, 0 0 20px #000, 0 0 25px #000, 0 0 30px #000, 0 0 35px #000, 0 0 40px #000;
  }
}

@keyframes glow {
  from {
    text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #000, 0 0 20px #000, 0 0 25px #000, 0 0 30px #000, 0 0 35px #000;
  }
  
  to {
    text-shadow: 0 0 10px #fff, 0 0 15px #000, 0 0 20px #000, 0 0 25px #000, 0 0 30px #000, 0 0 35px #000, 0 0 40px #000;
  }
}


.preorder{
    font-family: 'Tajawal';
    font-size: 10px;
    color: rgb(255, 255, 255);
    line-height: 24px;
    background-color: #000000;
    padding-left: 10px;
    padding-right: 10px;
    display: inline-block;
    position: absolute;
    top: 10px;
	left: 10px;
    z-index: 3;
    border-radius: 12px;
    font-weight: 700;
}
</style>

<?php
require 'templates/slider.php';
require 'templates/coupons.php';  
if ( $theme == 1 ){
	require 'templates/bestsellers.php';   
	require 'templates/recent.php'; 
	require 'templates/mobile-menu.php';
	require 'templates/sidebar.php';
    require 'templates/main-container.php';
}else{
	require 'templates/bestsellers.php';   
	require 'templates/recent.php'; 
    require 'templates/categories.php';
}
require 'templates/footer.php'; 
*/
?>