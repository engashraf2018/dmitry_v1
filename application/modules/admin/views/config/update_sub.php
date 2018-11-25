<?php
ob_start();
include('opendb.inc');

$product=$_POST['product'];
$cat=$_POST['cat'];
$id=$_POST['id'];
$sql = "update health_care set name='$product' where id='$id'";
$rsd= mysql_query($sql) or die(mysql_error());
 
if($cat!=0){
$sql = "update health_care set id_cat='$cat' where id='$id'";
$rsd= mysql_query($sql) or die(mysql_error());
 

}

include('closedb.inc');
header("location:../update_sub.php?up=1&id=$id");
ob_flush();
?>
