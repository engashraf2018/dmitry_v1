<?php
ob_start();
include('opendb.inc');
$id=$_GET['id'];
$id_lang=$_REQUEST['id_lang'];
$sql="select img from product  where id='$id'";
$rsd=mysql_query($sql) or die ("".mysql_error());
while($row=mysql_fetch_array($rsd)){
$img=$row['img'];
unlink("../../product/$img");
}


$sql = "DELETE FROM product WHERE id = '$id'";
$rsd = mysql_query($sql) or die(mysql_error());

if(isset($_POST['check'])&&$_POST['check']!=""){	
	$check=$_POST['check'];
	$length=count($check);
	for($i=0;$i<$length;$i++){
		$sql="select img from product  where id='$check[$i]'";
$rsd=mysql_query($sql) or die ("".mysql_error());
while($row=mysql_fetch_array($rsd)){
$img=$row['img'];
unlink("../../product/$img");
}
		$sql = "DELETE FROM product WHERE id = '$check[$i]'";
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
header("location: http://".$_SERVER['HTTP_HOST'].$page_name."product.php?id_lang=$id_lang");

ob_flush();
?>
