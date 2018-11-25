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
$title=$help->name;
$details=$help->details;
$img_site=$help->img;
$idhelp=$help->id;
	}

?>

<!DOCTYPE html>

<!--[if !IE]><!-->
<html class="sidebar sidebar-discover">
<head>
<title>سياسة الخصوصية<?php echo $title;?></title>
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
<?php
if($img_site!=""){
?>
<div style="text-align:center">
<img src="<?php echo $main_baseurl?>site/ar/images/about_rose/<?php echo $img_site?>"  style="width:400px;">
</div>
<?php }?>
  <div class="widget-body innerAll">
      <form  method="POST" action="<?php echo $dd?>home/update_termaction" id="myform"  enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $idhelp?>">
        <div class="widget">
<div class="widget-body innerAll inner-2x">
<div class="form-group" style="text-align:center; margin-top:20px;">
<label for="logo"  style="direction:ltr">image(width:450px,height:300px)</label>
  <span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">image</span>
<input type="file" class="margin-none"  name="file"/></span>
</span>
</div>

<div class="form-group"  style="width:100%">
<label class=""  style="direction:ltr;font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان</label>
<input   name="title" type="text"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;;direction:rtl; height:40px;" value="
<?php echo $title?>"/>
</div>

<div style="text-align:center; margin-top:10px;">
<label for="logo" style="direction:rtl">الوصف</label>
<textarea name="mapar" rows="2" style="direction:rtl; width:100%; direction:rtl;height:200px;font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $details?></textarea>
</div>
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