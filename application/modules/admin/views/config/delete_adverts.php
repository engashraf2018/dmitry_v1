<?php
ob_start();
include('opendb.inc');
$id=$_GET['id'];
$id_lang=$_GET['id_lang'];
$sql="select img  from adverts  where id='$id'";
$rsd=mysql_query($sql) or die ("".mysql_error());
while($row=mysql_fetch_array($rsd)){
$img=$row['img'];
unlink("../../advert/$img");
 
}


$sql = "DELETE FROM adverts WHERE id = '$id'";
$rsd = mysql_query($sql) or die(mysql_error());

if(isset($_POST['check'])&&$_POST['check']!=""){	
	$check=$_POST['check'];
	$length=count($check);
	for($i=0;$i<$length;$i++){
		$sql="select img  from adverts  where id='$check[$i]'";
$rsd=mysql_query($sql) or die ("".mysql_error());
while($row=mysql_fetch_array($rsd)){
$img=$row['img'];
unlink("../../advert/$img");
 
}
		$sql = "DELETE FROM adverts WHERE id = '$check[$i]'";
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
header("location: http://".$_SERVER['HTTP_HOST'].$page_name."adverts.php?id_lang=$id_lang");
include('closedb.inc');
ob_flush();
?>
