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
$no_activite="غير مفعل";
$activite="مفعل";
?>
<!DOCTYPE html>
<html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>
<title>المساحة الأعلانية</title>
<meta charset="utf-8">
<?php include ("home/inc/head1.inc");?>
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
<div class="widget widget-body-white widget-heading-simple">
<div class="widget">
<div class="widget-body">
<table class="dynamicTable scrollVertical table table-primary">
	<thead>
		<tr>
			<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">Left Image</th>
            <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">Right Image</th>
			<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">تغير</th>
		</tr>
	</thead>
<tbody>
<form action="delete_slider" method="POST" id="form">
        <?php if(count($site_info)==0){?>
                         <tr style="height:100px">
                          <td colspan="10" class="center" style="color:#E63998; font-size:18px">
                    نأسف لعدم وجود بيانات حاليا
                          </td>
                        </tr>
<?php
}
foreach($site_info as $row){ 
$id_categ=$row->id;
$img_right=$row->footer_rightimg;
$img_left=$row->footer_leftimg; 
$img_right=$main_baseurl."site/ar/images/site_setting/".$img_right;
$img_left=$main_baseurl."site/ar/images/site_setting/".$img_left;        
?>

<tr>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;">
<a class="example-image-link" href="<?php echo $img_left;?>" data-lightbox="example-1">مشاهدة</a></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;">
<a class="example-image-link" href="<?php echo $img_right;?>" data-lightbox="example-1">مشاهدة</a></td>
<td class="center">
<a href="update_footeradvs?id=<?php echo $id_categ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
</td>
</tr>
<?php
}
?>
</tbody>                     </form>	
</table>
             
                <div align="center">
              
               <div class="sep"></div>
                     </div>
</form>
<!---------------Form END------------>



		</div>
	</div>
	<!-- // Widget END -->


</div>

	
	
		
		</div>





		<div class="clearfix"></div>
<div id="footer" class="hidden-print">

			<?php

            include ("home/inc/footer.inc");

			?>

		

		</div>

		

		<!-- // Footer END -->

		

	</div>

	<!-- // Main Container Fluid END -->

	<?php
    include ("home/inc/headf1.inc");
	?>
</body>
</html>