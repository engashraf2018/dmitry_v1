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

$r=$_GET['r'];
$page=$_GET['page'];
$per_page =15; 
if($page==""){
	$page=1;
}
if(isset($_GET['success'])){
?>
<script>
$(document).ready(function(e) {
 msg_success("تم تنفيذ المطلوب بنجاح");
});
</script>
<?php }?>

<!DOCTYPE html>

<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>

	<title>الاقسام الرئيسية</title>
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
		var data={id:id, view:view};
			$.ajax({
				url: '<?php echo $dd?>home/maincategory_view',
                type: 'POST',
                dataType: 'json',
                data: data,				
                success: function( data ) {
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
        window.location.assign("<?php echo $dd?>home/add_maincategory");
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
<div class="alert-msgs"></div>
<div class="innerLR">
	<!-- Widget -->
	<div class="widget widget-body-white widget-heading-simple">
	<!-- Widget -->
	<div class="widget">
		<div class="widget-body">
			
<div style="text-align:right; width:550px; float:right; margin-bottom:30px;">
            </div>
            
            
<table class="dynamicTable scrollVertical table table-primary">
	<!-- Table heading -->
	<thead>
		<tr>
<th scope="col"  class="center" ><input type="checkbox" id="checkAll"></th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الاسم</th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">القسم الرئيسى</th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الحالة</th>
<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">تغير</th>
		</tr>
	</thead>
<tbody>
 <form action="<?php echo $dd?>home/delete_subcategory" method="POST" id="form">
		<!-- Table row -->
        <?php
						  $id="";
						  $name="";
						  $counter=0;
						  
						  /*first user in page*/
                          $start = ($page-1)*$per_page;
						  $sql = "SELECT SQL_CALC_FOUND_ROWS * from sub_category order by id desc limit $start,$per_page";
						  $rsd=mysql_query($sql) or die(mysql_error());
						  
						  /*count all alarms*/
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
        
		                  /*all pages*/
                          $pages = ceil($count/$per_page);
						  /*pages in pagination*/
						  $pages_in =10;
						  /*start_pagination and end_pagination*/
                          $start_page = ((ceil($page/$pages_in)-1)*$pages_in)+1;
                          if(($start_page+$pages_in-1)>$pages){
							 $end_page=$pages;
                          }
                          else{
                             $end_page=$start_page+9;
                          }
						  if(mysql_num_rows($rsd)==0){
						?>
                         <tr style="height:100px">
                          <td colspan="10" class="center" style="color:#E63998; font-size:18px">
                     <?php echo $exite?>
                          </td>
                        </tr>
                        <?php
						  }
						  while($row=mysql_fetch_assoc($rsd)){
							  $id_categ=$row['id'];
							  $name_eng=$row['name'];
							   $arrange=$row['arrange'];
						 		$counter++;
						      $view=$row['view'];
							  $main_cat_id=$row['id_cat'];
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
			  $ddd="select * from category where id='$main_cat_id'"; 
  $res=mysql_query($ddd) or die("".mysql_error());
   $rowws=mysql_fetch_array($res);
    $name_cat=$rowws['name'];					
	?>

                        <tr>
<td class="center"><input type="checkbox" name="check[]" value="<?php echo $id_categ;?>"></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $name_eng;?></td>
 <td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $name_cat?></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $view;?></td>
<td class="center">
<a href="<?php echo $dd?>home/update_maincategory?id_categ=<?php echo $id_categ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
<a href="<?php echo $dd?>home/delete_subcategory?id=<?php echo $id_categ;?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
<a href="#" class="table-icon change" title="تغيير الحالة"></a>

							</td>
						</tr>
                        <?php
						  }
						?>
					</tbody>                     </form>	
				</table>
             
                <div align="center">
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
					  echo '<a href="maincategory?r='.$count.'&page='.$pr_page.'">«'.$prev.'</a>';							  
					}else{
						echo '<span>«'.$prev.'</span>';
					}
					
					for($i=$start_page;$i<=$end_page;$i++){
						if($i==$page){
							echo '<span class="active">'.$i.'</span>';
						}
						else{
							echo '<a href="maincategory?r='.$count.'&page='.$i.'">'.$i.'</a>';
						}
					}
					
					if($page!=$pages){
						$nx_page=$page+1;
						echo '<a href="maincategory?r='.$count.'&page='.$nx_page.'">'.$next.'»</a>';	
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