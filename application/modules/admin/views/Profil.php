<?php
ob_start();
session_start();
$id_admin=$_SESSION['id_admin'];
include('db/opendb.inc');
include("inc/lang.php");
$currentFile = $_SERVER["PHP_SELF"];
$parts = explode('/', $currentFile);
$length = count($parts);
$page_name="/";
for($i=0; $i<$length-1; $i++){
	if($parts[$i]!=""){
		$page_name .= $parts[$i]."/";
	}	
}
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){
	//header("Location: http://".$_SERVER['SERVER_username']."/Work/nada_host/ar/index.php");
	header("Location: http://".$_SERVER['HTTP_HOST'].$page_name."login.php"); 
}
//echo $id_admin;
$sql="select * from admin where id='$id_admin'";
$rsdd=mysql_query($sql);
$roww=mysql_fetch_array($rsdd);
$password=$roww['password'];
$usernameed=$roww['username'];
$user_mail=$roww['mail'];
?>
<!DOCTYPE html>
<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>
	<title>المستخدم</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<?php include ("inc/head.inc");?>
	<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script>
$(document).ready(function(e) {
    $("#send").click(function(e) {
        e.preventDefault();
		var data=$("#myform").serialize();
		
		$.ajax({
			url:"db/change_profil.php",
			data:data,
			type:'POST',
			dataType:"json",
			success: function(data){
			if(data==="0"){
				$("#mail").hide();
				$("#user").hide();
			$(".n_ok").show();
				window.location.reload();				
	
			}
			else if(data==="1") {
				$("#user").hide();
				$(".n_ok").hide();
				$("#mail").show();
				
			}
			else if(data==="-1") {
				$("#mail").hide();
				$(".n_ok").hide();
				$("#user").show();
                                
					
			}
			}
		});
    });
});
</script>
</head>
<body class="scripts-async">
	
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden">
		
				<!-- Sidebar Menu -->
<?php 
include ("inc/sidebar.inc");
?>
		<!-- // Sidebar Menu END -->
				
		<!-- Content -->
		<div id="content">

			<div class="navbar hidden-print main" role="navigation">
	<div class="user-action user-action-btn-navbar pull-left border-right">
		<button class="btn btn-sm btn-navbar btn-inverse btn-stroke"><i class="fa fa-bars fa-2x"></i></button>
	</div>
	<?php 
	include ("inc/header.inc");
	?>
	
	
</div>
<!-- // END navbar -->



<div class="innerLR">

	<h2 class="margin-none" style="position:relative; direction:<?php echo $dir?>">المستخدم &nbsp;<div class="product" style="position:absolute;<?php echo $align?>:153px; top:-13px;"></div></h2>

	<div class="separator-h"></div>
				
	<div class="row">	</div>
<div class="widget widget-body-white overflow-hidden">
				<div class="widget-head innerAll half">
					<h4 class="margin-none" style="direction:<?php echo $dir?>"><i class="fa fa-fw icon-wallet"></i>المستخدم</h4>
				</div>
				<div class="widget-body innerAll">
<div class="n_ok" style="display:none;text-align:right"><p><?php echo $success?></p></div>
                <div class="n_error" style="display:none; text-align:right" id="mail"><p>من فضلك ادخل كلمة المرور</p></div>
                <div class="n_error" style="display:none;text-align:right" id="user"><p>من فضلك ادخل الايميل</p></div>
				<div class="innerLR">
	<!-- Form -->
<form  method="post" action="#" id="myform">
	<input  type="hidden" name="id" value="<?php echo $id_admin?>">
	<!-- Widget -->
	<div class="widget">
	
		<!-- Widget heading -->
		<div class="widget-head">
			<h4 class="heading" style=" direction:<?php echo $dir?>">المستخدمين</h4>
		</div>
<div class="widget-body innerAll inner-2x">
		
			<!-- Row -->
			<div class="row innerLR"  style="direction:<?php echo $dir?>">
			
				<!-- Column -->
				<div class="col-md-4" style="width:50%; direction:<?php echo $dir?>; margin-left:250px;" align="center">
				
					<!-- Group -->
				
						<label class="" for="firstname" style=" direction:<?php echo $dir?>;">اسم المستخدم</label>
						
                        <input class="form-control" id="firstname" name="username" type="text" value="<?php echo $usernameed?>"  style="width:100%"/></div>
					
				</div>
				<div style="clear:both"></div>
                <div class="col-md-4" style="width:50%; direction:<?php echo $dir?>; margin-left:250px;" align="center">
				
					<!-- Group -->
				
						<label class="" for="firstname" style=" direction:<?php echo $dir?>;">كلمة المرور</label>
						
                        <input class="form-control" id="firstname" name="password" type="password" value="<?php echo $password?>"  style="width:100%"/></div>

				<div style="clear:both"></div>
                <div class="col-md-4" style="width:50%; direction:<?php echo $dir?>; margin-left:248px" align="center">
				
					<!-- Group -->
				
						<label class="" for="firstname" style=" direction:<?php echo $dir?>;">الايميل</label>
						
                        <input class="form-control" id="firstname" name="mail" type="text" value="<?php echo $user_mail?>"  style="width:100%"/></div>
					
				</div>
                <div style="clear:both"></div>
<div style="clear:both"></div>
			<!-- Form actions -->
			<div class="form-actions" align="center"  style="width:84%;">
             <input type="submit" value="<?php echo $button?>" class="btn btn-primary fa fa-check-circle" id="send">
				<button type="button" class="btn btn-default" id="cancel" ><i class="fa fa-times"></i> <?php echo $delete?></button>
			</div>
			<!-- // Form actions END -->
			<div style="clear:both"></div>
		</div>
	</div>
	<!-- // Widget END -->
	
</form>
<!-- // Form END -->			</div>
			
			
		</div>
       <div class="clear"></div>
    </div>


</div>
</div>
</div>
		<!-- // Content END -->
		
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->
		
		<div id="footer" class="hidden-print">
 
			<?php include ("inc/footer.inc");?>
			<!--  End Copyright Line -->
	
		</div>
		
		<!-- // Footer END -->
		
	</div>
	<!-- // Main Container Fluid END -->

<?php
include ("inc/headf.inc");
?>
		
</body>
</html>