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
$title=$articles->title;
$titleeng=$articles->titleeng;
$idhelp=$articles->id;
$model=$articles->model;
$smalldescriptionar=$articles->smalldescriptionar;
$smalldescription=$articles->smalldescription;
$position=$articles->position;
	}
?>
<!DOCTYPE html>
<html class="sidebar sidebar-discover">
<head>
<title>تعديل</title>
<meta charset="utf-8">
<?php 
include ("home/inc/head1.inc");
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
<form  method="POST" action="<?php echo $dd?>home/update_categ" id="myform" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?php echo $idhelp?>">
<div class="widget">
<div class="widget-body innerAll inner-2x">
<div class="form-group"  style="width:100%">
<label class=""  style="direction:rtl;    font-family: 'Droid Arabic Kufi', sans-serif; float:right">العنوان</label>
<input   name="title" type="text" required value="<?php echo $title?>"   style="width:100%;    font-family: 'Droid Arabic Kufi', sans-serif;direction:rtl; height:40px;"/></div>


<div class="form-group"  style="width:100%">
<label class=""  style="direction:ltr;float:left">Title</label>
<input   name="titleeng" type="text" value="<?php echo $titleeng?>" required style="width:100%;direction:ltr; height:40px;"/>
</div>

<div class="form-group"  style="width:100%">
<label class=""  style="direction:ltr;    font-family: 'Droid Arabic Kufi', sans-serif; float:left">Start Model</label>
<input   name="model" type="text" value="<?php echo $model?>"  required style="width:100%;direction:ltr; height:40px;"/>
</div>


<div class="col-md-4" style="width:100%; direction:rtl" align="center" >
<div class="form-group"><label class="control-label" for="firstname" style=" direction:rtl; float:right;font-family:NeoSansArabic !important">وصف مختصر</label>
<textarea style="height:50px; width:100%;" name="smalldescriptionar"><?php echo $smalldescriptionar?></textarea></div></div>

<div class="col-md-4" style="width:100%; direction:ltr" align="center" >
<div class="form-group"><label class="control-label"  style=" direction:ltr; float:left;">Small Description</label>
<textarea style="height:50px; width:100%;" name="smalldescription"><?php echo $smalldescription?></textarea></div></div>


<div class="form-group" style="text-align:center">

<label class="control-label" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">نوع الخدمة</label> 
<select name="position" required class="sel">
<option>اختر نوع الخدمة</option>	
<option value="0" <?php if($position== "0")echo "selected"; ?>>نقل فردى</option>	
<option value="1" <?php if($position == "1")echo "selected"; ?>>نقل جماعى</option>	
<option value="2" <?php if($position == "2")echo "selected"; ?>>نقل فردى و جماعى</option>	
</select>
<br><br></div>

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

<script src="text_css/jquery.datetimepicker.full.js"></script>

<script>

$('.functional_date').datetimepicker();

$('.cancellation_date').datetimepicker();

$('.renewal_date').datetimepicker();

</script>

<script>			

CKEDITOR.replace('description');		
CKEDITOR.replace('descriptioneng');
</script>



<script>

function getState(val) {

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