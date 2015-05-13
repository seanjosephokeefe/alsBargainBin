<?php
//DBConnect.php
include_once "Config.php";
$conn=mysqli_connect($dbHost,$dbUser,$dbPassWord,$dataBase);
// Check connection
$connStatus=true;
if (mysqli_connect_errno())
{
	$connStatus=False;
}
?>