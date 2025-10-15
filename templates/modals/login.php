<!-- login popup -->
<div class="modal form-popup myModal--effect-zoomIn" id="login_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body text-center">
                <div class="modal-box-padding">
                    <h4 class="title"><?php echo $WelcomeBackText ?></h4>
                    <p class="mb-4"><?php echo $LoginWithYourEmailAndPasswordText ?></p>
                    <div class="form-group">
                        <input type="email" class="form-control LoginE" name="email" placeholder="<?php echo $emailText ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control LoginPass" name="password" placeholder="<?php echo $paswordText ?>">
                    </div>
                    <button class="btn theme-btn w-100 LoginAj"><?php echo $continueText ?></button>
                    <p class="mt-4 mb-4"><?php echo $DontHaveAnAccountText ?><a href="#" class="link" data-dismiss="modal" data-toggle="modal" data-target="#reg_popup"><?php echo $signUpText ?></a></p>
                </div>
                <div class="forgot-link">
                    <p><?php echo $ForgotYourPasswordText ?><a href="#" class="link" data-dismiss="modal" data-toggle="modal" data-target="#forgot_popup"><?php echo $restItText ?></a></p>
                </div>
            </div>
        </div>
    </div>
</div>