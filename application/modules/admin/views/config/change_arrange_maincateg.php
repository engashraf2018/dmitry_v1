<?php
ob_start();
$base_url=base_url();
include('opendb.inc');
$arran=$_POST['arran'];
$sql="update  site_info set arrange_maincateg='$arran'";
$rsd=mysql_query($sql) or die("".mysql_error());
include('closedb.inc');

header("location:".$base_url."home/maincategory");

?>
