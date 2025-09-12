/**
 * Post Forms Handling Script
 * 
 * This script converts GET links to POST forms for product, category, and brand links
 * while keeping the 'v' parameter in the URL as GET
 */

document.addEventListener('DOMContentLoaded', function() {
    // Add console log to check if the script is loaded
    console.log('Post-forms script loaded');
    
    // Handle product links
    const productLinks = document.querySelectorAll('.product-link');
    console.log('Found ' + productLinks.length + ' product links');
    
    productLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Product link clicked', this);
            
            // Get the product ID from data attribute
            const productId = this.getAttribute('data-product-id');
            // Get attribute ID if available
            const attributeId = this.getAttribute('data-attribute-id');
            
            // Create form element
            const form = document.createElement('form');
            form.method = 'post';
            form.action = 'index.php?v=Product'; // Keep v as GET parameter
            
            // Create input for product ID
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = productId;
            form.appendChild(idInput);
            
            // Add attribute ID if available
            if (attributeId) {
                const attrInput = document.createElement('input');
                attrInput.type = 'hidden';
                attrInput.name = 'attributeId';
                attrInput.value = attributeId;
                form.appendChild(attrInput);
            }
            
            // Append form to body and submit it
            document.body.appendChild(form);
            form.submit();
        });
    });
    
    // Handle category links
    document.querySelectorAll('.category-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the category ID from data attribute
            const categoryId = this.getAttribute('data-category-id');
            
            // Create form element
            const form = document.createElement('form');
            form.method = 'post';
            form.action = 'index.php?v=Search'; // Keep v as GET parameter
            
            // Create input for category ID
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'categoryId';
            idInput.value = categoryId;
            form.appendChild(idInput);
            
            // Append form to body and submit it
            document.body.appendChild(form);
            form.submit();
        });
    });
    
    // Handle brand links
    document.querySelectorAll('.brand-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the brand ID from data attribute
            const brandId = this.getAttribute('data-brand-id');
            
            // Create form element
            const form = document.createElement('form');
            form.method = 'post';
            form.action = 'index.php?v=Search'; // Keep v as GET parameter
            
            // Create input for brand ID
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'brandId';
            idInput.value = brandId;
            form.appendChild(idInput);
            
            // Append form to body and submit it
            document.body.appendChild(form);
            form.submit();
        });
    });
});
