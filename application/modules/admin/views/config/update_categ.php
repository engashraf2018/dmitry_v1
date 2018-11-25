<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$type=$_POST['type'];
$arrange=$_POST['arrange'];
$id=$_POST['id'];
$qu = $this->db->get_where("category",array("type"=>$_POST['type'],"arrange"=>$_POST['arrange']))->result();      
if (count($qu) == 0) {
$sql="update  category set title='$categ_ar',type='$type',arrange='$arrange' where id='$id'";
$rsd=mysql_query($sql) or die("".mysql_error());
header("location:".$dd."home/category");
}else{
$sql="update  category set title='$categ_ar' where id='$id'";
$rsd=mysql_query($sql) or die("".mysql_error());
header("location:".$dd."home/category");

}
?>