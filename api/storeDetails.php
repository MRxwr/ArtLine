<?php
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
	$giftCard = $storeDetails[0]["giftCard"];
	$emailOpt = $storeDetails[0]["emailOpt"];
	$storeAddress = $storeDetails[0]["noAddress"];
	$settingsDTime = $storeDetails[0]["enDeveliveryTime"];
	$settingsDTimeAr = $storeDetails[0]["arDeveliveryTime"];
	$PaymentAPIKey = $storeDetails[0]["PaymentAPIKey"];
	$storeSocialMediaLinks = json_decode($storeDetails[0]["socialMedia"], true);
}else{
	header ("LOCATION: default.php");die();
}
?>

