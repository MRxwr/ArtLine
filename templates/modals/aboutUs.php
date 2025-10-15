<!-- about popup -->
<div class="modal form-popup myModal--effect-zoomIn" id="about_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body">
            <div class="modal-box-padding mb-3" style="text-align: <?php echo direction("left","right"); ?>">
                <h4 class="title"><?php echo direction("About Us","معلومات عنا") ?></h4>
            <?php 
                if( empty($aboutPrivacy[0]["enAbout"]) ){
                    echo "{$aboutPrivacy[0]["arAbout"]}";
                }elseif( empty($aboutPrivacy[0]["arAbout"]) ){
                    echo "{$aboutPrivacy[0]["enAbout"]}";
                }else{
                    echo direction($aboutPrivacy[0]["enAbout"], $aboutPrivacy[0]["arAbout"]);
                }
            ?>
            </div>
            </div>
        </div>
    </div>
</div>