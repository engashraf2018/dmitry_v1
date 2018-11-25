<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$name_job=$_POST['name_job'];
$type=$_POST['type'];
$arrange=$_POST['arrange'];
$qu = $this->db->get_where("haram_job",array("type"=>$_POST['type'],"arrange"=>$_POST['arrange']))->result();      
if (count($qu) == 0) {
$sql="insert into haram_job(name,name_job,type,arrange)values('$categ_ar','$name_job','$type','$arrange')";
mysql_query($sql) or die("".mysql_error());
header("location:".$dd."home/haram");
}else{

redirect(base_url('home/add_haram?error'), 'refresh');

}
?>
