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
<title>السياسة التحريرية</title>
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
         
		var id = $(this).parents().eq(1).find("td:nth-child(1) input").val();
		var view = "";
		var table="news";
		//alert (table);
		var content=$(this);
		if(content.parents().eq(1).find("td:nth-child(4) span").html()=="<?php echo $no_activite?>"){
			view="1";
		}else{
		    view="0";
		}
		var data={id:id,view:view};
		 //alert(data);
		$.ajax({
				url: '<?php echo $base_url?>home/policy_view',
                dataType:'json',
                data: data,	
				type:'POST',
                success: function( data ) {
			//alert (data)
				if(content.parents().eq(1).find("td:nth-child(4) span").html()=="<?php echo $no_activite?>"){
					content.parents().eq(1).find("td:nth-child(4) span").html("<?php echo $activite?>");
					content.parents().eq(1).find("td:nth-child(4) span").css("color","green");
				}else{
					content.parents().eq(1).find("td:nth-child(4) span").html("<?php echo $no_activite?>");
					content.parents().eq(1).find("td:nth-child(4) span").css("color","red");
				}
				}
         });
	});
});
</script>

<script>
$(document).ready(function(e) {
      $(".add").click(function(e) {
        window.location.assign("add_policy");
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
            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">العنوان الرئيسى</th>
             <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الصورة</th>
            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الحالة</th>
			<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">تغير</th>
		</tr>
	</thead>
<tbody>
<form action="delete_policy" method="POST" id="form">
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
								  $image=$jobs->img; 
								 $img=$main_baseurl."site/ar/images/about_rose/".$image;    
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
						?>

                        <tr>
<td class="center"><input type="checkbox" name="check[]" value="<?php echo $id_categ;?>"></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $jobs->name;?></td>
 <td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;">
 <a class="example-image-link" href="<?php echo $img;?>" data-lightbox="example-1">مشاهدة</a></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $view;?></td>
<td class="center">
<a href="delete_policy?id=<?php echo $id_categ;?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
<a href="update_policy?id=<?php echo $id_categ;?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
<a href="#" class="table-icon change" title="تغيير الحالة"></a>
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