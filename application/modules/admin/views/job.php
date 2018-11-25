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
?>



<!DOCTYPE html>

<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>
	<title><?php echo $job?></title>
	
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
		if(content.parents().eq(1).find("td:nth-child(6) span").html()=="<?php echo $no_activite?>"){
			view="1";
		}else{
		    view="0";
		}
		var data={id:id, view:view,table:table};
		$.ajax({
				url: 'db/job_view.php',
                type: 'POST',
                dataType: 'json',
                data: data,				
                success: function( data ) {
			//alert (data)
				if(content.parents().eq(1).find("td:nth-child(6) span").html()=="<?php echo $no_activite?>"){
					content.parents().eq(1).find("td:nth-child(6) span").html("<?php echo $activite?>");
					content.parents().eq(1).find("td:nth-child(6) span").css("color","green");
				}else{
					content.parents().eq(1).find("td:nth-child(6) span").html("<?php echo $no_activite?>");
					content.parents().eq(1).find("td:nth-child(6) span").css("color","red");
				}
				}
         });
	});

    
});
</script>
<script>
$(document).ready(function(e) {
    $(".add").click(function(e) {
        window.location.assign("add_product.php?id_lang=<?php echo $limit?>");
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



<h1 dir="<?php echo $dir?>"><?php echo $job?></h1>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-body-white widget-heading-simple">


	<h3 class="innerTB" dir="<?php echo $dir?>"><?php echo $job?><span>(<?php echo $num_job;?>)&nbsp;وظيفة</span></h3>

	<!-- Widget -->
	<div class="widget">
		<div class="widget-body">
			<!-- Table -->
<table class="dynamicTable scrollVertical table table-primary">

	<!-- Table heading -->
	<thead>
		<tr>
        <th class="center"><input type="checkbox" id="checkAll"></th>
        
			<th class="center"><?php echo $job_title?></th>
            <th class="center"><?php echo $owner_advert?></th>
            <th class="center"><?php echo $place_advert?></th>
            <th class="center"><?php echo $details?></th>
            <th class="center"><?php echo $status?></th>
			<th  class="center"  ><?php echo $change?></th>
		</tr>
	</thead>
	<tbody>
     <form action="db/delete_product.php" method="POST" id="form">
<input type="hidden" name="id_lang" value="<?php echo $limit?>">
		<!-- Table row -->
        <?php
						  $id="";
						  $name="";
						  $counter=0;
						  
						  /*first user in page*/
                          $start = ($page-1)*$per_page;
						  $sql = "SELECT SQL_CALC_FOUND_ROWS * from job order by id desc  limit $start,$per_page";
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
                         <tr style="height:200px">
                          <td colspan="8" class="center" style="color:#E63998; font-size:18px">
                     <?php echo $exite?>
                          </td>
                        </tr>
                        <?php
						  }
						  while($row=mysql_fetch_assoc($rsd)){
							  $id_categ=$row['id'];
							    $pname=$row['name'];
								$idclient=$row['client_id']; 
									$place=$row['place'];
									$city_id=$row['city_id'];        
								$counter++;
								$desc1=$row['details'];
						     $desc='<a href="#" class="popper" data-popbox="pop'.$counter.'" >'.substr($desc1,0,60).'...'.'</a>';
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
							  $sqlclient="select fname from client where id='$idclient'";
							  $rsdd=mysql_query($sqlclient)or die("".mysql_error());
							  $rowclient=mysql_fetch_array($rsdd);
                                  $name_client=$rowclient['fname'];
								  ///////////////////////////////
								   $sqlclient="select ar_name from city where id='$city_id'";
							  $rsdd=mysql_query($sqlclient)or die("".mysql_error());
							  $rowclient=mysql_fetch_array($rsdd);
                                  $ar_name=$rowclient['ar_name'];
						?>
		  <div id="pop<?php echo $counter;?>" class="popbox" style="word-wrap:break-word">
                           <p style="text-align:justify; word-wrap:break-word;"><?php echo $desc1;?></p>
                        </div>
                        <tr>
                            <td class="center"><input type="checkbox" name="check[]" value="<?php echo $id_categ;?>"></td>
							<td class="center"><a href=""><?php echo $pname;?></a></td>
                              <td class="center"><?php echo $name_client;?></td>
                            <td class="center"><?php echo $ar_name."-".$place;?></td>
                             <td class="center"><?php echo $desc;?></td>
                                 <td class="center"><?php echo $view;?></td>
                               
                           
							<td class="center">
                          
				<a href="db/delete_job.php?id=<?php echo $id_categ;?>&id_lang=<?php echo $limit?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>

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
					  echo '<a href="job.php?r='.$count.'&page='.$pr_page.'&id_lang='.$limit.'">«'.$prev.'</a>';							  
					}else{
						echo '<span>«'.$prev.'</span>';
					}
					
					for($i=$start_page;$i<=$end_page;$i++){
						if($i==$page){
							echo '<span class="active">'.$i.'</span>';
						}
						else{
							echo '<a href="job.php?r='.$count.'&page='.$i.'&id_lang='.$limit.'">'.$i.'</a>';
						}
					}
					
					if($page!=$pages){
						$nx_page=$page+1;
						echo '<a href="job.php?r='.$count.'&page='.$nx_page.'&id_lang='.$limit.'">'.$next.'»</a>';	
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
             
               <?php
			   }else{
			   echo '<script>$("#checkAll").attr("disabled","disabled");</script>';
			   }
			   ?>
           
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

<script>
  jQuery(document).ready(function($) {
      $('a').smoothScroll({
        speed: 1000,
        easing: 'easeInOutCubic'
      });

      $('.showOlderChanges').on('click', function(e){
        $('.changelog .old').slideDown('slow');
        $(this).fadeOut();
        e.preventDefault();
      })
  });

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2196019-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
		
	</div>
	<?php 
	include("inc/headf.inc");
	?>
    </body>
</html>