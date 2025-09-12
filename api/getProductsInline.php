<?php
require("../admin/includes/config.php");
require("../admin/includes/functions.php");

$counter = 0;
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Search 
$searchQuery = " "; 
$searchQueryCounter = "";

if($searchValue != ''){
  $searchQuery = " AND (subId LIKE '%".$searchValue."%' OR enTitle LIKE '%".$searchValue."%' OR arTitle LIKE '%".$searchValue."%')";
  $searchQueryCounter = " AND (subId LIKE '%".$searchValue."%' OR enTitle LIKE '%".$searchValue."%' OR arTitle LIKE '%".$searchValue."%')";
}

## Total number of records without filtering
$psorders = selectDB2("COUNT(*) AS `totalCount`","products","status = '0' AND hidden != '2'");
$totalRecords = $psorders[0]["totalCount"];

## Total number of record with filtering
$sorders = selectDB2("COUNT(*) AS `totalCount`","products","status = '0' AND hidden != '2' {$searchQueryCounter}");
$totalRecordwithFilter = $sorders[0]["totalCount"];

if( $products = selectDB("products","status = '0' AND hidden != '2' {$searchQuery} ORDER BY `id` DESC LIMIT {$row},{$rowperpage}") ){
    $data = array(); 
	for( $i = 0; $i < sizeof($products); $i++ ){
        $counter = $row + $i + 1;
        
        // Get all product images
        $productImages = selectDB("images", "`productId` = '{$products[$i]["id"]}' ORDER BY `id` ASC");
        $imageUrls = array();
        $primaryImageUrl = "noimage.png";
        
        if($productImages){
            foreach($productImages as $img){
                $imageUrls[] = $img["imageurl3"];
            }
            $primaryImageUrl = $imageUrls[0]; // Use first image as primary
        }
        
        // Get product categories
        $productCategories = selectDB("category_products", "`productId` = '{$products[$i]["id"]}'");
        $categoryNames = array();
        if($productCategories){
            foreach($productCategories as $pc){
                $cat = selectDB("categories", "`id` = '{$pc["categoryId"]}'");
                if($cat) $categoryNames[] = direction($cat[0]["enTitle"], $cat[0]["arTitle"]);
            }
        }
        
        // Get price for simple products
        $price = "";
        $attr = null;
        if($products[$i]["type"] == 1){
            $attr = selectDB("attributes_products", "`productId` = '{$products[$i]["id"]}' ORDER BY `id` DESC LIMIT 1");
            $price = ($attr) ? $attr[0]["price"] : "0";
        }else{
            $price = direction("Variant","متغير");
        }
        
        $action = "";
		$english = "<label style='white-space: break-spaces;'>{$products[$i]["enTitle"]}</label>";
		$arabic = "<label style='white-space: break-spaces;'>{$products[$i]["arTitle"]}</label>";
        $image = "<img src='../logos/{$primaryImageUrl}' style='width:75px;height:75px'>";
        $order = $products[$i]["id"];
        $type = ($products[$i]["type"] == 1) ? direction("Simple","بسيط") : direction("Variant","متغير");
        
        // Show/Hide logic
        if ( $products[$i]["hidden"] == 1 ){
            $icon = "fa fa-eye";
            $link = "?v=ProductsInline&show={$products[$i]["id"]}";
            $hide = direction("Show","إظهار");
        }else{
            $icon = "fa fa-eye-slash";
            $link = "?v=ProductsInline&hide={$products[$i]["id"]}";
            $hide = direction("Hide","إخفاء");
        }
        
        // Recent status
        $recentColor = ($products[$i]["recent"] == 1) ? "text-success" : "text-muted";
        $recentLink = "?v=ProductsInline&newId={$products[$i]["id"]}";
        
        // Bestseller status
        $bestColor = ($products[$i]["bestSeller"] == 1) ? "text-success" : "text-muted";
        $bestLink = "?v=ProductsInline&bestId={$products[$i]["id"]}";
        
        // Build actions
        if($products[$i]["type"] == 1) {
            $action .= '<a id="'.$products[$i]["id"].'" class="mr-25 edit" data-toggle="tooltip" data-original-title="'.direction("Edit","تعديل").'"> 
                <i class="fa fa-pencil text-inverse m-r-10"></i>
            </a>';
        } else {
            $action .= '<a href="?v=ProductAction&id='.$products[$i]["id"].'" class="mr-25" data-toggle="tooltip" data-original-title="'.direction("Edit Variant","تعديل المتغير").'"> 
                <i class="fa fa-cogs text-inverse m-r-10"></i>
            </a>';
        }
        
        $action .= '<a href="'.$recentLink.'" class="mr-25 '.$recentColor.'" data-toggle="tooltip" data-original-title="'.direction("Recent","جديدنا").'"> 
            <i class="fa fa-star m-r-10"></i>
        </a>';
        
        $action .= '<a href="'.$bestLink.'" class="mr-25 '.$bestColor.'" data-toggle="tooltip" data-original-title="'.direction("Bestseller","الأكثر مبيعا").'"> 
            <i class="fa fa-trophy m-r-10"></i>
        </a>';
        
        $action .= '<a href="'.$link.'" class="mr-25" data-toggle="tooltip" data-original-title="'.$hide.'"> 
            <i class="'.$icon.' text-inverse m-r-10"></i>
        </a>';
        
        $action .= '<a href="?v=ProductsInline&delId='.$products[$i]["id"].'" data-toggle="tooltip" data-original-title="'.direction("Delete","حذف").'">
            <i class="fa fa-close text-danger"></i>
        </a>';
        
        // Hidden data for editing
        $hiddenData = '<div style="display:none">';
        $hiddenData .= '<label id="arTitle'.$products[$i]["id"].'">'.$products[$i]["arTitle"].'</label>';
        $hiddenData .= '<label id="enTitle'.$products[$i]["id"].'">'.$products[$i]["enTitle"].'</label>';
        $hiddenData .= '<label id="type'.$products[$i]["id"].'">'.$products[$i]["type"].'</label>';
        $hiddenData .= '<label id="shopId'.$products[$i]["id"].'">'.($products[$i]["shopId"] ?? '0').'</label>';
        $hiddenData .= '<label id="brandId'.$products[$i]["id"].'">'.($products[$i]["brandId"] ?? '0').'</label>';
        $hiddenData .= '<label id="discount'.$products[$i]["id"].'">'.($products[$i]["discount"] ?? '0').'</label>';
        $hiddenData .= '<label id="discountType'.$products[$i]["id"].'">'.($products[$i]["discountType"] ?? '0').'</label>';
        $hiddenData .= '<label id="hidden'.$products[$i]["id"].'">'.($products[$i]["hidden"] ?? '0').'</label>';
        $hiddenData .= '<label id="recent'.$products[$i]["id"].'">'.($products[$i]["recent"] ?? '0').'</label>';
        $hiddenData .= '<label id="bestSeller'.$products[$i]["id"].'">'.($products[$i]["bestSeller"] ?? '0').'</label>';
        
        // Additional fields from old system
        $hiddenData .= '<label id="preorder'.$products[$i]["id"].'">'.($products[$i]["preorder"] ?? '0').'</label>';
        $hiddenData .= '<label id="preorderText'.$products[$i]["id"].'">'.($products[$i]["preorderText"] ?? '').'</label>';
        $hiddenData .= '<label id="preorderTextAr'.$products[$i]["id"].'">'.($products[$i]["preorderTextAr"] ?? '').'</label>';
        $hiddenData .= '<label id="oneTime'.$products[$i]["id"].'">'.($products[$i]["oneTime"] ?? '0').'</label>';
        $hiddenData .= '<label id="collection'.$products[$i]["id"].'">'.($products[$i]["collection"] ?? '0').'</label>';
        $hiddenData .= '<label id="giftCard'.$products[$i]["id"].'">'.($products[$i]["giftCard"] ?? '0').'</label>';
        $hiddenData .= '<label id="isImage'.$products[$i]["id"].'">'.($products[$i]["isImage"] ?? '0').'</label>';
        $hiddenData .= '<label id="sizeChart'.$products[$i]["id"].'">'.($products[$i]["sizeChart"] ?? '0').'</label>';
        $hiddenData .= '<label id="video'.$products[$i]["id"].'">'.($products[$i]["video"] ?? '').'</label>';
        $hiddenData .= '<label id="weight'.$products[$i]["id"].'">'.($products[$i]["weight"] ?? '0').'</label>';
        $hiddenData .= '<label id="width'.$products[$i]["id"].'">'.($products[$i]["width"] ?? '0').'</label>';
        $hiddenData .= '<label id="height'.$products[$i]["id"].'">'.($products[$i]["height"] ?? '0').'</label>';
        $hiddenData .= '<label id="depth'.$products[$i]["id"].'">'.($products[$i]["depth"] ?? '0').'</label>';
        
        // Handle extras
        $productExtras = ($products[$i]["extras"] && json_decode($products[$i]["extras"], true)) ? json_decode($products[$i]["extras"], true) : array();
        $hiddenData .= '<label id="extras'.$products[$i]["id"].'">'.implode(',', $productExtras).'</label>';
        
        // Handle details with proper JSON escaping to avoid syntax errors
        $arDetails = $products[$i]["arDetails"] ? str_replace("'", '"', $products[$i]["arDetails"]) : '';
        $enDetails = $products[$i]["enDetails"] ? str_replace("'", '"', $products[$i]["enDetails"]) : '';
        $hiddenData .= "<label id='arDetails{$products[$i]["id"]}' data-content='{$arDetails}'></label>";
        $hiddenData .= "<label id='enDetails{$products[$i]["id"]}' data-content='{$enDetails}'></label>";
        $hiddenData .= '<label id="images'.$products[$i]["id"].'">'.implode(',', $imageUrls).'</label>';
        $hiddenData .= '<label id="categories'.$products[$i]["id"].'">'.implode(',', array_column($productCategories, 'categoryId')).'</label>';
        
        if($products[$i]["type"] == 1 && $attr) {
            $hiddenData .= '<label id="price'.$products[$i]["id"].'">'.$attr[0]["price"].'</label>';
            $hiddenData .= '<label id="cost'.$products[$i]["id"].'">'.$attr[0]["cost"].'</label>';
            $hiddenData .= '<label id="quantity'.$products[$i]["id"].'">'.$attr[0]["quantity"].'</label>';
            $hiddenData .= '<label id="sku'.$products[$i]["id"].'">'.$attr[0]["sku"].'</label>';
        }
        $hiddenData .= '</div>';
        
        $action .= $hiddenData;
        
		$data[] = array( 
              "#"=>$counter,
              "order"=>$order,
              "image"=>$image,
              "english"=>$english,
              "type"=>$type,
              "price"=>$price,
              "action"=>$action
           );	  
	}
	$response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
    );
    echo json_encode($response);
} else {
    $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => 0,
      "iTotalDisplayRecords" => 0,
      "aaData" => array()
    );
    echo json_encode($response);
}
?>
