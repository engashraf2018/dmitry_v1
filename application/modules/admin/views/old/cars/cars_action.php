
<?php
ob_start();
$service_type=$_POST['service_type'];
$title=$_POST['title'];
$titleeng=$_POST['titleeng'];

$data['titleeng'] = $titleeng;
$data['title'] = $title;
$length=count($service_type);
  for($i=0;$i<$length;$i++){
	 	  $data['id_category'] = $service_type[$i];
		  $insert = $this->db->insert('cars',$data);
  }
//$ids = $this->db->insert_id();             
//ob_flush();
header("location:".base_url()."home/cars");

?>
