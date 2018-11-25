<?php
ob_start();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$arrange=$_POST['arrange'];
$main_cat=$_POST['main_cat'];
$id=$_POST['id'];
$sql="update  sub_category set name='$categ_ar',arrange='$arrange' where id='$id'";
$rsd=mysql_query($sql) or die("".mysql_error());
if($main_cat!=""){
$sql="update  sub_category set id_cat='$main_cat' where id='$id'";
$rsd=mysql_query($sql) or die("".mysql_error());	
}

include('closedb.inc');
header("location:../home/maincategory");
?>
