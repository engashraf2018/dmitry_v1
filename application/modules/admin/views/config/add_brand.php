<?php
include('opendb.inc');
$id_lang=$_REQUEST['id_lang'];
$name_categ=$_REQUEST['categ'];
$sql="insert into car(name,id_lang) values ('$name_categ','$id_lang');";
$rsd=mysql_query($sql);

include('closedb.inc');
echo json_encode("ok");
?>
