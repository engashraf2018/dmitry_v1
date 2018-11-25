<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$cat=$_POST['cat'];
$id=$_POST['id'];
$sql="update sub_values set name_value='$categ_ar' where id='$id'";
mysql_query($sql) or die("".mysql_error());
 if($cat!=0){
$sql="update sub_values set id_cat='$cat' where id='$id'";
mysql_query($sql) or die("".mysql_error());
 }
header("location:".$dd."home/sub_values");
?>
