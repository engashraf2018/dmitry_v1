<?php

$base_url=base_url();

if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){

header("Location:".$dd."home/login");  

}

else{

$id_admin=$_SESSION['id_admin'];

$admin_name=$_SESSION['admin_name'];

$last_login=$_SESSION['last_login'];	

}

$no_activite="غير مفعل";

$activite="مفعل";

?>



<!DOCTYPE html>



<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->

<head>

<title>الكتاب</title>

	<meta charset="utf-8">

	<?php 

	include ("home/inc/head1.inc");

	?>

<script src="<?php echo $base_url?>home/js/jquery-1.7.2.min.js"></script>

<script>

$(document).ready(function(e) {

    $("#checkAll").change(function(){

		$("input[type=checkbox]").not("#checkAll").each(function() {

            this.checked=!this.checked;

        });

	});

	$(".cancel").click(function(){

		if($('input[type=checkbox]:not("#checkAll"):checked').length>0){

			$('#form').unbind('submit').submit();//renable submit

		}

	    else{

		    alert("اختر على الاقل رابط واحد للحذف");

	}

			

	});

	

});

</script>

<script>

$(document).ready(function(e) {

    $(".change").click(function(e) {

         

		var id = $(this).data("id");



		var data={id:id};

			$.ajax({

				url: '<?php echo base_url("home/check_view_videos") ?>',

                type: 'POST',

                // dataType: 'json',

                data: data,				

                success: function( data ) {

                	if (data == "1") {

                		$(".views-"+id).text("مفعل");

                		$(".views-"+id).css("color","green");



                	}

                	if (data == "0") {

                		$(".views-"+id).text("غير مفعل");

                		$(".views-"+id).css("color","red");



                	}

				}

         });

	});

});

</script>



<script>

$(document).ready(function(e) {

      $(".add").click(function(e) {

        window.location.assign("<?php echo $base_url?>home/add_videos");

    });



});

  

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

if(isset($_GET['success'])){

?>

<script>

$(document).ready(function(e) {

 msg_success("تم تنفيذ المطلوب بنجاح");

});

</script>

<?php }?>		

<div class="alert-msgs"></div>

<div class="innerLR">

	<div class="widget">

		<div class="widget-body">

<table class="dynamicTable scrollVertical table table-primary">

	<thead>

		<tr>

        <th scope="col" class="center"><input type="checkbox" id="checkAll"></th>

            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">العنوان</th>

            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">التاريخ</th>

            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">حالة الظهور</th>

            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الحالة</th>

			<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">تغير</th>

		</tr>

	</thead>

<tbody>

<form action="<?php echo $base_url?>home/delete_videos1" method="POST" id="form">

<?php

						?>

                         <?php if(count($results)==0){?>

                         <tr style="height:70px">

                          <td colspan="8" class="center" style="color:#E63998; font-size:18px">

                    

                     لا يوجد بيانات حاليا

                          </td>

                        </tr>

                          <?php }?>

                        <?php

						foreach($results as $jobs){

							  $id_categ=$jobs->id;

								 $view=$jobs->view;




						?>



                        <tr>

<td class="center"><input type="checkbox" name="check[]" value="<?php echo $id_categ;?>"></td>

<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $jobs->title;?></td>

<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $jobs->date;?></td>

 <td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;">
<?php
 if($jobs->view_news == 0){
 	echo "لا تظهر";
 }else{

 	echo "تظهر فى شريط الاخبار";
 }

 	?>
 </td>

<td class="center views-<?php echo $id_categ;?>" <?php if ($view == "1") {echo "style='color:green'";}else{echo "style='color:red'";	} ?> style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php if ($view == "1") {

	echo "مفعل";

}else{

	echo "غير مفعل";	

	} ?></td>

	<td class="center">

<a href="<?php echo $base_url?>home/delete_videos1?id=<?php echo $id_categ;?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>

<a href="<?php echo $base_url?>home/update_videos1?id=<?php echo $id_categ;?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>

<a href="#" class="table-icon change" data-id="<?php echo $id_categ;?>" title="تغيير الحالة"></a>

							</td>

						</tr>

                        <?php

						  }

						?>

                         </form>	

					</tbody>       

				</table>

                <?php foreach($links as $link){?><?php echo $link;?><?php } 

				?>



<div style="text-align:center">

               <?php

			   if(count($results)!=0){

			   ?>

<button class="cancel Go">حذف</button>	

               <?php

			   }else{

			   echo '<script>$("#checkAll").attr("disabled","disabled");</script>';

			   }

			   ?>

<button class="add Go">اضافة</button>

       </div>

</div>

	</div>

</div>

<div class="clearfix"></div>

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