<!-- edit profile modal -->
<div class="modal form-popup myModal--effect-zoomIn" id="editProfile_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body text-center">
                <div class="modal-box-padding m-3">
                <h4 class="title"><?php echo $editProfileText ?></h4>
                    <p class="mb-4"><?php echo $insertANewPass ?></p>
                    <div class="form-group">
                        <input type="email" class="form-control editEmail" name="email" placeholder="<?php echo $emailText ?>" value="<?php echo $userEmail ?>" disabled>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control editPass" name="password" placeholder="<?php echo $paswordText ?>" value="">
                    </div>
                    <a href="profile.html"><button class="btn theme-btn w-100 editPassword"><?php echo $continueText ?></button></a>
                </div>
            </div>
        </div>
    </div>
</div>