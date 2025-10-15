<!-- sizeChart modal -->
<div class="modal form-popup myModal--effect-zoomIn" id="sizeChartPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo direction("Size Chart","لوحة المقاسات") ?></h5>
        <button type="button" data-dismiss="modal" aria-label="Close" style="border: 1px solid #9a9a9a;border-radius: 5px;background-color: #c8c8c8;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-3">
      <?php 
        if( $sizeChart = selectDB("s_media","`id` = '4'") ){
            if ( !empty($sizeChart[0]["sizeChartImage"]) ){
                echo "<img src='".encryptImage("logos/{$sizeChart[0]["sizeChartImage"]}")."' style='width:100%'>";
            }
        }
        ?>
      </div>
    </div>
  </div>
</div>