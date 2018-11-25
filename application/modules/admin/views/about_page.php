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

foreach($mainpage as $articles){
$video=$articles->video;
$video_about=$articles->video_about;
$video_about_ar=$articles->video_about_ar;
$main_descrip=$articles->main_descrip;
$main_descripar=$articles->main_descripar;
$secmain_descrip=$articles->secmain_descrip;
$secmain_descripar=$articles->secmain_descripar;


$about_title=$articles->about_title;
$about_titlear=$articles->about_titlear;
$about_titleb=$articles->about_titleb;
$about_titlebar=$articles->about_titlebar;


$about_img=$articles->about_img;
$about_img1=$articles->about_img1;

	}

?>

<!DOCTYPE html>

<!--[if !IE]><!-->

<html class="sidebar sidebar-discover">

<!-- <![endif]-->

<head>

<title>من نحن</title>

<meta charset="utf-8">

<?php include ("home/inc/head1.inc");?>
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="text_css/jquery.datetimepicker.css"/>
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

<form  method="POST" action="<?php echo $dd?>home/update_aboutpage" id="myform" enctype="multipart/form-data">
<div class="widget">
<div class="widget-body innerAll inner-2x">


<div class="col-md-12" style="float:right; margin-bottom:20px;" align="center" >
<label class="control-label"  style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">الفيديو</label>
<textarea style="height:40px; width:100%;direction:ltr" name="video" ><?php echo $video?></textarea>
<?php
if($video!=""){
	
	$str2 = $video;  
$upload_extension2 =  explode("=", $str2);
$num = @strpos($upload_extension2[1],"&");
echo $upload_extension2[1]."<br>";
echo $num;

if ($num != "") {
  if ($num > 3) {
$num_last = substr($upload_extension2[1], 0, $num);
$img_youtube =$num_last;
}
else{
  $upload_extension = end($upload_extension2);

$img_youtube = $upload_extension;

}
}else{
$upload_extension = end($upload_extension2);
$img_youtube = $upload_extension;

}
	
	?>




<embed width="420" height="200" src="https://www.youtube.com/v/<?php echo $img_youtube;?>"></embed>
<?php }?>
</div>


<div class="col-md-6">
Introduction About Video
<textarea style="height:80px; width:100%;" name="video_about"><?php echo $video_about?></textarea>	
</div>


<div class="col-md-6"   style="text-align:right">
عن الفيديو
<textarea style="width:100%;" name="video_about_ar"><?php echo $video_about_ar?></textarea>	
</div>


<div class="col-md-12">

<div class="col-md-12" style="margin:30px;"></div>
<div style="text-align:center;font-family: 'Droid Arabic Kufi', sans-serif;">الجزء الاول</div>

<div class="col-md-6"  style="float:right">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان الرئيسى</label>
<input   name="about_titlear" type="text"  value="<?php echo $about_titlear?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>
</div>
<div class="col-md-6">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:left">Block Title</label>
<input   name="about_title" type="text"  value="<?php echo $about_title?>"   style="width:100%;;direction:ltr; height:40px;"/>
</div>

<div class="col-md-12">
<label for="logo"  style="direction:ltr">Image(width:1350px,height:400px)</label>
<div style="text-align:center">
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">Image</span>
<input type="file" class="margin-none"  name="about_img" /></span></span>
</div>
<div style="text-align:center">
<img src="../../site/ar/images/site_setting/<?php echo $about_img?>"  style="width:100%; ">
</div>

</div>
<div class="col-md-12">
<div class="col-md-6" style="float:right; text-align:right">
الوصف الاول
<textarea style="height:200px; width:100%;" name="main_descripar"><?php echo $main_descripar?></textarea>	
</div>

<div class="col-md-6">
First Description
<textarea style="height:200px; width:100%;" name="main_descrip"><?php echo $main_descrip?></textarea>	
</div>

</div>


</div>


<div class="col-md-12">

<div class="col-md-12" style="margin:30px;"></div>
<div style="text-align:center;font-family: 'Droid Arabic Kufi', sans-serif; ">الجزء الثانى</div>

<div class="col-md-6"  style="float:right">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان الرئيسى</label>
<input   name="about_titlebar" type="text"  value="<?php echo $about_titlebar?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>

</div>
<div class="col-md-6">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:left">Block Title</label>
<input   name="about_titleb" type="text"  value="<?php echo $about_titleb?>"   style="width:100%;;direction:ltr; height:40px;"/>
</div>

<div class="col-md-12">

<label for="logo"  style="direction:ltr">Image(width:1350px,height:400px)</label>
<div style="text-align:center">
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">Image</span>
<input type="file" class="margin-none"  name="about_img1" /></span></span>
</div>
<div style="text-align:center">
<img src="../../site/ar/images/site_setting/<?php echo $about_img1?>"  style="width:100%;">
</div>

</div>
<div class="col-md-12"  style="margin-top:20px;">
<div class="col-md-6" style=" float:right; text-align:right">
الوصف الاول
<textarea style="height:200px; width:100%;" name="secmain_descripar"><?php echo $secmain_descripar?></textarea>	
</div>

<div class="col-md-6">
First Description
<textarea style="height:200px; width:100%;" name="secmain_descrip"><?php echo $secmain_descrip?></textarea>	
</div>

</div>


</div>





<div class="form-actions" align="center" style="padding-bottom:20px;">

<input type="submit" value="تعديل" class="Go" id="Send"  style="    font-family: 'Droid Arabic Kufi', sans-serif;">

</div>







</form>

</div>

  </div>

</div>

</div>

<div style=" clear:both; height:20px;"></div>

<div class="clearfix"> 

  <script>			
CKEDITOR.replace('video_about');
CKEDITOR.replace('video_about_ar');


	
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
