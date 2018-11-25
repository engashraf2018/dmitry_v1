<?php

include("config/opendb.inc");

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

?>



<!DOCTYPE html>







<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->



<head>



	<title>اضافة مجلة رئيسى</title>







	<meta charset="utf-8">

<?php 

	include ("home/inc/head1.inc");

	?>

<script src="assets/js/jquery-1.9.1.min.js"></script>

<script src="text_js/ckeditor.js"></script>

<link href="text_css/sample.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="text_css/jquery.datetimepicker.css"/>



<script type="text/javascript">

function msg_error(text){







  var msgs = $(".msg-alert").size();







  if(msgs== 0){







  $(".alert-msgs").append($('<div>').addClass("msg-alert msg-error").attr("id","msg_error").append($('<h2>').text(text)).append($('<a>').addClass("close").attr("onclick","close_alert(this);").append('<i class="fa fa-times" aria-hidden="true"></i>')).fadeIn(function(){







    setTimeout(function(){







      $(".msg-alert#msg_error").fadeOut(function(){







        $(".msg-alert#msg_error").remove();







      });







    },2000);







  }));



  }







}







function msg_success(text){







  var msgs = $(".msg-alert").size();







  msgs+=1;







  $(".alert-msgs").append($('<div>').addClass("msg-alert msg-success").attr("id","msg_"+msgs).append($('<h2>').text(text)).append($('<a>').addClass("close").attr("onclick","close_alert(this);").append('<i class="fa fa-times" aria-hidden="true"></i>')).fadeIn(function(){







    setTimeout(function(){







      $(".msg-alert#msg_"+msgs).fadeOut(function(){







        $(".msg-alert#msg_"+msgs).remove();







      });







    },2000);







  }));







}



</script>

<script>			

CKEDITOR.replace('descriptdion');		

</script>

<style type="text/css">



.alert-msgs{position: fixed;width: auto;height: auto;right: 0;z-index:10000; margin-right: 35%}



.msg-alert{width: 300px;height: auto;padding: 10px;opacity: 0.7;text-align: center;margin: 20px 10px;position: relative;}



.msg-alert h2{color: #fff;font-size: 20px;margin: 0;}



.msg-alert .close{position: absolute;width: 20px;height: 20px;top: 0px;right: 0px;z-index: 10;opacity: 1;}



.msg-alert .close i{color: rgba(0, 0, 0, 0.29);font-size: 14px;display: block;height: 100%;width: 100%;padding: 3px;text-shadow: none;transition: ease-in-out 0.3s;}



.msg-alert .close:hover i{color: rgba(0, 0, 0, 0.9);}



.msg-success{background-color: #1bde07;}



.msg-error{background-color: #f00;}



</style>

</head>

     <?= $this->session->flashdata('title_msg'); ?>

 <div class="alert-msgs"></div>  

<body class="">



	



	<!-- Main Container Fluid -->



	<div class="container-fluid menu-hidden">



	



<?php 



include ("home/inc/sidebar.inc");

if(isset($_GET['error'])){

?>

<script>

$(document).ready(function(e) {

 msg_error("نأسف لوجود قسم بهذا الترتيب");

});

</script>

<?php }?>

</div>

<div id="content">

<?php 



include("home/inc/header.inc");



?>		

<div class="innerLR">



	<!-- Widget -->

	<div class="widget-body innerAll">

<div class="n_ok" style="display:<?php echo $df;?>; direction:rtl;     font-family: 'Droid Arabic Kufi', sans-serif;"><p>لقد تم فتح الحساب بنجاح</p></div>

                <div class="n_error" style="display:none"><p><?php echo $error?></p></div>

				<div class="innerLR">

	<!-- Form -->

<form  method="post" action="user_action" id="myform"  enctype="multipart/form-data">

<div class="widget">

<div class="widget-body innerAll inner-2x">
	


<div class="row innerLR">

                        



<div class="form-group">

<label class="control-label" for="firstname" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">اسم العضو</label> <input class="form-control" id="password" name="name" type="text" style="width:100%; text-align:right; direction:rtl" required/></div>
<input type="hidden" name="id" value="<?php echo $this->input->get("id") ?>">




<div style="width:100%; margin-bottom:30px;" align="center">
<div >
<label for="logo" style="direction:rtl">الوصف</label>
<textarea name="description" maxlength="500" style="width:100%; direction:rtl;height:80px;">
</textarea>
</div>
</div>




<!--  <center>

<div class="form-group slider" style="display: none;text-align:center;">

<label for="logo"  style="direction:rtl">image(width:550px,height:450px)</label>

<span class="input-group-btn">

<span class="btn btn-default btn-file hh"><span class="fileupload-new">معرض الصور</span>

<input type="file" class="margin-none imageUpload"  name="img1[]"/></span>

</span>

</div>

</center> -->





<!-- <div class="form-group" style="text-align:right; direction:rtl">



  <input type="radio" name="type" style="text-align:right; direction:rtl" value="1">اضافة فى القائمة الرئيسية<br>

  <input type="radio" name="type" style="text-align:right; direction:rtl" value="0">اضافة فى القائمة الفرعية (المزيد)



</div>



<div class="form-group" style="text-align:right; direction:rtl">

<label class="control-label" for="firstname" style=" direction:rtl; float:right;font-family: 'Droid Arabic Kufi', sans-serif;">الترتيب</label><input type="number" class="num" value="<?php echo set_value('arrange'); ?>" required name="arrange" min="1" max="200">

</div>

 -->





<div class="form-actions" align="center" style="padding-bottom:20px;">

<input type="submit" value="اضافة عضو جديد" class="btn btn-primary fa fa-check-circle" id="Send"  style="font-family: 'Droid Arabic Kufi', sans-serif;">

			</div>

			<!-- // Form actions END -->

			

		</div>

	</div>

	<!-- // Widget END -->

	
<?php 

$row1 = $this->db->get_where("committees_users",array("id_committees"=>$this->input->get("id")))->result();
foreach ($row1 as $row) {
	?>
الاسم : <?php echo $row->name ?>
الوصف : <?php echo $row->description ?>
<a href="<?php echo base_url("home/delete_user/".$row->id); ?>" class="btn btn-danger"> حذف العضو</a>
<br>
<?php	
}
?>
		
</form>

</div>
	

			

		</div>

</div>



<div id="footer" class="hidden-print">



			<?php



            include ("home/inc/footer.inc");



			?>



<script>



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

$(document).ready(function(e) {

    $(".num").keyup(function(e) {

		var username=$("#username").val();

		$.ajax({

        url: 'check_username',

        type: 'POST',

        // dataType: 'json',

        data:data,

        success: function( data ) {

			//alert(data);

            if(data==1){

				$(".n_error2").show();

				$(".n_seccs").hide();

				$("#myform").submit(function(e) {

                    e.preventDefault();

                });

			}

			else {

				$(".n_error2").hide();

				$("#myform").unbind("submit").submit();

			}

			

        }

    });



    });

	});

 $('.sel').change(function(){		

	var kk = $(this).val();

	if (kk == "img") {

		$(".slider").hide();

		$(".img").show();



	}

	if (kk == "slider") {

		$(".img").hide();

		$(".slider").show();



	}

	

		});	

	</script>





		</div>



		



		<!-- // Footer END -->



		



	</div>





	<!-- // Main Container Fluid END -->



	<?php



    include ("home/inc/headf1.inc");



	?>

</body>

</html>