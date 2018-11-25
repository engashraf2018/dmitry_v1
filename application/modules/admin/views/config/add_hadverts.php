<?php
ob_start();
include('opendb.inc');
include('SimpleImage.php');
$image = new SimpleImage();
$limit=$_REQUEST['id_lang'];
function gen_random_string()
{
    $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
    $final_rand='';
    for($i=0;$i<4; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
    }
    return $final_rand;
}
$url=$_FILES["file"]["name"];
$parts=explode('.',$url);
$lenght=count($parts);
$curr_page=$parts[$lenght-1];
$link=$_REQUEST['link'];
$img_name=gen_random_string().".".$curr_page;
copy($_FILES["file"]["tmp_name"], "../../advert/" . $_FILES["file"]["name"]);
rename("../../advert/$url","../../advert/$img_name");
$sql = "INSERT INTO header_advert(img,link) VALUES('$img_name','$link')";
$rsd= mysql_query($sql) or die(mysql_error());
   //////////////////////////////////image product
  include('closedb.inc');
header("location:../add_hadverts.php?up=1&id_lang=2");

ob_flush();

?>
