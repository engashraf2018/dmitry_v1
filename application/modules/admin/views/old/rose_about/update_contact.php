<?php
ob_start();
$dd=base_url();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){
header("Location:".$dd."home/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];	
}

$success="رسالة النجاح! إعدادات تم حفظها في قاعدة البيانات";
$error="رسالة خطأ! كان هناك خطأ في البيانات المدرجة، أو أن هناك بيانات ناقصة";
if(isset($mess_s)){
$df="block";
}
else{
$df="none";	
}
foreach($contact_info as $contactinf){
$address=$contactinf->address;
$phone=$contactinf->phone;
$fax=$contactinf->fax;
$email=$contactinf->mail;
$support_mail=$contactinf->support_mail;
$infomail=$contactinf->infomail;
$lat=$contactinf->lat;
$lag=$contactinf->lag;
$addresseng=$contactinf->eng_address;


$small_title=$contactinf->small_title;
$map_title=$contactinf->map_title;
$small_title=$contactinf->small_titleeng;
$map_title=$contactinf->map_titleeng;
}
?>

<!DOCTYPE html>



<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->

<head>

	<title>تواصل معنا</title>

	<meta charset="utf-8">
<?php 
	include ("home/inc/head1.inc");
	?>
<script src="assets/js/jquery-1.9.1.min.js"></script>
	<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAG-nYUaJfvdGhtiae2pqCRQl_NlRbNdY4"></script>    

</head>

<body class="">

	

	<!-- Main Container Fluid -->

	<div class="container-fluid menu-hidden">

	

<?php 

include ("home/inc/sidebar.inc");

?>
<style>
.map-wrap {
    width: 97%;
    padding: 1.5%;
    background: #fff;
    webkit-box-shadow: 0 0 2px rgba(0,0,0,0.1);
    -moz-box-shadow: 0 0 2px rgba(0,0,0,0.1);
    box-shadow: 0 0 2px rgba(0,0,0,0.1);
}
.gmap {
    border: 1px solid #ccc;
    display: block;
    width: 100%;
    height:300px;
}
</style>
</div>
<div id="content">
<?php 
include("home/inc/header.inc");
?>		
<div class="innerLR">
<div class="widget-body innerAll">
 <div class="n_error" style="display:none"><p><?php echo $error?></p></div>
<div class="innerLR">

<form  method="POST" action="contact_action" id="myform">
<div class="widget">
<div class="widget-body innerAll inner-2x">
<div class="form-group"  style="width:100%">
<div class="map-Options">
                <input id="lat"  name="lat" type="hidden" value="<?php echo $lat?>" onkeyup="initialize();" />
                <input id="lag" name="lag" type="hidden" value="<?php echo $lag;?>" onkeyup="initialize();" />
                <div class="map-wrap"><div class="gmap" id="map_canvas">
                </div></div></div></div>
            


 <div class="form-group"  style="width:100%">
<label class=""  style="direction:rtl;font-family: 'Droid Arabic Kufi', sans-serif; float:right">التليفون</label>
<input   name="phone" type="text"   style="width:100%;    font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;" value="<?php echo $phone?>"/></div>

<div class="form-group"  style="width:100%">
<label class=""  style="direction:rtl;font-family: 'Droid Arabic Kufi', sans-serif;float:right">التليفون</label>
<input   name="fax" type="text"   style="width:100%;    font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;" value="<?php echo $fax?>"/></div>
                        

 <div style="width:100%; margin-bottom:30px;" align="center">
<label for="logo" style="direction:rtl;text-align:right;font-family: 'Droid Arabic Kufi', sans-serif;">العنوان</label>
<textarea name="address" rows="3" style="direction:rtl; width:100%; direction:rtl; font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $address;?></textarea> </div> 

 <div style="width:100%; margin-bottom:30px;" align="center">
<label for="logo" style="direction:ltr;text-align:left;">Address</label>
<textarea name="addresseng" rows="3" style="direction:ltr; width:100%; "><?php echo $addresseng;?></textarea> </div> 


<div   style="width:100%">
<label class=""  style="direction:rtl;font-family: 'Droid Arabic Kufi', sans-serif;float:right">البريد الالكترونى</label>
<input   name="infomail" type="text"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;" value="<?php echo $infomail?>"/></div>
<div   style="width:100%">
<label class=""  style="direction:rtl;font-family: 'Droid Arabic Kufi', sans-serif;float:right">البريد الالكترونى</label>
<input   name="support_mail" type="text"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;" value="<?php echo $support_mail?>"/></div>

 


			<!-- Form actions -->
			<div class="form-actions" align="center" style="padding-bottom:20px;">
             <input type="submit" value="حفظ الاعدادات" class="Go" id="Send" >
			</div>
			<!-- // Form actions END -->
			
		</div>
	</div>
	<!-- // Widget END -->
	
</form>
<!-- // Form END -->			</div>
			
			
		</div>
</div>
	
	
		
		</div>
	</div>
    <div style=" clear:both; height:20px;"></div>
<div class="clearfix">
<script type="text/javascript">
    $(document).ready(function(){
        initialize();
    })
	function initialize() {
	 var lat = $(".map-Options #lat").val();
    var lag = $(".map-Options #lag").val();
    var secheltLoc = new google.maps.LatLng(lat, lag);
    var myMapOptions = {
    zoom: 10
	    ,center: secheltLoc
	    ,mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var theMap = new google.maps.Map(document.getElementById("map_canvas"), myMapOptions);
    var marker = new google.maps.Marker({
	    map: theMap,
	    draggable: true,
	    position: secheltLoc,
	    visible: true
    });
    google.maps.event.addListener(marker, 'dragend', function (event) {
        document.getElementById("lat").value = this.getPosition().lat();
        document.getElementById("lag").value = this.getPosition().lng();
    });

		}

</script>
</div>
<div id="footer" class="hidden-print">

			<?php

            include ("home/inc/footer.inc");

			?>

		

		</div>
			

		<!-- // Footer END -->

		

	</div>

	<!-- // Main Container Fluid END -->

	<?php

    include ("home/inc/headf1.inc");

	?>
</body>
</html>