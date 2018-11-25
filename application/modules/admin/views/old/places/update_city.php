<?php
include("config/opendb.inc");
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
foreach($city as $city){
	$title=$city->name;
	$titleeng=$city->name_eng;
	
	$idtestimonals=$city->id;
		$lat=$city->lat;
		$lag=$city->lag;
	}

?>

<!DOCTYPE html>

<!--[if !IE]><!-->
<html class="sidebar sidebar-discover">
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBwu_V0EDRonc3I5icYli72YZHp3PeX2X4"></script>    
<script type="text/javascript">
function Set_Location() {
    var lat = $(".map-Options #lat").val();
    var lag = $(".map-Options #lag").val();
    var secheltLoc = new google.maps.LatLng(lat, lag);
    var myMapOptions = {
    zoom:10
	    ,center: secheltLoc
	    ,mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var theMap = new google.maps.Map(document.getElementById("map_canvas"), myMapOptions);
    var marker = new google.maps.Marker({
	    map: theMap,
	    draggable: true,
	    position: secheltLoc,
        title:"Drag me!",
	    visible: true
    });
    google.maps.event.addListener(marker, 'dragend', function (event) {
        document.getElementById("lat").value = this.getPosition().lat();
        document.getElementById("lag").value = this.getPosition().lng();
    });
}
$(document).ready(function(){
        Set_Location();
    })
</script>

<head>
<title>تعديل&nbsp; <?php echo $title;?></title>
<meta charset="utf-8">
<?php 
	include ("home/inc/head1.inc");
	?>

</head>

<body class="">
<div class="container-fluid menu-hidden">
  <?php 
include ("home/inc/sidebar.inc");
?>
</div>
<div id="content">
  <?php 
include("home/inc/header.inc");
?>
  <div class="innerLR">
    <div class="widget-body innerAll">
      <div class="n_ok" style="display:<?php echo $df;?>; direction:rtl; font-family: 'Droid Arabic Kufi', sans-serif;">
        <p> <?php echo $success?> </p>
      </div>
      <div class="innerLR map-Options">
<form  method="POST" action="update_cities" id="myform"  enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $idtestimonals?>">
<input id="lat"  name="lat" type="hidden" value="<?php echo $lat;?>" onkeyup="Set_Location();" />
<input id="lag" name="lag" type="hidden" value="<?php echo $lag;?>" onkeyup="Set_Location();" />
<div class="map-wrap">
<div class="gmap" id="map_canvas"></div>
</div>
<div class="widget">
<div class="widget-body innerAll inner-2x">
<div class="form-group"  style="width:100%">
<label class=""  style="direction:ltr;font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان</label>
<input   name="title" type="text"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;" value="
<?php echo $title?>"/>
</div>
<div class="form-group"  style="width:100%">
<label class=""  style="direction:ltr;font-family: 'Droid Arabic Kufi', sans-serif;float:left">Name</label>
<input   name="titleeng" type="text"   style="width:100%;direction:ltr; height:40px;"  value="
<?php echo $titleeng?>"/>
</div>

 <div class="form-actions" align="center" style="padding-bottom:20px;">
            <input type="submit" value="حفظ الاعدادات" class="Go" id="Send"  style="font-family: 'Droid Arabic Kufi', sans-serif;">
          </div>
          <!-- // Form actions END --> 
          
        </div>
        </div>
        <!-- // Widget END -->
        
      </form>
      <!-- // Form END --> </div>
</div>
</div>
<div id="footer" class="hidden-print">
  <?php
            include ("home/inc/footer.inc");
			?>
</div>

<?php

    include ("home/inc/headf1.inc");

	?>
</body>
</html>
<script>
function getState(val) {
$.ajax({
	type: "POST",
	url: "get_state",
	data:'country_id='+val,
	success: function(data){
		$("#state-list").html(data);
	}
	});
}
</script>