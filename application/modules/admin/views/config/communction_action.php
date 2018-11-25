<?php
ob_start();
include ('opendb.inc');
$id=$_REQUEST['id'];
$id_lang=$_REQUEST['id_lang'];
$phone_sale=$_REQUEST['phone_sale'];
$phone_support=$_REQUEST['phone_support'];
$email_sales=$_REQUEST['email_sales'];
$email_support=$_REQUEST['email_support'];
$address=$_REQUEST['address'];
$fax=$_REQUEST['fax'];
$map=$_REQUEST['map'];
$sql="update contact_info set support_m='$phone_support',sales_m='$phone_sale',support='$email_support',sales_manager='$email_sales',address='$address' where id='$id'";
$res=mysql_query($sql)or die("".mysql_error());
//echo date('Y-m-d', strtotime($Date. ' + 2 days'));
header("location:../update_comunction.php?up=1&id_lang=$id_lang&id=$id");
?>