<?php
include("opendb.inc");
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
foreach($contact_messages as $contact_messages){
$id=$contact_messages->id;
$subject=$contact_messages->subject;
$messages=$contact_messages->messages;
$to=$contact_messages->id_sender;
$id_reciver=$contact_messages->id_reciver;
}
$ids = substr($to, 1);
$too=$to[0];

switch($too)
{
case 'j':
$too="مقدم خدمة";
$sql = "SELECT * from jobseeker where id='$ids' order by id";
$query=mysql_query($sql) or die(mysql_error());
$name=mysql_fetch_assoc($query);
$user = $name['username'];

break;
case 'c':
$too="عميل";
$sql = "SELECT * from client where id='$ids' order by id";
$query=mysql_query($sql) or die(mysql_error());
$name=mysql_fetch_assoc($query);
$user = $name['username'];
break;
}
//$sql = "UPDATE contact_messages SET view='1' WHERE id = '$id'";
//$rsd = mysql_query($sql) or die(mysql_error());
?>

<!DOCTYPE html>



<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<style>
.map-wrap {
    width: 97%;
    padding: 1.5%;
    background: #fff;
    webkit-box-shadow: 0 0 2px rgba(0,0,0,0.1);
    -moz-box-shadow: 0 0 2px rgba(0,0,0,0.1);
    box-shadow: 0 0 2px rgba(0,0,0,0.1);
}
.gmap {
    border: 1px solid #ccc;
    display: block;
    width: 100%;
    height:400px;
}
</style>
<head>
<title>الاقسام الرئيسية</title>
<meta charset="utf-8">
<?php include ("home/inc/head1.inc");?>
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
<div class="widget-body innerAll">

<div class="innerLR">


<div class="widget">
<div class="widget-body innerAll inner-2x">

<div class="row innerLR"  >
<div class="form-group  col-md-12"></div>
<div class="form-group  col-md-2"></div>
<div class="form-group col-md-2"></div> 
<div class="form-group col-md-8">
<form  method="post" action="send_replay_m" id="myform">
<input type="hidden" value="<?php echo $id_reciver?>" name="from">
<input type="hidden" value="<?php echo $to?>" name="to">
<div class="form-group">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;">الي :</label>
<select name="id_reciver" disabled class="form-control" style="height: 40px;">
<option value=""><?php echo $too."( ".$user. ")";?></option>
</select>
</div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;">الموضوع :</label>
<input class="form-control" id="mail" name="subject" value="رد : <?php echo $subject;?>" type="text" style="width:100%; direction:rtl" required />
</div>

<div class="form-group">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;">نص الرسالة : </label>
<textarea class="form-control" id="mail" name="message" rows="10" style="width:100%; direction:rtl" required /></textarea>
</div>

<!-- Form actions -->
<div class="form-actions" align="center" style="padding-bottom:20px;">
<input type="submit" value="إرسال" class="btn btn-primary fa fa-check-circle" id="Send"  style="font-family: 'Droid Arabic Kufi', sans-serif;">
</div>
<!-- // Form actions END -->
</form>			
</div>		

</div>
</div>
</div>
</div>
</div>

</div>
<div id="footer" class="hidden-print">
<?php include ("home/inc/footer.inc");?>
</div>
</div>
<?php include ("home/inc/headf1.inc");?>
</body>
</html>