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
$description=$articles->descriptionar;
$idhelp=$articles->id;
$descriptioneng=$articles->description;
$video=$articles->video;
	}
?>
<!DOCTYPE html>
<html class="sidebar sidebar-discover">
<head>
<title>تعديل</title>
<meta charset="utf-8">
<?php 
include ("home/inc/head1.inc");
include ("opendb.inc");
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
<form  method="POST" action="<?php echo $dd?>home/update_cartype_action" id="myform" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?php echo $idhelp?>">
<div class="widget">
<div class="widget-body innerAll inner-2x">
<div class="form-group"  style="width:100%">
<label class=""  style="direction:rtl;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">نوع الخدمة</label>
<?php
$current_service = $this->db->get_where("category",array('id'=>$id_category))->result();
foreach($current_service as $current_service)

?>

<select name="service_type" required class="sel">
<option value="<?php echo $current_service->id?>"><?php echo $current_service->titleeng?></option>	
<?php
$result_service = $this->db->get_where("category",array('view'=>'1','id !='=>$id_category))->result();
foreach($result_service as $result_service){
?>
<option value="<?php echo $result_service->id;?>"><?php echo $result_service->titleeng;?></option>	
<?php }?>
</select>
</div>


<div style="width:100%; margin-bottom:30px;" align="center">
<div >
<label for="logo" style="direction:rtl">تفاصيل</label>
<textarea name="description" rows="2" style="width:100%; direction:rtl;height:80px;"><?php echo $description?></textarea>
</div>
</div>


<div style="width:100%; margin-bottom:30px;" align="center">
<div >
<label for="logo" style="direction:rtl">Details</label>
<textarea name="descriptioneng" rows="2" style="width:100%; direction:rtl;height:80px;"><?php echo $descriptioneng;?></textarea>
</div>
</div>


<div class="form-group video1">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">الفيديو</label> <input class="form-control videof" id="password" name="video" type="text" style="width:100%; text-align:right; direction:rtl" value="<?php echo $video?>"></div>	
<br><br>
<div class="col-sm-6 slider1" >
<span class="input-group-btn">
<span class="hh">
<input type="file" class="margin-none imgf imageUpload" name="img1[]" size="20" multiple>
</div> 	
<div class="clearfix"></div>


<?php
$gallery = $this->db->get_where("gallery",array("id_car"=>$this->input->get('id')))->result();
if (count($gallery) != 0) {
foreach($gallery as $gallery) {

								?>



							<div class="col-md-3" >

								<div class="old_img" style="position: relative">
<a href="<?php echo base_url("home/delete_gallery/".$gallery->id."/".$this->uri->segment(3)) ?>" title="delete" class="delete_img" >

										<input type="hidden" name="id_img" class="id_img" value="<?php echo $id_img; ?>" />

										<input type="hidden" name="img_img" class="img_img" value="<?php echo $img; ?>" />

										<i title="مسح" style="position: absolute;cursor: ;right: 62px;top: 35px;color: #4ebd4a;border-radius: 6px;border: 1px solid #5c5454;padding: 7px;" class="fa fa-lg fa-trash" ></i>

									</a>

									<img style="width:80px;height:50px;" src="../../site/ar/images/car_type/<?php echo $gallery->img?>" alt="Product Image" />

								</div>

						</div>

									<?php }}?>

							
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

CKEDITOR.replace('description');		
CKEDITOR.replace('descriptioneng');
</script>