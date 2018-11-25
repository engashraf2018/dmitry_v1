<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$id=$_GET['id'];
$sql = "DELETE FROM sub_values WHERE id = '$id'";
$rsd = mysql_query($sql) or die(mysql_error());

if(isset($_POST['check'])&&$_POST['check']!=""){	
	$check=$_POST['check'];
	$length=count($check);
	for($i=0;$i<$length;$i++){
	
$sql = "DELETE FROM sub_values WHERE id = '$check[$i]'";
		$rsd = mysql_query($sql) or die(mysql_error());
	}
}

$currentFile = $_SERVER["PHP_SELF"];
$parts = explode('/', $currentFile);
$length = count($parts);
$page_name="/";
for($i=0; $i<$length-2; $i++){
	if($parts[$i]!=""){
		$page_name .= $parts[$i]."/";
	}	
}
include('closedb.inc');
header("location:".$dd."home/sub_values");
ob_flush();
?>
