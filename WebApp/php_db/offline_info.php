<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');
// 상품코드를 JSON으로 전송 받음
$data = json_decode(file_get_contents('php://input'), true);
$product_idx= $data['product_idx'];

// 오프라인 매장에 대한 정보를 찾는 쿼리문.
$get_info = mysql_query("SELECT M.name as market_name, M.latitude, M.longitude, M.phone_num, S.stock_qty, E.name as event_name, E.start_date, E.end_date
FROM product as P JOIN stock as S JOIN market as M JOIN eventList AS E on P.idx = S.product_idx AND S.market_idx = M.idx AND E.market_idx = S.market_idx AND E.product_idx = S.product_idx
WHERE S.stock_qty != 0 AND M.idx != 0 AND $product_idx = P.idx");

$off_info = [];
while($temp1 = mysql_fetch_assoc($get_info)){
		array_push($off_info, [
				//'product_idx' => $temp1['idx'],     // 
				'market_name' => $temp1['market_name'],  // 매장 이름
				'latitude' => $temp1['latitude'],        // 위도
				'longitude' => $temp1['longitude'],      // 경도
				'phone_num' => $temp1['phone_num'],      // 매장 핸드폰 번호
				'stock_qty' => $temp1['stock_qty'],      // 매장 재고 수
				'event_name' => $temp1['event_name'],    // 매장 이벤트 정보
				'start_date' => $temp1['start_date'],    // 이벤트 시작 날짜
				'end_date' => $temp1['end_date']         // 이벤트 종료 날짜
		]);
}
// JSON array로 전송
$someJSON = json_encode($off_info);
echo $someJSON;

mysql_close($connect);
?>