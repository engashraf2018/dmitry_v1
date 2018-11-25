<?php 
ob_start();
$dd=base_url();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$type=$_POST['type'];
$name_job=$_POST['name_job'];
$arrange=$_POST['arrange'];
$id=$_POST['id'];
$qu = $this->db->get_where("haram_job",array("type"=>$_POST['type'],"arrange"=>$_POST['arrange']))->result();      
if (count($qu) == 0) {
$sql="update  haram_job set name='$categ_ar',name_job='$name_job',type='$type',arrange='$arrange' where id='$id'";
$rsd=mysql_query($sql) or die("".mysql_error());
header("location:".$dd."home/haram");
}else{
$sql="update  haram_job set name='$categ_ar',name_job='$name_job' where id='$id'";
$rsd=mysql_query($sql) or die("".mysql_error());
header("location:".$dd."home/haram");

}
?>
