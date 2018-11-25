<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$id=$_GET['id'];
$sql = "DELETE FROM comments WHERE id = '$id'";
      $id_article = $this->data->get_table_row("comments",array("id"=>$id),"id_article");


      $check = $this->data->get_table_row("articles",array("id"=>$id_article),"num_comment");
      $sum = $check - 1;
      $this->data->edit_table("articles",$id_article,array("num_comment"=>$sum));
$rsd = mysql_query($sql) or die(mysql_error());

if(isset($_POST['check'])&&$_POST['check']!=""){	
	$check=$_POST['check'];
	$length=count($check);
	for($i=0;$i<$length;$i++){
$sql = "DELETE FROM comments WHERE id = '$check[$i]'";
		$rsd = mysql_query($sql) or die(mysql_error());
		
      $id_article = $this->data->get_table_row("comments",array("id"=>$check[$i]),"id_article");		
      $check = $this->data->get_table_row("articles",array("id"=>$id_article),"num_comment");
      $sum = $check - 1;
      $this->data->edit_table("articles",$id_article,array("num_comment"=>$sum));		
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
header("location:".$dd."home/comments");
ob_flush();
?>
