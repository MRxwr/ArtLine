<div class="header fixme d-md-block d-sm-none d-none" style="background-color: <?php echo $websiteColor ?>;border: 1px solid <?php echo $websiteColor ?>;">
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <div class="col-md-2 mt-3 mb-3" style="white-space:nowrap">
				<form method="post" action="<?php echo "{$settingsWebsite}/{$storeCode}/" ?>">
                <input type="submit" style="color: <?php echo $websiteColor ?>;font-size: 22px;background: <?php echo $headerButton ?>;padding: 10px;border-radius: 6px;border: 0px;" value="<?php echo $settingsTitle ?>">
				</form>
            </div>
            <div class="col-md-10 text-left">
                <ul class="nav-links list-unstyled list-inline mb-0 pl-0">
					<?php
					$langParam = direction("lang=AR","lang=ENG");
					//$flagClass = direction("flag-icon-arabic","flag-icon-us");
					$flagClass = direction("العربية","English");
					?>
					<li class="list-inline-item ">
						<a href="#" data-toggle="modal" data-target="#wishlist_popup" id="wishlistHeart"  aria-label="WishlistIcon">
							<span class="fa fa-heart mr-1" style="color:white"><label style="font-size:7px" id="wishlistTotal">
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
					</li>
					<li class="list-inline-item "><a href="#" data-toggle="modal" data-target="#serch_popup" aria-label="Search"><span class="fa fa-car mr-1" style="color:white"></span></a></li>
					<li class="list-inline-item "><a href="<?php echo $_SERVER['REQUEST_URI'].getSign().$langParam ?>" aria-label="Langauge" style="color:white"><?php echo $flagClass ?></a></li>
					<li class="list-inline-item "><?php echo currView() ?></li>
					<li class="list-inline-item "><?php echo getLoginStatus(); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>