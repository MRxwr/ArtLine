<?php
require("../admin/includes/config.php");
require("../admin/includes/functions.php");
//require("../admin/includes/translate.php");
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

$joinData = array(
    "select" => ["t.id","t.subId","t.collection","t.type","t1.imageurl3 as imageurl","t.enTitle","t.arTitle","t.recent","t.bestSeller","t.hidden"],
    "join" => ["images"],
    "on" => ["t.id = t1.productId"],
);

if( $products = selectDB("products","status = '0' AND hidden != '2' {$searchQuery} ORDER BY `id` DESC LIMIT {$row},{$rowperpage}") ){
    $data = array(); 
	for( $i = 0; $i < sizeof($products); $i++ ){
        if($image = selectDB2("imageurl3 as imageurl","images","`productId` = '{$products[$i]["id"]}' ORDER BY `id` ASC")){
        }else{
            $image[0]["imageurl"] = "noimage.png";
        }
        $counter = $i + 1;
        $action = "";
		$english = "<label style='white-space: break-spaces;'>{$products[$i]["enTitle"]}</label>";
		$arabic = "<label style='white-space: break-spaces;'>{$products[$i]["arTitle"]}</label>";
        $image = "<img src='../logos/{$image[0]["imageurl"]}' style='width:100px;height:100px'>";
        $order = $products[$i]["id"];
        if ( $products[$i]["hidden"] == 2 ){
            $icon = "fa fa-eye";
            $link = "?v={$_GET["v"]}&show={$products[$i]["id"]}";
            $hide = direction("Show","إظهار");
        }else{
            $icon = "fa fa-eye-slash";
            $link = "?v={$_GET["v"]}&hide={$products[$i]["id"]}";
            $hide = direction("Hide","إخفاء");
        }
		if ( $products[$i]["type"] == 0 ){
            $action .= '<a href="?v=AttributesProducts&id='.$products[$i]["id"].'" class="font-18 txt-grey mr-10 pull-left" data-toggle="tooltip" data-placement="top" title="'.direction("Attributes","المنتجات").'"><i class="fa fa-sitemap"></i></a>';
        }
        if ( $products[$i]["collection"] == 1 ){
            $action .= '<a href="?v=Collection&id='.$products[$i]["id"].'" class="font-18 txt-grey mr-10 pull-left" data-toggle="tooltip" data-placement="top" title="'.direction("Collection","التجميع").'"><i class="fa fa-object-group"></i></a>';
        }
        $action .='<a href="?v=ProductAction&id='.$products[$i]["id"].'" class="font-18 txt-grey mr-10 pull-left" data-toggle="tooltip" data-placement="top" title="'.direction("Edit","تعديل").'"><i class="zmdi zmdi-edit"></i></a>';
        if ( $products[$i]["hidden"] == 0 ){
            $action .= '<a href="includes/products/delete.php?id='.$products[$i]["id"].'" class="font-18 txt-grey mr-10 pull-left" data-toggle="tooltip" data-placement="top" title="'.direction("Hide","إخفاء").'"><i class="fa fa-eye-slash"></i></a>';
        }else{
            $action .= '<a href="includes/products/delete.php?id='.$products[$i]["id"].'&show=1" class="font-18 txt-grey mr-10 pull-left" data-toggle="tooltip" data-placement="top" title="'.direction("Hide","إخفاء").'"><i class="fa fa-eye"></i></a>';
        }
        $action .= '<a href="includes/products/delete.php?id='.$products[$i]["id"].'&forceDelete=1" class="font-18 txt-grey mr-10 pull-left" data-toggle="tooltip" data-placement="top" title="'.direction("Delete","حذف").'"><i class="fa fa-times"></i></a>';
        if( $products[$i]["bestSeller"] == 1 ){
            $color = "txt-success";
        }else{
            $color = "txt-grey";
        }
        $action .= '<a href="?v=Product&bestId='.$products[$i]["id"].'" class="font-18 '.$color.' mr-10 pull-left" data-toggle="tooltip" data-placement="top" title="'.direction("Bestseller","الأكثر مبيعا").'"><i class="fa fa-usd"></i></a>';
        if( $products[$i]["recent"] == 1 ){
            $color = "txt-success";
        }else{
            $color = "txt-grey";
        }
        $action .= '<a href="?v=Product&newId='.$products[$i]["id"].'" class="font-18 '.$color.' mr-10 pull-left" data-toggle="tooltip" data-placement="top" title="'.direction("Recent","جديدنا").'"><i class="fa fa-plus-square"></i></a>';
		$data[] = array( 
              "#"=>$counter,
              "order"=>$order,
              "image"=>$image,
              "english"=>$english,
              "arabic"=>$arabic,
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
}
	?>