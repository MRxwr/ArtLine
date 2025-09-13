<?php session_start(); ?>
<?php require 'templates/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">Select Store</h1>
            
            <div class="row">
                <?php
                // Get list of stores
                if ($stores = selectDB("stores", "`status` = '0'")) {
                    foreach ($stores as $store) {
                        $websiteColor = $store["websiteColor"] ?? "#000000";
                        $headerButton = $store["headerButton"] ?? "#FFFFFF";
                        
                        echo '<div class="col-md-4 mb-4">
                            <div class="card" style="border-color: '.$websiteColor.';">
                                <div class="card-header" style="background-color: '.$websiteColor.'; color: '.$headerButton.';">
                                    '.$store["title"].'
                                </div>
                                <div class="card-body">
                                    <p><strong>Email:</strong> '.$store["email"].'</p>
                                    <p><strong>Phone:</strong> '.$store["phone"].'</p>
                                    <div style="display: flex; margin-bottom: 10px;">
                                        <div style="width: 30px; height: 30px; background-color: '.$websiteColor.'; margin-right: 10px; border: 1px solid #ddd;"></div>
                                        <div style="width: 30px; height: 30px; background-color: '.$headerButton.'; border: 1px solid #ddd;"></div>
                                    </div>
                                    <a href="index.php?storeID='.$store["id"].'" class="btn" style="background-color: '.$websiteColor.'; color: '.$headerButton.';">Select This Store</a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<div class="col-12"><p class="text-center">No stores found</p></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php require 'templates/footer.php'; ?>