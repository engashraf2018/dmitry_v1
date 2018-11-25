<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$cat=$_POST['cat'];
$sql="insert into sub_values(name_value,id_cat)values('$categ_ar','$cat')";
mysql_query($sql) or die("".mysql_error());
header("location:".$dd."home/sub_values");
?>
