<?php
if( isset($_GET["id"]) && !empty($_GET["id"]) ){
	if( $category = selectDBNew("categories",[$_GET["id"]],"`id` = ?","") ){
		if( !empty($category[0]["header"]) ){
			$settingsImage = $category[0]["header"];
		}
	}
}
?>
<div class="main-slider" style="background-image: url(&quot;<?php echo encryptImage("logos/{$settingsImage}") ?>&quot;); margin-top:25px !important;margin-bottom: 10px !important">
    <div class="slider-text-div">
        <div class="row d-flex justify-content-center text-center" style="margin-left:0; margin-right:0;">
            <div class="col-12" style="<?php echo showLogo() ?>">
                <img src="<?php echo encryptImage("logos/{$settingslogo}") ?>" class="img-fluid slider-logo" style="border-radius: 10.25rem!important;">
                <h1></h1>
                <p style="font-size:18px">
                 </p>
            </div>
            <div class="col-12 d-none">
                <?php
                if ( isset($_GET["error"]) AND $_GET["error"] == 1 ){
                    echo "<p style='font-size:18px; color:red'>{$wrongOrderNumberPleaseCheckAgain}</p>";
                }
                ?>
                <div class="search-box d-flex align-items-center">
                    <span class="cat"><?php echo $orderNumberText ?></span>
                    <div class="form-group mb-0">
                        <form method="get" action="order">
                            <input type="text" class="form-control" name="orderId" placeholder="" required>
                            <button class="btn search-btn" style="padding: 0.8rem 45px;"><span class="fa fa-search mr-2"></span><?php echo $orderStatusText ?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <ul class="social-icons pl-0 mb-0 pr-0" style="margin-top: 0rem!important;">
                    <!-- $socialMedia loop through it and get all available social media -->
                     
                    <?php
                    var_dump($storeSocialMediaLinks);
					if( isset($storeSocialMediaLinks) && !empty($storeSocialMediaLinks) && is_array($storeSocialMediaLinks) ){
						$smIndex = ["phone","whatsapp","email","snapchat","tiktok","instagram","twitter","facebook","location"];
						$smIcon = ["fa fa-phone","fa fa-whatsapp","fa fa-envelope","fa fa-snapchat","fa fa-tiktok","fa fa-instagram","fa fa-twitter","fa fa-facebook","fa fa-map-marker"];
						$smURL = ["tel:","https://wa.me/","mailto:","https://www.snapchat.com/add/","https://www.tiktok.com/@","https://www.instagram.com/","https://twitter.com/","https://facebook.com/",""]; 
						
						for( $i = 0; $i < sizeof($smIndex); $i++ ){
							if( isset($storeSocialMediaLinks[$smIndex[$i]]) && !empty($storeSocialMediaLinks[$smIndex[$i]]) && $storeSocialMediaLinks[$smIndex[$i]] != "#" ){
								// For location, use the value directly; for others, concatenate with URL
								$link = ($smIndex[$i] == "location") ? $storeSocialMediaLinks[$smIndex[$i]] : $smURL[$i] . $storeSocialMediaLinks[$smIndex[$i]];
								echo "
								<li>
									<a href='{$link}' aria-label='{$smIndex[$i]}' target='_blank'>
										<span class='{$smIcon[$i]}'></span>
									</a>
								</li>";
							}
						}
					}
					?>
                </ul>
            </div>
        </div>
    </div>
</div>