<?php
   require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');
 //  xmlRequest.setRequestHeader("content-type","application/x-www-form-urlencoded; charset=UTF-8;");
session_start();
$idx = ['100','101','102','103','104','105','106','107','108','109','200','201','202','203','204','205','206','207','208','209','300','301','302','303','304','305'];
$contents = ['1.jpg', '4.jpg','5.png','19.jpg','14.jpg'];
$names = ['창립 36주년 축하 이벤트', '할인쿠폰 증정 이벤트', '롯데백화점 상품권 증정 이벤트', '영수증 복권 이벤트', '롯데 프리미엄 설마중 이벤트','소원을 말해봐 이벤트'];

//stock random
for($j=14;$j<36;$j++)
{
	//for ($i=0;$i<26;$i++)
	//{
		$qty = mt_rand(100,999);
		mysql_query("insert into LotteMall.stock (product_idx,market_idx,stock_qty)
				values ('$j',0,'$qty')");
	//}
}

//eventList Random
/*
for($j=22;$j<36;$j++)
{
	for ($i=0;$i<26;$i++)
	{
		$idx_rand = mt_rand(0,25);
		$randp = mt_rand(0,4);
		mysql_query("insert into LotteMall.eventList (product_idx,market_idx,name,start_date,end_date,contents)
			values ('$j','$idx[$idx_rand]','$names[$randp]',CURRENT_TIMESTAMP,'2016-02-29 00:00:00','$contents[$randp]')");
	}
}
*/
//mysql_query("delete from eventList where product_idx=22");
mysql_close($connect);
?> 