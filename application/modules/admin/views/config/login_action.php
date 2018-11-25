<?php
ob_start();
include('opendb.inc');
$username=$_POST['user_name'];
$password=$_POST['password']; 
//echo $username;
$sql="SELECT * FROM admin where view='1' and username='$username' and password='$password'";
$rsd=mysql_query($sql) or die("".mysql_error());
$row=mysql_fetch_array($rsd);
if($row){
	$exist=1;
	$id=$row['id'];
	session_start();
	$_SESSION['admin_name']=$row['username'];
	$_SESSION['last_login']=$row['last_login'];
	$_SESSION['id_admin']=$row['id'];
	$_SESSION['counter']=1;
	$_SESSION['type_admin']=$row['type'];

	$sql="UPDATE admin SET last_login=NOW() WHERE username = '$username'";
    $rsd=mysql_query($sql);
}
echo json_encode($exist);
include('closedb.inc');
ob_flush();
?>
