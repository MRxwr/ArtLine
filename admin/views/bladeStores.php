<?php 
if( isset($_GET["delId"]) && !empty($_GET["delId"]) ){
	if( updateDB('stores',array('status'=> '1'),"`id` = '{$_GET["delId"]}'") ){
		header("LOCATION: ?v=Stores");
	}
}

if( isset($_POST["title"]) ){
	$id = $_POST["update"];
	unset($_POST["update"]);
	
	// Handle logo upload
	if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
		$filenewname = uploadImageBannerFreeImageHost($_FILES['logo']['tmp_name']);
		$_POST["logo"] = $filenewname;
	}
	
	// Handle background image upload
	if (is_uploaded_file($_FILES['bgImage']['tmp_name'])) {
		$filenewname = uploadImageBannerFreeImageHost($_FILES['bgImage']['tmp_name']);
		$_POST["bgImage"] = $filenewname;
	}
	
	// Handle whatsapp notification array
	if(isset($_POST["whatsappNoti"]) && is_array($_POST["whatsappNoti"])) {
		$_POST["whatsappNoti"] = json_encode($_POST["whatsappNoti"]);
	}
	
	if ( $id == 0 ){
		if( insertDB("stores", $_POST) ){
			header("LOCATION: ?v=Stores");
		}else{
		?>
		<script>
			alert("Could not process your request, Please try again.");
		</script>
		<?php
		}
	}else{
		if( updateDB("stores", $_POST, "`id` = '{$id}'") ){
			header("LOCATION: ?v=Stores");
		}else{
		?>
		<script>
			alert("Could not process your request, Please try again.");
		</script>
		<?php
		}
	}
}

// Get Countries for dropdown
if( $listOfCountries = selectDB("cities","`id` != '0' GROUP BY `countryName`") ){
	$countries = $listOfCountries;
}

?>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
	<h6 class="panel-title txt-dark"><?php echo direction("Store Details","تفاصيل المتجر") ?></h6>
</div>
	<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
	<form class="" method="POST" action="" enctype="multipart/form-data">
		<div class="row m-0">
			<!-- System section -->
			<div class="col-md-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark"><?php echo direction("System", "النظام") ?></h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<!-- system Title -->

							<div class="col-md-12">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark"><?php echo direction("Store URL Title", "عنوان المتجر") ?></h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="text">
												<input class="form-control" type="text" name="storeCode" placeholder="artline">
											</div>
										</div>
									</div>
								</div>
							</div>


							<div class="col-md-4">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark">Title</h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="text">
												<input class="form-control" type="text" name="title" placeholder="Create-Store">
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- default international shipping -->
							<div class="col-md-4">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark"><?php echo direction("International Shipping", "التوصيل الدولي") ?></h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="text">
												<select class="form-control" type="text" name="shippingMethod">
													<?php
													$shippingMethodValues = [0, 1, 2, 3];
													$shippingMethodText = [direction("None", "لا يوجد"), direction("DHL", "دي اتش ال"), direction("Aramex", "أراميكس"), direction("AllowMENA","الومينا")];
													for ($i = 0; $i < sizeof($shippingMethodValues); $i++) {
														echo "<option value='{$shippingMethodValues[$i]}'>{$shippingMethodText[$i]}</option>";
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- default Language -->
							<div class="col-md-4">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark"><?php echo direction("Language", "اللغة") ?></h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="text">
												<select class="form-control" type="text" name="language">
													<?php
													$languageValue = [0, 1];
													$languages = [direction("English", "الإنجليزية"), direction("Arabic", "العربية")];
													for ($i = 0; $i < sizeof($languageValue); $i++) {
														echo "<option value='{$languageValue[$i]}'>{$languages[$i]}</option>";
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- default country -->
							<div class="col-md-4">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark"><?php echo direction("Country", "الدولة") ?></h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="text">
												<select class="form-control" type="text" name="country">
													<option value=""><?php echo direction("Select Country","إختر الدولة") ?></option>
													<?php
													if( $listOfCountries = selectDB("cities","`id` != '0' GROUP BY `countryName`") ){
														for ($i = 0; $i < sizeof($listOfCountries); $i++) {
															echo "<option value='{$listOfCountries[$i]["CountryCode"]}'>{$listOfCountries[$i]["CountryName"]}</option>";
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>



							<!-- default currency -->
							<div class="col-md-4">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark"><?php echo direction("Default Currency", "العملة الأساسية"); ?></h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="text">
												<select class="form-control" name="currency">
													<?php
													if ($currency = selectDB("currency", "`status` = '0' AND `hidden` = '1'")) {
														foreach ($currency as $key) {
															echo "<option value='{$key["short"]}'>{$key["short"]}</option>";
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- system main email -->
							<div class="col-md-4">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark">Email</h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="text">
												<input class="form-control" type="text" name="email" placeholder="info@store.com">
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Phone -->
							<div class="col-md-4">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark"><?php echo direction("Phone","رقم الهاتف") ?></h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="text">
												<input class="form-control" type="text" name="phone" placeholder="+1234567890">
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- system package -->
							<div class="col-md-4">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark">Select Package</h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="text">
												<select class="form-control" name="package">
													<?php
													$packageValue = [0, 1, 2];
													$packageName = [direction("Free", "مجاني"), direction("Monthly", "شهرية"), direction("Annually", "سنوية")];
													for ($i = 0; $i < sizeof($packageValue); $i++) {
														echo "<option value='$packageValue[$i]'>{$packageName[$i]}</option>";
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Whatsapp Notification <?php echo direction("Turn On/Off","تشغيل/إيقاف") ?></h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="text">
										<select class="form-control" name="whatsappNoti[status]" >
											<?php 
											$wStatus = [0,1];
											$wTitle = [direction("No","لا"),direction("Yes","نعم")];
											for( $i = 0; $i < sizeof($wStatus); $i++){
												echo "<option value='{$wStatus[$i]}'>{$wTitle[$i]}</option>";
											}
											?>
										</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>

			<!-- Payment section -->
			<div class="col-md-12">
				<div class="panel panel-default card-view">
				<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo direction("Payment", "الدفع") ?></h6>
				</div>
				<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<!-- Package details -->
					<div class="col-md-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Package Details</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="col-md-6">
										<label><?php echo direction("Start Date", "تاريخ البدء") ?></label>
										<input class="form-control" type="date" name="startDate">
									</div>
									<div class="col-md-6">
										<label><?php echo direction("Amount", "المبلغ") ?></label>
										<input class="form-control" type="float" name="amount" placeholder="25.0">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				</div>
			</div>
			<!-- Theme section -->
			<div class="col-md-12">
				<div class="panel panel-default card-view">
				<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo direction("Theme", "التصميم") ?></h6>
				</div>
				<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
				<div class="panel-body">

					<!-- uplaod system background image -->
					<div class="col-md-6">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><?php echo direction("Upload Background image", "ارفق خلفية") ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="text txt-center">
										<input class="form-control" type="file" name="bgImage"></br>
										<img id="bgImagePreview" src="" style="height:250px; max-width: 100%; display: none;">
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- uplaod system logo -->
					<div class="col-md-6">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><?php echo direction("Upload Logo", "أرفق الشعار") ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="text">
										<input class="form-control" type="file" name="logo"></br>
										<img id="logoPreview" src="" style="height:250px; max-width: 100%; display: none;">
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- select theme -->
					<div class="col-md-3">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><?php echo direction("Theme", "التصميم") ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="text">
										<select class="form-control" type="text" name="theme">
											<?php
											$themeValue = [0, 1];
											$themes = [direction("Categories", "أقسام"), direction("Products", "منتجات")];
											for ($i = 0; $i < sizeof($themeValue); $i++) {
												echo "<option value='{$themeValue[$i]}'>{$themes[$i]}</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- category View -->
					<div class="col-md-3">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><?php echo direction("Category View", "عرض القسم") ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="text">
										<select class="form-control" type="text" name="categoryView">
											<?php
											$categoryViewValue = [0, 1];
											$categoryShapes = [direction("Square", "مربع"), direction("Portrait", "مستطيل")];
											for ($i = 0; $i < sizeof($categoryViewValue); $i++) {
												echo "<option value='{$categoryViewValue[$i]}'>{$categoryShapes[$i]}</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Product View -->
					<div class="col-md-3">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><?php echo direction("Product View", "عرض المنتج") ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="text">
										<select class="form-control" type="text" name="productView">
											<?php
											$productViewValue = [0, 1];
											$productShapes = [direction("Square", "مربع"), direction("Portrait", "مستطيل")];
											for ($i = 0; $i < sizeof($productViewValue); $i++) {
												echo "<option value='{$productViewValue[$i]}'>{$productShapes[$i]}</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- show or hide logo -->
					<div class="col-md-3">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><?php echo direction("Show Category Title", "أظهر عنوان القسم") ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="text">
										<select class="form-control" type="text" name="showCategoryTitle">
											<?php
											$showCategoryTitleValue = [0, 1];
											$showCategoryTitleText = [direction("Show", "أظهر"), direction("Hide", "أخفي") ];
											for ($i = 0; $i < sizeof($showCategoryTitleValue); $i++) {
												echo "<option value='{$showCategoryTitleValue[$i]}'>{$showCategoryTitleText[$i]}</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- show or hide logo -->
					<div class="col-md-4">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><?php echo direction("Show Logo", "أظهر اللوجو") ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="text">
										<select class="form-control" type="text" name="showLogo">
											<?php
											$showLogoValue = [0, 1];
											$showLogoText = [direction("Show", "أظهر"), direction("Hide", "أخفي")];
											for ($i = 0; $i < sizeof($showLogoValue); $i++) {
												echo "<option value='{$showLogoValue[$i]}'>{$showLogoText[$i]}</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Change websie main color -->
					<div class="col-md-4">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><?php echo direction("Website Color", "لون الموقع") ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="text">
										<input class="form-control" type="color" name="websiteColor" value="#000000">
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Change header button colot color -->
					<div class="col-md-4">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><?php echo direction("Header Button Color", "لون الإيقونه") ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="text">
										<input class="form-control" type="color" name="headerButton" value="#000000">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				</div>
			</div>
			
			<div class="col-md-12" style="margin-top:10px">
				<input type="submit" class="btn btn-primary" value="<?php echo direction("Submit","أرسل") ?>">
				<input type="hidden" name="update" value="0">
			</div>
		</div>
	</form>
</div>
</div>
</div>
</div>
				
<!-- Bordered Table -->
<div class="col-sm-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
<h6 class="panel-title txt-dark"><?php echo direction("List of Stores","قائمة المتاجر") ?></h6>
</div>
<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap mt-40">
<div class="table-responsive">
	<table class="table display responsive product-overview mb-30" id="myTable">
		<thead>
		<tr>
		<th><?php echo direction("Title","العنوان") ?></th>
		<th><?php echo direction("Email","البريد الإلكتروني") ?></th>
		<th><?php echo direction("Phone","رقم الهاتف") ?></th>
		<th><?php echo direction("Country","الدولة") ?></th>
		<th><?php echo direction("Theme","التصميم") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		if( $stores = selectDB("stores","`status` = '0'") ){
			for( $i = 0; $i < sizeof($stores); $i++ ){
				$counter = $i + 1;
				
				// Get country name
				$countryName = $stores[$i]["country"];
				if($countryDetails = selectDB("cities","`CountryCode` = '{$stores[$i]["country"]}' LIMIT 1")){
					$countryName = $countryDetails[0]["CountryName"];
				}
				
				// Get language
				$languageText = $stores[$i]["language"] == 0 ? direction("English","الإنجليزية") : direction("Arabic","العربية");
				
				// Get theme
				$themeText = $stores[$i]["theme"] == 0 ? direction("Categories","أقسام") : direction("Products","منتجات");
				?>
				<tr>
				<td id="title<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["title"] ?></td>
				<td id="email<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["email"] ?></td>
				<td id="phone<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["phone"] ?></td>
				<td id="countryName<?php echo $stores[$i]["id"]?>" ><?php echo $countryName ?><label id="country<?php echo $stores[$i]["id"]?>" style="display:none"><?php echo $stores[$i]["country"] ?></label></td>
				<td><?php echo $themeText ?><label id="theme<?php echo $stores[$i]["id"]?>" style="display:none"><?php echo $stores[$i]["theme"] ?></label></td>
				<td class="text-nowrap">
				
				<a id="<?php echo $stores[$i]["id"] ?>" class="mr-25 edit" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل") ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
				</a>
				
				<a href="<?php echo "?v={$_GET["v"]}&delId={$stores[$i]["id"]}" ?>" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف") ?>" onclick="return confirm('Delete entry?')" ><i class="fa fa-close text-danger"></i>
				</a>			
				</td>
				</tr>
				
				<!-- Hidden data for edit -->
				<div style="display:none">
					<label id="currency<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["currency"] ?></label>
					<label id="language<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["language"] ?></label>
					<label id="logo<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["logo"] ?></label>
					<label id="bgImage<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["bgImage"] ?></label>
					<label id="package<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["package"] ?></label>
					<label id="startDate<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["startDate"] ?></label>
					<label id="amount<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["amount"] ?></label>
					<label id="whatsappNoti<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["whatsappNoti"] ?></label>
					<label id="showLogo<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["showLogo"] ?></label>
					<label id="websiteColor<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["websiteColor"] ?></label>
					<label id="headerButton<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["headerButton"] ?></label>
					<label id="categoryView<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["categoryView"] ?></label>
					<label id="productView<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["productView"] ?></label>
					<label id="showCategoryTitle<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["showCategoryTitle"] ?></label>
					<label id="shippingMethod<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["shippingMethod"] ?></label>
					<label id="storeCode<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["storeCode"] ?></label>
				</div>
				<?php
			}
		}
		?>
		</tbody>
		
	</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
	$(document).on("click",".edit", function(){
		var id = $(this).attr("id");
        $("input[name=update]").val(id);
		// Basic info
		var title = $("#title"+id).html();
		var storeCode = $("#storeCode"+id).html();
		var email = $("#email"+id).html();
		var phone = $("#phone"+id).html();
		var country = $("#country"+id).html();
		var language = $("#language"+id).html();
		var currency = $("#currency"+id).html();
		
		// Payment
		var package = $("#package"+id).html();
		var startDate = $("#startDate"+id).html();
		var amount = $("#amount"+id).html();
		
		// Theme
		var theme = $("#theme"+id).html();
		var showLogo = $("#showLogo"+id).html();
		var websiteColor = $("#websiteColor"+id).html();
		var headerButton = $("#headerButton"+id).html();
		var categoryView = $("#categoryView"+id).html();
		var productView = $("#productView"+id).html();
		var showCategoryTitle = $("#showCategoryTitle"+id).html();
		var shippingMethod = $("#shippingMethod"+id).html();
		
		// WhatsApp
		var whatsappNoti = $("#whatsappNoti"+id).html();
		
		// Images
		var logo = $("#logo"+id).html();
		var bgImage = $("#bgImage"+id).html();
		
		// Fill form fields
		$("input[name=title]").val(title);
		$("input[name=storeCode]").val(storeCode);
		$("input[name=email]").val(email);
		$("input[name=phone]").val(phone);
		$("select[name=country]").val(country);
		$("select[name=language]").val(language);
		$("select[name=currency]").val(currency);
		
		// Payment
		$("select[name=package]").val(package);
		$("input[name=startDate]").val(startDate ? startDate.substring(0, 10) : "");
		$("input[name=amount]").val(amount);
		
		// Theme
		$("select[name=theme]").val(theme);
		$("select[name=showLogo]").val(showLogo);
		$("input[name=websiteColor]").val(websiteColor || "#000000");
		$("input[name=headerButton]").val(headerButton || "#000000");
		$("select[name=categoryView]").val(categoryView);
		$("select[name=productView]").val(productView);
		$("select[name=showCategoryTitle]").val(showCategoryTitle);
		$("select[name=shippingMethod]").val(shippingMethod);
		
		// WhatsApp - handle if it's stored as JSON string
		
		// If whatsappNoti is available and not empty
		if (whatsappNoti) {
			try {
				// Try to parse as JSON if it's stored as a JSON string
				var whatsappData = JSON.parse(whatsappNoti);
				
				// Only handle the status (on/off)
				if (whatsappData.status) {
					$("select[name='whatsappNoti[status]']").val(whatsappData.status);
				}
			} catch (e) {
				// If parsing fails, it's not a valid JSON string
				console.log("WhatsApp notification data is not in valid JSON format");
			}
		}
		
		// Show image previews if available
		if (logo) {
			$("#logoPreview").attr("src", "../logos/" + logo).show();
		} else {
			$("#logoPreview").hide();
		}
		
		if (bgImage) {
			$("#bgImagePreview").attr("src", "../logos/" + bgImage).show();
		} else {
			$("#bgImagePreview").hide();
		}
		
		$("input[name=update]").val(id);
		
		// Scroll to the top form
		$('html, body').animate({
			scrollTop: $("form").offset().top
		}, 500);
	})
</script>