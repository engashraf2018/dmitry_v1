<ul class="arrows_list1">		
<li  class="<?php echo $activation_das;?>"><a href="<?php echo base_url()?>home/dashboard?<?php echo $langxxx?>"><i class="fa fa-angle-<?php echo $left;?>"></i> 
<?php echo $my_account?></a></li>
<li  class="<?php echo $activation_pro;?>"><a href="<?php echo base_url()?>home/profile?<?php echo $langxxx?>"><i class="fa fa-angle-<?php echo $left;?>"></i><?php echo $Profile?></a></li>
<li class="<?php echo $activation_mess;?>"><a href="<?php echo base_url()?>home/messages?<?php echo $langxxx?>">
<i class="fa fa-angle-<?php echo $left;?>"></i> <?php echo $side_messages?></a></li>
<?php 
if($this->session->userdata('type_admin ')==0){
$id_admin=$this->session->userdata('id_admin');
$attachment_services= $this->db->get_where("attachment",array("id_clients"=> $id_admin,'id_category'=>3))->result();
if(count($attachment_services)==1){
 ?>
<li  class="<?php echo $activation_offer_rides;?>"><a href="<?php echo base_url()?>home/offered_rides?<?php echo $langxxx?>">
<i class="fa fa-angle-<?php echo $left;?>"></i><?php echo $offer_ride;?></a></li>
<li  class="<?php echo $activation_mytrips;?>"><a href="<?php echo base_url()?>home/mytrips?<?php echo $langxxx?>">
<i class="fa fa-angle-<?php echo $left;?>"></i><?php echo $my_offer;?></a></li>
<?php }}?>


<?php
if($this->session->userdata('type_admin ')==0){
$id_admin=$this->session->userdata('id_admin');
 $company_count= $this->db->get_where("company",array("id_clients"=> $id_admin))->result();
 if(count($company_count)==1){
 ?>
<li  class="<?php echo $activation_offer_rides;?>"><a href="<?php echo base_url()?>home/addcar?<?php echo $langxxx?>">
<i class="fa fa-angle-<?php echo $left;?>"></i><?php echo $new_car;?></a></li>
<li  class="<?php echo $activation_mytrips;?>"><a href="<?php echo base_url()?>home/mycars?<?php echo $langxxx?>">
<i class="fa fa-angle-<?php echo $left;?>"></i><?php echo $my_cars;?></a></li>
<?php }}?>

<!--<li class="<?php echo $activation_alert;?>"><a href="ride-alert.html"><i class="fa fa-angle-right"></i> Ride Alert</a></li>
<li   class="<?php echo $activation_mywallet;?>"><a href="<?php echo base_url()?>home/mywallet?<?php echo $langxxx?>">
<i class="fa fa-angle-<?php echo $left;?>"></i><?php echo $side_wallet;?></a></li>-->

<li  class="<?php echo $activation_history_trips;?>"><a href="<?php echo base_url()?>home/history_trips?<?php echo $langxxx?>">
<i class="fa fa-angle-<?php echo $left;?>"></i><?php echo $historytrips?></a></li>

<li  class="<?php echo $activation_edit;?>"><a href="<?php echo base_url()?>home/edit_information?<?php echo $langxxx?>"><i class="fa fa-angle-<?php echo $left;?>"></i><?php echo $side_info?></a></li>

<li   class="<?php echo $activation_Addreviews;?>"><a href="<?php echo base_url()?>home/Addreviews?<?php echo $langxxx?>">
<i class="fa fa-angle-<?php echo $left;?>"></i><?php echo $Addreviews;?></a></li>

<li   ><a href="<?php echo base_url()?>home/logout?<?php echo $langxxx?>"><i class="fa fa-sign-out-right"></i><?php echo $logout?></a></li>
</ul>