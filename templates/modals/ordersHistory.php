<!-- orders popup -->
<div class="modal form-popup myModal--effect-zoomIn" id="orders_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body text-center">
                <div class="modal-box-padding w-100">
                    <h4 class="title"><?php echo $OrdersHistoryText ?></h4>
                    <p class="mb-4"><?php echo $checkOrdersBelowText ?></p>
                    <div class="row mb-3">
                    <div class="col-4">
                    <?php echo $dateText ?>
                    </div>
					<div class="col-4">
                    <?php echo direction("Order #","الطلب#") ?>
                    </div>
                    <div class="col-4">
                    <?php echo direction("Price","السعر") ?>
                    </div>
                    </div>
                    <?php 
					if ( isset($orderUserEmail) ){
						$sql = "SELECT *, (price+JSON_UNQUOTE(JSON_EXTRACT(address,'$.shipping'))) as totalPrice
								FROM `orders2`
								WHERE JSON_UNQUOTE(JSON_EXTRACT(info,'$.email')) LIKE '%{$orderUserEmail}%'
								ORDER BY `date` DESC
								";
						$result = $dbconnect->query($sql);
						while ( $row = $result->fetch_assoc() ){
							?>
							<div class="row mb-3" style="font-size:14px">
                            <div class="col-4">
							<a class="text-danger" href="order?orderId=<?php echo $row["orderId"]; ?>">
							<?php echo substr(str_replace("-","/",$row["date"]),0,10) ?>
							</a>
							</div>
							<div class="col-4" style="overflow-wrap: break-word;">
                            <a class="text-danger" href="order?orderId=<?php echo $row["orderId"]; ?>">
							<?php echo $row["orderId"] ?>
							</a>
							</div>
                            <div class="col-4" style="overflow-wrap: break-word;">
							<?php echo numTo3Float(priceCurr($row["totalPrice"])) . selectedCurr(); ?>
							</div>
							</div>
							<?php 
						}
					}
						?>
				</div>
            </div>
        </div>
    </div>
</div>