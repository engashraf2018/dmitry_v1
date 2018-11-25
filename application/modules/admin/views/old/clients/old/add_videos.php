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

<title>اضافة كاتب</title>

<meta charset="utf-8">

<?php 

	include ("home/inc/head1.inc");

	?>

<script src="assets/js/jquery-1.9.1.min.js"></script>

<script src="text_js/ckeditor.js"></script>

<link href="text_css/sample.css" rel="stylesheet">

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

<form  method="POST" action="<?php echo $dd?>home/videos_action" id="myform" enctype="multipart/form-data">

<div class="widget">

<div class="widget-body innerAll inner-2x">



<div class="form-group"  style="width:100%">

<label class=""  style="direction:ltr;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان</label>

<input   name="title" type="text" required   style="width:100%;    font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>

</div>




<div class="form-group"  style="width:100%">

<label class=""  style="direction:ltr;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">لينك الفيديو</label>

<input   name="link" type="text" required   style="width:100%;    font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>

</div>

<div class="form-group"  style="width:100%">
<label class=""  style="direction:ltr;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">اختر حالة الظهور</label>

<select name="view_news" required class="sel">
<option value="0">لا يظهر فى شريط الاخبار</option>	
<option value="1">يظهر فى شريط الاخبار</option>	

</select>

</div>'

</div>

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