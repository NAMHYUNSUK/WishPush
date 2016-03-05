<?php

$headers = array(
	'Content-Type:application/json',
	'Authorization:key=AlzaSyAfJHhDzkAtqAOQrhSK3heEE_UBqyJNDhw'
);



$arr = array();
$arr['data'] = array();
$arr['data']['msg'] = "push message 한글 테스트";
$arr['registration_ids'] = array();
$arr['registration_ids'][0] = "cSeTSxqv-TU:APA91bGA0ZQ_Gp52jjkY70xwyYX4-BVfg3x6XD_TypH-dDpDalGbmKNFI9QHLMEvrQCRKNicdGO77XaLd0BzuEs9SreOfV2mwiBYqrLrrouokeo11JKItT_ae8UrO-PqbUBOh1QOi1el";

$ch = curl_init();

$json = new Services_JSON():

curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
$response = curl_exec($ch);

curl_close($ch);

echo "푸시 메시지 전송 완료!";

?>
