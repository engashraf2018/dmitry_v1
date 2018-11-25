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
<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>
<title>الاسليدر</title>
<meta charset="utf-8">
<?php 
	include ("home/inc/head1.inc");
	?>
<script src="assets/js/jquery-1.9.1.min.js"></script>
	<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
</head>

<body class="">

	

	<!-- Main Container Fluid -->

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
<form  method="POST" action="<?php echo base_url()?>home/slider_action" id="myform" enctype="multipart/form-data">
	<!-- Widget -->
	<div class="widget">

<div class="widget-body innerAll inner-2x">
		

<div class="form-group" style="text-align:center">
<label for="logo"  style="direction:ltr">image(width:1350px,height:450px)</label>
<span class="input-group-btn">
<span class="btn btn-default btn-file"><span class="fileupload-new">image</span>
<input type="file" class="margin-none"  name="file"/></span>
</span>
</div>

<div class="col-md-4" style="width:100%; direction:rtl" align="center" >
<div class="form-group">
<label class="control-label" for="email" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">العنوان</label>
<input class="form-control" id="email" name="title"  type="text"style="width:100%"/>
</div>
</div>

<div class="col-md-4" style="width:100%; direction:rtl" align="center" >
<div class="form-group">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">الوصف المختصر</label>
<textarea style="height:50px; width:100%; resize:none" name="metadesc"></textarea>	
</div></div>




<div class="col-md-4" style="width:100%; direction:ltr" align="center" >
<div class="form-group">
<label class="control-label" for="email" style=" direction:ltr; float:left;font-family: 'Droid Arabic Kufi', sans-serif;">Title</label>
<input class="form-control" id="email" name="titleeng"  type="text"style="width:100%"/>
</div>
</div>

<div class="col-md-4" style="width:100%; direction:ltr" align="center" >
<div class="form-group">
<label class="control-label" for="firstname" style=" direction:ltr; float:left;font-family: 'Droid Arabic Kufi', sans-serif;">small Desctription</label>
<textarea style="height:50px; width:100%; resize:none" name="metadesceng"></textarea>	
</div></div>


<div class="col-md-4" style="width:100%; direction:ltr" align="center" >
<div class="form-group">
<label class="control-label" for="email" style=" direction:ltr; float:left;font-family: 'Droid Arabic Kufi', sans-serif;">Title_link</label>
<input class="form-control" id="email" name="titleeng_link"  type="text"style="width:100%"/>
</div>
</div>

<div class="col-md-4" style="width:100%; direction:rtl" align="center" >
<div class="form-group">
<label class="control-label" for="email" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">عنوان الرابط</label>
<input class="form-control" id="email" name="title_link"  type="text"style="width:100%"/>
</div>
</div>

<div class="col-md-4" style="width:100%; direction:ltr" align="center" >
<div class="form-group">
<label class="control-label" for="email" style=" direction:ltr; float:left;font-family: 'Droid Arabic Kufi', sans-serif;">link</label>
<input class="form-control" id="email" name="link"  type="text"style="width:100%"/>
</div>
</div>

<div class="form-actions" align="center" style="padding-bottom:20px;">
<input type="submit" value="اضافة" class="btn btn-primary fa fa-check-circle" id="Send"  style="font-family: 'Droid Arabic Kufi', sans-serif; !important">
</div>
			<!-- // Form actions END -->
			
		</div>
	</div>
	<!-- // Widget END -->
	
</form>
<!-- // Form END -->			</div>
			
			
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

		

		<!-- // Footer END -->

		

	</div>

	<!-- // Main Container Fluid END -->

	<?php

    include ("home/inc/headf1.inc");

	?>
</body>
</html>