<div class="sec-pad">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
            <?php 
            if( empty($aboutPrivacy[0]["enTerms"]) ){
                echo urldecode("{$aboutPrivacy[0]["arTerms"]}");
            }elseif( empty($aboutPrivacy[0]["arTerms"]) ){
                echo urldecode("{$aboutPrivacy[0]["enTerms"]}");
            }else{
                echo direction(urldecode($aboutPrivacy[0]["enTerms"]), urldecode($aboutPrivacy[0]["arTerms"]));
            }
            ?>
            </div>
        </div>
    </div>
</div>