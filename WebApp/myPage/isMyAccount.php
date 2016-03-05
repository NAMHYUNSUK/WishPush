<?php 

session_start();

 $is_logged = $_SESSION['is_logged'];

if ($is_logged == 'YES')
{
	header('Location: ./myAccount.html');
	exit();
}

else {
	header('Location: ./myPage.html');
	exit();
}
?>