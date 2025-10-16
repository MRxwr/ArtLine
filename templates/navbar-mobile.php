<div class="mobile-header fixme d-md-none d-sm-block d-block" style="background-color: <?php echo $websiteColor ?>; padding: 0px!important;">
    <nav role='navigation' style="direction: rtl !important; float:right !important; width: 100%;">
		<?php
		$langParam = direction("lang=AR","lang=ENG");
		$flagClass = direction("العربية","English");
		?>
		<div class="row m-0 w-100">	
			<div class="col-1 text-center mt-2">
				<a href="#" data-toggle="modal" data-target="#wishlist_popup" id="wishlistHeartMobile" aria-label="WishlistIcon">
					<span class="fa fa-heart mr-1" style="color:white"><label style="font-size:7px" id="wishlistTotal1">
					<?php
					if( isset($_COOKIE[$cookieSession."activity"]) ){
						$total = json_decode($_COOKIE[$cookieSession."activity"],true);
						echo sizeof($total["wishlist"]["id"]);
					}else{
						echo "0";
					}
					?>
					</label></span>
				</a>
			</div>
			
			<div class="col-10 <?php echo "text-center" //direction("text-right","text-left") ?> mt-2">
				<form method="post" action="<?php echo "{$settingsWebsite}/{$storeCode}/?v=Home" ?>">
                <input type="submit" style="color:<?php echo $headerButton ?>; font-size:24px;white-space: nowrap;background: transparent;border: 0px;direction: ltr;" value="<?php echo $settingsTitle ?>">
				</form>
			</div>
			
			<div class="col-1 text-center mt-3">
				<div id="menuToggle">
					<input type="checkbox" style="margin-top: -21px;" aria-label="menu"/>
					<span style="margin-top: -21px;"></span>
					<span></span>
					<span></span>
					<ul id="menu">
						<li><img src='<?php echo encryptImage("logos/{$settingslogo}") ?>' style="height: 200px;width: 200px;" class="rounded"alt="<?php echo $settingsTitle ?>"></li>
						<li><a href="index.php" class="active"><?php echo $mainText ?></a></li>
						<li><a href="#" data-toggle="modal" data-target="#serch_popup" aria-label='search'><?php echo direction("Track Order","تابع الطلب") ?></a></li>
						<li><a href="#" data-toggle="modal" data-target="#wishlist_popup" id="wishlistHeartMenu"><?php echo direction("Wishlist","المفضلة") ?></a></li>
						<?php if ( isset($userID) AND !empty($userID) ){ ?>
						<li><a href="#" data-toggle="modal" data-target="#editProfile_popup"><?php echo $ProfileText ?></a></li>
						<li><a href="#" data-toggle="modal" data-target="#orders_popup"><?php echo $orderText ?></a></li>
						<li><a href="logout.php" ><?php echo $logoutText ?></a></li>
						<?php
						}else{
						?>
						<li><a href="#" data-toggle="modal" class="loginClick" data-target="#login_popup"><?php echo $loginText ?></a>
						</li>
						<?php  } ?>
						<li>
						<div class="row">
							<div class="col-6">
								<?php echo currView() ?>
							</div>
							<div class="col-6 p-2">
								<a href="<?php echo $_SERVER['REQUEST_URI'].getSign().$langParam ?>" aria-label="language"><?php echo $flagClass ?></a>
							</div>
						</div>
						</li>
						<?php
						echo (isset($aboutPrivacy) AND (!empty($aboutPrivacy[0]["enAbout"]) || !empty($aboutPrivacy[0]["arAbout"]))) ? "<li><a data-toggle='modal' data-target='#about_popup' aria-label='about'>".direction("About Us","معلومات عنا")."</a></li>" : "";
						echo (isset($aboutPrivacy) AND (!empty($aboutPrivacy[0]["enPrivacy"]) || !empty($aboutPrivacy[0]["arPrivacy"]))) ? "<li><a data-toggle='modal' data-target='#privacy_popup' aria-label='privacy'>".direction("Privacy Policy","سياسة الخصوصية")."</a></li>" : "";
						echo (isset($aboutPrivacy) AND (!empty($aboutPrivacy[0]["enReturn"]) || !empty($aboutPrivacy[0]["arReturn"]))) ? "<li><a data-toggle='modal' data-target='#return_popup' aria-label='return'>".direction("Terms & Conditions","الشروط والأحكام")."</a></li>" : "";
						?>
						<li><a href="#" ><?php echo direction("Contact us","تواصل معنا") ?></a></li>
						<li>
						<ul class="social-icons pl-0 mb-0 pr-0" style="margin-top: 10px;text-align: center;">
						<?php
						if( $socialMedia = selectDB("s_media","`id` = '1'") ){
							$smIndex = ["whatsapp","snapchat","instagram","location","email"];
							$smIcon = ["fa fa-whatsapp","fa fa-snapchat","fa fa-instagram","fa fa-globe","fa fa-envelope"];
							$smURL = ["https://wa.me/","https://www.snapchat.com/add/","https://www.instagram.com/",$socialMedia[0]["location"],"mailto:"];
							for( $i = 0; $i < sizeof($smIndex); $i++ ){
								if( !empty($socialMedia[0][$smIndex[$i]]) && $socialMedia[0][$smIndex[$i]] != "#" ){
									echo "
									<li style='padding: 10px;'>
										<a style='font-size: 20px;height: 36px;width: 36px;' href='{$smURL[$i]}{$socialMedia[0][$smIndex[$i]]}' aria-label='{$smIndex[$i]}'>
											<span class='{$smIcon[$i]}' style='height: 15px; background: {$websiteColor}'></span>
										</a>
									</li>";
								}
							}
						}
						?>
						</ul>
						</li>
						<li><p class="menu-foot-link">Powered by <a href="http://www.createkuwait.com" target="_blank">Createkuwait.com</a></p></li>
					</ul>
				</div>
			</div>
		</div>
    </nav>
</div>