<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');

session_start();

// get info about id & pw for checking a sign in 
$usr_id=mysql_real_escape_string($_POST["usr_id"]);

$query = "SELECT password, idx, token FROM account WHERE id ='{$usr_id}'";
$result = mysql_query($query);
$hash = mysql_fetch_row($result); // 

//echo $hash[0]."<br />";

$usr_pw = addslashes($_POST['usr_pw']); // input password

// echo "$usr_pw"."<br />"; 
// echo "$hash[1]"."<br />"; // hash[1] = account_idx

if (password_verify($usr_pw, $hash[0])) {
	// password Collect
	//echo '로그인 성공. <br />';
	
	//세션을 이용한 로그인 유지
	$_SESSION['is_logged'] = 'YES';
	$_SESSION['usr_id'] = $usr_id;
	$_SESSION['account_idx'] = $hash[1];
	$_SESSION['token'] = $hash[2];	
	//$_SESSION['market_array'] = serialize($someArray);
/*$data = array(
                'account_idx'  			=> $hash[1],
                'market_info'           => array( "market_info" => $someArray ),
                );
*/

	
// 	for($row=1; $row<count($someArray); $row++) {
// 		echo '|'.$someArray[$row]['idx'];
// 		echo '|'.$someArray[$row]['latitude'];
// 		echo '|'.$someArray[$row]['longitude'].'|<br />';
// 	}
	
	
 	echo "<script>alert(\"로그인 완료!\");</script>";
 	echo "<script>location.replace('../myPage/myPage.html');</script>";

	exit();

} else {
	// 

	
	$_SESSION['is_logged'] = 'NO';
	$_SESSION['usr_id'] = '';

//	echo "로그인 실패 <br />";
	echo "<script>alert(\"로그인 실패! 아이디와 비밀번호가 일치하지 않습니다.\");</script>";	
	echo "<script>location.replace('../myPage/login.html');</script>";
	

	exit();
	
}

// $re=mysql_query("SELECT * FROM LotteMall.account where id = '$usr_id', password = '$usr_pw'",'$conn');
// $result = mysql_num_rows($re);
// echo(json_encode($result)); // result == 0 -> success to login       result == 1  -> fail to login
mysql_close($connect);
?>
