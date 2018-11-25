<?php
ob_start();
include('opendb.inc');
$id=$_GET['id'];
$id_lang=$_REQUEST['id_lang'];
$sql = "DELETE FROM car WHERE id = '$id'";
$rsd = mysql_query($sql) or die(mysql_error());
$currentFile = $_SERVER["PHP_SELF"];
$parts = explode('/', $currentFile);
$length = count($parts);
$page_name="/";
for($i=0; $i<$length-2; $i++){
	if($parts[$i]!=""){
		$page_name .= $parts[$i]."/";
	}	
}
header("location: http://".$_SERVER['HTTP_HOST'].$page_name."car_brand.php?id_lang=$id_lang");
include('closedb.inc');
ob_flush();
?>
