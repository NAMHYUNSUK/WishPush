<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');

//Get usr_infomation
 $usr_id=mysql_real_escape_string($_POST["usr_id"]);
 //$usr_id=$_POST["usr_id"];
 $usr_name=mysql_real_escape_string($_POST["usr_name"]);
 $usr_pw=mysql_real_escape_string($_POST["usr_pw"]);
 $usr_pw2=mysql_real_escape_string($_POST["usr_pw2"]);
 $usr_pnum=mysql_real_escape_string($_POST["usr_pnum"]);

$re=mysql_query("SELECT id FROM LotteMall.account where id = '$usr_id'"); // check id duplication 
$result=mysql_num_rows($re);

if($result == 0) // result == 0 is that it's ok to insert info to db
{
// 	echo $usr_id;
// 	echo $usr_name;
// 	echo $usr_pw;
// 	echo $usr_pw2;
// 	echo $usr_pnum;
	
	
	if ($usr_id == NULL)
	{
    	echo "<script>alert(\"아이디가 입력되지 않았습니다.\");</script>";
    	echo "<script>history.back();</script>";
	}
	
	elseif ($usr_name == NULL)
	{
		echo "<script>alert(\"이름이 입력되지 않았습니다.\");</script>";
		echo "<script>history.back();</script>";
	}
	
	elseif ($usr_pw == NULL)
	{
		echo "<script>alert(\"패스워드가 입력되지 않았습니다.\");</script>";
		echo "<script>history.back();</script>";
	}
	
	elseif ($usr_pw2 == NULL)
	{
		echo "<script>alert(\"확인 패스워드가 입력되지 않았습니다.\");</script>";
		echo "<script>history.back();</script>";
	}
	
	elseif ($usr_pnum == NULL)
	{
		echo "<script>alert(\"휴대폰 번호가 입력되지 않았습니다.\");</script>";
		echo "<script>history.back();</script>";
	}
	
	elseif($usr_pw !== $usr_pw2){
		echo "<script>alert(\"두 비밀번호가 일치하지 않습니다\");</script>";
		echo "<script>history.back();</script>";
	}
	
	else {
			//비밀번호를 암호화 처리.
			$hash = password_hash($usr_pw, PASSWORD_DEFAULT);
	// 			echo "비밀번호 암호화<br />";
	// 			echo "$hash <br />";
		
			mysql_query("insert into LotteMall.account (id,name,password,phone_num) values ('$usr_id','$usr_name','$hash','$usr_pnum')");//------>
			//echo "inserted";
			//send true
			echo "<script>alert(\"가입 완료!\");</script>";
			echo "<script>location.replace('../index.html');</script>";
		}
		
}
else // result == 1 or other
{
	echo "<script>alert(\"이미 아이디가 존재합니다!\");</script>";
	echo "<script>location.replace('../myPage/signUp.html');</script>";
	
	//send false
}

//echo json_encode($result);
/*
result == 0 success to sign up
else fail to sign up
*/

mysql_close($connect);
?>