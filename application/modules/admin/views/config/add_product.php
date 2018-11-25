<?php
ob_start();
include('opendb.inc');

$product=$_POST['product'];
$cat=$_POST['cat'];

$sql = "INSERT INTO health_care (name,id_cat) VALUES('$product','$cat')";
$rsd= mysql_query($sql) or die(mysql_error());

include('closedb.inc');
header("location:../add_product.php?up=1");
ob_flush();
?>
