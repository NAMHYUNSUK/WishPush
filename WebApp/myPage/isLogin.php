<?php 

session_start();

$is_logged = $_SESSION['is_logged'];
$usr_id = $_SESSION['usr_id'];

if ($is_logged == 'YES')
{
	header('Location: ./myPage.html');
}

else {
	header('Location: ./login.html');
}


?>