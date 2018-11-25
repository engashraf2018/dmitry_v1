<?php
include('opendb.inc');
$username=$_REQUEST['username'];
$mail=$_REQUEST['mail'];
$password=$_REQUEST['password'];
$id=$_REQUEST['id'];
$num_mail=mysql_num_rows(mysql_query("select * from admin where mail='$mail'"));
if($password==""){
$exit='1';	
}
else if($username==""){
	$exit='-1';	
}
else {
$sql="update admin set username='$username',mail='$mail',password='$password' where id='$id'";
$rsd=mysql_query($sql);
$exit='0';
}
include('closedb.inc');
echo json_encode($exit);
?>
