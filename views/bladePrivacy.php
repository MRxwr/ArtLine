<div class="sec-pad">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
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