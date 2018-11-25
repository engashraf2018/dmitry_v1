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

foreach($help as $help){

$title=$help->title;

$link=$help->link;

$view=$help->view_news;



$idhelp=$help->id;

	}



?>



<!DOCTYPE html>



<!--[if !IE]><!-->

<html class="sidebar sidebar-discover">

<head>

<title>تعديل الكاتب<?php echo $title;?></title>

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



  <div class="widget-body innerAll">

      <form  method="POST" action="<?php echo $dd?>home/update_videosaction" id="myform"  enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $idhelp?>">

        <div class="widget">

<div class="widget-body innerAll inner-2x">









<div class="form-group"  style="width:100%">

<label class=""  style="direction:ltr;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان</label>

<input   name="title" type="text" required value="<?php echo $title;?>"    style="width:100%;    font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>

</div>


<div class="form-group"  style="width:100%">

<label class=""  style="direction:ltr;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">لينك الفيديو</label>

<input   name="link" type="text" value="<?php echo $link;?>" required  style="width:100%;    font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>

</div>

<div class="form-group" required style="width:100%">
<label class=""  style="direction:ltr;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">اختر حالة الظهور</label>

<select name="view_news" class="sel">
<option value="0" <?php if($view == 0){echo "selected";}  ?>>لا يظهر فى شريط الاخبار</option>  
<option value="1" <?php if($view == 1){echo "selected";}  ?>>يظهر فى شريط الاخبار</option> 

</select>

<div class="form-actions" align="center" style="padding-bottom:20px;">

<input type="submit" value="حفظ الاعدادات" class="Go" id="Send"  style="font-family: 'Droid Arabic Kufi', sans-serif;">

</div>

          </div>

        </div>

      </form>



<div id="footer" class="hidden-print" style="bottom:-100px !important; ">

  <?php include ("home/inc/footer.inc");?>

</div>

<?php include ("home/inc/headf1.inc");?>

</body>

</html>