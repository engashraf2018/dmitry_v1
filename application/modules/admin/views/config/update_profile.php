<?php
include('opendb.inc');
$password=$_POST['password'];
$password=md5($password);
$username=$_POST['username'];
$email=$_POST['email'];
$id=$_POST['id'];

$sql="update admin set mail='$email',username='$username',password='$password' where id='$id'";
$rsd=mysql_query($sql) or die("".mysql_error());
$_SESSION['admin_name']=$username;
include('closedb.inc');
header("location:../home/Profile");
?>
