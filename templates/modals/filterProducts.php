<!-- filters modal -->
<div class="modal form-popup myModal--effect-zoomIn" id="filter_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body text-center">
                <div class="modal-box-padding mb-3">
                    <h4 class="title"><?php echo direction("Sort products by:","رتب المنتجات حسب: ") ?></h4>
                    <?php 
					$sortArray = ["pl","ph","rn","ro"];
					$sortArrayTitleEn = ["Price: Low -> High","Price: High -> Low","New -> Old","Old -> New"];
					$sortArrayTitleAr = ["السعر: الأقل للأعلى","السعر الأعلى للأقل","الأحدث للأقدم","الأقدم للأحدث"];
					for ( $i = 0; $i < sizeof($sortArray); $i++ ){
						$output = "";
						if( isset($_GET["order"]) && !empty($_GET["order"]) && $_GET["order"] == $sortArray[$i] ){
							$activeSort = "btn theme-btn";
						}else{
							$activeSort = "btn btn-default border";
						}
						$output = "<form method='get' action='' class='w-100'>";
						if ( isset($_GET["id"]) && !empty($_GET["id"]) ){
							$output .= "<input type='hidden' name='id' value='{$_GET["id"]}'>";
						}
						$output .= "<button name='order' value='{$sortArray[$i]}' class='{$activeSort} w-100 m-1' >".direction($sortArrayTitleEn[$i],$sortArrayTitleAr[$i])."</button>
							</form>";
						echo $output;
					}
					?>
                </div>
            </div>
        </div>
    </div>
</div>