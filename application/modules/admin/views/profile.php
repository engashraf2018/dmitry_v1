<?php
ob_start();

if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){
	$dd=base_url();
header("Location:".$dd."home/login"); }
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
include("config/opendb.inc");

$sql="select * from admin  where id='$id_admin'";
$rsdd=mysql_query($sql);
$roww=mysql_fetch_array($rsdd);
$password=$roww['password'];
$usernameed=$roww['username'];
$user_mail=$roww['mail'];

?>
<!DOCTYPE html>



<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->

<head>

	<title>تعديل الحساب الشخصى</title>



	<meta charset="utf-8">
<?php 
include ("home/inc/head1.inc");
	?>
<script src="assets/js/jquery-1.9.1.min.js"></script>
</head>
<body class="">
	<!-- Main Container Fluid -->

	<div class="container-fluid menu-hidden">
<?php 

include ("home/inc/sidebar.inc");

?>

		</div>

		<!-- // Sidebar Menu END -->

				

		<!-- Content -->

		<div id="content">



<?php 
include("home/inc/header.inc");
?>		
<div class="innerLR">

	<!-- Widget -->
	<div class="widget-body innerAll">
<div class="n_ok" style="display:<?php echo $df;?>; direction:rtl; font-family:NeoSansArabic !important"><p><?php echo $success?></p></div>
                <div class="n_error" style="display:none"><p><?php echo $error?></p></div>
				<div class="innerLR">
	<!-- Form -->
<form  method="post" action="update_profile" id="myform" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id_admin?>">
	<!-- Widget -->
	<div class="widget">

<div class="widget-body innerAll inner-2x">
		
			<!-- Row -->
			<div class="row innerLR"  >
			

            
				<div class="col-md-4" style="width:100%; direction:rtl" align="center" >
					<div class="form-group">
					<label class="control-label" for="firstname" style=" direction:ltr; float:left;font-family:NeoSansArabic !important">Password</label>
                        <input class="form-control" id="firstname" name="password"  value="<?php echo $password?>" type="password"style="width:100%; direction:ltr"/>
	
				</div></div>
                <div class="col-md-4" style="width:100%; direction:rtl" align="center" >
					<div class="form-group">
					<label class="control-label" for="firstname" style=" direction:ltr; float:left;font-family:NeoSansArabic !important">Username</label>
                        <input class="form-control" id="firstname" name="username"  value="<?php echo $usernameed?>" type="text" style="width:100%; direction:ltr"/>
	
				</div></div>
                
                
                                    <div class="col-md-4" style="width:100%; direction:rtl" align="center" >
					<div class="form-group">
					<label class="control-label" for="firstname" style=" direction:ltr; float:left;font-family:NeoSansArabic !important">E_Mail</label>
                        <input class="form-control" id="firstname" name="email"  value="<?php echo $user_mail?>" type="text" style="width:100%; direction:ltr"/>
	
				</div></div>         


			<!-- Form actions -->
			<div class="form-actions" align="center">
             <input type="submit" value="حفظ الاعدادت" class="btn btn-primary fa fa-check-circle" id="Send"  style="font-family:NeoSansArabic !important">
			</div>
			<!-- // Form actions END -->
			
		</div>
	</div>
	<!-- // Widget END -->
	
</form>
<!-- // Form END -->			</div>
			
			
		</div>

	
	
		
		</div>





		<div class="clearfix"></div>
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