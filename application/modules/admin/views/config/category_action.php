<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$type=$_POST['type'];
$arrange=$_POST['arrange'];
$qu = $this->db->get_where("category",array("type"=>$_POST['type'],"arrange"=>$_POST['arrange']))->result();      
if (count($qu) == 0) {
$sql="insert into category(title,type,arrange)values('$categ_ar','$type','$arrange')";
mysql_query($sql) or die("".mysql_error());
header("location:".$dd."home/category");
}else{

redirect(base_url('home/add_category?error'), 'refresh');

}
?>
