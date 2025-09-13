<?php
// Admin script to update colors for all stores
require_once("../includes/config.php");
require_once("../includes/functions.php");

// Check if admin is logged in
// Add your admin authentication check here

// Default colors
$defaultWebsiteColor = "#000000"; 
$defaultHeaderButton = "#FFFFFF";

// Get colors from settings
if ($settings = selectDB("settings", "`id` = '1'")) {
    $defaultWebsiteColor = $settings[0]["websiteColor"] ?? $defaultWebsiteColor;
    $defaultHeaderButton = $settings[0]["headerButton"] ?? $defaultHeaderButton;
}

// Update all stores that don't have colors set
$stores = selectDB("stores", "`status` = '0'");
$updatedStores = 0;

if ($stores) {
    foreach ($stores as $store) {
        $updates = [];
        
        // Check if website color is empty
        if (empty($store["websiteColor"])) {
            $updates["websiteColor"] = $defaultWebsiteColor;
        }
        
        // Check if header button is empty
        if (empty($store["headerButton"])) {
            $updates["headerButton"] = $defaultHeaderButton;
        }
        
        // Update only if there are changes to make
        if (!empty($updates)) {
            updateDB("stores", $updates, "`id` = '{$store["id"]}'");
            $updatedStores++;
        }
    }
}

echo "Updated colors for {$updatedStores} stores.";
?>