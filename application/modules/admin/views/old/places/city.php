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
if(isset($_GET['r'])){
	$r=$_GET['r'];
$page=$_GET['page'];
$per_page =20; 
if($page==""){
	$page=1;
}
}
else{
$per_page =20; 
$page=1;

}
include("config/opendb.inc");
$no_activite="غير مفعل";
$activite="مفعل";
?>

<!DOCTYPE html>

<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>

	<title>المدينة</title>
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
				url: '<?php echo $base_url?>home/city_view',
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
        window.location.assign("add_city");
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

	<!-- Widget -->
	<div class="widget">
		<div class="widget-body">
			<!-- Table -->
<table class="dynamicTable scrollVertical table table-primary">
	<!-- Table heading -->
	<thead>
		<tr>
        <th scope="col" class="center"><input type="checkbox" id="checkAll"></th>
        <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;; font-weight:400;">العنوان</th>
          <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;; font-weight:400;">Title</th>
        <th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;; font-weight:400;">الحالة</th>
		<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif;; font-weight:400;">تغير</th>
		</tr>
	</thead>
<tbody>
<form action="delete_city" method="POST" id="form">
<?php
$id="";
$name="";
$counter=0;
$start = ($page-1)*$per_page;
$sql = "SELECT SQL_CALC_FOUND_ROWS *  from city  order by id desc  limit $start,$per_page";
						  $rsd=mysql_query($sql) or die(mysql_error());
						  if($r=="")
						  { 
						    $all_sql="SELECT FOUND_ROWS()";
                            $all = mysql_query($all_sql);
		                    $row2 = mysql_fetch_array($all);
    	                    $count=$row2[0];	
                          }
                          else{
	                        $count=$r;
                          }
        
                          $pages = ceil($count/$per_page);
						  $pages_in =10;
                          $start_page = ((ceil($page/$pages_in)-1)*$pages_in)+1;
                          if(($start_page+$pages_in-1)>$pages){
							 $end_page=$pages;
                          }
                          else{
                             $end_page=$start_page+9;
                          }
						  if(mysql_num_rows($rsd)==0){
						?>
                         <tr style="height:70px">
                          <td colspan="8" class="center" style="color:#E63998; font-size:18px">
                     <?php echo $exite?>
                          </td>
                        </tr>
                        <?php
						  }
						  while($row=mysql_fetch_assoc($rsd)){
							  $id_categ=$row['id'];
							    $name_Cat=$row['name']; 
								   $name_eng=$row['name_eng'];        
						 		$counter++;
								 $view=$row['view'];
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
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;;"><?php echo $name_Cat;?></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;;"><?php echo $name_eng;?></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;;"><?php echo $view;?></td>
<td class="center">
<a href="delete_city?id=<?php echo $id_categ;?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
<a href="update_city?id=<?php echo $id_categ;?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
<a href="#" class="table-icon change" title="تغيير الحالة"></a>
							</td>
						</tr>
                        <?php
						  }
						?>
                         </form>	
					</tbody>       
				</table>
             
 			
	

  <div align="center">
               <?php
                if($pages==1)
				{
					echo '<div class="pagination">
	    		           <span class="active">[1]</span>
			              </div>';
				}else if($pages>1){
					echo '<div class="pagination">';
			        if($page!=1){
					  $pr_page=$page-1;
					  echo '<a href="city?r='.$count.'&page='.$pr_page.'">«'.$prev.'</a>';							  
					}else{
						echo '<span>«'.$prev.'</span>';
					}
					
					for($i=$start_page;$i<=$end_page;$i++){
						if($i==$page){
							echo '<span class="active">'.$i.'</span>';
						}
						else{
							echo '<a href="city?r='.$count.'&page='.$i.'">'.$i.'</a>';
						}
					}
					
					if($page!=$pages){
						$nx_page=$page+1;
						echo '<a href="city?r='.$count.'&page='.$nx_page.'">'.$next.'»</a>';	
					}else{
						echo '<span>'.$next.'»</span>';
					}
                           
	    		    echo '</div>';
				}
				?>
               <div class="sep"></div>
               <?php
			   if($counter!=0){
			   ?>
<button class="cancel Go">حذف</button>	
               <?php
			   }else{
			   echo '<script>$("#checkAll").attr("disabled","disabled");</script>';
			   }
			   ?>
<button class="add Go">اضافة</button>
       </div>
</div></div>
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