<?php 
if( isset($_GET["delId"]) && !empty($_GET["delId"]) ){
	if( updateDB('stores',array('status'=> '1'),"`id` = '{$_GET["delId"]}'") ){
		header("LOCATION: ?v=Stores");
	}
}

if( isset($_POST["name"]) ){
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
$countries = [];
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
			<div class="col-md-4">
			<label><?php echo direction("Store Name","إسم المتجر") ?></label>
			<input type="text" name="name" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Email","البريد الإلكتروني") ?></label>
			<input type="email" name="email" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Phone","رقم الهاتف") ?></label>
			<input type="text" name="phone" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Country","الدولة") ?></label>
			<select name="country" class="form-control" required>
				<option value=""><?php echo direction("Select Country","إختر الدولة") ?></option>
				<?php
				foreach ($countries as $country) {
					echo "<option value='{$country["CountryCode"]}'>{$country["CountryName"]}</option>";
				}
				?>
			</select>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Address","العنوان") ?></label>
			<input type="text" name="address" class="form-control" required>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Website","الموقع الإلكتروني") ?></label>
			<input type="text" name="website" class="form-control">
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Store Type","نوع المتجر") ?></label>
			<select name="type" class="form-control" required>
				<option value="0"><?php echo direction("Retail","تجزئة") ?></option>
				<option value="1"><?php echo direction("Wholesale","جملة") ?></option>
				<option value="2"><?php echo direction("Both","كلاهما") ?></option>
			</select>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Active","نشط") ?></label>
			<select name="active" class="form-control" required>
				<option value="0"><?php echo direction("No","لا") ?></option>
				<option value="1"><?php echo direction("Yes","نعم") ?></option>
			</select>
			</div>
			
			<div class="col-md-4">
			<label><?php echo direction("Logo","الشعار") ?></label>
			<input type="file" name="logo" class="form-control">
			</div>
			
			<div class="col-md-12" style="margin-top:10px">
			<label><?php echo direction("Description","الوصف") ?></label>
			<textarea name="description" class="form-control" rows="4"></textarea>
			</div>
			
			<div class="col-md-6" style="margin-top:10px">
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
		<th><?php echo direction("Store Name","إسم المتجر") ?></th>
		<th><?php echo direction("Email","البريد الإلكتروني") ?></th>
		<th><?php echo direction("Phone","رقم الهاتف") ?></th>
		<th><?php echo direction("Country","الدولة") ?></th>
		<th><?php echo direction("Type","النوع") ?></th>
		<th><?php echo direction("Active","نشط") ?></th>
		<th class="text-nowrap"><?php echo direction("Actions","الخيارات") ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php 
		if( $stores = selectDB("stores","`status` = '0'") ){
			for( $i = 0; $i < sizeof($stores); $i++ ){
				$counter = $i + 1;
				$storeType = "";
				if($stores[$i]["type"] == 0){
					$storeType = direction("Retail","تجزئة");
				}elseif($stores[$i]["type"] == 1){
					$storeType = direction("Wholesale","جملة");
				}else{
					$storeType = direction("Both","كلاهما");
				}
				
				$activeStatus = $stores[$i]["active"] == 0 ? direction("No","لا") : direction("Yes","نعم");
				
				// Get country name
				$countryName = $stores[$i]["country"];
				if($countryDetails = selectDB("cities","`CountryCode` = '{$stores[$i]["country"]}' LIMIT 1")){
					$countryName = $countryDetails[0]["CountryName"];
				}
				
				?>
				<tr>
				<td id="name<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["name"] ?></td>
				<td id="email<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["email"] ?></td>
				<td id="phone<?php echo $stores[$i]["id"]?>" ><?php echo $stores[$i]["phone"] ?></td>
				<td id="countryName<?php echo $stores[$i]["id"]?>" ><?php echo $countryName ?><label id="country<?php echo $stores[$i]["id"]?>" style="display:none"><?php echo $stores[$i]["country"] ?></label></td>
				<td><?php echo $storeType ?><label id="type<?php echo $stores[$i]["id"]?>" style="display:none"><?php echo $stores[$i]["type"] ?></label></td>
				<td><?php echo $activeStatus ?><label id="active<?php echo $stores[$i]["id"]?>" style="display:none"><?php echo $stores[$i]["active"] ?></label></td>
				<td class="text-nowrap">
				
				<a id="<?php echo $stores[$i]["id"] ?>" class="mr-25 edit" data-toggle="tooltip" data-original-title="<?php echo direction("Edit","تعديل") ?>"> <i class="fa fa-pencil text-inverse m-r-10"></i>
				</a>
				
				<a href="<?php echo "?v={$_GET["v"]}&delId={$stores[$i]["id"]}" ?>" data-toggle="tooltip" data-original-title="<?php echo direction("Delete","حذف") ?>" onclick="return confirm('Delete entry?')" ><i class="fa fa-close text-danger"></i>
				</a>			
				</td>
				</tr>
				
				<!-- Hidden data for edit -->
				<div style="display:none">
					<label id="website<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["website"] ?></label>
					<label id="address<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["address"] ?></label>
					<label id="description<?php echo $stores[$i]["id"] ?>"><?php echo $stores[$i]["description"] ?></label>
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
		var name = $("#name"+id).html();
		var email = $("#email"+id).html();
		var phone = $("#phone"+id).html();
		var country = $("#country"+id).html();
		var type = $("#type"+id).html();
		var active = $("#active"+id).html();
		var website = $("#website"+id).html();
		var address = $("#address"+id).html();
		var description = $("#description"+id).html();
		
		$("input[name=name]").val(name);
		$("input[name=email]").val(email);
		$("input[name=phone]").val(phone);
		$("select[name=country]").val(country);
		$("select[name=type]").val(type);
		$("select[name=active]").val(active);
		$("input[name=website]").val(website);
		$("input[name=address]").val(address);
		$("textarea[name=description]").val(description);
		$("input[name=update]").val(id);
		
		// Scroll to the top form
		$('html, body').animate({
			scrollTop: $("form").offset().top
		}, 500);
	})
</script>