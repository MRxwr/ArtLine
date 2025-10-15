<!-- return popup -->
<div class="modal form-popup myModal--effect-zoomIn" id="return_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body">
            <div class="modal-box-padding mb-3" style="text-align: <?php echo direction("left","right"); ?>">
                <h4 class="title"><?php echo direction("Terms & Conditions","الشروط والأحكام") ?></h4>
            <?php 
                if( empty($aboutPrivacy[0]["enReturn"]) ){
                    echo "{$aboutPrivacy[0]["arReturn"]}";
                }elseif( empty($aboutPrivacy[0]["arReturn"]) ){
                    echo "{$aboutPrivacy[0]["enReturn"]}";
                }else{
                    echo direction($aboutPrivacy[0]["enReturn"], $aboutPrivacy[0]["arReturn"]);
                }
            ?>
            </div>
            </div>
        </div>
    </div> 
</div>