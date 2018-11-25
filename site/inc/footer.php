<div id="newsletter-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 clearfix">
<div class="col-md-2 col-sm-6 col-xs-12"></div>
            <div class="col-md-2 col-sm-6 col-xs-12">
               <div class="">
                <h3><?php echo $news_letter;?></h3>
                </div>
                </div>
                 <div class="col-md-4 col-sm-6 col-xs-12">
                <form id="register-newsletter">
                    <input type="text" class="nws" name="newsletter" required placeholder="<?php echo $entermail;?>" style="width:100%;margin-bottom:10px;">
                
                </div>

               <div class="col-md-2 col-sm-6 col-xs-12">
                <input type="submit" class="btn btn-custom-3" value="<?php echo $Join;?>">
                </form>
                </div>
 <div class="col-md-2 col-sm-6 col-xs-12"></div>
            </div>
        </div>
    </div
></div>

<footer>

<div class="footer-bottom">
<div class="container">
<div class="col-md-4 col-xs-12">
 <h5 class="section-title"><?php echo $abouttareki;?></h5>
 <p>
  <?php 
 if($langxxx=="lang=en"): echo $result_siteinfo->about_footer;
else:echo $result_siteinfo->about_footer_ar;
endif;
 ?>
 
 
</p>
</div>
<div class="col-md-2 col-xs-12">
 <h5 class="section-title"><?php echo $site_link;?></h5>
 <ul class="textcontact">
   <li><a target="_self" href="<?php echo base_url()?>?<?php echo $langxxx?>"><?php echo $Home?></a></li>
   <li><a target="_self" href="<?php echo base_url()?>home/how?<?php echo $langxxx?>"><?php echo $Works?></a></li>
   <li><a target="_self" href="<?php echo base_url()?>home/news?<?php echo $langxxx?>"><?php echo $News?></a></li>
   <li><a target="_self" href="<?php echo base_url()?>home/events?<?php echo $langxxx?>"><?php echo $Events?></a></li>
   <li><a target="_self" href="<?php echo base_url()?>home/aboutus?<?php echo $langxxx?>"><?php echo $About?></a></li>
   <li><a target="_self" href="<?php echo base_url()?>home/contactus?<?php echo $langxxx?>"><?php echo $Contact?></a></li>
   
 </ul>
</div>
<div class="col-md-3 col-xs-12">
<?php
$result_contactz = $this->db->get_where("contact_info")->result();
foreach($result_contactz as $result_contact)
if($langxxx=="lang=en"):$address_site=$result_contact->eng_address;
else:
$address_site=$result_contact->address;
endif;

?>
 <h5 class="section-title"><?php echo $Contact?></h5>
  <p><i class="fa fa-home"></i><?php echo $address_site; ?></p>
  <p><i class="fa fa-phone"></i><?php echo $result_siteinfo->phone;?></p>
  <p><i class="fa fa-envelope"></i> <?php echo $result_siteinfo->email;?></p>
  <ul class="foosocial">
			<li class="faceboox"><a href="<?php echo $result_siteinfo->face;?>"><i class="fa fa-facebook"></i></a></li>
            <li class="twitter"><a href="<?php echo $result_siteinfo->twitter;?>"><i class="fa fa-twitter"></i></a></li>
            <li class="gplus"><a href="<?php echo $result_siteinfo->google;?>"><i class="fa fa-google-plus"></i></a></li>
            <li class="linkdin"><a href="<?php echo $result_siteinfo->instgram;?>"><i class="fa fa-instagram"></i></a></li>
        </ul>
</div>
<div class="col-md-3 col-xs-12 mxm3">
<a href="<?php echo base_url()?>?<?php echo $langxxx;?>" target="_self"><img src="<?php echo base_url()?>site/ar/images/site_setting/<?php echo $result_siteinfo->logo;?>" alt="Tareki"></a>

<p>
<span><a href="#" target="_blank"><img src="<?php echo base_url()?>site/img/Android.jpg" height="30" style="border:1px solid #f2f2f2;" ></a></span> 
<span><a href="#" target="_self"><img src="<?php echo base_url()?>site/img/Applestore.jpg" height="30" style="margin-top:0;border:1px solid #f2f2f2;"></a></span>
</p>      

</div>
</div>





</div>
<div class="copyrights">
<p>Copyright © 2017 Tareki. All Right Reserved.Powered By <a href="http://techvillageco.com" target="_blank">TechVillage</a></p>
</div>
</footer>