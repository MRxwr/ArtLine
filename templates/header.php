<?php
ob_start();
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");
if( !isset($_GET["storeCode"]) || empty($_GET["storeCode"]) ){
	header ("LOCATION: default.php");die();
}
require ('admin/includes/config.php');
require ('admin/includes/functions.php');
require ('admin/includes/translate.php');
require ('includes/checksouthead.php');
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
$maintenace = selectDB("maintenance","`id` = '1'");
if ( $maintenace[0]["status"] == 1 ){
    header ("LOCATION: maintenance.php");
}elseif ( $maintenace[0]["status"] == 2 ){
    header ("LOCATION: busy");
}

if( $aboutPrivacy = selectDB("s_media","`id` = '3'") ){}
if( isset($_GET["curr"]) && !empty($_GET["curr"]) ){
	setCurr($_GET["curr"]);
	?>
	<script>
		window.location.href = "<?php echo str_replace("?curr={$_GET["curr"]}", "" ,str_replace("&curr={$_GET["curr"]}", "", $_SERVER['REQUEST_URI'])) ?>";
	</script>
	<?php
}

$fontLink = direction('<link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300&display=swap" rel="stylesheet">','<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">');
$fontFamily = direction("'Signika Negative', sans-serif;","'Cairo', sans-serif;");
$fontImport = direction("@import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300&display=swap');","@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap');");
?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo $directionHTML ?>">
	<head>
		<meta property="og:title" content="<?php echo $settingsTitle ?>">
		<meta property="og:url" content="<?php echo $settingsWebsite ?>">
		<meta property="og:description" content="<?php echo $settingsOgDescription ?>">
		<meta property="og:image" content="<?php echo encryptImage("logos/{$settingslogo}") ?>">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="theme-color" content="<?php echo $websiteColor ?>" />
		<link href="<?php echo encryptImage("logos/{$settingslogo}") ?>" rel="shortcut icon" />
		<title><?php echo $settingsTitle ?></title>
		<meta name="description" content="<?php echo $settingsOgDescription ?>">
		<meta name="keywords" content="<?php echo $settingsOgDescription ?>">
		<link rel="shortcut icon" href="<?php echo encryptImage("logos/{$settingslogo}") ?>" type="image/x-icon">
		<link rel="apple-touch-icon" href="<?php echo encryptImage("logos/{$settingslogo}") ?>">
		<link href="css/bootstrap.min.css?<?php echo randLetter() . "=" . rand(0,9) ?>" rel="stylesheet">
		<link href="css/owl.carousel.min.css?<?php echo randLetter() . "=" . rand(0,9) ?>" rel="stylesheet">
		<link href="css/bootstrap-select.min.css?<?php echo randLetter() . "=" . rand(0,9) ?>" rel="stylesheet">
		<link href="css/flag-icon.min.css?<?php echo randLetter() . "=" . rand(0,9) ?>" rel="stylesheet">
		<link href="css/jquery-ui.css?<?php echo randLetter() . "=" . rand(0,9) ?>" rel="stylesheet">
		<link href="css/custome.css?<?php echo randLetter() . "=" . rand(0,9) ?>" rel="stylesheet">
		<link href="css/responsive.css?<?php echo randLetter() . "=" . rand(0,9) ?>" rel="stylesheet">
		<link href="css/font-awesome.css?<?php echo randLetter() . "=" . rand(0,9) ?>" rel="stylesheet">
		<link href="css/animate.min.css?<?php echo randLetter() . "=" . rand(0,9) ?>" rel="stylesheet">
		<link href="css/jquery.fancybox.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<?php echo $fontLink ?>
		<link rel="manifest" href="manifest.json">
		<script src="js/jquery-3.3.1.slim.min.js" ></script>
		<script src="js/jquery-1.11.1.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/cookie.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/wow.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/jquery.fancybox.min.js"></script>
		<script src="https://kit.fontawesome.com/123faab6fe.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		<script src="js/main.js?y=<?php echo md5(time()) ?>"></script>
		<?php
		if( isset($googleCode) && !empty($googleCode) ){
			echo $googleCode;
		}
		if( isset($pixilCode) && !empty($pixilCode) ){
			echo $pixilCode;
		}
		?>
	</head>
	<style>
		<?php echo $fontImport ?>
		body {
			font-family: <?php echo $fontFamily ?>;
			padding:0 !important;
		}
		.join-btn {
			background: <?php echo $headerButton ?>;
			color: <?php echo $websiteColor ?>;
			padding: 0.4rem 1.2rem;
			border-radius: 6px;
		}
	</style>
	<?php echo require_once("css/storeColors.php"); ?>
	<body class="rtl <?php echo $directionBODY ?>" id="body">

	<div class="loading-screen">
		<div class="loader"></div>
	</div>

	<div class="v-body">

	<?php require_once("templates/navbar.php"); ?>
	<?php require_once("templates/navbar-mobile.php"); ?>



