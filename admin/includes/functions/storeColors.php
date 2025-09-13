<?php
/**
 * Functions for managing store-specific colors and styles
 */

/**
 * Get store colors based on the current store or default colors if not set
 * 
 * @return array Array containing website color and header button color
 */
function getStoreColors() {
    global $dbconnect, $cookieSession;
    
    // Default colors from settings
    $defaultColors = selectDB("settings", "`id` = '1'");
    $colors = [
        "websiteColor" => $defaultColors[0]["websiteColor"] ?? "#000000",
        "headerButton" => $defaultColors[0]["headerButton"] ?? "#FFFFFF"
    ];
    
    // If a storeID parameter is passed in the URL, set it as the current store
    if (isset($_GET['storeID']) && !empty($_GET['storeID'])) {
        setCurrentStore($_GET['storeID']);
    }
    
    // Check if store-specific cookie exists
    if (isset($_COOKIE[$cookieSession."StoreID"]) && !empty($_COOKIE[$cookieSession."StoreID"])) {
        $storeId = $_COOKIE[$cookieSession."StoreID"];
        
        // Get store-specific colors
        if ($storeColors = selectDB("stores", "`id` = '{$storeId}'")) {
            $colors["websiteColor"] = $storeColors[0]["websiteColor"] ?? $colors["websiteColor"];
            $colors["headerButton"] = $storeColors[0]["headerButton"] ?? $colors["headerButton"];
        }
    }
    
    return $colors;
}

/**
 * Generate CSS variables for the current store
 * 
 * @return string CSS variables declaration
 */
function getStoreColorCSS() {
    $colors = getStoreColors();
    
    return "
    :root {
        --website-color: {$colors['websiteColor']};
        --header-button-color: {$colors['headerButton']};
    }";
}

/**
 * Set the current store for the session
 * 
 * @param int $storeId Store ID to set
 * @return bool Success status
 */
function setCurrentStore($storeId) {
    global $cookieSession;
    
    if (!empty($storeId)) {
        setcookie($cookieSession."StoreID", $storeId, time() + (86400*30), "/");
        return true;
    }
    
    return false;
}