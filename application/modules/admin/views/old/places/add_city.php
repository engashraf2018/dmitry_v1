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
?>
<!DOCTYPE html>
<!--[if !IE]><!-->
<html class="sidebar sidebar-discover">
<!-- <![endif]-->
<head>
<title>اضافة منطقة</title>
<meta charset="utf-8">
<?php 
	include ("home/inc/head1.inc");
	?>
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
    zoom:8
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
<div class="innerLR"> 
<!-- Form -->
<form  method="POST" action="<?php echo $dd?>home/city_action" id="myform" enctype="multipart/form-data">
<div class="widget map-Options">
<div class="widget-body innerAll inner-2x">
<div class="form-group"  style="width:100%">

<input id="lat"  name="lat" type="hidden" value="30.116147085664718" onkeyup="Set_Location();" />
<input id="lag" name="lag" type="hidden" value="31.2762451171875" onkeyup="Set_Location();" />
<div class="map-wrap">
<div class="gmap" id="map_canvas"></div>
</div>
<label class=""  style="direction:ltr;font-family: 'Droid Arabic Kufi', sans-serif;float:right">الأسم</label>
<input   name="title" type="text"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>
</div>
<label class=""  style="direction:ltr;font-family: 'Droid Arabic Kufi', sans-serif;float:left">Name</label>
<input   name="titleeng" type="text"   style="width:100%;direction:ltr; height:40px;"/>



<div class="form-actions" align="center" style="padding-bottom:20px;">
<input type="submit" value="اضافة" class="Go" id="Send"  style="font-family: 'Droid Arabic Kufi', sans-serif;">
</div>
</form>
</div>
</div>
</div>
</div>
<div style=" clear:both; height:20px;"></div>
<div class="clearfix"> 
<script>			

</script> 
</div>
<div id="footer" class="hidden-print">
  <?php
include ("home/inc/footer.inc");
?>
</div>
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