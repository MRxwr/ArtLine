<!-- minPrice modal -->
<?php
$sql = "SELECT `minPrice` FROM `s_media` WHERE `id` = 2";
$result = $dbconnect->query($sql);
$row = $result->fetch_assoc();
?>
<div class="modal form-popup myModal--effect-zoomIn" id="minPrice_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body text-center">
                <div class="modal-box-padding m-3">
                <svg xmlns="http://www.w3.org/2000/svg" height="25px" viewBox="0 0 512 512" width="25px"><g><path d="m277.332031 128c0 11.78125-9.550781 21.332031-21.332031 21.332031s-21.332031-9.550781-21.332031-21.332031 9.550781-21.332031 21.332031-21.332031 21.332031 9.550781 21.332031 21.332031zm0 0" data-original="#000000" class="active-path" data-old_color="#000000" fill="#C12020"/><path d="m256 405.332031c-8.832031 0-16-7.167969-16-16v-165.332031h-21.332031c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h37.332031c8.832031 0 16 7.167969 16 16v181.332031c0 8.832031-7.167969 16-16 16zm0 0" data-original="#000000" class="active-path" data-old_color="#000000" fill="#C12020"/><path d="m256 512c-141.164062 0-256-114.835938-256-256s114.835938-256 256-256 256 114.835938 256 256-114.835938 256-256 256zm0-480c-123.519531 0-224 100.480469-224 224s100.480469 224 224 224 224-100.480469 224-224-100.480469-224-224-224zm0 0" data-original="#000000" class="active-path" data-old_color="#000000" fill="#C12020"/><path d="m304 405.332031h-96c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h96c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0" data-original="#000000" class="active-path" data-old_color="#000000" fill="#C12020"/></g> </svg>

                <h4 class="title"><?php echo $minPriceText ?></h4>
                    <p class="mb-4"><?php echo $minPriceText . ": " . $row["minPrice"] ?>KD</p>
                </div>
            </div>
        </div>
    </div>
</div>