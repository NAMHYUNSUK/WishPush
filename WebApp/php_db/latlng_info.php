<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');
session_start();
// 안드로이드로부터 flag를 수신

$data = json_decode(file_get_contents('php://input'), true); 
$flag = $data['flag'];


if($flag == '1') // flag == 1 이면 해당하는 상품코드, 매장코드, 위도, 경도
{
	$sql = mysql_query("SELECT wishNstock.product_idx, market_info.idx as market_idx, market_info.latitude, market_info.longitude
	FROM market_info JOIN wishNstock ON market_info.idx = wishNstock.market_idx
			where wishNstock.account_idx = 55");
	
	$someArray = [];
	while($row=mysql_fetch_assoc($sql)) {
	    array_push($someArray, [
	    		'product_idx' => $row['product_idx'],
	    		'market_idx' => $row['market_idx'],	    		
	    		'latitude' => $row['latitude'],
	    		'longitude' => $row['longitude']
	    		]);
	    
	}
}
else {
	echo "잘못된 접근입니다.";
}
 
// JSON array로 전송	
$someJSON = json_encode($someArray);
echo $someJSON;
	
mysql_close($connect);
?>