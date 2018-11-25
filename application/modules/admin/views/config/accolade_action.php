<?php
ob_start();
$dd=base_url();
include('opendb.inc');
$categ_ar=$_POST['categ_ar'];
$description=$_POST['description'];
$data['title'] = $categ_ar;
$data['description'] = $description;


 $insert = $this->db->insert('accolade',$data);
     

header("location:".$dd."home/accolade");

?>
