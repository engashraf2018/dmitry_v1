dl<?php

$base_url=base_url();

if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){

header("Location:".$dd."admin/login");  

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

<title>فريق العمل</title>
<meta charset="utf-8">
<?php include ("design/inc/head1.inc");?>
<script src="<?php echo $base_url?>design/js/jquery-1.7.2.min.js"></script>
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
				url: '<?php echo base_url("admin/check_view_admin") ?>',
                type: 'POST',
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
        window.location.assign("<?php echo $base_url?>admin/add_admin");
    });

});

  

</script>

</head>

<body class="">

<div class="container-fluid menu-hidden">

<?php 
include ("design/inc/sidebar.inc");
?>
</div>
<div id="content">
<?php 
include("design/inc/header.inc");
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
        <th scope="col"  class="center" ><input type="checkbox" id="checkAll"></th>
			<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">اسم المستخدم</th>
            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الأيميل</th>
            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الصلاحية</th>
             <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">التاريخ</th>
             
            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">اخر دخول</th>
           <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الحالة</th>
			<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">تغير</th>
		</tr>
	</thead>
<tbody>
<form action="<?php echo $base_url?>admin/delete_admin" method="POST" id="form">
                         <?php if(count($results)==0){?>
<tr style="height:70px">
<td colspan="8" class="center" style="color:#E63998; font-size:18px">لا يوجد بيانات حاليا </td>
</tr>

                          <?php }?>

                        <?php

						foreach($results as $jobs){

							  $id_categ=$jobs->id;
 $view=$jobs->view;
 $type=$jobs->role;
  $last_login=$jobs->last_login;

							  switch($view){
								  case 0:
								    $view="<span class='view' style='color:red'>$no_activite</span>";
								    break;
								  case 1:
								    $view="<span class='view' style='color:green'>$activite</span>";
								    break;
								  default:
								    break; 

							  }
                                  switch($type){
								    case 1:
								    $type="<span class='view' style='color:blue'>الادمن</span>";
								    break;
								  case 2:
								    $type="<span class='view' style='color:red'>المدير</span>";
								    break;
								  case 3:
								    $type="<span class='view' style='color:green'>المحاسب</span>";
								    break;
								    case 4:
								    $type="<span class='view' style='color:green'>خدمة العملاء</span>";
								    break;
								  default:
								    break; 
							  }
						?>



                        <tr>
<td class="center"><input type="checkbox" name="check[]" value="<?php echo $id_categ;?>"></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php
echo character_limiter($jobs->username,50);
 ;?></td>
 <td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php
echo character_limiter($jobs->email,50);
 ;?></td>
 
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $type;?></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo date("Y-m-d",strtotime($jobs->creation_date))?></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $last_login;?></td>
<td class="center views-<?php echo $id_categ;?>" <?php if ($view == "مفعل") {echo "style='color:green'";}else{echo "style='color:red'";	} ?> style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php if ($view == "مفعل") {
	echo $view;
}else{
	echo $view;
	} ?></td>

<td class="center">
<a href="<?php echo $base_url?>admin/delete_admin?id=<?php echo $id_categ;?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
<a href="<?php echo $base_url?>admin/update_admin?id=<?php echo $id_categ;?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
<a href="#" data-id="<?php echo $id_categ;?>" class="table-icon change" title="تغيير الحالة"></a>
							</td>
						</tr>

                        <?php

						  }

						?>

                         </form>	

					</tbody>       

				</table>

                <?php foreach($links as $link){?><?php echo $link;?><?php } ?>



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

 include ("design/inc/footer.inc");

?>

</div>

</div>

	<?php



    include ("design/inc/headf1.inc");



	?>

</body>

</html>