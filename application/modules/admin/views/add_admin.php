<?php
ob_start();
	$dd=base_url();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){
header("Location:".$dd."admin/login"); 
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
    $chars ="1234567890";
    $final_rand='';
    for($i=0;$i<4; $i++) {
 $final_rand .= $chars[ rand(0,strlen($chars)-1)];
    }
?>
<!DOCTYPE html>
<!--[if !IE]><!-->
<html class="sidebar sidebar-discover">
<!-- <![endif]-->
<head>
<title>أضافة</title>
<meta charset="utf-8">
<?php 
include ("design/inc/head1.inc");
	?>
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script src="text_js/ckeditor.js"></script>
<link href="text_css/sample.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="text_css/jquery.datetimepicker.css"/>
<script type="text/javascript">
</script>
</head>
<body class="">
<div class="container-fluid menu-hidden">
  <?php include ("design/inc/sidebar.inc");?>
</div>
<div id="content">
  <?php include("design/inc/header.inc");?>
  <div class="innerLR">
<div class="innerLR"> 
<!-- Form -->
<form  method="post" action="<?php echo $dd?>admin/admin_action" id="myform">
<div class="widget">
<div class="widget-body innerAll inner-2x">

<div class="row innerLR"  >
                        
	<div class="form-group">

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:ltr; float:right;    font-family: 'Droid Arabic Kufi', sans-serif;">اسم المستخدم</label> 
<input class="form-control" id="username" name="username" type="text" style="width:100%;direction:rtl" required  value="<?php echo "BS".$final_rand;?>"/>
<div style="width:100%; clear:both"></div>
<span style="display:none; color:#F00;" class="n_error0">اسم المستخدم غير متاح حاليا</span>
<span style="display:none; color:#090;" class="n_seccs">اسم المستخدم  متاح حاليا</span>

</div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:ltr; float:right;    font-family: 'Droid Arabic Kufi', sans-serif;">كلمة المرور</label> <input class="form-control" id="password" name="password" type="password" style="width:100%;direction:rtl" required /></div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:ltr; float:right;    font-family: 'Droid Arabic Kufi', sans-serif;">كلمة المرور الداخلية </label> <input class="form-control" id="password" name="pincode" type="password" style="width:100%;direction:rtl" required /></div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:ltr; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">البريد الالكترونى</label> <input class="form-control"  id="mail" name="mail" type="text" style="direction:rtl;width:100%" required />
<div style="width:100%; clear:both"></div>
<span style="display:none; color:#F00;" class="n_error1">البريد الالكترونى غير متاح حاليا</span>
<span style="display:none; color:#090;" class="n_seccs1">البريد الالكترونى متاح</span>

</div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">الصلاحيات</label> 
<select  name="type" style="height:40px;width:100%;font-size:16px; text-align:right" class="sel">
<option  value="1">الادمن</option>
<option  value="2">المدير</option>
<option  value="3">المحاسب</option>
<option  value="4">خدمة العملاء</option
</select>
</div>

<div class="form-actions" align="center" style="padding-bottom:20px;">
             <input type="submit" value="اضافة"  class="Go"  id="Send"  style="font-family: 'Droid Arabic Kufi', sans-serif;">
			</div>
			<!-- // Form actions END -->
			
		</div>
	</div>
	<!-- // Widget END -->
	
</form>
</div>
</div>
</div>
</div>
<div style=" clear:both; height:20px;"></div>
<div class="clearfix"> 
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
    <script>
    $("#Send").hover(function(e) {
		var username=$("#username").val();
		var mail=$("#mail").val();
		var item = $(this);
		var data={username:username,mail:mail}
		//alert(mail);
		$.ajax({
        url: 'check_mail',
        type: 'POST',
        dataType: 'json',
        data:data,
        success: function( data ) {
		//alert(data);
            if(data==1){
				$(".n_error0").show();
				$(".n_error1").hide();
				$(".n_seccs").hide();
				$(".n_seccs1").hide();
				item.attr("type","button");
			}
		if(data==2){
				$(".n_error1").show();
				$(".n_error0").hide();
				$(".n_seccs").hide();
				$(".n_seccs1").hide();
				item.attr("type","button");
			}
		  if(data==3){
				$(".n_error1").show();
				$(".n_error0").show();
				$(".n_seccs").hide();
				$(".n_seccs1").hide();
				item.attr("type","button");
			}
			 if(data==4){
				$(".n_error1").hide();
				$(".n_error0").show();
				$(".n_seccs").hide();
				$(".n_seccs1").show();
				item.attr("type","button");
			}
						
			 if(data==5){
				$(".n_error1").show();
				$(".n_error0").hide();
				$(".n_seccs").show();
				$(".n_seccs1").hide();
				item.attr("type","button");
			}
			
			
			if(data==6){
				$(".n_error1").hide();
				$(".n_error0").hide();
				$(".n_seccs").show();
				$(".n_seccs1").show();
				item.attr("type","submit");
			}
        }
    });
    });
	</script>

</body>
</html>
