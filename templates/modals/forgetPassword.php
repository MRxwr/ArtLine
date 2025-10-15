<!-- forgot modal -->
<div class="modal form-popup myModal--effect-zoomIn" id="forgot_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body text-center">
                <div class="modal-box-padding">
                    <form action="includes/loginfp.php" method="post">
                    <h4 class="title"><?php echo $ForgotPasswordText ?></h4>
                    <p class="mb-4"><?php echo $weWillSendYouANewPassText ?></p>
                    <div class="form-group">
                        <input type="email" class="form-control userEmail" name="email" placeholder="email">
                    </div>
                    <button class="btn theme-btn w-100 resetP"><?php echo $resetItNowText ?></button>
                    <p class="mt-4 mb-4"><?php echo $backToText ?> <a href="#" class="link" data-dismiss="modal" data-toggle="modal" data-target="#login_popup"><?php echo $loginText ?></a></p>
                </div>
            </div>
                </form>
        </div>
    </div>
</div>