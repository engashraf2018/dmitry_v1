<?php
ob_start();
include('opendb.inc');
$title=$_POST['title'];
$titleeng=$_POST['titleeng'];
$lat=$_POST['lat'];
$lag=$_POST['lag'];
/**************************************************
***************************************************
***************************************************/
$sql = "INSERT INTO city (name,name_eng,lat,lag)VALUES('$title','$titleeng','$lat','$lag')";
$rsd= mysql_query($sql) or die(mysql_error());
include('closedb.inc');
header("location:city");
ob_flush();
?>
