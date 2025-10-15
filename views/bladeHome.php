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
?>