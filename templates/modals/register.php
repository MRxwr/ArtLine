<!-- sign up popup -->
<div class="modal form-popup myModal--effect-zoomIn" id="reg_popup" >
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body text-center">
                <div class="modal-box-padding">
                    <h4 class="title"><?php echo $signUpText ?></h4>
                    <p class="mb-4"><?php echo $PleaseEnterYourDetails ?>:</p>
                    <div class="form-group">
                        <input type="email" class="form-control newEmail" name="email" placeholder="<?php echo $emailText ?>" title="Email" required >
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control newPass" name="password" placeholder="<?php echo $paswordText ?>" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control newName" name="name" placeholder="<?php echo $fullNameText ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control newPhone" name="phone" placeholder="<?php echo $phoneNumberText ?>" minlength="8" maxlength="8" required>
                    </div>
                    <button class="btn theme-btn w-100 newUser"><?php echo $continueText ?></button>
                    <p class="mt-4 mb-4"><?php echo $youGotAnAccount ?> <a href="#" class="link"  data-dismiss="modal" data-toggle="modal" data-target="#login_popup"><?php echo $loginText ?></a></p>
                </div>
            </div>
        </div>
    </div>
</div>