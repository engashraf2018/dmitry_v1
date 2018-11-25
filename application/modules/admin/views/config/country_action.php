<?php
ob_start();
include('opendb.inc');
$title=$_POST['title'];
////////////////////////////////////////

$sql = "INSERT INTO countries (name)VALUES('$title')";
$rsd= mysql_query($sql) or die(mysql_error());
include('closedb.inc');
header("location:country");
ob_flush();
?>
