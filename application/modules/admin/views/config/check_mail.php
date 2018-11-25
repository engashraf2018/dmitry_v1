<?php
include('opendb.inc');
$username=$_POST['username'];
$mail=$_POST['mail'];
$num_b=mysql_num_rows(mysql_query("select * from admin where username='$username'"));
$num_b1=mysql_num_rows(mysql_query("select * from admin where mail='$mail'"));
if($num_b>0){
$exist=1;
}
if($num_b1>0){
$exist=2;
}

if($num_b>0&&$num_b1>0){
$exist=3;
}

if($num_b>0&&$num_b1==0){
$exist=4;
}

if($num_b==0&&$num_b1>0){
$exist=5;
}

else if($num_b==0&&$num_b1==0){
$exist=6;
} 
echo json_encode($exist);
?>
