<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');

// View Table 미리 생성. first, second


//$product_idx=$_POST["product_idx"];

$data = json_decode(file_get_contents('php://input'), true);
$product_idx= $data['product_idx'];
// 상품 코드를 전송 받음

/*$re=mysql_query("SELECT B.stock_qty
FROM product as A inner JOIN stock as B on A.idx = B.product_idx 
WHERE B.market_idx = 0 AND B.product_idx = $product_idx ") or die('Could not query');   //----------------- List check
*/

// 매장 정보와 재고수를 찾는 쿼리문
$re=mysql_query("SELECT second.m_idx as market_idx, market.name as market_name, second.event_name, second.a_qty as stock_qty, second.rate, second.contents
		FROM market JOIN second ON market.idx = second.m_idx
		where second.p_idx = $product_idx ORDER BY second.m_idx ASC") or die('Could not query');

//$json = array();
$someArray = [];
while($row=mysql_fetch_assoc($re)) {
    array_push($someArray, [
    		//'product_idx' => $row['product_idx'],
    		'market_idx' => $row['market_idx'],  // 매장 코드
    		'market_name' => $row['market_name'],// 매장명
    		'event_name' => $row['event_name'],  // 이벤트 정보
    		'stock_qty' => $row['stock_qty'],    // 재고 수
    		'rate' => $row['rate'],              // 할인율
    		'contents' => $row['contents']       // 이벤트 이미지
    		]);
}

$someJSON = json_encode($someArray);
echo $someJSON;

mysql_close($connect);

/*
 CREATE VIEW EnStock
 AS SELECT E.product_idx, E.market_idx, E.name, S.stock_qty

 FROM

 eventList as E RIGHT OUTER JOIN stock as S on E.product_idx = S.product_idx
 AND E.market_idx = S.market_idx


 WHERE E.idx IS NOT NULL OR S.market_idx = 0)

 (SELECT D.product_idx, M.idx, D.rate
 FROM discount as D JOIN market as M ON D.market_idx = M.idx) as DnMarket

 (SELECT E.product_idx, E.market_idx, E.name, S.stock_qty

 FROM

 eventList as E RIGHT OUTER JOIN stock as S on E.product_idx = S.product_idx
 AND E.market_idx = S.market_idx


 WHERE E.idx IS NOT NULL OR S.market_idx = 0) as


 SELECT ifNULL(EnStock.product_idx,0), ifNULL(EnStock.market_idx, 0), ifNULL(EnStock.name,0),  EnStock.stock_qty
 FROM DnMarket RIGHT OUTER JOIN EnStock ON DnMarket.idx = EnStock.market_idx
 WHERE EnStock.product_idx = 11
 */
?>



