<?php
ob_start();
include('opendb.inc');
include('SimpleImage.php');
$image = new SimpleImage();
$product=$_POST['product'];
$cat=$_POST['cat'];
$id_lang=$_REQUEST['id_lang'];
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
$img_name=gen_random_string().".".$curr_page;



copy($_FILES["file"]["tmp_name"], "../../gallery/" . $_FILES["file"]["name"]);


rename("../../gallery/$url","../../gallery/$img_name");
$sql = "INSERT INTO gallery (name,id_cat,img,id_lang) VALUES('$product','$cat','$img_name','$id_lang')";
$rsd= mysql_query($sql) or die(mysql_error());
	
include('closedb.inc');
ob_flush();
header("location:../add_gallery.php?up=1&id_lang=$id_lang");

?>
