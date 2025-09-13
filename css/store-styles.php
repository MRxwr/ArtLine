<?php
require_once("../admin/includes/config.php");
require_once("../admin/includes/functions.php");

// Set content type to CSS
header("Content-type: text/css");

// Get store colors
$storeColors = getStoreColors();
$websiteColor = $storeColors["websiteColor"] ?? "#000000";
$headerButton = $storeColors["headerButton"] ?? "#FFFFFF";
?>

/* Store-specific styles */
:root {
    --website-color: <?php echo $websiteColor; ?>;
    --header-button-color: <?php echo $headerButton; ?>;
}

/* Override specific elements */
.header {
    background-color: var(--website-color) !important;
    border: 1px solid var(--website-color) !important;
}

.join-btn {
    background: var(--header-button-color) !important;
    color: var(--website-color) !important;
}

.mobile-header {
    background-color: var(--website-color) !important;
}

/* Override buttons and links */
.btn-primary {
    background-color: var(--website-color) !important;
    border-color: var(--website-color) !important;
}

.btn-outline-primary {
    color: var(--website-color) !important;
    border-color: var(--website-color) !important;
}

.btn-outline-primary:hover {
    background-color: var(--website-color) !important;
    color: var(--header-button-color) !important;
}

/* Accent colors for links */
a.accent {
    color: var(--website-color) !important;
}

/* Product box hover effects */
.product-box:hover {
    border-color: var(--website-color) !important;
}

/* Cart button */
.cart-btn {
    background-color: var(--website-color) !important;
}

/* Checkout button */
.CheckoutButton {
    background-color: var(--website-color) !important;
}

/* Form focus elements */
.form-control:focus {
    border-color: var(--website-color) !important;
    box-shadow: 0 0 0 0.2rem rgba(var(--website-color-rgb, 0, 0, 0), 0.25) !important;
}

/* Navbar active items */
.navbar-nav .nav-item.active .nav-link {
    color: var(--header-button-color) !important;
}

/* Social icons */
.social-icons a:hover {
    background-color: var(--header-button-color) !important;
    color: var(--website-color) !important;
}