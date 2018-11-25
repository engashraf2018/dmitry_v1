<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$arrange=$_POST['arrange'];
$main_cat=$_POST['main_cat'];
$sql="insert into sub_category(name,arrange,id_cat)values('$categ_ar','$arrange','$main_cat')";
mysql_query($sql) or die("".mysql_error());
header("location:".$dd."home/maincategory");
?>
