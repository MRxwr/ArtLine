<!-- privacy popup -->
<div class="modal form-popup myModal--effect-zoomIn" id="privacy_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body">
            <div class="modal-box-padding mb-3" style="text-align: <?php echo direction("left","right"); ?>">
                <h4 class="title"><?php echo direction("Privacy Policy","سياسة الخصوصية") ?></h4>
            <?php 
                if( empty($aboutPrivacy[0]["enPrivacy"]) ){
                    echo urldecode("{$aboutPrivacy[0]["arPrivacy"]}");
                }elseif( empty($aboutPrivacy[0]["arPrivacy"]) ){
                    echo urldecode("{$aboutPrivacy[0]["enPrivacy"]}");
                }else{
                    echo direction(urldecode($aboutPrivacy[0]["enPrivacy"]), urldecode($aboutPrivacy[0]["arPrivacy"]));
                }
            ?>
            </div>
            </div>
        </div>
    </div>
</div>