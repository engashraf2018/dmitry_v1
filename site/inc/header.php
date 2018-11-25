<header>
	<div class="top-bar">
<div class="container">
<div class="col-xs-7 pad1" style="padding-left:0px;padding-right:0px;"><ul class="user-menu"><li style="margin-left:0px;margin-right:10px;"><a href="<?php echo base_url()?>home/signup?<?php echo $langxxx?>" target="_self"><?php echo $signup?></a></li>
<li style="margin-left:10px;margin-right:0px;"><a href="<?php echo base_url()?>home/login?<?php echo $langxxx?>" target="_self"><?php echo $login?></a></li>
</ul></div>
<div class="col-xs-5 pad1">

<ul style="margin-left:0px;">
<?php
$page_name=$this->session->userdata('page_name');
if($page_name!=""){$url="home/".$page_name;}
else {$url="";}
if($this->uri->segment(2)=="cartype"||$this->uri->segment(2)=="news_details"||$this->uri->segment(2)=="events_details"){
$url=$url."/".$this->uri->segment(3)."/";
}


?>
<li><a href="<?php echo base_url()?><?php echo $url?>?lang=ar" target="_self"><img src="<?php echo base_url()?>site/img/ar.png" width="25" height="25"></a></li>
<li><a href="<?php echo base_url()?><?php echo $url?>?lang=en" target="_self"><img src="<?php echo base_url()?>site/img/en.png" width="25" height="25"></a></li>
</ul>


</div>
<div class="col-md-4 pad">
<ul class="user-menu">
<?php if(!isset($_SESSION['id_admin'])) {?>
<li><a href="<?php echo base_url()?>home/signup?<?php echo $langxxx?>" target="_self"><i class="fa fa-lock"></i>
<?php echo $signup?>
</a></li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php echo $login?> <b class="caret"></b></a>
                     <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
           
                        <li>
                              <div class="myform">
                                 <form class="form" role="form" method="post" action="<?php echo base_url()?>home/submitlogin" accept-charset="UTF-8" id="login-nav">
                                  <input name="lang" class="sppb-form-control" value="<?php echo $langxxe; ?>"  type="hidden" >
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2"><?php echo $Email?>-<?php echo $phone?></label>
  <input type="text" class="form-control"  placeholder="<?php echo $Email?>-<?php echo $phone?>"  name="username">
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2"><?php echo $Passowrd?></label>
    <input type="password" class="form-control" placeholder="<?php echo $Passowrd?>" name="pass"  style="width:100%; height:33px;" required>
                                    </div>
                                    <div class="checkbox">
 <span class="mxm1"><input type="checkbox"><?php echo $Remember?></span>
 <span class="mxm2"><a href="<?php echo base_url()?>home/forgotpassword?<?php echo $langxxx?>"><?php echo $fpassw?></a></span>
                                    </div>
                                    <div class="form-group">
                                    
                                    </div>
                                    <div class="form-group">
                                       <button type="submit" class="btn btn-block"><?php echo $login?></button>
                                    </div>
                                 </form>
                              </div>
                          
                        </li>
                       
                        
                     </ul>
                  </li>
                  <?php } else {?>
                  <li class="dropdown">
          <span class="fa fa-user pull-left"></span><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $my_account?><b class="caret"></b></a>
          <ul class="dropdown-menu driver-menu">
            <li><a href="<?php echo base_url()?>home/dashboard?<?php echo $langxxx?>">Dashboard <span class="fa fa-user-circle pull-right"></span></a></li>
             <li><a href="<?php echo base_url()?>home/profile?<?php echo $langxxx?>"><?php echo $Profile?> <span class="fa fa-user pull-right"></span></a></li>
             <li><a href="<?php echo base_url()?>home/messages?<?php echo $langxxx?>"><?php echo $side_messages?> <span class="fa fa-envelope pull-right"> </span></a></li>
             <?php 
			 if($this->session->userdata('type_admin ')==0){
	 $id_admin=$this->session->userdata('id_admin');
  $attachment_count= $this->db->get_where("attachment",array("id_clients"=> $id_admin,'id_category'=>3))->result();
 if(count($attachment_count)==1){
				 
			 ?>
<li><a href="<?php echo base_url()?>home/offered_rides?<?php echo $langxxx?>"><?php echo $offer_ride;?><span class="fa fa-car pull-right"></span></a></li>
<li><a href="<?php echo base_url()?>home/mytrips?<?php echo $langxxx?>"><?php echo $my_offer;?><span class="fa fa-car pull-right"></span></a></li>
<?php }}?>

  <?php 
			 if($this->session->userdata('type_admin ')==0){
	 $id_admin=$this->session->userdata('id_admin');
  $company_count= $this->db->get_where("company",array("id_clients"=> $id_admin))->result();
 if(count($company_count)==1){
			 ?>
<li><a href="<?php echo base_url()?>home/addcar?<?php echo $langxxx?>"><?php echo $new_car;?><span class="fa fa-car pull-right"></span></a></li>
<li><a href="<?php echo base_url()?>home/mycars?<?php echo $langxxx?>"><?php echo $my_cars;?><span class="fa fa-car pull-right"></span></a></li>
<?php }}?>


<!--<li><a href="ride-alert.html">Ride Alert <span class="fa fa-bell pull-right"> </span></a></li>
<li><a href="<?php echo base_url()?>home/mywallet?<?php echo $langxxx?>"><?php echo $side_wallet;?><span class="fa fa-dollar pull-right"></span></a></li>-->
<li><a href="<?php echo base_url()?>home/history_trips?<?php echo $langxxx?>"><?php echo $historytrips?><span class="fa fa-car pull-right"></span></a></li>
<li><a href="<?php echo base_url()?>home/edit_information?<?php echo $langxxx?>"><?php echo $side_info?><span class="fa fa-gear pull-right"></span></a></li>
<li><a href="<?php echo base_url()?>home/Addreviews?<?php echo $langxxx?>"><?php echo $Addreviews?><span class="fa fa-comment pull-right"></span></a></li>

          </ul>
<li><a href="<?php echo base_url()?>home/logout?<?php echo $langxxx?>"><?php echo $logout?>
<span class="fa fa-sign-out pull-left"></span></a></li>
        </li>
        <?php }?>
               </ul>

</div>
<div class="col-md-2 pull-right pad">
<ul>
<?php
$page_name=$this->session->userdata('page_name');
if($page_name!=""){$url="home/".$page_name;}
else {$url="";}
if($this->uri->segment(2)=="cartype"||$this->uri->segment(2)=="news_details"||$this->uri->segment(2)=="events_details"){
$url=$url."/".$this->uri->segment(3)."/";
}
?>
<li><a href="<?php echo base_url()?><?php echo $url?>?lang=ar" target="_self"><img src="<?php echo base_url()?>site/img/ar.png" width="33" height="30"></a></li>
<li><a href="<?php echo base_url()?><?php echo $url?>?lang=en" target="_self"><img src="<?php echo base_url()?>site/img/en.png" width="33" height="30"></a></li>
</ul>
</div>
</div>
</div>
	<div class="menu-bar">
<div class="container">
<div class="col-md-2 col-xs-6 col-sm-2" >
<a href="<?php echo base_url()?>?<?php echo $langxxx?>" target="_self">
<img src="<?php echo base_url();?>site/ar/images/site_setting/<?php echo $result_siteinfo->logo;?>" alt="Tareki" class="mxm2"></a>
</div>

<div class="navbar-header " >
 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
 <span class="sr-only">Toggle navigation</span>
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 </button>
</div>

<div class="collapse navbar-collapse navbar-ex1-collapse col-md-10 col-sm-10 col-xs-12">
<ul class="nav navbar-nav mynav">
 <li><a href="<?php echo base_url()?>?<?php echo $langxxx?>" ><?php echo $Home?></a></li>
 <li><a href="<?php echo base_url()?>home/how?<?php echo $langxxx?>" ><?php echo $Works?></a></li>
 <li>
<a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><?php echo $Trips?></a>
 <ul class="dropdown-menu">
<li><a href="<?php  echo base_url()?>home/trips?<?php echo $langxxx;?>" ><?php echo $carpooling?></a></a></li>
<li><a href="<?php  echo base_url()?>home/organizations?<?php echo $langxxx;?>" ><?php echo $organizations?></a></a></li>
 </ul>
 </li>
 <li class="dropdown">
 <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><?php echo $car_type?></a>
  <ul class="dropdown-menu"> 
  <?php
  $cars_result= $this->db->get_where("category",array("view"=>'1'))->result();
foreach ($cars_result as $cars){
  ?>
<li><a class="trigger" href="<?php  echo base_url()?>home/cartype/<?php echo $cars->id;?>/?<?php echo $langxxx;?>">
<?php 
if($langxxx=="lang=en"):echo $cars->titleeng;
else:
echo $cars->title;
endif;
?>
     </a></li>
  <?php }?>
            		
  </ul>           
 </li>
 
 
 <li ><a href="<?php echo base_url()?>home/news?<?php echo $langxxx?>" ><?php echo $News?></a></li>
 <li><a href="<?php echo base_url()?>home/events?<?php echo $langxxx?>" ><?php echo $Events?></a></li>
 <li><a href="<?php echo base_url()?>home/aboutus?<?php echo $langxxx?>" ><?php echo $About?></a></li>
 <li ><a href="<?php echo base_url()?>home/contactus?<?php echo $langxxx?>" ><?php echo $Contact?></a></li>
</ul>
</div>
  <?php
 if($this->session->userdata('type_admin')==0){
	 $id_admin=$this->session->userdata('id_admin');
  $attachment_count= $this->db->get_where("attachment",array("id_clients"=> $id_admin,'id_category'=>3))->result();
 if(count($attachment_count)==1){
			?>
<div class="offer">
<a href="<?php echo base_url()?>home/offered_rides?<?php echo $langxxx?>" class=""><i class="fa fa-plus-circle"></i><?php echo $offer_ride;?></a>
</div>
<?php }}?>
</div>
</div>
</header>