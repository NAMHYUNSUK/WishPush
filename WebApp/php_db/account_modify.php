<?php 

require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');

session_start();

$usr_id = $_SESSION['usr_id'];	

var_dump($_SESSION);

echo $usr_id. "<br />";
// $re=mysql_query("SELECT (password, phone_num) FROM LotteMall.account where id = '$usr_id'"); // check id duplication
// $result=mysql_num_rows($re);


 	if($usr_pw !== $usr_pw2){
 		echo "<script>alert(\"두 비밀번호가 일치하지 않습니다\");</script>";
		echo "<script>location.replace('../myPage/myAccount.html');</script>";
 	}
 	else{
 		//비밀번호를 암호화 처리.
 		$hash = password_hash($usr_pw, PASSWORD_DEFAULT);
 		mysql_query("UPDATE LotteMall.account SET password = '$hash', phone_num = '$usr_pnum' where id = '$usr_id'");
 		//echo "inserted";
 		//send true
 		echo "<script>alert(\"변경 완료!\");</script>";
 		echo "<script>location.replace('../myPage/myPage.html');</script>";

  }

mysql_close($connect);
?>
