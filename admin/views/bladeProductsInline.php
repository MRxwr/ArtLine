<?php 
// Handle image deletion
if( isset($_GET["imgdel"]) && isset($_GET["pid"]) ){
	// Delete from database
	deleteDB("images", "`imageurl3` = '{$_GET["imgdel"]}' AND `productId` = '{$_GET["pid"]}'");
	exit(); // Just exit for AJAX call
}

// Handle hide/show product
if( isset($_GET["hide"]) && !empty($_GET["hide"]) ){
	if( updateDB("products",array('hidden'=> '1'),"`id` = '{$_GET["hide"]}'") ){
		header("LOCATION: ?v=ProductsInline");
	}
}

if( isset($_GET["show"]) && !empty($_GET["show"]) ){
	if( updateDB("products",array('hidden'=> '0'),"`id` = '{$_GET["show"]}'") ){
		header("LOCATION: ?v=ProductsInline");
	}
}

// Handle soft delete
if( isset($_GET["delId"]) && !empty($_GET["delId"]) ){
	if( updateDB("products",array('hidden'=> '2'),"`id` = '{$_GET["delId"]}'") ){
		header("LOCATION: ?v=ProductsInline");
	}
}

// Handle rank update
if( isset($_POST["updateRank"]) ){
	for( $i = 0; $i < sizeof($_POST["rank"]); $i++){
		updateDB("products",array("rank"=>$_POST["rank"][$i]),"`id` = '{$_POST["id"][$i]}'");
	}
	header("LOCATION: ?v=ProductsInline");
}

// Handle recent/bestseller toggles
if( isset($_GET["newId"]) && !empty($_GET["newId"]) ){
	if( selectDB("products","`id` = '{$_GET["newId"]}' AND `recent` = '0'") ){
		updateDB("products",array("recent"=>1),"`id` = '{$_GET["newId"]}'");
	}else{
		updateDB("products",array("recent"=>0),"`id` = '{$_GET["newId"]}'");
	}
	header("LOCATION: ?v=ProductsInline");
}

if( isset($_GET["bestId"]) && !empty($_GET["bestId"]) ){
	if( selectDB("products","`id` = '{$_GET["bestId"]}' AND `bestSeller` = '0'") ){
		updateDB("products",array("bestSeller"=>1),"`id` = '{$_GET["bestId"]}'");
	}else{
		updateDB("products",array("bestSeller"=>0),"`id` = '{$_GET["bestId"]}'");
	}
	header("LOCATION: ?v=ProductsInline");
}

// Handle product form submission (add/edit)
if( isset($_POST["arTitle"]) ){
	$id = $_POST["update"];
	$categoryIds = $_POST["categoryId"];
	unset($_POST["update"]);
	unset($_POST["categoryId"]);
	
	// Handle multiple image uploads
	$uploadedImages = array();
	if (isset($_FILES['imageurl']) && is_array($_FILES['imageurl']['tmp_name'])) {
		$i = 0;
		while ($i < sizeof($_FILES['imageurl']['tmp_name'])) {
			if (is_uploaded_file($_FILES['imageurl']['tmp_name'][$i])) {
				$uploadedImages[] = uploadImageBannerFreeImageHost($_FILES['imageurl']['tmp_name'][$i]);
			}
			$i++;
		}
	}
	unset($_POST["imageurl"]);
	
	// Escape string data
	$_POST["arTitle"] = escapeStringDirect($_POST["arTitle"]);
	$_POST["enTitle"] = escapeStringDirect($_POST["enTitle"]);
	
	// Clean TinyMCE content before escaping
	if(isset($_POST["arDetails"])) {
		// Remove the \r\n that TinyMCE adds after HTML tags
		$_POST["arDetails"] = str_replace(">\r\n<", "><", $_POST["arDetails"]);
		$_POST["arDetails"] = str_replace(">\r\n", ">", $_POST["arDetails"]);
		$_POST["arDetails"] = str_replace("\r\n<", "<", $_POST["arDetails"]);
		$_POST["arDetails"] = escapeStringDirect($_POST["arDetails"]);
	}
	
	if(isset($_POST["enDetails"])) {
		// Remove the \r\n that TinyMCE adds after HTML tags
		$_POST["enDetails"] = str_replace(">\r\n<", "><", $_POST["enDetails"]);
		$_POST["enDetails"] = str_replace(">\r\n", ">", $_POST["enDetails"]);
		$_POST["enDetails"] = str_replace("\r\n<", "<", $_POST["enDetails"]);
		$_POST["enDetails"] = escapeStringDirect($_POST["enDetails"]);
	}
	
	// Handle extras JSON
	if( isset($_POST["extras"]) && !empty($_POST["extras"]) && is_array($_POST["extras"]) ){
		$_POST["extras"] = json_encode($_POST["extras"]);
	}else{
		$_POST["extras"] = json_encode(array());
	}
	
	// Set default values for missing fields if not provided
	$defaultFields = [
		'preorderText' => '',
		'preorderTextAr' => '',
		'video' => '',
		'weight' => 0,
		'width' => 0,
		'height' => 0,
		'depth' => 0,
		'preorder' => 0,
		'oneTime' => 0,
		'collection' => 0,
		'giftCard' => 0,
		'isImage' => 0,
		'sizeChart' => 0
	];
	
	foreach($defaultFields as $field => $defaultValue) {
		if(!isset($_POST[$field])) {
			$_POST[$field] = $defaultValue;
		}
	}
	
	// Escape text fields
	if(isset($_POST['preorderText'])) $_POST['preorderText'] = escapeStringDirect($_POST['preorderText']);
	if(isset($_POST['preorderTextAr'])) $_POST['preorderTextAr'] = escapeStringDirect($_POST['preorderTextAr']);
	
	if ( $id == 0 ){
		// Insert new product
		if( insertDB("products", $_POST) ){
			// Get the inserted product ID
			$newProduct = selectDB("products", "`enTitle` = '{$_POST["enTitle"]}' AND `arTitle` = '{$_POST["arTitle"]}' ORDER BY `id` DESC LIMIT 1");
			$productId = $newProduct[0]["id"];
			
			// Handle category associations
			for( $i = 0; $i < sizeof($categoryIds); $i++ ){
				insertDB("category_products", array("productId" => $productId, "categoryId" => $categoryIds[$i]));
			}
			
			// Handle multiple image uploads
			if(!empty($uploadedImages)){
				foreach($uploadedImages as $imageUrl){
					insertDB("images", array(
						"productId" => $productId,
						"imageurl" => $imageUrl,
						"imageurl2" => $imageUrl,
						"imageurl3" => $imageUrl
					));
				}
			}
			
			// Handle simple product attributes
			if($_POST["type"] == 1 && isset($_POST["price"])){
				insertDB("attributes_products", array(
					"productId" => $productId,
					"price" => $_POST["price"],
					"cost" => $_POST["cost"],
					"quantity" => $_POST["quantity"],
					"sku" => $_POST["sku"]
				));
			}
			
			header("LOCATION: ?v=ProductsInline");
		}else{
		?>
		<script>
			alert("Could not process your request, Please try again.");
		</script>
		<?php
		}
	}else{
		// Update existing product
		if( updateDB("products", $_POST, "`id` = '{$id}'") ){
			// Update category associations
			deleteDB("category_products", "`productId` = '{$id}'");
			for( $i = 0; $i < sizeof($categoryIds); $i++ ){
				insertDB("category_products", array("productId" => $id, "categoryId" => $categoryIds[$i]));
			}
			
			// Handle multiple image uploads for update
			if(!empty($uploadedImages)){
				foreach($uploadedImages as $imageUrl){
					insertDB("images", array(
						"productId" => $id,
						"imageurl" => $imageUrl,
						"imageurl2" => $imageUrl,
						"imageurl3" => $imageUrl
					));
				}
			}
			
			// Handle simple product attributes update
			$product = selectDB("products", "`id` = '{$id}'");
			if($product[0]["type"] == 1 && isset($_POST["price"])){
				deleteDB("attributes_products", "`productId` = '{$id}'");
				insertDB("attributes_products", array(
					"productId" => $id,
					"price" => $_POST["price"],
					"cost" => $_POST["cost"],
					"quantity" => $_POST["quantity"],
					"sku" => $_POST["sku"]
				));
			}
			
			header("LOCATION: ?v=ProductsInline");
		}else{
		?>
		<script>
			alert("Could not process your request, Please try again.");
		</script>
		<?php
		}
	}
}
?>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading" style="cursor: pointer;" onclick="toggleProductForm()">
<div class="pull-left">
	<h6 class="panel-title txt-dark"><?php echo direction("Product Details","تفاصيل المنتج") ?></h6>
</div>
<div class="pull-right">
	<button type="button" class="btn btn-success btn-sm" style="background-color: #5cb85c !important; border-color: #4cae4c !important; color: white !important;" onclick="event.stopPropagation(); openProductForm()"><?php echo direction("Add Product","إضافة منتج") ?></button>
	<i class="fa fa-chevron-down" id="formToggleIcon" style="margin-left: 10px;"></i>
</div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse" id="productFormPanel">
<div class="panel-body">
	<form class="" method="POST" action="" enctype="multipart/form-data">
		<div class="row m-0">
            <div class="col-md-12">
			<label><?php echo direction("Product Type","نوع المنتج") ?></label>
			<select name="type" class="form-control" onchange="toggleSimpleFields(this.value)">
				<option value="0"><?php echo direction("Variant","متغير") ?></option>
				<option value="1" selected><?php echo direction("Simple","بسيط") ?></option>
			</select>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("Arabic Title","العنوان بالعربي") ?></label>
			<input type="text" name="arTitle" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("English Title","العنوان بالإنجليزي") ?></label>
			<input type="text" name="enTitle" class="form-control" required>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Shop","المتجر") ?></label>
			<select name="shopId" class="form-control select2-single" required data-placeholder="<?php echo direction("Select Shop","اختر المتجر") ?>">
				<option value=""><?php echo direction("Select Shop","اختر المتجر") ?></option>
				<?php
				if( $shops = selectDB("shops", "`status` = '0' ORDER BY `enTitle` ASC, `arTitle` ASC") ){
					for( $i = 0; $i < sizeof($shops); $i++ ){
						$title = direction($shops[$i]["enTitle"],$shops[$i]["arTitle"]);
						echo "<option value='{$shops[$i]["id"]}'>{$title}</option>";
					}
				}
				?>
			</select>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("Brand","الماركة") ?></label>
			<select name="brandId" class="form-control select2-single" required data-placeholder="<?php echo direction("Select Brand","اختر الماركة") ?>">
				<option value=""><?php echo direction("Select Brand","اختر الماركة") ?></option>
				<?php
				if( $brands = selectDB("brands", "`status` = '0' ORDER BY `enTitle` ASC, `arTitle` ASC") ){
					for( $i = 0; $i < sizeof($brands); $i++ ){
						$title = direction($brands[$i]["enTitle"],$brands[$i]["arTitle"]);
						echo "<option value='{$brands[$i]["id"]}'>{$title}</option>";
					}
				}
				?>
			</select>
			</div>

            <div class="col-md-6">
			<label><?php echo direction("Category","القسم") ?></label>
			<select name="categoryId[]" class="form-control select2-multiple" multiple required data-placeholder="<?php echo direction("Select Categories","اختر الأقسام") ?>">
				<?php
				if( $categories = selectDB("categories", "`status` = '0' ORDER BY `enTitle` ASC, `arTitle` ASC") ){
					for( $i = 0; $i < sizeof($categories); $i++ ){
						$title = direction($categories[$i]["enTitle"],$categories[$i]["arTitle"]);
						echo "<option value='{$categories[$i]["id"]}'>{$title}</option>";
					}
				}
				?>
			</select>
			</div>

			<div class="col-md-6">
			<label><?php echo direction("Add-ons","الإضافات") ?></label>
			<select name="extras[]" class="form-control select2-multiple" multiple data-placeholder="<?php echo direction("Select Add-ons","اختر الإضافات") ?>">
				<?php
				if( $extras = selectDB("extras", "`status` = '0'") ){
					for( $i = 0; $i < sizeof($extras); $i++ ){
						$title = direction($extras[$i]["enTitle"],$extras[$i]["arTitle"]);
						echo "<option value='{$extras[$i]["id"]}'>{$title}</option>";
					}
				}
				?>
			</select>
			</div>
			
			<!-- Simple Product Fields (Hidden by default) -->
			<div id="simpleFields" style="display:block;">
				<div class="col-md-3">
				<label><?php echo direction("Price","السعر") ?></label>
				<input type="number" name="price" class="form-control" step="0.01">
				</div>
				
				<div class="col-md-3">
				<label><?php echo direction("Cost","التكلفة") ?></label>
				<input type="number" name="cost" class="form-control" step="0.01">
				</div>
				
				<div class="col-md-3">
				<label><?php echo direction("Quantity","الكمية") ?></label>
				<input type="number" name="quantity" class="form-control">
				</div>
				
				<div class="col-md-3">
				<label>SKU</label>
				<input type="text" name="sku" class="form-control">
				</div>
			</div>

			<div class="col-md-4">
			<label><?php echo direction("Video Link","رابط الفيديو") ?> (YOUTUBE)</label>
			<input type="text" name="video" class="form-control">
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Discount","الخصم") ?></label>
			<input type="number" name="discount" class="form-control" min="0" max="100" value="0">
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Discount Type","نوع الخصم") ?></label>
			<select name="discountType" class="form-control">
				<option value="0"><?php echo direction("Percentage","نسبة مئوية") ?></option>
				<option value="1"><?php echo direction("Fixed","قيمة ثابتة") ?></option>
			</select>
			</div>
			
			<!-- Additional Product Options -->
			<div class="col-md-3">
			<label><?php echo direction("Pre-Order","طلب مسبق") ?></label>
			<select name="preorder" class="form-control">
				<option value="0"><?php echo direction("No","لا") ?></option>
				<option value="1"><?php echo direction("Yes","نعم") ?></option>
			</select>
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("English Tag","شعار بالإنجليزي") ?></label>
			<input type="text" name="preorderText" class="form-control">
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Arabic Tag","شعار بالعربي") ?></label>
			<input type="text" name="preorderTextAr" class="form-control">
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("One Time Add","إضافة لمرة واحدة") ?></label>
			<select name="oneTime" class="form-control">
				<option value="0"><?php echo direction("No","لا") ?></option>
				<option value="1"><?php echo direction("Yes","نعم") ?></option>
			</select>
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Collection","المجموعة") ?></label>
			<select name="collection" class="form-control">
				<option value="0"><?php echo direction("No","لا") ?></option>
				<option value="1"><?php echo direction("Yes","نعم") ?></option>
			</select>
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Gift Card","كرت هدية") ?></label>
			<select name="giftCard" class="form-control">
				<option value="0"><?php echo direction("No","لا") ?></option>
				<option value="1"><?php echo direction("Yes","نعم") ?></option>
			</select>
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Require Image","إرفاق صورة") ?></label>
			<select name="isImage" class="form-control">
				<option value="0"><?php echo direction("No","لا") ?></option>
				<option value="1"><?php echo direction("Yes","نعم") ?></option>
			</select>
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Size Chart","لوحة المقاسات") ?></label>
			<select name="sizeChart" class="form-control">
				<option value="0"><?php echo direction("No","لا") ?></option>
				<option value="1"><?php echo direction("Yes","نعم") ?></option>
			</select>
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Width","العرض") ?></label>
			<input type="number" name="width" class="form-control" step="0.01" value="0">
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Height","الطول") ?></label>
			<input type="number" name="height" class="form-control" step="0.01" value="0">
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Depth","العمق") ?></label>
			<input type="number" name="depth" class="form-control" step="0.01" value="0">
			</div>
			
			<div class="col-md-3">
			<label><?php echo direction("Weight","الوزن") ?></label>
			<input type="number" name="weight" class="form-control" step="0.01" value="0">
			</div>

			<div class="col-md-6">
			<label><?php echo direction("Arabic Description","الوصف بالعربي") ?></label>
			<textarea name="arDetails" class="tinymce" rows="3"></textarea>
			</div>
			
			<div class="col-md-6">
			<label><?php echo direction("English Description","الوصف بالإنجليزي") ?></label>
			<textarea name="enDetails" class="tinymce" rows="3"></textarea>
			</div>

			<div class="col-md-12">
			<label><?php echo direction("Product Image","صورة المنتج") ?></label>
			<input type="file" name="imageurl[]" class="form-control" multiple="multiple" accept="image/*">
			</div>
			
			<div id="existingImages" style="margin-top: 10px; display:none">
				<div class="col-md-12">
					<label><?php echo direction("Existing Images","الصور الموجودة") ?></label>
					<div id="existingImagesContainer" style="display: flex; flex-wrap: wrap; gap: 10px;">
						<!-- Existing images will be loaded here -->
					</div>
				</div>
			</div>
			
			<div id="imagePreview" style="margin-top: 10px; display:none">
				<div class="col-md-12">
				<img id="productImg" src="" style="width:200px;height:200px">
				</div>
			</div>
			
			<div class="col-md-12" style="margin-top:10px">
			<input type="submit" class="btn btn-primary" value="<?php echo direction("Submit","أرسل") ?>">
			<input type="hidden" name="update" value="0">
			<input type="hidden" name="status" value="0">
			<input type="hidden" name="hidden" value="0">
			<input type="hidden" name="recent" value="0">
			<input type="hidden" name="bestSeller" value="0">
			<input type="hidden" name="storeQuantity" value="0">
			<input type="hidden" name="onlineQuantity" value="0">
			</div>
		</div>
	</form>
</div>
</div>
</div>
</div>
				
<!-- Products List -->
<form method="post" action="">
<input name="updateRank" type="hidden" value="1">
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
<h6 class="panel-title txt-dark"><?php echo direction("Products List","قائمة المنتجات") ?></h6>
</div>
<div class="pull-right">
<div class="form-group">
<label><?php echo direction("Show","عرض") ?>:</label>
<select id="pageLength" class="form-control" style="width: 80px; display: inline-block;">
<option value="10">10</option>
<option value="20">20</option>
<option value="50">50</option>
<option value="100">100</option>
</select>
<?php echo direction("entries","عنصر") ?>
</div>
</div>
<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap mt-40">
<div class="table-responsive">
	<table class="table display responsive product-overview mb-30" id="productsTable">
		<thead>
		<tr>
		<th>#</th>
		<th><?php echo direction("ID","الرقم") ?></th>
		<th><?php echo direction("Image","الصورة") ?></th>
		<th><?php echo direction("English Title","العنوان بالإنجليزي") ?></th>
		<th><?php echo direction("Type","النوع") ?></th>
		<th><?php echo direction("Price","السعر") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		<tbody>
		<!-- Data will be loaded via AJAX -->
		</tbody>
	</table>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
</div>

<script>
function toggleProductForm() {
	var panel = document.getElementById('productFormPanel');
	var icon = document.getElementById('formToggleIcon');
	
	if (panel.classList.contains('in')) {
		panel.classList.remove('in');
		icon.className = 'fa fa-chevron-down';
	} else {
		panel.classList.add('in');
		icon.className = 'fa fa-chevron-up';
	}
}

function openProductForm() {
	var panel = document.getElementById('productFormPanel');
	var icon = document.getElementById('formToggleIcon');
	
	panel.classList.add('in');
	icon.className = 'fa fa-chevron-up';
	
	// Clear form for adding new product
	clearProductForm();
}

function clearProductForm() {
	// Reset form to default values for new product
	$("input[name=arTitle]").val('');
	$("input[name=enTitle]").val('');
	$("input[name=update]").val('0');
	$("select[name=type]").val('0');
	$("select[name=shopId]").val('').trigger('change');
	$("select[name=brandId]").val('').trigger('change');
	$("input[name=discount]").val('0');
	$("select[name=discountType]").val('0');
	$("input[name=hidden]").val('0');
	$("input[name=recent]").val('0');
	$("input[name=bestSeller]").val('0');
	
	// Reset additional fields
	$("select[name=preorder]").val('0');
	$("input[name=preorderText]").val('');
	$("input[name=preorderTextAr]").val('');
	$("select[name=oneTime]").val('0');
	$("select[name=collection]").val('0');
	$("select[name=giftCard]").val('0');
	$("select[name=isImage]").val('0');
	$("select[name=sizeChart]").val('0');
	$("input[name=video]").val('');
	$("input[name=weight]").val('0');
	$("input[name=width]").val('0');
	$("input[name=height]").val('0');
	$("input[name=depth]").val('0');
	
	// Clear TinyMCE content
	if(typeof tinymce !== 'undefined') {
		setTimeout(function() {
			if(tinymce.get('arDetails')) {
				tinymce.get('arDetails').setContent('');
			}
			if(tinymce.get('enDetails')) {
				tinymce.get('enDetails').setContent('');
			}
		}, 100);
	} else {
		$("textarea[name=arDetails]").val('');
		$("textarea[name=enDetails]").val('');
	}
	
	// Clear categories and extras
	$("select[name='categoryId[]']").val([]).trigger('change');
	$("select[name='extras[]']").val([]).trigger('change');
	
	// Hide image preview and existing images
	$("#imagePreview").attr("style","margin-top:10px;display:none");
	$("#existingImages").hide();
	$("#existingImagesContainer").html('');
	
	// Reset simple product fields
	toggleSimpleFields('0');
	$("input[name=price]").val('');
	$("input[name=cost]").val('');
	$("input[name=quantity]").val('');
	$("input[name=sku]").val('');
	
	// Make file input required again
	$("input[type=file]").prop("required", true);
}

function toggleSimpleFields(type) {
	if(type == '1') {
		document.getElementById('simpleFields').style.display = 'block';
		// Make price, cost, quantity, sku required for simple products
		document.querySelector('input[name="price"]').required = true;
		document.querySelector('input[name="cost"]').required = true;
		document.querySelector('input[name="quantity"]').required = true;
		document.querySelector('input[name="sku"]').required = true;
	} else {
		document.getElementById('simpleFields').style.display = 'none';
		// Remove required attribute for variant products
		document.querySelector('input[name="price"]').required = false;
		document.querySelector('input[name="cost"]').required = false;
		document.querySelector('input[name="quantity"]').required = false;
		document.querySelector('input[name="sku"]').required = false;
	}
}

$(document).ready(function() {
	var table = $('#productsTable').DataTable({
		'processing': true,
		'serverSide': true,
		'searching': true,
		'ordering': true,
		'pageLength': 10,
		'lengthMenu': [[10, 20, 50, 100], [10, 20, 50, 100]],
		'ajax': {
			'url': '../api/getProductsInline.php',
			'type': 'POST',
			'dataSrc': function(json) {
				if (!json.aaData) {
					console.error('Invalid JSON response:', json);
					return [];
				}
				return json.aaData;
			},
			'error': function(xhr, error, thrown) {
				console.error('Error fetching data:', error, thrown);
				console.error('Response:', xhr.responseText);
			}
		},
		'order': [[1, 'desc']], // Order by ID descending
		'columns': [
			{ 'data': '#', 'orderable': false },
			{ 'data': 'order' },
			{ 'data': 'image', 'orderable': false },
			{ 'data': 'english' },
			{ 'data': 'type' },
			{ 'data': 'price' },
			{ 'data': 'action', 'orderable': false }
		],
		'language': {
			'processing': '<div class="custom-loading-overlay"><div class="loading-spinner"></div><div class="loading-text"><?php echo direction("Loading...","جاري التحميل...") ?></div></div>',
			'search': '<?php echo direction("Search:","البحث:") ?>',
			'lengthMenu': '<?php echo direction("Show _MENU_ entries","عرض _MENU_ عنصر") ?>',
			'info': '<?php echo direction("Showing _START_ to _END_ of _TOTAL_ entries","عرض _START_ إلى _END_ من _TOTAL_ عنصر") ?>',
			'infoEmpty': '<?php echo direction("Showing 0 to 0 of 0 entries","عرض 0 إلى 0 من 0 عنصر") ?>',
			'infoFiltered': '<?php echo direction("(filtered from _MAX_ total entries)","(مفلتر من _MAX_ عنصر إجمالي)") ?>',
			'paginate': {
				'first': '<?php echo direction("First","الأول") ?>',
				'last': '<?php echo direction("Last","الأخير") ?>',
				'next': '<?php echo direction("Next","التالي") ?>',
				'previous': '<?php echo direction("Previous","السابق") ?>'
			}
		}
	});
	
	// Add custom loading overlay functionality
	table.on('preXhr.dt', function() {
		$('#productsTable_wrapper').addClass('datatable-loading');
	});
	
	table.on('xhr.dt', function() {
		$('#productsTable_wrapper').removeClass('datatable-loading');
	});
	
	// Handle page length change
	$('#pageLength').on('change', function() {
		table.page.len($(this).val()).draw();
	});
});

$(document).on("click",".edit", function(){
	// Open the product form panel
	var panel = document.getElementById('productFormPanel');
	var icon = document.getElementById('formToggleIcon');
	panel.classList.add('in');
	icon.className = 'fa fa-chevron-up';
	
	var id = $(this).attr("id");
	var arTitle = $("#arTitle"+id).html();
	var enTitle = $("#enTitle"+id).html();
	var type = $("#type"+id).html();
	var shopId = $("#shopId"+id).html();
	var brandId = $("#brandId"+id).html();
	var discount = $("#discount"+id).html();
	var discountType = $("#discountType"+id).html();
	var hidden = $("#hidden"+id).html();
	var recent = $("#recent"+id).html();
	var bestSeller = $("#bestSeller"+id).html();
	
	// Additional fields from old system
	var preorder = $("#preorder"+id).html();
	var preorderText = $("#preorderText"+id).html();
	var preorderTextAr = $("#preorderTextAr"+id).html();
	var oneTime = $("#oneTime"+id).html();
	var collection = $("#collection"+id).html();
	var giftCard = $("#giftCard"+id).html();
	var isImage = $("#isImage"+id).html();
	var sizeChart = $("#sizeChart"+id).html();
	var video = $("#video"+id).html();
	var weight = $("#weight"+id).html();
	var width = $("#width"+id).html();
	var height = $("#height"+id).html();
	var depth = $("#depth"+id).html();
	var extras = $("#extras"+id).html().split(',').filter(Boolean);
	
	// Safely decode base64 content with error handling
	function safeAtob(str) {
		try {
			return str ? atob(str) : '';
		} catch (e) {
			console.error('Base64 decoding error:', e);
			return '';
		}
	}
	
	// Function to convert \r\n to proper line breaks for TinyMCE
	function formatTextForEditor(text) {
		if (!text) return '';
		// Replace \r\n, \r, and \n with proper HTML line breaks
		return text.replace(/\\r\\n/g, '<br>')
				   .replace(/\\n/g, '<br>')
				   .replace(/\\r/g, '<br>')
				   .replace(/\r\n/g, '<br>')
				   .replace(/\n/g, '<br>')
				   .replace(/\r/g, '<br>');
	}
	
	var arDetails = (($("#arDetails"+id).attr('data-content')));
	var enDetails = (($("#enDetails"+id).attr('data-content')));
	var images = $("#images"+id).html().split(',').filter(Boolean);
	var categories = $("#categories"+id).html().split(',');
	
	// Clear form and populate with product data
	$("input[type=file]").prop("required",false);
	$("input[name=arTitle]").val(arTitle).focus();
	$("input[name=enTitle]").val(enTitle);
	$("input[name=update]").val(id);
	$("select[name=type]").val(type);
	$("select[name=shopId]").val(shopId).trigger('change');
	$("select[name=brandId]").val(brandId).trigger('change');
	$("input[name=discount]").val(discount);
	$("select[name=discountType]").val(discountType);
	$("input[name=hidden]").val(hidden);
	$("input[name=recent]").val(recent);
	$("input[name=bestSeller]").val(bestSeller);
	
	// Populate additional fields
	$("select[name=preorder]").val(preorder);
	$("input[name=preorderText]").val(preorderText);
	$("input[name=preorderTextAr]").val(preorderTextAr);
	$("select[name=oneTime]").val(oneTime);
	$("select[name=collection]").val(collection);
	$("select[name=giftCard]").val(giftCard);
	$("select[name=isImage]").val(isImage);
	$("select[name=sizeChart]").val(sizeChart);
	$("input[name=video]").val(video);
	$("input[name=weight]").val(weight);
	$("input[name=width]").val(width);
	$("input[name=height]").val(height);
	$("input[name=depth]").val(depth);
	
	// Set TinyMCE content
	if(typeof tinymce !== 'undefined') {
		setTimeout(function() {
			if(tinymce.get('arDetails')) {
				tinymce.get('arDetails').setContent(arDetails || '');
			}
			if(tinymce.get('enDetails')) {
				tinymce.get('enDetails').setContent(enDetails || '');
			}
		}, 100);
	} else {
		// Fallback to textarea
		$("textarea[name=arDetails]").val(arDetails || '');
		$("textarea[name=enDetails]").val(enDetails || '');
	}
	
	// Handle categories (multiple select with Select2)
	$("select[name='categoryId[]']").val(categories).trigger('change');
	
	// Handle extras (multiple select with Select2)
	$("select[name='extras[]']").val(extras).trigger('change');
	
	// Show existing images
	if(images.length > 0) {
		var imagesHtml = '';
		images.forEach(function(imgUrl, index) {
			if(imgUrl.trim()) {
				imagesHtml += '<div class="image-item" style="position:relative; display:inline-block; margin:5px;">';
				imagesHtml += '<img src="../logos/' + imgUrl.trim() + '" style="width:100px; height:100px; object-fit:cover; border:1px solid #ddd;">';
				imagesHtml += '<button type="button" class="btn btn-danger btn-xs delete-image" data-image="' + imgUrl.trim() + '" data-product="' + id + '" style="position:absolute; top:-5px; right:-5px; border-radius:50%; width:20px; height:20px; padding:0;"><i class="fa fa-times"></i></button>';
				imagesHtml += '</div>';
			}
		});
		$("#existingImagesContainer").html(imagesHtml);
		$("#existingImages").show();
		
		// Show first image as preview
		$("#productImg").attr("src","../logos/"+images[0]);
		$("#imagePreview").attr("style","margin-top:10px;display:block");
	} else {
		$("#existingImages").hide();
		$("#imagePreview").hide();
	}
	
	// Handle simple product fields
	if(type == '1') {
		toggleSimpleFields('1');
		var price = $("#price"+id).html();
		var cost = $("#cost"+id).html();
		var quantity = $("#quantity"+id).html();
		var sku = $("#sku"+id).html();
		
		$("input[name=price]").val(price);
		$("input[name=cost]").val(cost);
		$("input[name=quantity]").val(quantity);
		$("input[name=sku]").val(sku);
	}
});

// Handle image deletion
$(document).on('click', '.delete-image', function(e) {
	e.preventDefault();
	if(confirm('<?php echo direction("Are you sure you want to delete this image?","هل أنت متأكد من حذف هذه الصورة؟") ?>')) {
		var imageUrl = $(this).data('image');
		var productId = $(this).data('product');
		var imageItem = $(this).closest('.image-item');
		
		// Make AJAX call to delete image
		$.ajax({
			url: '?v=ProductsInline&imgdel=' + imageUrl + '&pid=' + productId,
			type: 'GET',
			success: function(response) {
				imageItem.fadeOut(function() {
					$(this).remove();
					// If no images left, hide the container
					if($('#existingImagesContainer .image-item').length == 0) {
						$('#existingImages').hide();
						$('#imagePreview').hide();
					}
				});
			},
			error: function() {
				alert('<?php echo direction("Error deleting image","خطأ في حذف الصورة") ?>');
			}
		});
	}
});

// Basic initialization of Select2
$(document).ready(function() {
    // Simple Select2 initialization
    $('.select2-multiple').select2();
    $('.select2-single').select2();
    
    // TinyMCE is handled by template's tinymce-data.js
    $('.tinymce').addClass('wysihtml5');
});
</script>

<style>
/* Custom DataTable Loading Overlay - Full Screen */
.datatable-loading {
    position: relative;
}

.datatable-loading .table-responsive {
    opacity: 0.3;
    pointer-events: none;
}

.datatable-loading .dataTables_processing {
    position: fixed !important;
    top: 50% !important;
    left: 50% !important;
    transform: translate(-50%, -50%) !important;
    width: auto !important;
    height: auto !important;
    margin: 0 !important;
    padding: 30px 40px !important;
    background: rgba(255, 255, 255, 0.98) !important;
    border: 1px solid #ddd !important;
    border-radius: 12px !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2) !important;
    z-index: 9999 !important;
    font-size: 16px !important;
    color: #333 !important;
    min-width: 200px !important;
}

.custom-loading-overlay {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #337ab7;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

.loading-text {
    font-weight: 600;
    color: #337ab7;
    font-size: 16px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Full screen overlay backdrop */
.datatable-loading::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    z-index: 9998;
    pointer-events: none;
}

/* Hide default DataTables processing indicator when using custom overlay */
.datatable-loading .dataTables_processing {
    display: flex !important;
}
</style>