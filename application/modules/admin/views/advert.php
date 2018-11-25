<?php
ob_start();
session_start();
include('db/opendb.inc');
include("inc/lang.php");
$currentFile = $_SERVER["PHP_SELF"];
$parts = explode('/', $currentFile);
$length = count($parts);
$page_name="/";
for($i=0; $i<$length-1; $i++){
	if($parts[$i]!=""){
		$page_name .= $parts[$i]."/";
	}	
}
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){
	//header("Location: http://".$_SERVER['SERVER_username']."/Work/nada_host/ar/index.php");
	header("Location: http://".$_SERVER['HTTP_HOST'].$page_name."login.php"); 
}
$r=$_GET['r'];
$page=$_GET['page'];
$per_page =10; 
if($page==""){
	$page=1;
}
$sql="select * from pages where  page_name='offers.php' and id_lang='$limit'";
$rsd=mysql_query($sql);
$rows=mysql_fetch_array($rsd);
$img_page="../pages/".$rows['img'];
$id_pages=$rows['id'];

$r=$_GET['r'];
$page=$_GET['page'];
$per_page =10; 
if($page==""){
	$page=1;
}
?>



<!DOCTYPE html>

<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>
	<title><?php echo $advert?></title>
	
	<!-- Meta -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<?php
include ("inc/head.inc");
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
		//var data={id:id, view:view};
		//alert (view);
			//alert(id);
		var data={id:id, view:view,table:table};
		$.ajax({
				url: 'db/advert_view.php',
                type: 'POST',
                dataType: 'json',
                data: data,				
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
        window.location.assign("add_advert.php?id_lang=<?php echo $limit?>");
    });
});
</script>

</head>
<body class="scripts-async">
	
	<!-- Main Container Fluid -->
<div class="container-fluid menu-hidden">
		
<?php include("inc/sidebar.inc");?>		
		<!-- // Sidebar Menu END -->
				
		<!-- Content -->
		<div id="content">

<?php include("inc/header.inc");?>

<!-- // END navbar -->



<h1 dir="<?php echo $dir?>"><?php echo $advert?></h1>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-body-white widget-heading-simple">


	<h3 class="innerTB" dir="<?php echo $elamed?>"></h3>
	<div class="widget">
		<div class="widget-body">
			<!-- Table -->
<table class="dynamicTable scrollVertical table table-primary">
	<thead>
		<tr>
        <th scope="col" class="center"><input type="checkbox" id="checkAll"></th>
			<th class="center"><?php echo $image?></th>
            <th class="center"><?php echo $link?></th>
            <th class="center"><?php echo $status?></th>
			<th  class="center"  ><?php echo $change?></th>
		
		</tr>
	</thead>
	<!-- // Table heading END -->
	
	<!-- Table body -->
	<tbody>
	            <form action="db/delete_advert.php" method="POST" id="form">
<input type="hidden" name="id_lang" value="<?php echo $limit?>">
		<!-- Table row -->
        <?php
						  $id="";
						  $name="";
						  $counter=0;
						  
						  /*first user in page*/
                          $start = ($page-1)*$per_page;
						  $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM advert order by id desc  limit $start,$per_page";
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
                         <tr style="height:150px">
                          <td colspan="8" class="center" style="color:#E63998; font-size:18px">
                        <?php echo $exite?>
                          </td>
                        </tr>
                        <?php
						  }
						  while($row=mysql_fetch_assoc($rsd)){
							  $id_categ=$row['id'];
							    $offers_name=$row['name'];        
								$counter++;
								$desc1=$row['link'];
						     $desc='<a href="#" class="popper" data-popbox="pop'.$counter.'" >'.substr($desc1,0,60).'...'.'</a>';
						      $view=$row['view'];
							  $type=$row['img'];
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
			
							  //$date=date("Y-m-d",strtotime($row['start_date']));
						?>
		  <div id="pop<?php echo $counter;?>" class="popbox" style="word-wrap:break-word">
                           <p style="text-align:justify; word-wrap:break-word;"><?php echo $desc1;?></p>
                        </div>
                        <tr>
                            <td class="center"><input type="checkbox" name="check[]" value="<?php echo $id_categ;?>"></td>
							<td class="center"><a href="">مشاهدة</a></td>
                             <td class="center"><?php echo $desc;?></td>
                                 <td class="center"><?php echo $view;?></td>
          							<td class="center">
				<a href="db/delete_advert.php?id=<?php echo $id_categ;?>&type=<?php echo $type?>&id_lang=<?php echo $limit?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>

                                   <a href="#" class="table-icon change" title="تغيير الحالة"></a>
							</td>
						</tr>
                        <?php
						  }
						?>
					</tbody>
                     </form>	
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
					  echo '<a href="advert.php?r='.$count.'&page='.$pr_page.'&id_lang='.$limit.'">«'.$prev.'</a>';							  
					}else{
						echo '<span>«'.$prev.'</span>';
					}
					
					for($i=$start_page;$i<=$end_page;$i++){
						if($i==$page){
							echo '<span class="active">'.$i.'</span>';
						}
						else{
							echo '<a href="advert.php?r='.$count.'&page='.$i.'&id_lang='.$limit.'">'.$i.'</a>';
						}
					}
					
					if($page!=$pages){
						$nx_page=$page+1;
						echo '<a href="advert.php?r='.$count.'&page='.$nx_page.'&id_lang='.$limit.'">'.$next.'»</a>';	
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
               
               <button class="cancel"><?php echo $delete?></button>	
               <?php
			   }else{
			   echo '<script>$("#checkAll").attr("disabled","disabled");</script>';
			   }
			   ?>
               <button class="add">أضافة اعلان جديد</button>
       </div>
				
			
	

	


</form>
<!---------------Form END------------>



		</div>
	</div>
	<!-- // Widget END -->


</div>

	
	
		
		</div>
		<!-- // Content END -->
		
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->
		
		<div id="footer" class="hidden-print">
			
			<?php 
			include ("inc/footer.inc");
			?>
	
		</div>
		
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/jquery.smooth-scroll.min.js"></script>
<script src="js/lightbox.js"></script>

		
	</div>
	<?php 
	include("inc/headf.inc");
	?>
    </body>
</html>