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
$title_solgin=$articles->title_solgin;
$description_solgin=$articles->description_solgin;
$titlear_solgin=$articles->titlear_solgin;
$descriptionar_solgin=$articles->descriptionar_solgin;
$b1=$articles->b1;
$b2=$articles->b2;
$b3=$articles->b3;

$block1=$articles->block1;
$block2=$articles->block2;
$block3=$articles->block3;

$block1ar=$articles->block1ar;
$block2ar=$articles->block2ar;
$block3ar=$articles->block3ar;

$btitle1=$articles->btitle1;
$btitle2=$articles->btitle2;
$btitle3=$articles->btitle3;
$btitle_ar1=$articles->btitle_ar1;
$btitle_ar2=$articles->btitle_ar2;
$btitle_ar3=$articles->btitle_ar3;

$policyimg=$articles->policyimg;
$policyar=$articles->policyar;
$policy=$articles->policy;


$main_title=$articles->main_title;
$main_titlear=$articles->main_titlear;
$t1=$articles->t1;
$t2=$articles->t2;
$t3=$articles->t3;
$t1ar=$articles->t1ar;
$t2ar=$articles->t2ar;
$t3ar=$articles->t3ar;
$imgt1=$articles->imgt1;
$imgt2=$articles->imgt2;
$imgt3=$articles->imgt3;
	}

?>

<!DOCTYPE html>

<!--[if !IE]><!-->

<html class="sidebar sidebar-discover">

<!-- <![endif]-->

<head>

<title>الصفحة الرئيسية</title>

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

<form  method="POST" action="<?php echo $dd?>home/update_mainpage" id="myform" enctype="multipart/form-data">
<div class="widget">
<div class="widget-body innerAll inner-2x">
<div class="form-group"  style="width:48%; float:right">
<label class=""  style="direction:rtl;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان التعرفى</label>
<input   name="titlear_solgin" type="text"  value="<?php echo $titlear_solgin?>"   style="width:100%;    font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>
</div>

<div class="form-group"  style="width:48%">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:left">Title Slogin</label>
<input   name="title_solgin" type="text"  value="<?php echo $title_solgin?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:ltr; height:40px;"/>

</div>


<div class="col-md-4" style="width:48%; float:right" align="center" >
<div class="form-group"><label class="control-label"  style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">الوصف التعريفى</label>
<textarea style="height:70px; width:100%;direction:rtl" name="descriptionar_solgin" ><?php echo $descriptionar_solgin?></textarea>	</div></div>

                

                                

<div class="col-md-4" style="width:48%; direction:ltr" align="center" >
<div class="form-group">
<label class="control-label" style=" direction:ltr; float:left;font-family: 'Droid Arabic Kufi', sans-serif;"> Description Slogin</label>
<textarea style="height:70px; width:100%;" name="description_solgin"><?php echo $description_solgin?></textarea>	
</div></div>


<div class="col-md-12">
<div class="col-md-12" style="margin:30px;"></div>
<div class="col-md-4">
<div style="text-align:center;font-family: 'Droid Arabic Kufi', sans-serif;">القسم الاول</div>
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:left">Block Title</label>
<input   name="btitle1" type="text"  value="<?php echo $btitle1?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:ltr; height:40px;"/>

<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان</label>
<input   name="btitle_ar1" type="text"  value="<?php echo $btitle_ar1?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:ltr; height:40px;"/>

<label for="logo"  style="direction:ltr">Image(width:151px,height:151px)</label>
<div style="text-align:center">
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">Image</span>
<input type="file" class="margin-none"  name="b1" /></span></span>
</div>

<div style="text-align:center">
<img src="../../site/ar/images/site_setting/<?php echo $b1?>"  style="width:151px; height:151px;">
</div>

<label class="control-label" style=" direction:ltr; float:left;">Description</label>
<textarea style="height:70px; width:100%;" name="block1"><?php echo $block1?></textarea>
<label class="control-label" style=" direction:rtl; float:right;">المحتوى</label>
<textarea style="height:70px; width:100%;" name="block1ar"><?php echo $block1ar?></textarea>	
</div>
<div class="col-md-4">
<div style="text-align:center;font-family: 'Droid Arabic Kufi', sans-serif;">القسم الثانى</div>
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:left">Block Title</label>
<input   name="btitle2" type="text"  value="<?php echo $btitle2?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:ltr; height:40px;"/>

<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif;float:right">العنوان</label>
<input   name="btitle_ar2" type="text"  value="<?php echo $btitle_ar2?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:ltr; height:40px;"/>


<label for="logo"  style="direction:ltr">Image(width:151px,height:151px)</label>
<div style="text-align:center">
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">Image</span>
<input type="file" class="margin-none"  name="b2" /></span></span>
</div>
<div style="text-align:center">
<img src="../../site/ar/images/site_setting/<?php echo $b2?>"  style="width:151px; height:151px;">
</div>

<label class="control-label" style=" direction:ltr; float:left;">Description</label>
<textarea style="height:70px; width:100%;" name="block2"><?php echo $block2?></textarea>
<label class="control-label" style=" direction:rtl; float:right;">المحتوى</label>
<textarea style="height:70px; width:100%;" name="block2ar"><?php echo $block2ar?></textarea>	
</div>
<div class="col-md-4">
<div style="text-align:center;font-family: 'Droid Arabic Kufi', sans-serif;">القسم الثالث</div>
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:left">Block Title</label>
<input   name="btitle3" type="text"  value="<?php echo $btitle3?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:ltr; height:40px;"/>

<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif;float:right">العنوان</label>
<input   name="btitle_ar3" type="text"  value="<?php echo $btitle_ar3?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:ltr; height:40px;"/>

<label for="logo"  style="direction:ltr">Image(width:151px,height:151px)</label>
<div style="text-align:center">
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">Image</span>
<input type="file" class="margin-none"  name="b3" /></span></span>
</div>
<div style="text-align:center">
<img src="../../site/ar/images/site_setting/<?php echo $b3?>"  style="width:151px; height:151px;">
</div>

<label class="control-label" style=" direction:ltr; float:left;">Description</label>
<textarea style="height:70px; width:100%;" name="block3"><?php echo $block3?></textarea>
<label class="control-label" style=" direction:rtl; float:right;">المحتوى</label>
<textarea style="height:70px; width:100%;" name="block3ar"><?php echo $block3ar?></textarea>	
</div></div></div>


<div class="col-md-12">
<div class="col-md-12" style="margin:30px;"></div>
<div class="col-md-4"  style="float:right">
<label for="logo"  style="direction:ltr">Image(width:450px,height:400px)</label>
<div style="text-align:center">
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">Image</span>
<input type="file" class="margin-none"  name="policyimg" /></span></span>
</div>
<div style="text-align:center">
<img src="../../site/ar/images/site_setting/<?php echo $policyimg?>"  style="width:100%">
</div>


</div>
<div class="col-md-8" >
<div style="width:100%; direction:rtl" align="center" >
<div class="form-group">
Indroduction
<textarea style="height:50px; width:100%;" name="policy"><?php echo $policy?></textarea>	
</div></div>

<div style="width:100%; direction:rtl" align="center" >
<div class="form-group">
الكلمة التعريفية
<textarea style="height:50px; width:100%;" name="policyar"><?php echo $policyar?></textarea>	
</div></div></div></div>


<div class="col-md-12">
<div class="col-md-12" style="margin:30px;"></div>
<div class="col-md-6"  style="float:right">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان الرئيسى</label>
<input   name="main_titlear" type="text"  value="<?php echo $main_titlear?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>

</div>
<div class="col-md-6">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:left">Block Title</label>
<input   name="main_title" type="text"  value="<?php echo $main_title?>"   style="width:100%;;direction:ltr; height:40px;"/>
</div>


<div style="margin:50px;"></div>
<div class="col-md-4"  style="float:right; margin-top:30px;">
<div style="text-align:center;font-family: 'Droid Arabic Kufi', sans-serif;">القسم الاول</div>

<label for="logo"  style="direction:ltr">Image(width:180px,height:180px)</label>
<div style="text-align:center">
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">Image</span>
<input type="file" class="margin-none"  name="imgt1" /></span></span>
</div>
<div style="text-align:center">
<img src="../../site/ar/images/site_setting/<?php echo $imgt1?>"  style="width:180px;height:180px;">
</div>

<div class="col-md-6"  style="float:right">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:right;direction:rtl;">العنوان الرئيسى</label>
<input   name="t1ar" type="text"  value="<?php echo $t1ar?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/>

</div>
<div class="col-md-6">
<label class=""  style="float:left">Block Title</label>
<input   name="t1" type="text"  value="<?php echo $t1?>"   style="width:100%;;direction:ltr; height:40px;"/>
</div>


</div>


<div class="col-md-4" style="margin-top:30px;">
<div style="text-align:center;font-family: 'Droid Arabic Kufi', sans-serif;">القسم الثانى</div>
<label for="logo"  style="direction:ltr">Image(width:180px,height:180px)</label>
<div style="text-align:center">
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">Image</span>
<input type="file" class="margin-none"  name="imgt2" /></span></span>
</div>
<div style="text-align:center">
<img src="../../site/ar/images/site_setting/<?php echo $imgt2?>"  style="width:180px;height:180px;">
</div>
<div class="col-md-6"  style="float:right">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان الرئيسى</label>
<input   name="t2ar" type="text"  value="<?php echo $t2ar?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:ltr; height:40px;"/>

</div>
<div class="col-md-6">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:left">Block Title</label>
<input   name="t2" type="text"  value="<?php echo $t2?>"   style="width:100%;;direction:ltr; height:40px;"/>
</div>


</div>


<div class="col-md-4"  style="margin-top:30px;">
<div style="text-align:center;font-family: 'Droid Arabic Kufi', sans-serif;">القسم الثالث</div>
<label for="logo"  style="direction:ltr">Image(width:180px,height:180px)</label>
<div style="text-align:center">
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">Image</span>
<input type="file" class="margin-none"  name="imgt3" /></span></span>
</div>
<div style="text-align:center">
<img src="../../site/ar/images/site_setting/<?php echo $imgt3?>"  style="width:180px; height:180px;">
</div>

<div class="col-md-6"  style="float:right">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان الرئيسى</label>
<input   name="t3ar" type="text"  value="<?php echo $t3ar?>"   style="width:100%;font-family: 'Droid Arabic Kufi', sans-serif;direction:ltr; height:40px;"/>

</div>
<div class="col-md-6">
<label class=""  style="font-family: 'Droid Arabic Kufi', sans-serif; float:left">Block Title</label>
<input   name="t3" type="text"  value="<?php echo $t3?>"   style="width:100%;;direction:ltr; height:40px;"/>
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
CKEDITOR.replace('policy');
CKEDITOR.replace('policyar');		
</script>