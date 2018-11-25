<?php
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){
$dd=base_url();
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
foreach($up_admin as $upadmin){
	$name_username=$upadmin->username;
	$name_mail=$upadmin->email;
	$text_value=$upadmin->text_value;
	$name_id=$upadmin->id;
		}
?>

<!DOCTYPE html>
<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>
<title>التعديل</title>
<meta charset="utf-8">
<?php 
	include ("design/inc/head1.inc");
	?>
<script src="assets/js/jquery-1.9.1.min.js"></script>
	<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
</head>
<body class="">
	<div class="container-fluid menu-hidden">
<?php include ("design/inc/sidebar.inc");?>
</div>
<div id="content">
<?php 
include("design/inc/header.inc");?>		
<div class="innerLR">
  	<div class="widget-body innerAll">
<div class="n_ok" style="display:<?php echo $df;?>; direction:rtl;     font-family: 'Droid Arabic Kufi', sans-serif;"><p>لقد تم فتح الحساب بنجاح</p></div>
				<div class="innerLR">
	<!-- Form -->
<form  method="post" action="<?php echo $dd?>admin/update_admin_action" id="myform">
<input type="hidden" value="<?php echo $name_id?>" name="id">
<div class="widget">
<div class="widget-body innerAll inner-2x">

<div class="row innerLR"  >
                        
	<div class="form-group">

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;    font-family: 'Droid Arabic Kufi', sans-serif;">اسم المستخدم</label> 
<input class="form-control" id="username" name="username" type="text" style="width:100%; direction:rtl" value="<?php echo $name_username?>" readonly />
<div style="width:100%; clear:both"></div>
<span style="display:none; color:#F00;" class="n_error0">اسم المستخدم غير متاح حاليا</span>
<span style="display:none; color:#090;" class="n_seccs">اسم المستخدم  متاح حاليا</span>

</div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;    font-family: 'Droid Arabic Kufi', sans-serif;">كلمة المرور</label> <input class="form-control" id="password" name="password" type="text" style="width:100%; direction:rtl"  value="<?php echo $text_value;?>" /></div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:ltr; float:right;    font-family: 'Droid Arabic Kufi', sans-serif;">كلمة المرور الداخلية </label> <input class="form-control" id="password" name="pincode" type="password" style="width:100%;direction:rtl" required /></div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:ltr; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">الأيميل</label> <input class="form-control"  id="mail" name="mail" type="text" value="<?php echo $name_mail?>" style=" direction:rtl;width:100%" readonly />
<div style="width:100%; clear:both"></div>
<span style="display:none; color:#F00;" class="n_error1">البريد الالكترونى غير متاح حاليا</span>
<span style="display:none; color:#090;" class="n_seccs1">البريد الالكترونى متاح</span>

</div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">الصلاحيات</label> 
<select  name="type" style="height:40px;width:100%;font-size:16px; text-align:left; direction:rtl" class="sel">
<option  value="">من فضلك حدد الصلاحية</option>
<option  value="1">الادمن</option>
<option  value="2">المدير</option>
<option  value="3">المحاسب</option>
<option  value="4">خدمة العملاء</option>
</select>
</div>

<div class="form-actions" align="center" style="padding-bottom:20px;">
             <input type="submit" value="حفظ الأعدادات"  class="Go"  id="Send"  style="font-family: 'Droid Arabic Kufi', sans-serif;">
			</div>
		</div>
	</div>
</form>
</div></div>
</div>
<div id="footer" class="hidden-print">
			<?php
            include ("design/inc/footer.inc");
			?>
		</div>
	</div>
	<?php
    include ("design/inc/headf1.inc");
	?>
</body>
</html>