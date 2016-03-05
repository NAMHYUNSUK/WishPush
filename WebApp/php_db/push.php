<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');
// flag == 1  -> push 전송

session_start();
$account_idx = $_SESSION['account_idx'];
$data = json_decode(file_get_contents('php://input'), true);
$market_idx = $data['market_idx'];
$product_idx = $data['product_idx'];



//$account_idx = $_SESSION['account_idx'];
// Your API key
$api_key = "AIzaSyCCLnsfLunKml8qVXCo_yLMm4OzS_xUZMo"; // 일단 api 설정 완료
$gcm_url = 'https://gcm-http.googleapis.com/gcm/send';
// Client IDs from your application

// 주찬 핸드폰 토큰
//$registration_ids = array('dnEQi8C6YiQ:APA91bGfjx97V-rIxfuFPjcy7nYu5QldMuFV-9eM_nu-m9lk1ZR0QJ4gy4XuYYnNdcBVcWex047OAa7tz0xRKCZZ3n5CIFvvFhGxew3Kzct21_dd1fq80b4_SkUNup9xNf36vj7dbdke');

// 남현석 핸드폰 토큰
$registration_ids = array('-cSeTSxqv-TU:APA91bGA0ZQ_Gp52jjkY70xwyYX4-BVfg3x6XD_TypH-dDpDalGbmKNFI9QHLMEvrQCRKNicdGO77XaLd0BzuEs9SreOfV2mwiBYqrLrrouokeo11JKItT_ae8UrO-PqbUBOh1QOi1el');

/*$re=mysql_query("SELECT DISTINCT wishNstockNmarket.account_idx, wishNstockNmarket.product_idx, wishNstockNmarket.market_idx, wishNstockNmarket.market_name, eventList.name as event_name

		FROM wishNstockNmarket JOIN eventList ON wishNstockNmarket.market_idx = eventList.market_idx AND wishNstockNmarket.product_idx = eventList.product_idx
		where wishNstockNmarket.market_idx = '$market_idx' AND wishNstockNmarket.product_idx = '$product_idx' AND wishNstockNmarket.account_idx = '55'
		") or die('Could not query');
*/
/*$re=mysql_query("SELECT DISTINCT WnEnMnP.account_idx, WnEnMnP.product_idx, WnEnMnP.market_idx, WnEnMnP.event_name, WnEnMnP.market_name, WnEnMnP.product_name, stock.stock_qty
FROM WnEnMnP JOIN stock ON WnEnMnP.product_idx = stock.product_idx and WnEnMnP.market_idx = stock.market_idx  
ORDER BY `WnEnMnP`.`market_idx`  DESC
		where ~~~~~~~~");*/
$market_compare=mysql_query("SELECT market.name as market_name, market.latitude, market.longitude
FROM market
where market.idx = '$market_idx'");
$product_compare=mysql_query("SELECT product.name as product_name
FROM product
WHERE product.idx = '$product_idx'");

$marketArray = [];
while($row=mysql_fetch_assoc($market_compare)) {
	array_push($marketArray, [
			'market_name' => $row['market_name'],
			'latitude' => $row['latitude'],
			'longitude' => $row['longitude']
	]);
}
$productArray = [];
while($row=mysql_fetch_assoc($product_compare)) {
	array_push($productArray, [
			'product_name' => $row['product_name']
	]);
}





/*$someArray = [];
while($row=mysql_fetch_assoc($re)) {
	array_push($someArray, [
			'product_idx' => $row['product_idx'],
			'market_idx' => $row['market_idx'],
			'market_name' => $row['market_name'],
			'event_name' => $row['event_name']
	]);
}*/
//$message = ";
//foreach ($someArray as $key => $value) {
foreach($marketArray as $key => $value)
{
	$title = $value['market_name'];
	$latitude = $value['latitude'];
	$longitude = $value['longitude'];
}
foreach($productArray as $key => $value)
{
	$message = $value['product_name'];
}
//}
//echo $someArray[event_name];
// URL to POST to
//$title = $value['product_name'];

$fields = array(
                'registration_ids'  => $registration_ids,
                'data'              => array(   "title"     => $title,     // 푸시 타이틀
                		 						"message"   => $message,   // 푸시 메세지
                								"latitude"  => $latitude,  // 경도
                								"longitude" => $longitude  // 위도
                )
                );

// headers for the request
$headers = array( 
                    'Authorization: key=' . $api_key,
                    'Content-Type: application/json'
                );

$curl_handle = curl_init();

// set CURL options
curl_setopt( $curl_handle, CURLOPT_URL, $gcm_url );

curl_setopt( $curl_handle, CURLOPT_POST, true );
curl_setopt( $curl_handle, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true );

curl_setopt( $curl_handle, CURLOPT_POSTFIELDS, json_encode( $fields ) );

// send
$response = curl_exec($curl_handle);

curl_close($curl_handle);

echo $response;
// let's check the response


$data = json_decode($response);

foreach ($data['results'] as $key => $value) {
    if ($value['registration_id']) {
        printf("%s has a new registration id: %s\r\n", $key, $value['registration_id']);
    }
    if ($value['error']) {
        printf("%s encountered error: %s\r\n", $key, $value['error']);
    }
    if ($value['message_id']) {
        printf("%s was successfully sent, message id: %s", $key, $value['message_id']);
    }
}
?>