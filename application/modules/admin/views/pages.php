<?php

ob_start();
 $dd=base_url();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){
header("Location:$dd"."home/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];	
}

$no_activite="غير مفعل";
$activite="مفعل";
include("config/opendb.inc");


?>

<!DOCTYPE html>

<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>

	<title>الصفحات الرئيسية</title>
	<meta charset="utf-8">
	<?php 
	include ("home/inc/head1.inc");
	?>

<script src="assets/js/jquery-1.9.1.min.js"></script>
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
		//alert(id);

		var data={id:id};
			$.ajax({
				url: '<?php echo base_url("home/check_view_pages") ?>',
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
     window.location.assign("<?php echo $dd?>home/add_pages");
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
?>		
<div class="innerLR">
	<!-- Widget -->
	<div class="widget widget-body-white widget-heading-simple">
	<!-- Widget -->
	<div class="widget">
		<div class="widget-body">

            
<table class="dynamicTable scrollVertical table table-primary">
	<!-- Table heading -->
	<thead>
		<tr>
<th scope="col"  class="center" ><input type="checkbox" id="checkAll"></th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">اسم اللجنة</th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">عدد اعضاء اللجنة</th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الحالة</th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">اضافة عضو</th>
<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">تغير</th>
		</tr>
	</thead>
<tbody>
 <form action="<?php echo $dd?>home/delete_pages" method="POST" id="form">
		<!-- Table row -->
        <?php
		$counter=0;
						  $sql = "SELECT SQL_CALC_FOUND_ROWS * from committees order by id desc";
						  $rsd=mysql_query($sql) or die(mysql_error());
						
						  while($row=mysql_fetch_assoc($rsd)){
							  $id_categ=$row['id'];
							  $num1 = $this->db->get_where("committees_users",array("id_committees"=>$id_categ))->num_rows();
							  $name_eng=$row['name'];
						 		$counter++;
						      $view=$row['view'];

							  switch($view){
								  case 0:
								    $view="غير مفعل";
								    break;
								  case 1:
								    $view="مفعل";
								    break;
								  default:
								    break; 
							  }
	?>

                        <tr>
<td class="center"><input type="checkbox" name="check[]" value="<?php echo $id_categ;?>"></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $name_eng;?></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $num1;?></td>

<td class="center views-<?php echo $id_categ;?>" <?php if ($view == "مفعل") {echo "style='color:green'";}else{echo "style='color:red'";	} ?> style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php 

	echo $view;
 ?></td>
 <td class="center">
<a href="<?php echo $dd?>home/add_user?id=<?php echo $id_categ;?>" class="btn btn-sm btn-success"><i class="fa fa-pencil">اضافة عضو</i></a>

							</td> 
 <td class="center">
<a href="<?php echo $dd?>home/update_pages?id_categ=<?php echo $id_categ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
<a href="<?php echo $dd?>home/delete_pages?id=<?php echo $id_categ;?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
<a href="#" data-id="<?php echo $id_categ;?>" class="table-icon change" title="تغيير الحالة"></a>

							</td>
						</tr>
                        <?php
						  }
						?>
					</tbody>                     </form>	
				</table>
             
                <div align="center">
               <div align="center">

               <div class="sep"></div>
               <?php
			   if($counter!=0){
			   ?>
                <button class="cancel Go" >حذف</button>	
               <?php
			   }else{
			   echo '<script>$("#checkAll").attr("disabled","disabled");</script>';
			   }
			   ?>
               <button class="add Go" >اضافة</button>
       </div></form>
<!---------------Form END------------>
		</div>
	</div>
</div></div>
<div class="clearfix"></div>
<div id="footer" class="hidden-print">
<?php include ("home/inc/footer.inc");?>
</div></div><?php
    include ("home/inc/headf1.inc");
	?>
</body>
</html>