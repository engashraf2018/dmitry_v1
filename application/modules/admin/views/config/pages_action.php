<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$data['name'] = $categ_ar;
$this->db->insert("committees",$data);
     

header("location:".$dd."home/pages");

?>
