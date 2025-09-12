<?php
function uploadImageFreeImageHostAPI($imageUrl){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://api.imgbb.com/1/upload?expiration=600&key=d4aba98558417ca912f2669f469950c7',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => array('image'=> $imageUrl),
	));
	$response = json_decode(curl_exec($curl),true);
	curl_close($curl);
	if( isset($response["success"]) && $response["success"] == true ){
		file_put_contents("../../logos/{$response["data"]["id"]}.{$response["data"]["image"]["extension"]}", file_get_contents($response["data"]["image"]["url"]));
		file_put_contents("../../logos/m{$response["data"]["id"]}.{$response["data"]["image"]["extension"]}", file_get_contents($response["data"]["medium"]["url"]));
		file_put_contents("../../logos/b{$response["data"]["id"]}.{$response["data"]["image"]["extension"]}", file_get_contents($response["data"]["thumb"]["url"]));
		return "{$response["data"]["id"]}.{$response["data"]["image"]["extension"]}"; 
	}else{
		return "";
	}
}

if( isset($_GET["action"]) ){
    if( $_GET["action"] == "add" ){
        if( !isset($_POST["enTitle"]) || empty($_POST["enTitle"]) ){
            echo outputError(array("msg" => "English title is required"));
            exit;
        }
        if( !isset($_POST["arTitle"]) || empty($_POST["arTitle"]) ){
            echo outputError(array("msg" => "Arabic title is required"));
            exit;
        }
        if( !isset($_POST["enDetails"]) || empty($_POST["enDetails"]) ){
            echo outputError(array("msg" => "English details are required"));
            exit;
        }
        if( !isset($_POST["arDetails"]) || empty($_POST["arDetails"]) ){
            echo outputError(array("msg" => "Arabic details are required"));
            exit;
        }
        if( !isset($_POST["categoryId"]) || empty($_POST["categoryId"]) ){
            echo outputError(array("msg" => "Category is required"));
            exit;
        }
        if( !isset($_POST["brandId"]) || empty($_POST["brandId"]) ){
            echo outputError(array("msg" => "Brand is required"));
            exit;
        }
        if( !isset($_POST["price"]) || empty($_POST["price"]) ){
            echo outputError(array("msg" => "Price is required"));
            exit;
        }
        if( !isset($_POST["quantity"]) || empty($_POST["quantity"]) ){
            echo outputError(array("msg" => "Quantity is required"));
            exit;
        }
        if( !isset($_POST["sku"]) || empty($_POST["sku"]) ){
            echo outputError(array("msg" => "SKU is required"));
            exit;
        }
        if( !isset($_POST["cost"]) || empty($_POST["cost"]) ){
            echo outputError(array("msg" => "Cost is required"));
            exit;
        }
        if( !isset($_POST["image"]) || empty($_POST["image"]) || !is_array($_POST["image"]) ){
            echo outputError(array("msg" => "At least one image is required"));
            exit;
        }
        $data = $_POST;
        $product = array(
            "enTitle" => $data["enTitle"],
            "arTitle" => $data["arTitle"],
            "enDetails" => $data["enDetails"],
            "arDetails" => $data["arDetails"],
            "categoryId" => $data["categoryId"],
            "brandId" => $data["brandId"],
            "hidden" => 1,
            "type" => 1, 
            "extras" => "null",
        );
        if(insertDB("products",$product)){
            $productId = $dbconnect->insert_id;
        }else{
            echo outputError(array("msg" => "Failed to add product"));
        }

        $category = array(
            "productId" => $productId,
            "categoryId" => $data["categoryId"]
        );
        if( insertDB("category_products",$category) ){
        }else{
            echo outputError(array("msg" => "Failed to add product category"));
        }
        $variant = array(
            "productId" => $productId,
            "enTitle" => "",
            "arTitle" => "",
            "attribute" => "",
            "price" => $data["price"],
            "quantity" => $data["quantity"],
            "sku" => $data["sku"],
            "cost" => $data["cost"]
        );
        if( insertDB("attributes_products",$variant) ){
        }else{
            echo outputError(array("msg" => "Failed to add product variant"));
        }
        $i = 0;
        while ( $i < sizeof($data['image']) ){
            if( !empty($data['image'][$i]) ){
                $filenewname = uploadImageFreeImageHostAPI($data["image"][$i]);
                $image = array(
                    "productId" => $productId,
                    "imageurl" => $filenewname
                );
                if( insertDB("images",$image) ){
                }else{
                    echo outputError(array("msg" => "Failed to add product image"));
                    exit;
                }
            }
            $i++;
        }
        echo outputData(array("msg" => "Product added successfully"));
    }else{
        echo outputError(array("msg" => "Failed to find action"));
    }
}else{
    echo outputError(array("msg" => "please set action"));
}
?>