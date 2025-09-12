<?php
/**
 * Generate HTML for a product card
 * @param array $product Product data from API
 * @param array $options Optional settings for card display
 * @return string HTML for the product card
 */
function generateProductCard($product, $options = []) {
    // Return empty string if product data is invalid
    if (empty($product) || !is_array($product) || empty($product['id'])) {
        return '';
    }
    
    // Default options
    $defaultOptions = [
        'showBrand' => true,
        'showDiscount' => true,
        'cardClass' => 'col-6 col-md-4 col-lg-3 mb-4',
        'imageHeight' => '200px'
    ];
    
    $options = array_merge($defaultOptions, $options);
    
    // Extract product data
    $productId = $product['id'] ?? '';
    $attributeId = $product['attributeId'] ?? '';
    $title = $product['productTitle'] ?? 'Product';
    $brand = $product['brandTitle'] ?? '';
    $category = $product['categoryTitle'] ?? '';
    $price = floatval($product['price'] ?? 0);
    $finalPrice = floatval($product['finalPrice'] ?? $price);
    $image = $product['image'] ?? '';
    $flag = $product['flag'] ?? '';
    $isLiked = ($product['isLiked'] ?? 0) == 1;
    $quantity = intval($product['quantity'] ?? 0);
    
    // Check for discount
    $hasDiscount = $price > $finalPrice && $finalPrice > 0;
    $discountPercent = $hasDiscount ? round((($price - $finalPrice) / $price) * 100) : 0;
    
    // Handle image URL
    $imageUrl = $GLOBALS['base_url'] . "assets/img/logoPlaceholder.svg";
    if (!empty($image)) {
        $imageUrl = $image; // Use full URL from API
    }
    
    // Start building HTML
    ob_start();
    ?>
    <div class="<?php echo htmlspecialchars($options['cardClass']); ?>">
        <div class="card h-100 product-card" 
             data-product-id="<?php echo htmlspecialchars($productId); ?>" 
             data-attribute-id="<?php echo htmlspecialchars($attributeId); ?>" 
             style="cursor: pointer; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            
            <!-- Product Image Container -->
            <div class="position-relative">
                <!-- Favorite Button on Image -->
                <form method="post" action="index.php?v=ToggleFavorite" class="position-absolute top-0 end-0 m-2" style="z-index: 3;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($productId); ?>">
                    <?php if (!empty($attributeId)): ?>
                        <input type="hidden" name="attributeId" value="<?php echo htmlspecialchars($attributeId); ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-sm p-1" style="background: rgba(255,255,255,0.9); border: none; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                        <?php echo $isLiked ? '❤️' : '🤍'; ?>
                    </button>
                </form>
                
                <!-- Brand Badge on Image -->
                <?php if ($options['showBrand'] && !empty($brand)): ?>
                    <span class="badge bg-dark position-absolute top-0 start-0 m-2" style="z-index: 2; font-size: 0.7rem; white-space: nowrap; max-width: fit-content;">
                        <?php echo htmlspecialchars($brand); ?>
                    </span>
                <?php endif; ?>
                
                <!-- Special Flag -->
                <?php if (!empty($flag)): ?>
                    <span class="badge bg-warning position-absolute" style="top: 30px; right: 8px; z-index: 2; font-size: 0.65rem;">
                        <?php echo htmlspecialchars($flag); ?>
                    </span>
                <?php endif; ?>
                
                <!-- Product Image -->
                <img src="<?php echo htmlspecialchars($imageUrl); ?>" 
                     class="card-img-top" 
                     alt="<?php echo htmlspecialchars($title); ?>"
                     style="height: <?php echo $options['imageHeight']; ?>; object-fit: cover; border-radius: 8px 8px 0 0;">
            </div>

            <!-- Card Body -->
            <div class="card-body p-3 d-flex flex-column">
                <!-- Product Title (2 lines max) -->
                <h6 class="card-title mb-1" 
                    style="font-size: 0.85rem; line-height: 1.3; height: 2.6rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; line-clamp: 2; -webkit-box-orient: vertical;"
                    title="<?php echo htmlspecialchars($title); ?>">
                    <?php 
                    $truncatedTitle = strlen($title) > 36 ? substr($title, 0, 36) . '...' : $title;
                    echo htmlspecialchars($truncatedTitle); 
                    ?>
                </h6>
                
                <!-- Category -->
                <?php if (!empty($category)): ?>
                    <small class="text-muted mb-1" style="font-size: 0.7rem;">
                        <?php echo htmlspecialchars($category); ?>
                    </small>
                <?php endif; ?>
                
                <!-- Price Section -->
                <div class="mt-auto">
                    <?php if ($hasDiscount): ?>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold text-danger" style="font-size: 0.9rem;">
                                    <?php echo number_format($finalPrice, 3); ?> KWD
                                </span>
                                <small class="text-muted text-decoration-line-through" style="font-size: 0.75rem;">
                                    <?php echo number_format($price, 3); ?> KWD
                                </small>
                                <span class="badge bg-danger" style="font-size: 0.6rem;">
                                    -<?php echo $discountPercent; ?>%
                                </span>
                            </div>
                            <!-- Add to Cart Button -->
                            <?php if ($quantity > 0): ?>
                                <form method="post" action="index.php?v=AddToCart">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($productId); ?>">
                                    <?php if (!empty($attributeId)): ?>
                                        <input type="hidden" name="attributeId" value="<?php echo htmlspecialchars($attributeId); ?>">
                                    <?php endif; ?>
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; padding: 0; border-radius: 50%;">
                                        <svg width="12" height="12" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                    </button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled style="width: 28px; height: 28px; padding: 0; border-radius: 50%; font-size: 0.6rem;">
                                    ✕
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-bold text-primary" style="font-size: 0.9rem;">
                                <?php echo number_format($finalPrice, 3); ?> KWD
                            </span>
                            <!-- Add to Cart Button -->
                            <?php if ($quantity > 0): ?>
                                <form method="post" action="index.php?v=AddToCart">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($productId); ?>">
                                    <?php if (!empty($attributeId)): ?>
                                        <input type="hidden" name="attributeId" value="<?php echo htmlspecialchars($attributeId); ?>">
                                    <?php endif; ?>
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; padding: 0; border-radius: 50%;">
                                        <svg width="12" height="12" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                    </button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled style="width: 28px; height: 28px; padding: 0; border-radius: 50%; font-size: 0.6rem;">
                                    ✕
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Generate HTML for multiple product cards
 * @param array $products Array of product data
 * @param array $options Optional settings for card display
 * @return string HTML for all product cards
 */
function generateProductCards($products, $options = []) {
    // Return empty string if no valid products
    if (empty($products) || !is_array($products)) {
        return '';
    }
    
    $html = '';
    foreach ($products as $product) {
        // Only generate cards for valid products
        if (!empty($product) && is_array($product) && !empty($product['id'])) {
            $html .= generateProductCard($product, $options);
        }
    }
    return $html;
}

/**
 * Generate JavaScript for product card click functionality
 * @return string JavaScript code for product card interactions
 */
function getProductCardScript() {
    return '
<script>
// Function to navigate to product detail page
function goToProduct(productId, attributeId) {
    const form = document.createElement("form");
    form.method = "post";
    form.action = "index.php?v=Product";
    
    const idInput = document.createElement("input");
    idInput.type = "hidden";
    idInput.name = "id";
    idInput.value = productId;
    form.appendChild(idInput);
    
    if (attributeId) {
        const attrInput = document.createElement("input");
        attrInput.type = "hidden";
        attrInput.name = "attributeId";
        attrInput.value = attributeId;
        form.appendChild(attrInput);
    }
    
    document.body.appendChild(form);
    form.submit();
}

// Add click event handlers to product cards
document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("click", function(e) {
        const productCard = e.target.closest(".product-card");
        if (productCard && !e.target.closest("form") && !e.target.closest("button")) {
            e.preventDefault();
            const productId = productCard.getAttribute("data-product-id");
            const attributeId = productCard.getAttribute("data-attribute-id");
            if (productId) {
                goToProduct(productId, attributeId);
            }
        }
    });
});
</script>';
}
?>
