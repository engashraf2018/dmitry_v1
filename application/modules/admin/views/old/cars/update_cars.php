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

foreach($articles as $articles){
date_default_timezone_set("Africa/Cairo");
$id_category=$articles->id_category;
$title=$articles->title;
$idhelp=$articles->id;
$titleeng=$articles->titleeng;
	}
?>
<!DOCTYPE html>
<html class="sidebar sidebar-discover">
<head>
<title>تعديل</title>
<meta charset="utf-8">
<?php 
include ("home/inc/head1.inc");
?>
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="text_css/jquery.datetimepicker.css"/>
</head>
<body class="">
<div class="container-fluid menu-hidden">
  <?php include ("home/inc/sidebar.inc");?>
</div>
<div id="content">
  <?php include("home/inc/header.inc");?>

  <div class="innerLR">
<div class="innerLR"> 
<form  method="POST" action="<?php echo $dd?>home/update_cars_action" id="myform" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $idhelp?>" name="id">
<div class="widget">
<div class="widget-body innerAll inner-2x">
<label class=""  style=" text-align:center;font-family: 'Droid Arabic Kufi', sans-serif;">نوع الخدمة</label>
<div class="form-group col-md-12"  style="width:100%; margin-bottom:30px;">
<?php
$result_service = $this->db->get_where("category",array('view'=>'1'))->result();
foreach($result_service as $result_service){
$ids=$result_service->id;
?>
<div class="col-md-3">
<input type="checkbox" name="service_type[]" <?php if($id_category==$ids) echo "checked"?> value="<?php echo $result_service->id;?>"><span style="margin-left:5px">
<?php echo $result_service->titleeng;?></span>
</div>
<?php }?>
</div>

<div style="width:100%;clear:both"   class="col-md-12"></div>

<div style="width:100%; margin-bottom:30px;" align="center">
<div >
<label for="logo" style="direction:rtl">اسم السيارة</label>

<input   name="title" type="text"  value="<?php echo $title?>" required style="width:100%;direction:rtl; height:40px;"/>
</div>
</div>


<div style="width:100%; margin-bottom:30px;" align="center">
<div >
<label for="logo" style="direction:rtl">Car name</label>
<input   name="titleeng" type="text"  value="<?php echo $titleeng?>" required style="width:100%;direction:ltr; height:40px;"/>
</div>
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


<script>			

CKEDITOR.replace('description');		
CKEDITOR.replace('descriptioneng');
</script>