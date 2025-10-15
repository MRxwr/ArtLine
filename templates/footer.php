    <div id="footer">
        <div class="container">
            <div class="row">
            <div class="col-12 text-center" style="font-size: 12px">
                <?php
                if( isset($aboutPrivacy) && (!empty($aboutPrivacy[0]["enAbout"]) || !empty($aboutPrivacy[0]["arAbout"])) ){
                    echo "<a data-toggle='modal' data-target='#about_popup' aria-label='about'>".direction("About us","من نحن")."</a>";
                    if( isset($aboutPrivacy) && (!empty($aboutPrivacy[0]["enPrivacy"]) || !empty($aboutPrivacy[0]["arPrivacy"])) || (!empty($aboutPrivacy[0]["enReturn"]) || !empty($aboutPrivacy[0]["arReturn"])) ){
                        echo " | ";
                    }
                }
                if( isset($aboutPrivacy) && (!empty($aboutPrivacy[0]["enPrivacy"]) || !empty($aboutPrivacy[0]["arPrivacy"])) ){
                    echo "<a data-toggle='modal' data-target='#privacy_popup' aria-label='privacy'>".direction("Privacy Policy","سياسة الخصوصية")."</a>";
                    if( isset($aboutPrivacy) && (!empty($aboutPrivacy[0]["enReturn"]) || !empty($aboutPrivacy[0]["arReturn"])) ){
                        echo " | ";
                    }
                }
                if( isset($aboutPrivacy) && (!empty($aboutPrivacy[0]["enReturn"]) || !empty($aboutPrivacy[0]["arReturn"])) ){
                    echo "<a data-toggle='modal' data-target='#return_popup' aria-label='return'>".direction("Terms & Conditions","الشروط والأحكام")."</a>";
                }
                ?>
            </div>
                <div class="col-12 text-center mb-5" dir="ltr" style="font-size: 12px">
                    Powered with <img src="<?php echo encryptImage("img/heart-footer.svg") ?>" class="heart-footer" alt='Made with love By CreateKuwait.com' style="width: 15px;height: 15px;"> by  Createkuwait.com <br>
                    <img src="<?php echo encryptImage("img/payment-icons.webp") ?>" class="img-fluid payment-icons" alt='payment gateways createkuwait.com'>
                </div>
            </div>
        </div>
    </div>


    <?php require_once("templates/modals/aboutUs.php"); ?>
    <?php require_once("templates/modals/privacy.php"); ?>
    <?php require_once("templates/modals/terms.php"); ?>
    <?php require_once("templates/modals/searchOrder.php"); ?>
    <?php require_once("templates/modals/cart.php"); ?>
    <?php require_once("templates/modals/filterProducts.php"); ?>
    <?php require_once("templates/modals/register.php"); ?>
    <?php require_once("templates/modals/login.php"); ?>
    <?php require_once("templates/modals/forgetPassword.php"); ?>
    <?php require_once("templates/modals/editProfile.php"); ?>
    <?php require_once("templates/modals/wishlist.php"); ?>
    <?php require_once("templates/modals/sizeChart.php"); ?>
    <?php require_once("templates/modals/minPrice.php"); ?>
    <?php require_once("templates/modals/ordersHistory.php"); ?>

    </div>
    </div>
    </div>
    </div>
    </div>


    <div class="h-body">
        <div class="row m-0 d-flex justify-content-center align-items-center h-100">
            <div class="col-12 p-0 text-center">
                <div class="phone">
                    </div>
                    <div class="message">
                    Please rotate your device!
                    </div>
            </div>
        </div>
    </div>

    <?php require_once("templates/scripts.php"); ?>
    </body>
</html> 