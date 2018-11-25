<?php

ob_start();
 $dd=base_url();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){
header("Location:$dd"."home/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
//$last_login=$_SESSION['last_login'];	
}

$no_activite="غير مقرؤة";
$activite="أرشيف";
include("opendb.inc");

if(isset($_GET['r'])){
$r=$_GET['r'];
}
else{$r="";}
if(isset($_GET['page'])){
$page=$_GET['page'];
}
else{
$page=1;
}

?>
<!DOCTYPE html>
<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>
<title>الرسائل الخاصة <?php //echo $id_admin;?></title>
<meta charset="utf-8">
<?php include("home/inc/head1.inc");?>
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
		if(content.parents().eq(1).find("td:nth-child(10) span").html()=="<?php echo $no_activite?>"){
			view="1";
		}else{
		    view="0";
		}
		//var data={id:id, view:view};
		//alert (view);
		//alert(id);
		var data={id:id, view:view,table:table};
		$.ajax({
				url: 'messages_view',
                type: 'POST',
                dataType: 'json',
                data: data,				
                success: function( data ) {
		//	alert (data)
				if(content.parents().eq(1).find("td:nth-child(10) span").html()=="<?php echo $no_activite?>"){
					content.parents().eq(1).find("td:nth-child(10) span").html("<?php echo $activite?>");
					content.parents().eq(1).find("td:nth-child(10) span").css("color","green");
				}else{
					content.parents().eq(1).find("td:nth-child(10) span").html("<?php echo $no_activite?>");
					content.parents().eq(1).find("td:nth-child(10) span").css("color","red");
				}
				}
         });
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
		if(content.parents().eq(1).find("td:nth-child(5) span").html()=="<?php echo $no_activite?>"){
			view="1";
		}else{
		    view="0";
		}
		var data={id:id, view:view};
		//alert (view);
			//alert(id);
		var data={id:id, view:view,table:table};
		$.ajax({
				url: 'messages_view',
                type: 'POST',
                dataType: 'json',
                data: data,				
                success: function( data ) {
			//alert (data)
				if(content.parents().eq(1).find("td:nth-child(5) span").html()=="<?php echo $no_activite?>"){
					content.parents().eq(1).find("td:nth-child(5) span").html("<?php echo $activite?>");
					content.parents().eq(1).find("td:nth-child(5) span").css("color","green");
				}else{
					content.parents().eq(1).find("td:nth-child(5) span").html("<?php echo $no_activite?>");
					content.parents().eq(1).find("td:nth-child(5) span").css("color","red");
				}
				}
         });
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
		<div class="widget-body" style="direction: rtl;">
            
            
<table class="dynamicTable scrollVertical table table-primary">
<!-- Table heading -->
<thead>
<tr>
<th scope="col"  class="center" ><input type="checkbox" id="checkAll"></th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الاسم</th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الايميل</th>
<th class="center" style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">عنوان الرسالة</th>
<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">الحالة</th>
<th  class="center"  style="font-family: 'Droid Arabic Kufi', sans-serif; font-weight:400;">مشاهدة</th>
</tr>
</thead>
<tbody>
 <form action="delete_category" method="POST" id="form">
<!-- Table row-->
<?php
$id="";
$name="";
$counter=0;
$start = ($page-1)*$per_page;
$sql = "SELECT SQL_CALC_FOUND_ROWS * from contact_messages where view='0' order by id desc limit $start,$per_page";
$rsd=mysql_query($sql) or die(mysql_error());

/*count all alarms*/
if($r=="")
{ 
$all_sql="SELECT FOUND_ROWS()";
$all = mysql_query($all_sql);
$row2 = mysql_fetch_array($all);
$count=$row2[0];	
}
else
{
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
else
{
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
$id_messages=$row['id'];
$name=$row['name'];
$email=$row['email'];
$subject=$row['subject'];
$counter++;
$view=$row['view'];
switch($view)
{
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
<td class="center"><input type="checkbox" name="check[]" value="<?php echo $id_messages;?>"></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $name;?></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $email;?></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $subject;?></td>
<td class="center" style="font-family: 'Droid Arabic Kufi', sans-serif;"><?php echo $view;?></td>
<td class="center">
<a href="read_messages?id_messages=<?php echo $id_messages?>" class="btn btn-sm btn-success">
<i class="fa fa-eye"></i>
</a>
<a href="replay_messages?id_messages=<?php echo $id_messages?>" class="btn btn-sm btn-success">
<i class="fa fa-reply"></i>
</a>
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
}
else if($pages>1)
{
echo '<div class="pagination">';
if($page!=1)
{
$pr_page=$page-1;
echo '<a href="store_messages?r='.$count.'&page='.$pr_page.'&shop_id='.$id_admin.'">«'.$prev.'</a>';							  
}
else
{
echo '<span>«'.$prev.'</span>';
}
					
for($i=$start_page;$i<=$end_page;$i++)
{
if($i==$page)
{
echo '<span class="active">'.$i.'</span>';
}
else
{
echo '<a href="store_messages?r='.$count.'&page='.$i.'&shop_id='.$id_admin.'">'.$i.'</a>';
}
}

if($page!=$pages)
{
$nx_page=$page+1;
echo '<a href="category?r='.$count.'&page='.$nx_page.'&shop_id='.$id_admin.'">'.$next.'»</a>';	
}else{
echo '<span>'.$next.'»</span>';
}
echo '</div>';
}
?>
<div class="sep"></div>
</div>
</form>
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