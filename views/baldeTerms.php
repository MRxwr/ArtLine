<div class="sec-pad">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
            <?php 
            if( empty($aboutPrivacy[0]["enTerms"]) ){
                echo "{$aboutPrivacy[0]["arTerms"]}";
            }elseif( empty($aboutPrivacy[0]["arTerms"]) ){
                echo "{$aboutPrivacy[0]["enTerms"]}";
            }else{
                echo direction($aboutPrivacy[0]["enTerms"], $aboutPrivacy[0]["arTerms"]);
            }
            ?>
            </div>
        </div>
    </div>
</div>