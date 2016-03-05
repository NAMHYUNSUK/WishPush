<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');
session_start();
$account_idx = $_SESSION['account_idx'];
//print_r($_POST);
//$json_string = $_POST('flag');
$data = json_decode(file_get_contents('php://input'), true);
$flag = $data['flag'];


// account_idx를 검색하여 포인트 적립
// 추후 개발사항.  핸드폰에서 account_idx를 Session에서 받아오는 것.
if($flag=='55')
{
	mysql_query("UPDATE account 
	SET point=(point+10)
	WHERE account.idx = $flag") or die('Could not query');

$someArray = [];
	array_push($someArray, [
			'point' => 'lotte'
	]);

}
$someJSON = json_encode($someArray);
echo $someJSON;

mysql_close($connect);
?>