<?php
include("opendb.inc");
$id=$_POST['id'];
$view=$_POST['view'];
$sql = "UPDATE shop_messages  SET  view='$view' WHERE id = '$id'";
$rsd = mysql_query($sql) or die(mysql_error());
echo json_encode($view);
include('closedb.inc');
ob_flush();
?>
