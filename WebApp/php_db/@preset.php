<?php 
session_start();

$path['root'] = $_SERVER['DOCUMENT_ROOT'];

$url['root'] = 'https://'.$_SERVER['HTTP_HOST'];

require_once ('./config.php');

$connect=mysql_connect($DB['host'],$DB['id'],$DB['pw']) or die("connection failed.");
mysql_select_db($DB['db'],$connect);

extract($_GET);
extract($_POST);

?>