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
<!--[if !IE]><!-->
<html class="sidebar sidebar-discover">
<!-- <![endif]-->
<head>
<title>أضافة</title>
<meta charset="utf-8">
<?php 
include ("home/inc/head1.inc");
//include ("opendb.inc");
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
<form  method="POST" action="<?php echo $dd?>home/cartype_action" id="myform" enctype="multipart/form-data">
<div class="widget">
<div class="widget-body innerAll inner-2x">
<div class="form-group"  style="width:100%">
<label class=""  style="direction:rtl;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">نوع الخدمة</label>
<select name="service_type" required class="sel">
<option>حدد نوع الخدمة</option>	

<?php
$result_service = $this->db->get_where("category",array('view'=>'1'))->result();
foreach($result_service as $result_service){
?>
<option value="<?php echo $result_service->id;?>"><?php echo $result_service->titleeng;?></option>	
<?php }?>
</select>
</div>



<div style="width:100%; margin-bottom:30px;" align="center">
<div >
<label for="logo" style="direction:rtl">تفاصيل</label>
<textarea name="description" rows="2" style="width:100%; direction:rtl;height:80px;"></textarea>
</div>
</div>


<div style="width:100%; margin-bottom:30px;" align="center">
<div >
<label for="logo" style="direction:rtl">Details</label>
<textarea name="descriptioneng" rows="2" style="width:100%; direction:rtl;height:80px;"></textarea>
</div>
</div>


															

<div class="form-group video1">
<label class="control-label" for="firstname" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">الفيديو</label> <input class="form-control videof" id="password" name="video" type="text" style="width:100%; text-align:right; direction:rtl" value=""></div>						

<div class="col-sm-6 slider1" >
<span class="input-group-btn">
<span class="hh">
<input type="file" class="margin-none imgf imageUpload" name="img1[]" size="20" multiple>
</div>







<div class="form-actions" align="center" style="padding-bottom:20px;">
<input type="submit" value="اضافة" class="Go" id="Send"  style="    font-family: 'Droid Arabic Kufi', sans-serif;">
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
<script src="text_css/jquery.datetimepicker.full.js"></script>
<script>
$('.functional_date').datetimepicker();
$('.cancellation_date').datetimepicker();
$('.renewal_date').datetimepicker();
</script>
<script>			
CKEDITOR.replace( 'description');
CKEDITOR.replace( 'descriptioneng');
		
</script>

<script>
function getState(val) 
{
$.ajax({
	type: "POST",
	url: "<?php echo $dd?>home/get_state",
	data:'country_id='+val,
	success: function(data){
		$("#state-list").html(data);
	}
	});


	if(val==29)
	{

		$('.show_slider').css("display","block");
		$('.show_index').css("display","none");
		
	}
	if(val!=29)
	{
		$('.show_slider').css("display","none");
		$('.show_index').css("display","block");
	}
	

}


</script>
<script type="text/javascript">

var count=1;
$('.imageUpload').change(function(){		
count++;

$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple ><a class='Upload'>حذف</a>");
 $('.Upload').click(function(){		
$('.imageUpload').remove();
$(this).remove();
});  
	
 $('.imageUpload2').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
$('.Upload'+count).click(function(){		
$('.imageUpload2').remove();
$(this).remove();
		});  

 $('.imageUpload3').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload3').remove();

$(this).remove();
		});  

 $('.imageUpload4').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload4').remove();
$(this).remove();
		});  

 $('.imageUpload5').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload5').remove();
$(this).remove();
		});  
  $('.imageUpload6').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload6').remove();
$(this).remove();
		});
  $('.imageUpload7').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload7').remove();
$(this).remove();
		});
  $('.imageUpload8').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload8').remove();
$(this).remove();
		});

  $('.imageUpload9').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload9').remove();
$(this).remove();
		});

  $('.imageUpload10').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload10').remove();
$(this).remove();
		});
   $('.imageUpload11').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload11').remove();
$(this).remove();
		});

  $('.imageUpload12').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload12').remove();
$(this).remove();
		});

  $('.imageUpload13').change(function(){		
count++;
$(".hh").append("<input type='file' class='margin-none imageUpload"+count+"' name='img"+count+"[]' size='20' multiple><a class='Upload"+count+"'>حذف</a>");
 $('.Upload'+count).click(function(){		
$('.imageUpload13').remove();
$(this).remove();
		});

		});  
		});  
		});  
		});  
		});  
		});  
		});  
		});  
		});  
		});  
		});  
		});  
		});  
 $('.sel').change(function(){		
	var kk = $(this).val();
	if (kk == "link") {
		$(".video1").hide();
		$(".imgf1").val("");
		$(".linkf").attr("required","");
		$(".videof").removeAttr("required");
		$(".imgf").removeAttr("required");


		$(".slider1").hide();
		$(".link1").show();
	}
	if (kk == "slider") {
		$(".video1").hide();
		$(".link1").hide();
		$(".videof").attr("value","");
		$(".slider1").show();
		$(".videof").removeAttr("required");
		$(".linkf").removeAttr("required");
		$(".imgf").attr("required","");

	}
	if (kk == "video") {
		$(".video1").show();
		// $(".videof").attr("value","");
		$(".videof").attr("required","");
		$(".linkf").removeAttr("required");
		$(".imgf").removeAttr("required");

		$(".slider1").hide();
		$(".link1").hide();
	}
	if (kk == "image") {
		$(".slider1").hide();
		$(".video1").hide();
		$(".link1").hide();
		$(".imgf").removeAttr("required");
		$(".linkf").removeAttr("required");
		$(".videof").removeAttr("required");

		$(".videof").attr("value","");
	}	
		}); 
 $('#sel').change(function(){		
	var kk = $(this).val();
	if (kk == "now") {
		$(".date_").hide();

	}
	if (kk == "later") {
		$(".date_").show();

	}
	
		});		 
</script>