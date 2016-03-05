<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');
// 장바구니 담기 = 1
// 메뉴바에서 선택 = 2
// flag = 3 하나 삭제
// flag = 4 전부 삭제

session_start();
$account_idx = $_SESSION['account_idx'];
$data = json_decode(file_get_contents('php://input'), true);
$product_idx = $data['product_idx'];
$flag = $data['flag'];
$remove_product = $data['remove_product'];

//echo $remove_product;
//echo $product_idx;
//echo $flag;


// Adding product to wishList
if($flag == '1') 
{
	Log.$data;
	mysql_query("insert into LotteMall.wishList (product_idx,account_idx,create_date,update_date)
		values ('$product_idx','$account_idx',CURRENT_TIMESTAMP,'2016-02-29 00:00:00')");
}

// Remove product in wishlist
else if($flag == '3')
{
	mysql_query("delete from wishList where product_idx = $remove_product AND account_idx = $account_idx");
}
 

// Remove all of products in wishList 
else if($flag == '4')
{
	mysql_query("delete from wishList where account_idx = $account_idx");
}

$wish_lists = [];
$wish_list = mysql_query("SELECT wishNdiscount.product_idx, productNstock.name as product_name, productNstock.price as product_price, productNstock.img_name, productNstock.stock_qty as offline_qty, wishNdiscount.rate
		FROM productNstock JOIN wishNdiscount ON  productNstock.idx = wishNdiscount.product_idx
		WHERE productNstock.market_idx = 0 AND wishNdiscount.account_idx = $account_idx");

while($temp=mysql_fetch_assoc($wish_list))
{
	array_push($wish_lists, [
			'product_idx' => $temp['product_idx'],
			'product_name' => $temp['product_name'],
			'product_price' => $temp['product_price'],
			'img_name' => $temp['img_name'],
			'offline_qty' => $temp['offline_qty'],
			'rate' => $temp['rate']
	]);
}


$someJSON = json_encode($wish_lists);
echo $someJSON;

mysql_close($connect);
?>