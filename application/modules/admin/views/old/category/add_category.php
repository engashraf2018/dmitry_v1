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
?>
<!DOCTYPE html>
<!--[if !IE]><!-->
<html class="sidebar sidebar-discover">
<!-- <![endif]-->
<head>
<title>أضافة</title>
<meta charset="utf-8">
<?php 
include ("home/inc/head1.inc");
//include ("opendb.inc");
	?>
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="text_css/jquery.datetimepicker.css"/>
<script type="text/javascript">
</script>
</head>
<body class="">
<div class="container-fluid menu-hidden">
  <?php include ("home/inc/sidebar.inc");?>
</div>
<div id="content">
  <?php include("home/inc/header.inc");?>
  <div class="innerLR">
<div class="innerLR"> 
<!-- Form -->
<form  method="POST" action="<?php echo $dd?>home/category_action" id="myform" enctype="multipart/form-data">
<div class="widget">
<div class="widget-body innerAll inner-2x">
<div class="form-group"  style="width:100%">
<label class=""  style="direction:rtl;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان</label>
<input   name="title" type="text"  required style="width:100%;    font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>
</div>

<div class="form-group"  style="width:100%">
<label class=""  style="direction:ltr;font-family: 'Droid Arabic Kufi', sans-serif; float:left">Title</label>
<input   name="titleeng" type="text"  required style="width:100%;direction:ltr; height:40px;"/>
</div>

<div class="form-group"  style="width:100%">
<label class=""  style="direction:ltr;font-family: 'Droid Arabic Kufi', sans-serif; float:left">Start Model</label>
<input   name="model" type="text"  required style="width:100%;direction:ltr; height:40px;"/>
</div>


<div class="col-md-4" style="width:100%; direction:rtl" align="center" >
<div class="form-group"><label class="control-label" for="firstname" style=" direction:rtl; float:right;font-family:NeoSansArabic !important">وصف مختصر</label>
<textarea style="height:50px; width:100%;" name="smalldescriptionar"></textarea></div></div>

<div class="col-md-4" style="width:100%; direction:ltr" align="center" >
<div class="form-group"><label class="control-label"  style=" direction:ltr; float:left;">Small Description</label>
<textarea style="height:50px; width:100%;" name="smalldescription"></textarea></div></div>

<div class="form-group" style="text-align:center">

<label class="control-label" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">نوع الخدمة</label> 
<select name="position" required class="sel">
<option>اختر نوع الخدمة</option>	
<option value="0">نقل فردى</option>	
<option value="1">نقل جماعى</option>	
<option value="2" >نقل فردى و جماعى</option>	
</select>
<br><br></div>

<div class="form-actions" align="center" style="padding-bottom:20px;">
<input type="submit" value="اضافة" class="Go" id="Send"  style="    font-family: 'Droid Arabic Kufi', sans-serif;">
</div>

</form>
</div>
</div>
</div>
</div>
<div style=" clear:both; height:20px;"></div>
<div class="clearfix"> 
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
