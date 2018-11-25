<?php
include('opendb.inc');
$username=$_REQUEST['username'];
$mail=$_REQUEST['mail'];
$password=$_REQUEST['password'];
$id=$_REQUEST['id'];
$perv=$_REQUEST['perv'];
if($perv==-1){
$sql="update admin set username='$username',mail='$mail',password='$password' where id='$id'";
$rsd=mysql_query($sql);
$exit='0';
}
else{
$sql="update admin set username='$username',type='$perv',mail='$mail',password='$password' where id='$id'";
$rsd=mysql_query($sql);
$exit='0';
}
include('closedb.inc');
echo json_encode($exit);
?>
