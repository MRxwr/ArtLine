<div class="modal search-modal" id="serch_popup">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
        <form method="get" action="order">
            <table style="width:100%">
            <tr>
            <td>
            <div class="search-box d-flex align-items-center">
                <span class="cat"><?php echo $orderStatusText ?></span>
                <div class="form-group mb-0">
                    <input type="text" name="orderId" class="form-control" placeholder="<?php echo $orderNumberText ?>" required>
                </div>
            </div>
            </td>
            <td>
            <button style="border:0px; background-color:white" class="search-fa-icon"><span class="fa fa-car"></span></button>
            </td>
            </tr>
            </table>
            </form>
        </div>
    </div>
  </div>
</div>