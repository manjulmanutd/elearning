<?php
session_start();
//echo $_SESSION['username'];die();
$user = $_GET['un'];
if(isset($_SESSION['username']))
unset($_SESSION['username']);
$_SESSION['username'] = $user;
function redirect($loc="")
	{
	echo "<script language='javascript'>window.location.href='{$loc}';</script>";
	}
	redirect($_GET['url']);
?>