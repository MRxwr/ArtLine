<?php
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/translate.php';
setcookie($cookieSession."A", "", time() - (86400*30 ), "/");
session_start ();
if ( session_destroy() )
{
	header("Location: login.php");die();
}
?>