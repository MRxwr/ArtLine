<?php 
if( isset($_GET["delId"]) && !empty($_GET["delId"]) ){
	if( updateDB('stores',array('status'=> '1'),"`id` = '{$_GET["delId"]}'") ){
		header("LOCATION: ?v=Stores");
	}
}

if( isset($_POST["title"]) ){
	$id = $_POST["update"];
	unset($_POST["update"]);
	
	if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
		$filenewname = uploadImageBannerFreeImageHost($_FILES['logo']['tmp_name']);
		$_POST["logo"] = $filenewname;
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
			<!-- system Title -->
			<div class="col-md-4">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark"><?php echo direction("Title","العنوان") ?></h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="text">
								<input class="form-control" type="text" name="title" placeholder="Store Name">
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- system version -->
			<div class="col-md-4">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark"><?php echo direction("Email","البريد الإلكتروني") ?></h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="text">
								<input class="form-control" type="email" name="email" placeholder="email@example.com">
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- website description -->
			<div class="col-md-4">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark"><?php echo direction("Description","الوصف") ?></h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="text">
								<input class="form-control" type="text" name="OgDescription" placeholder="Store description">
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

			<!-- system cookie -->
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

			<!-- default currency -->
			<div class="col-md-4">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark"><?php echo direction("Currency", "العملة") ?></h6>
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

			<!-- system main website -->
			<div class="col-md-6">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark"><?php echo direction("Website","الموقع الإلكتروني") ?></h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="text">
								<input class="form-control" type="text" name="website" placeholder="https://example.com">
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Default language -->
			<div class="col-md-6">
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

			<!-- uplaod store logo -->
			<div class="col-md-12">
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
								<input class="form-control" type="file" name="logo">
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
		<th><?php echo direction("Website","الموقع الإلكتروني") ?></th>
		<th><?php echo direction("Language","اللغة") ?></th>
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
				?>
				<tr>
				<td id="title<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["title"] ?></td>
				<td id="email<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["email"] ?></td>
				<td id="phone<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["phone"] ?></td>
				<td id="countryName<?php echo $stores[$i]["id"]?>" ><?php echo $countryName ?><label id="country<?php echo $stores[$i]["id"]?>" style="display:none"><?php echo $stores[$i]["country"] ?></label></td>
				<td id="website<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["website"] ?></td>
				<td><?php echo $languageText ?><label id="language<?php echo $stores[$i]["id"]?>" style="display:none"><?php echo $stores[$i]["language"] ?></label></td>
				<td class="text-nowrap">
				
				<a id="<?php echo $stores[$i]["id"] ?>" class="mr-25 edit" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل") ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
				</a>
				
				<a href="<?php echo "?v={$_GET["v"]}&delId={$stores[$i]["id"]}" ?>" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف") ?>" onclick="return confirm('Delete entry?')" ><i class="fa fa-close text-danger"></i>
				</a>			
				</td>
				</tr>
				
				<!-- Hidden data for edit -->
				<div style="display:none">
					<label id="OgDescription<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["OgDescription"] ?></label>
					<label id="currency<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["currency"] ?></label>
					<label id="logo<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["logo"] ?></label>
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
		var title = $("#title"+id).html();
		var email = $("#email"+id).html();
		var phone = $("#phone"+id).html();
		var country = $("#country"+id).html();
		var website = $("#website"+id).html();
		var language = $("#language"+id).html();
		var currency = $("#currency"+id).html();
		var OgDescription = $("#OgDescription"+id).html();
		
		$("input[name=title]").val(title);
		$("input[name=email]").val(email);
		$("input[name=phone]").val(phone);
		$("select[name=country]").val(country);
		$("input[name=website]").val(website);
		$("select[name=language]").val(language);
		$("select[name=currency]").val(currency);
		$("input[name=OgDescription]").val(OgDescription);
		$("input[name=update]").val(id);
		
		// Scroll to the top form
		$('html, body').animate({
			scrollTop: $("form").offset().top
		}, 500);
	})
</script>