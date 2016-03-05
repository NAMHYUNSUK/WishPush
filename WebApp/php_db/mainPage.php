<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');
//  xmlRequest.setRequestHeader("content-type","application/x-www-form-urlencoded; charset=UTF-8;");

   
   
// 쿼리문으로 데이터베이스에서 상품코드, 상품명, 상품 가격, 상품 이미지, 할인율
$re=mysql_query("SELECT product.idx as product_idx, product.name as product_name, product.price as product_price, product.img_name, discount.rate
FROM product join discount on product.idx = discount.product_idx") or die('Could not query');   //----------------- List check
$json = array();
$someArray = [];
while($row=mysql_fetch_assoc($re)) {
    array_push($someArray, [
    		'product_idx' => $row['product_idx'], 
    		'product_name' => $row['product_name'],
    		'product_price' => $row['product_price'],
    		'img_name' => $row['img_name'],
    		'rate' => $row['rate']
    		]);
}


//echo(json_encode($products));
/*
 product.idx 
 product.name
 product.price
 product.img_name
 */
$someJSON = json_encode($someArray);
echo $someJSON; 
mysql_close($connect);
?>