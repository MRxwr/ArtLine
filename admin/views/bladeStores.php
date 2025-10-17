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

	// Handle sizechart image upload
	if (is_uploaded_file($_FILES['sizeChartImage']['tmp_name'])) {
		$filenewname = uploadImageBannerFreeImageHost($_FILES['sizeChartImage']['tmp_name']);
		$_POST["sizeChartImage"] = $filenewname;
	}
	
	// Handle whatsapp notification array
	if(isset($_POST["whatsappNoti"]) && is_array($_POST["whatsappNoti"])) {
		$_POST["whatsappNoti"] = json_encode($_POST["whatsappNoti"]);
	}
	
	// Handle about and privacy encoding
	$_POST["enAbout"] = urlencode($_POST["enAbout"]);
	$_POST["arAbout"] = urlencode($_POST["arAbout"]);
	$_POST["enPrivacy"] = urlencode($_POST["enPrivacy"]);
	$_POST["arPrivacy"] = urlencode($_POST["arPrivacy"]);
	$_POST["enTerms"] = urlencode($_POST["enTerms"]);
	$_POST["arTerms"] = urlencode($_POST["arTerms"]);
	$_POST["socialMedia"] = json_encode($_POST["socialMedia"]);
	$_POST["internationalDelivery"] = json_encode($_POST["internationalDelivery"]);
	$_POST["expressDelivery"] = json_encode($_POST["expressDelivery"]);

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
							<!-- system url code -->
							<div class="col-md-6">
								<h6 class="panel-title txt-dark"><?php echo direction("Store URL Title", "عنوان المتجر") ?></h6>
								<input class="form-control" type="text" name="storeCode" placeholder="artline">
							</div>

							<!-- maintenance mode -->
							<div class="col-md-6">
								<h6 class="panel-title txt-dark"><?php echo direction("Maintenance Mode", "وضع الصيانة") ?></h6>
								<select class="form-control" type="text" name="maintenanceMode">
									<?php
									$maintenanceModesValue = [1,2,3];
									$maintenanceModesText = [direction("Maintenance Mode", "وضع الصيانة"), direction("Busy Mode", "وضع مشغول"), direction("OFF", "إيقاف")];
									for ($i = 0; $i < sizeof($maintenanceModesValue); $i++) {
										echo "<option value='{$maintenanceModesValue[$i]}'>{$maintenanceModesText[$i]}</option>";
									}
									?>
								</select>
							</div>

							<!-- system Title -->
							<div class="col-md-4">
								<h6 class="panel-title txt-dark"><?php echo direction("Title", "العنوان") ?></h6>
								<input class="form-control" type="text" name="title" placeholder="Create-Store">
							</div>

							<!-- default international shipping -->
							<div class="col-md-4">
								<h6 class="panel-title txt-dark"><?php echo direction("International Shipping", "التوصيل الدولي") ?></h6>
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

							<!-- default Language -->
							<div class="col-md-4">
								<h6 class="panel-title txt-dark"><?php echo direction("Language", "اللغة") ?></h6>
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

							<!-- default country -->
							<div class="col-md-4">
								<h6 class="panel-title txt-dark"><?php echo direction("Country", "الدولة") ?></h6>
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

							<!-- default currency -->
							<div class="col-md-4">
								<h6 class="panel-title txt-dark"><?php echo direction("Default Currency", "العملة الأساسية"); ?></h6>
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

							<!-- system main email -->
							<div class="col-md-4">
								<h6 class="panel-title txt-dark"><?php echo direction("Email","البريد الإلكتروني") ?></h6>
								<input class="form-control" type="text" name="email" placeholder="info@store.com">
							</div>

							<!-- Phone -->
							<div class="col-md-4">
								<h6 class="panel-title txt-dark"><?php echo direction("Phone","رقم الهاتف") ?></h6>
								<input class="form-control" type="text" name="phone" placeholder="+1234567890">
							</div>

							<!-- payment API Key -->
							<div class="col-md-4">
								<h6 class="panel-title txt-dark"><?php echo direction("Payment API Key","مفتاح واجهة برمجة التطبيقات للدفع") ?></h6>
								<input class="form-control" type="text" name="paymentAPIKey" placeholder="sk_test_4eC39HqLyjWDarjtT1zdp7dc">
							</div>

							<div class="col-md-4">
								<h6 class="panel-title txt-dark">Whatsapp Notification <?php echo direction("Turn On/Off","تشغيل/إيقاف") ?></h6>
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
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("Select Package Type", "اختر نوع الباقة") ?></h6>
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
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("Start Date", "تاريخ البدء") ?></h6>
						<input class="form-control" type="date" name="startDate">
					</div>
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("Amount", "المبلغ") ?></h6>
						<input class="form-control" type="float" name="amount" placeholder="25.0">
					</div>
				</div>
				</div>
				</div>
			</div>

			<!-- other section -->
			<div class="col-md-12">
				<div class="panel panel-default card-view">
				<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo direction("Other Settings", "إعدادات أخرى") ?></h6>
				</div>
				<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
				<div class="panel-body">

					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Gift Card", "بطاقة هدية") ?></h6>
						<select class="form-control" name="giftCard">
							<?php
							$giftCardValue = [0, 1];
							$giftCardName = [direction("No", "لا"), direction("Yes", "نعم")];
							for ($i = 0; $i < sizeof($giftCardValue); $i++) {
								echo "<option value='$giftCardValue[$i]'>{$giftCardName[$i]}</option>";
							}
							?>
						</select>
					</div>

					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Buyer Email", "البريد الإلكتروني للمشتري") ?></h6>
						<select class="form-control" name="emailOpt">
							<?php
							$emailOptValue = [0, 1];
							$emailOptName = [direction("No", "لا"), direction("Yes", "نعم")];
							for ($i = 0; $i < sizeof($emailOptValue); $i++) {
								echo "<option value='$emailOptValue[$i]'>{$emailOptName[$i]}</option>";
							}
							?>
						</select>
					</div>

					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Enable Invoice Image", "تمكين صورة الفاتورة") ?></h6>
						<select class="form-control" name="enableInvoiceImage">
							<?php
							$enableInvoiceImageValue = [0, 1];
							$enableInvoiceImageName = [direction("No", "لا"), direction("Yes", "نعم")];
							for ($i = 0; $i < sizeof($enableInvoiceImageValue); $i++) {
								echo "<option value='$enableInvoiceImageValue[$i]'>{$enableInvoiceImageName[$i]}</option>";
							}
							?>
						</select>
					</div>

					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("User Discount", "خصم المستخدم") ?></h6>
						<input class="form-control" type="number" step="0.1" min="0" name="userDiscount" placeholder="25.0">
					</div>

					<div class="col-md-12">
						<h6 class="panel-title txt-dark"><?php echo direction("Size Chart Image", "صورة جدول المقاسات") ?></h6>
						<input class="form-control" type="file" name="sizeChartImage" >
						<img id="sizeChartPreview" src="" style="max-width: 100%; max-height: 300px; margin-top: 10px; display: none;">
					</div>

				</div>
				</div>
				</div>
			</div>

			<!-- Delivery section -->
			<div class="col-md-12">
				<div class="panel panel-default card-view">
				<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo direction("Delivery Settings", "إعدادات التوصيل") ?></h6>
				</div>
				<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
				<div class="panel-body">

					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("Delivery English Note", "ملاحظة توصيل باللغة الإنجليزية") ?></h6>
						<input class="form-control" type="text" name="enDeveliveryTime" placeholder="Enter note in English">
					</div>

					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("Delivery Arabic Note", "ملاحظة توصيل باللغة العربية") ?></h6>
						<input class="form-control" type="text" name="arDeveliveryTime" placeholder="Enter note in Arabic">
					</div>

					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("Pick Up", "استلام الطلب") ?></h6>
						<select class="form-control" name="inStore">
							<?php
							$pickupValue = [0, 1];
							$pickupName = [direction("No", "لا"), direction("Yes", "نعم")];
							for ($i = 0; $i < sizeof($pickupValue); $i++) {
								echo "<option value='$pickupValue[$i]'>{$pickupName[$i]}</option>";
							}
							?>
						</select>
					</div>

					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("No Address", "لا يوجد عنوان") ?></h6>
						<select class="form-control" name="noAddress">
							<?php
							$noAddressValue = [0, 1];
							$noAddressName = [direction("No", "لا"), direction("Yes", "نعم")];
							for ($i = 0; $i < sizeof($noAddressValue); $i++) {
								echo "<option value='$noAddressValue[$i]'>{$noAddressName[$i]}</option>";
							}
							?>
						</select>
					</div>

					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("No Address Delivery Charge", "رسوم التوصيل بدون عنوان") ?></h6>
						<input class="form-control" type="number" step="0.1" min="0" name="noAddressDelivery" placeholder="0">
					</div>

					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Express Delivery", "توصيل سريع") ?></h6>
						<select class="form-control" name="expressDelivery[status]">
							<?php
							$expressDeliveryValue = [0, 1];
							$expressDeliveryName = [direction("No", "لا"), direction("Yes", "نعم")];
							for ($i = 0; $i < sizeof($expressDeliveryValue); $i++) {
								echo "<option value='$expressDeliveryValue[$i]'>{$expressDeliveryName[$i]}</option>";
							}
							?>
						</select>
					</div>

					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Express Delivery Charge", "رسوم التوصيل السريع") ?></h6>
						<input class="form-control" type="number" step="0.1" min="0" name="expressDelivery[charge]" placeholder="0">
					</div>

					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Express Delivery English Note", "ملاحظة توصيل سريع باللغة الإنجليزية") ?></h6>
						<input class="form-control" type="text" name="expressDelivery[englishNote]" placeholder="Enter note in English">
					</div>

					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Express Delivery Arabic Note", "ملاحظة توصيل سريع باللغة العربية") ?></h6>
						<input class="form-control" type="text" name="expressDelivery[arabicNote]" placeholder="Enter note in Arabic">
					</div>

					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("International Delivery 1st Item", "توصيل دولي للمنتج الأول") ?></h6>
						<input class="form-control" type="number" step="0.1" min="0" name="internationalDelivery[0]" placeholder="0">
					</div>

					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("International Delivery Extra Item", "توصيل دولي للمنتج الإضافي") ?></h6>
						<input class="form-control" type="number" step="0.1" min="0" name="internationalDelivery[1]" placeholder="0">
					</div>

				</div>
				</div>
				</div>
			</div>

			<!-- soccial media accounts section -->
			<div class="col-md-12">
				<div class="panel panel-default card-view">
				<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo direction("Social Media Accounts", "حسابات التواصل الاجتماعي") ?></h6>
				</div>
				<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("Phone Number", "رقم الهاتف") ?></h6>
						<input class="form-control" type="number" step="1" minlength="11" name="socialMedia[phone]" placeholder="965xxxxxxxx">
					</div>
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("Email", "البريد الإلكتروني") ?></h6>
						<input class="form-control" type="email" name="socialMedia[email]" placeholder="you@example.com">
					</div>
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("whatsapp", "واتساب") ?></h6>
						<input class="form-control" type="number" step="1" minlength="11" name="socialMedia[whatsapp]" placeholder="965xxxxxxxx">
					</div>
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("instagram", "إنستغرام") ?></h6>
						<input class="form-control" type="text" name="socialMedia[instagram]" placeholder="https://instagram.com/yourpage">
					</div>
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("snapchat", "سناب شات") ?></h6>
						<input class="form-control" type="text" name="socialMedia[snapchat]" placeholder="https://snapchat.com/yourpage">
					</div>
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("tiktok", "تيك توك") ?></h6>
						<input class="form-control" type="text" name="socialMedia[tiktok]" placeholder="https://tiktok.com/yourpage">
					</div>
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("twitter", "تويتر") ?></h6>
						<input class="form-control" type="text" name="socialMedia[twitter]" placeholder="https://twitter.com/yourpage">
					</div>
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("facebook", "فيسبوك") ?></h6>
						<input class="form-control" type="text" name="socialMedia[facebook]" placeholder="https://facebook.com/yourpage">
					</div>
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("google maps", "خرائط جوجل") ?></h6>
						<input class="form-control" type="text" name="socialMedia[location]" placeholder="https://google.com/maps/yourlocation">
					</div>
				</div>
				</div>
				</div>
			</div>

			<!-- privacy and terms and about section -->
			<div class="col-md-12">
				<div class="panel panel-default card-view">
				<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo direction("Pages", "صفحات") ?></h6>
				</div>
				<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("About Us (EN)", "من نحن (إنجليزي)") ?></h6>
						<textarea id="enAbout" name="enAbout" class="tinymce"></textarea>
					</div>
					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("About Us (AR)", "من نحن (عربي)") ?></h6>
						<textarea id="arAbout" name="arAbout" class="tinymce"></textarea>
					</div>
					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("Privacy Policy (EN)", "سياسة الخصوصية (إنجليزي)") ?></h6>
						<textarea id="enPrivacy" name="enPrivacy" class="tinymce"></textarea>
					</div>
					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("Privacy Policy (AR)", "سياسة الخصوصية (عربي)") ?></h6>
						<textarea id="arPrivacy" name="arPrivacy" class="tinymce"></textarea>
					</div>
					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("Terms of Service (EN)", "شروط الخدمة (إنجليزي)") ?></h6>
						<textarea id="enTerms" name="enTerms" class="tinymce"></textarea>
					</div>
					<div class="col-md-6">
						<h6 class="panel-title txt-dark"><?php echo direction("Terms of Service (AR)", "شروط الخدمة (عربي)") ?></h6>
						<textarea id="arTerms" name="arTerms" class="tinymce"></textarea>
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
						<h6 class="panel-title txt-dark"><?php echo direction("Theme", "التصميم") ?></h6>
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

					<!-- category View -->
					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Category View", "عرض القسم") ?></h6>
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

					<!-- Product View -->
					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Product View", "عرض المنتج") ?></h6>
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

					<!-- show or hide logo -->
					<div class="col-md-3">
						<h6 class="panel-title txt-dark"><?php echo direction("Show Category Title", "أظهر عنوان القسم") ?></h6>
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
					
					<!-- show or hide logo -->
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("Show Logo", "أظهر اللوجو") ?></h6>
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

					<!-- Change websie main color -->
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("Website Color", "لون الموقع") ?></h6>
						<input class="form-control" type="color" name="websiteColor" value="#000000">
					</div>

					<!-- Change header button colot color -->
					<div class="col-md-4">
						<h6 class="panel-title txt-dark"><?php echo direction("Header Button Color", "لون الإيقونه") ?></h6>
						<input class="form-control" type="color" name="headerButton" value="#000000">
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
		<th><?php echo direction("Maintenance Mode","وضع الصيانة") ?></th>
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

				// maintenance mode 1 = maintenance , 2 = busy, 3 = off
				if($stores[$i]["maintenanceMode"] == 1){
					$maintenanceStatus = direction("Maintenance Mode","وضع الصيانة");
				}elseif($stores[$i]["maintenanceMode"] == 2){
					$maintenanceStatus = direction("Busy Mode","وضع مشغول");
				}else{
					$maintenanceStatus = direction("OFF","إيقاف");
				}
				?>
				<tr>
				<td id="title<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["title"] ?></td>
				<td id="email<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["email"] ?></td>
				<td id="phone<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["phone"] ?></td>
				<td id="countryName<?php echo $stores[$i]["id"]?>" ><?php echo $countryName ?><label id="country<?php echo $stores[$i]["id"]?>" style="display:none"><?php echo $stores[$i]["country"] ?></label></td>
				<td><?php echo $themeText ?><label id="theme<?php echo $stores[$i]["id"]?>" style="display:none"><?php echo $stores[$i]["theme"] ?></label></td>
				<td><?php echo $maintenanceStatus ?></td>
				<td class="text-nowrap">
					<a id="<?php echo $stores[$i]["id"] ?>" class="mr-25 edit" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل") ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
					<a href="<?php echo "?v={$_GET["v"]}&delId={$stores[$i]["id"]}" ?>" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف") ?>" onclick="return confirm('Delete entry?')" ><i class="fa fa-close text-danger"></i></a>			
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
					<label id="maintenanceMode<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["maintenanceMode"] ?></label>
					<label id="enAbout<?php echo $stores[$i]["id"] ?>"><?php echo urldecode($stores[$i]["enAbout"]) ?></label>
					<label id="arAbout<?php echo $stores[$i]["id"] ?>"><?php echo urldecode($stores[$i]["arAbout"]) ?></label>
					<label id="enPrivacy<?php echo $stores[$i]["id"] ?>"><?php echo urldecode($stores[$i]["enPrivacy"]) ?></label>
					<label id="arPrivacy<?php echo $stores[$i]["id"] ?>"><?php echo urldecode($stores[$i]["arPrivacy"]) ?></label>
					<label id="enTerms<?php echo $stores[$i]["id"] ?>"><?php echo urldecode($stores[$i]["enTerms"]) ?></label>
					<label id="arTerms<?php echo $stores[$i]["id"] ?>"><?php echo urldecode($stores[$i]["arTerms"]) ?></label>
					<label id="socialMedia<?php echo $stores[$i]["id"] ?>"><?php echo htmlspecialchars($stores[$i]["socialMedia"]) ?></label>
					<label id="sizeChartImage<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["sizeChartImage"] ?></label>
					<label id="userDiscount<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["userDiscount"] ?></label>
					<label id="internationalDelivery<?php echo $stores[$i]["id"] ?>"><?php echo htmlspecialchars($stores[$i]["internationalDelivery"]) ?></label>
					<label id="inStore<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["inStore"] ?></label>
					<label id="giftCard<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["giftCard"] ?></label>
					<label id="enableInvoiceImage<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["enableInvoiceImage"] ?></label>
					<label id="noAddress<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["noAddress"] ?></label>
					<label id="noAddressDelivery<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["noAddressDelivery"] ?></label>
					<label id="expressDelivery<?php echo $stores[$i]["id"] ?>"><?php echo htmlspecialchars($stores[$i]["expressDelivery"]) ?></label>
					<label id="emailOpt<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["emailOpt"] ?></label>
					<label id="enDeliveryTime<?php echo $stores[$i]["id"] ?>"><?php echo htmlspecialchars($stores[$i]["enDeliveryTime"]) ?></label>
					<label id="arDeliveryTime<?php echo $stores[$i]["id"] ?>"><?php echo htmlspecialchars($stores[$i]["arDeliveryTime"]) ?></label>
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
		var maintenanceMode = $("#maintenanceMode"+id).html();
		var enAbout = $("#enAbout"+id).html();
		var arAbout = $("#arAbout"+id).html();
		var enPrivacy = $("#enPrivacy"+id).html();
		var arPrivacy = $("#arPrivacy"+id).html();
		var enTerms = $("#enTerms"+id).html();
		var arTerms = $("#arTerms"+id).html();
		var socialMedia = $("#socialMedia"+id).html();
		var sizeChartImage = $("#sizeChartImage"+id).html();
		var userDiscount = $("#userDiscount"+id).html();
		var internationalDelivery = $("#internationalDelivery"+id).html();
		var inStore = $("#inStore"+id).html();
		var giftCard = $("#giftCard"+id).html();
		var enableInvoiceImage = $("#enableInvoiceImage"+id).html();
		var noAddress = $("#noAddress"+id).html();
		var noAddressDelivery = $("#noAddressDelivery"+id).html();
		var expressDelivery = $("#expressDelivery"+id).html();
		var emailOpt = $("#emailOpt"+id).html();
		var enDeliveryTime = $("#enDeliveryTime"+id).html();
		var arDeliveryTime = $("#arDeliveryTime"+id).html();

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
		$("input[name=storeCode]").val(storeCode).focus();
		$("input[name=email]").val(email);
		$("input[name=phone]").val(phone);
		$("select[name=country]").val(country);
		$("select[name=language]").val(language);
		$("select[name=currency]").val(currency);
		$("select[name=maintenanceMode]").val(maintenanceMode);
		$("select[name=emailOpt]").val(emailOpt);
		$("input[name=enDeliveryTime]").val(enDeliveryTime);
		$("input[name=arDeliveryTime]").val(arDeliveryTime);
		
		// Other Settings Fields
		$("select[name=inStore]").val(inStore);
		$("select[name=giftCard]").val(giftCard);
		$("select[name=enableInvoiceImage]").val(enableInvoiceImage);
		$("select[name=noAddress]").val(noAddress);
		$("input[name=noAddressDelivery]").val(noAddressDelivery);
		$("input[name=expressDelivery]").val(expressDelivery);
		$("input[name=userDiscount]").val(userDiscount);

		// Social Media - Parse JSON and populate fields
		if (socialMedia) {
			try {
				var socialMediaData = JSON.parse(socialMedia);
				if (socialMediaData) {
					// Populate each social media field
					if (socialMediaData.phone) $("input[name='socialMedia[phone]']").val(socialMediaData.phone);
					if (socialMediaData.email) $("input[name='socialMedia[email]']").val(socialMediaData.email);
					if (socialMediaData.whatsapp) $("input[name='socialMedia[whatsapp]']").val(socialMediaData.whatsapp);
					if (socialMediaData.instagram) $("input[name='socialMedia[instagram]']").val(socialMediaData.instagram);
					if (socialMediaData.snapchat) $("input[name='socialMedia[snapchat]']").val(socialMediaData.snapchat);
					if (socialMediaData.tiktok) $("input[name='socialMedia[tiktok]']").val(socialMediaData.tiktok);
					if (socialMediaData.twitter) $("input[name='socialMedia[twitter]']").val(socialMediaData.twitter);
					if (socialMediaData.facebook) $("input[name='socialMedia[facebook]']").val(socialMediaData.facebook);
					if (socialMediaData.location) $("input[name='socialMedia[location]']").val(socialMediaData.location);
				}
			} catch (e) {
				console.log("Error parsing social media data:", e);
			}
		}

		// internationalDelivery - Parse JSON if needed
		if (internationalDelivery) {
			try {
				var internationalDeliveryData = JSON.parse(internationalDelivery);
				if (internationalDeliveryData) {
					$("input[name='internationalDelivery[0]']").val(internationalDeliveryData[0]);
					$("input[name='internationalDelivery[1]']").val(internationalDeliveryData[1]);
				}
			} catch (e) {
				console.log("Error parsing international delivery data:", e);
			}
		}

		// express Delivery - Parse JSON if needed
		if (expressDelivery) {
			try {
				var expressDeliveryData = JSON.parse(expressDelivery);
				if (expressDeliveryData) {
					$("select[name='expressDelivery[status]']").val(expressDeliveryData.status);
					$("input[name='expressDelivery[charge]']").val(expressDeliveryData.charge);
					$("input[name='expressDelivery[englishNote]']").val(expressDeliveryData.englishNote);
					$("input[name='expressDelivery[arabicNote]']").val(expressDeliveryData.arabicNote);
				}
			} catch (e) {
				console.log("Error parsing express delivery data:", e);
			}
		}
		
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

		// About and Policies - Set content using TinyMCE API
		// Check if TinyMCE instances exist, if not they'll be populated when initialized
		if (tinymce.get("enAbout")) {
			tinymce.get("enAbout").setContent(enAbout || "");
		}
		if (tinymce.get("arAbout")) {
			tinymce.get("arAbout").setContent(arAbout || "");
		}
		if (tinymce.get("enPrivacy")) {
			tinymce.get("enPrivacy").setContent(enPrivacy || "");
		}
		if (tinymce.get("arPrivacy")) {
			tinymce.get("arPrivacy").setContent(arPrivacy || "");
		}
		if (tinymce.get("enTerms")) {
			tinymce.get("enTerms").setContent(enTerms || "");
		}
		if (tinymce.get("arTerms")) {
			tinymce.get("arTerms").setContent(arTerms || "");
		}
		
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
		
		if (sizeChartImage) {
			$("#sizeChartPreview").attr("src", "../logos/" + sizeChartImage).show();
		} else {
			$("#sizeChartPreview").hide();
		}
		
		$("input[name=update]").val(id);
		
		// Scroll to the top form
		$('html, body').animate({
			scrollTop: $("form").offset().top
		}, 500);
	})
</script>