<?php
include('opendb.inc');
ob_start();
$username=$_REQUEST['username'];
$mail=$_REQUEST['mail'];
$perv=$_REQUEST['type'];
$password=$_REQUEST['password'];
 $new_passw=md5($password);

$sql="insert into admin(username,mail,type,password) values ('$username','$mail','$perv','$new_passw')";
$rsd=mysql_query($sql);

include('closedb.inc');
header("location:../home/admin");
?>
