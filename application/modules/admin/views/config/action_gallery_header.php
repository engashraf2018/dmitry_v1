<?php
ob_start();
include ('opendb.inc');
include('SimpleImage.php');
$image = new SimpleImage();
$id_news=$_REQUEST['id'];
$id_lang=$_REQUEST['id_lang'];
$sqld="select img from pages where id='$id_news'";
$rsd=mysql_query($sqld) or die ("".mysql_error());
while($rowm=mysql_fetch_array($rsd)){
$img=$rowm['img'];	
unlink("../../pages/$img");
}
$url="head".$_FILES["file"]["name"];
	 $sql="update pages set img='$url'  where id='$id_news'";
	 $rsd=mysql_query($sql) or die ("".mysql_error());
      copy($_FILES["file"]["tmp_name"],
      "../../pages/" . $_FILES["file"]["name"]);
	  $name=$_FILES["file"]["name"];
   $new_name="head".$_FILES["file"]["name"];
  	$image->load("../../pages/$name");
   $image->resize(960,220);
   
   $image->save("../../pages/$new_name");
   $slides=glob('../../pages/*');
   for($j=0; $j<count($slides); $j++){
	//echo $slides[$j]."<br>";
	if($slides[$j]==="../../pages/$name"){
	unlink($slides[$j]);
	}
   }

header("location:../gallerycover.php?up=1&id_lang=$id_lang");
?>