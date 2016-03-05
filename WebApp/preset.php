<?php 
session_start();
//header("Content-Type: text/html; charset=UTF-8");


$path['root'] = $_SERVER['DOCUMENT_ROOT'];

$url['root'] = 'https://'.$_SERVER['HTTP_HOST'];

require_once ("./config.php");

$connect=mysql_connect($DB['host'],$DB['id'],$DB['pw']) or die("connection failed.");
mysql_select_db($DB['db'],$connect);

//mysql_query('SET CHARACTER SET utf8');



extract($_GET);
extract($_POST);

?>