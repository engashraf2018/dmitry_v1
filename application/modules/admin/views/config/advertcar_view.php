<?php
ob_start();
include('opendb.inc');

$id=$_POST['id'];
$view=$_POST['view'];
$sql = "UPDATE  car_shop SET  view='$view' WHERE id = '$id'";
$rsd = mysql_query($sql) or die(mysql_error());

echo json_encode($table);
include('closedb.inc');
ob_flush();
?>
