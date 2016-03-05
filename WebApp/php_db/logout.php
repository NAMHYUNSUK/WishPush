<?php 

//require_once ($_SERVER['DOCUMENT_ROOT'].'/preset.php');
session_start();

$is_logged = 'NO';
//$is_logged = 'YES';

echo $is_logged;

//var_dump($_SESSION);
if($is_logged == 'NO')
{
	if ($_SESSION['is_logged'] == 'YES')
	{
		//$is_logged = $_SESSION['is_logged'];
	
		$_SESSION['is_logged'] = 'NO';
		$_SESSION['usr_id'] = '';
		//$_SESSION['member_idx'] = '';
		$_SESSION['account_idx'] = '';
		$_SESSION['token'] = '';
		
		session_unset($_SESSION['is_logged']);
		session_unset($_SESSION['usr_id']);
		//session_unset($_SESSION['member_idx']);
		session_unset($_SESSION['account_idx']);
		session_unset($_SESSION['token']);

		//echo $is_logged;
	
		header('Location: ../php_db/logout_done.php');
		exit();
	}
	
	header('Location: ../index.html');
	exit();
}


?> 