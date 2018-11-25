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



if(isset($_GET['r'])){
$r=$_GET['r'];
}
else{
	$r="";
	}

if(isset($_GET['page'])){
$page=$_GET['page'];

}
else{
$page=1;

}

$per_page =15; 

?>



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

         

		var id = $(this).data("id");



		var data={id:id};

			$.ajax({

				url: '<?php echo base_url("home/check_view_comments") ?>',

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

     window.location.assign("<?php echo $dd?>home/add_category");

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

			<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الاسم</th>

			<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الايميل</th>

			<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">رقم الموبيل</th>

			<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">التعليق</th>

			<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">عنوان المقال</th>

			<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">القسم التابع له المقال</th>

 			<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الحالة</th>

			<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">تغير</th>



		</tr>





	</thead>

<tbody>











 <form action="<?php echo $dd?>home/delete_comment" method="POST" id="form">

		<!-- Table row -->

        <?php

						  $id="";

						  $name="";

						  $counter=0;

						  

						  /*first user in page*/

                          $start = ($page-1)*$per_page;

						  $sql = "SELECT SQL_CALC_FOUND_ROWS * from comments  order by id desc limit $start,$per_page";

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

							  $name_sender=$row['name'];

							  $email=$row['email'];

							  $phone=$row['phone'];

							  $comment=$row['comment'];

							  $id_article=$row['id_article'];



							



							 	 $this->db->where('id', $id_article);

	               				$query_article = $this->db->get('articles')->result();

	               				foreach ($query_article as $query_article) {


	               				}

	               					$name_article = @$query_article->title;
				               	$id_cat = @$query_article->id_cat;






				               	$this->db->where('id', $id_categ);

	               				$query_cat =  $this->db->get('category')->result();

	               				foreach ($query_cat as $query_cat) {


	               				}



				               	$name_cat = @$query_cat->title;





				               	






						 		$counter++;

						      $view=$row['active'];





	?>



                        <tr>

<td class="center"><input type="checkbox" name="check[]" value="<?php echo $id_categ;?>"></td>

<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $name_sender;?></td>

<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $email;?></td>

<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $phone;?></td>

<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $comment;?></td>

<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo substr($name_article,0,50);?></td>

<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $name_cat;?></td>













<td class="center views-<?php echo $id_categ;?>" <?php if ($view == "1") {echo "style='color:green'";}else{echo "style='color:red'";	} ?> style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php if ($view == "1") {

	echo "مفعل";

}else{

	echo "غير مفعل";	

	} ?></td>

	<td class="center">

<!--<a href="<?php //echo $dd?>home/update_category?id_categ=<?php// echo $id_categ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>-->

<a href="<?php echo $dd?>home/views_comment?id=<?php echo $id_categ;?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>

<a href="<?php echo $dd?>home/delete_comment?id=<?php echo $id_categ;?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>



<a class="table-icon change" style="cursor: pointer;" data-id="<?php echo $id_categ;?>" title="تغيير الحالة"></a>



							</td>

						</tr>

                        <?php

						  }

						?>

					</tbody>                     

		</form>	





















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

					  echo '<a href="category?r='.$count.'&page='.$pr_page.'">«'.$prev.'</a>';							  

					}else{

						echo '<span>«'.$prev.'</span>';

					}

					

					for($i=$start_page;$i<=$end_page;$i++){

						if($i==$page){

							echo '<span class="active">'.$i.'</span>';

						}

						else{

							echo '<a href="category?r='.$count.'&page='.$i.'">'.$i.'</a>';

						}

					}

					

					if($page!=$pages){

						$nx_page=$page+1;

						echo '<a href="category?r='.$count.'&page='.$nx_page.'">'.$next.'»</a>';	

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

               <!--<button class="add Go" >اضافة</button>-->

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