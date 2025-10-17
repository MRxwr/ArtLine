<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar">
		<li class="navigation-header">
			<span><?php echo $settingsTitle ?></span> 
			<i class="zmdi zmdi-more"></i>
		</li>
<?php 
if( $pages = selectDB("pages","`status` = '0' AND `section` = '0' ORDER BY CASE WHEN `rank` = 0 THEN 1 ELSE 0 END, `rank` ASC") ){
	if( $roles = selectDB("roles","`id` = '{$userType}'") ){
		$list = json_decode($roles[0]["pages"],true);
	}else{
		$list = array();
	}
	for( $i = 0; $i < sizeof($pages); $i++ ){
		if ( $userType == '0' || in_array($pages[$i]["id"],$list) ){
			// Check if this page or any of its subsections is active
			$isParentActive = false;
			$hasActiveSub = false;
			$collapseClass = "collapsed";
			$ariaExpanded = "false";
			$collapseInClass = "";
			
			if( $sections = selectDB("pages","`section` = '{$pages[$i]["id"]}' ORDER BY CASE WHEN `rank` = 0 THEN 1 ELSE 0 END, `rank` ASC") ){
				// Check if any subsection is active
				for( $s = 0; $s < sizeof($sections); $s++ ){
					if( isset($_GET["v"]) && strpos($sections[$s]["fileName"], $_GET["v"]) !== false ){
						$hasActiveSub = true;
						$collapseClass = "";
						$ariaExpanded = "true";
						$collapseInClass = "in";
						break;
					}
				}
				$anchor = "href='javascript:void(0);' data-toggle='collapse' data-target='#".str_replace(" ","_",$pages[$i]["enTitle"])."' class='{$collapseClass}' aria-expanded='{$ariaExpanded}'";
				$arrowDown = "<i class='zmdi zmdi-caret-down'></i>";
			}else{
				// Check if this single page is active
				if( isset($_GET["v"]) && strpos($pages[$i]["fileName"], $_GET["v"]) !== false ){
					$isParentActive = true;
				}
				$anchor = "href='{$pages[$i]["fileName"]}'";
				$arrowDown = '';
			}
			
			$parentActiveClass = ($isParentActive || $hasActiveSub) ? "active" : "";
			?>
			<li class="<?php echo $parentActiveClass ?>">
				<a <?php echo $anchor ?> >
					<div class="pull-left">
						<i class="<?php echo $pages[$i]["icon"] ?> mr-20"></i>
						<span class="right-nav-text"><?php echo direction($pages[$i]["enTitle"],$pages[$i]["arTitle"]) ?></span>
					</div>
					<div class="pull-right">
						<?php echo $arrowDown ?>
					</div>
					<div class="clearfix"></div>
				</a>
			<?php
			if ( $subSections = selectDB("pages","`section` = '{$pages[$i]["id"]}' ORDER BY CASE WHEN `rank` = 0 THEN 1 ELSE 0 END, `rank` ASC") ){
				?>
				<ul id="<?php echo str_replace(" ","_",$pages[$i]["enTitle"]) ?>" class="collapse-level-1 collapse <?php echo $collapseInClass ?>" aria-expanded="<?php echo $ariaExpanded ?>">
				<?php
				for( $y = 0; $y < sizeof($subSections); $y++ ){
					// Check if this subsection is active
					$isSubActive = false;
					if( isset($_GET["v"]) && strpos($subSections[$y]["fileName"], $_GET["v"]) !== false ){
						$isSubActive = true;
					}
					$subActiveClass = $isSubActive ? "active" : "";
					?>
						<li class="<?php echo $subActiveClass ?>">
							<a href="<?php echo $subSections[$y]["fileName"] ?>" >
								<div class="pull-left">
									<i class="<?php echo $subSections[$y]["icon"] ?> mr-20"></i>
									<span class="right-nav-text"><?php echo direction($subSections[$y]["enTitle"],$subSections[$y]["arTitle"]) ?></span>
								</div>
								<div class="pull-right"></div>
								<div class="clearfix"></div>
							</a>
						</li>
					<?php
				}
				?>
				</ul>
				<?php
			}
		}
		?>
		</li>
		<?php
	}
}
?>
	</ul>
</div>