<?php
ob_start();
session_start();
include('db/opendb.inc');
$id_admin=$_SESSION['id_admin'];
	$last_login=$_SESSION['last_login'];
	if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){
	//header("Location: http://".$_SERVER['SERVER_username']."/Work/nada_host/ar/index.php");
	header("Location: http://".$_SERVER['HTTP_HOST'].$page_name."login.php"); 
}
$sql="select type,username,password  from admin where id='$id_admin'";
	$res=mysql_query($sql);
	if(!$res){die ("".mysql_error());}
	while($row=mysql_fetch_array($res)){
		$type=$row['type'];
		$name_admin=$row['username'];
        $pass_admin=$row['password'];
        if($type=="0"){$type_admin="المدير";}
else {$type_admin="مشرف";}
	}
?>

<!DOCTYPE html>
<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>
	<title>Admin Setting</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<?php include("inc/head.inc");?>
		<script>
function changeusername(){
$("#mydiv").slideToggle("slow");
$("#mydiv1").slideUp("slow");
$("#mydiv2").slideUp("slow");
}
function changepassword(){
$("#mydiv1").slideToggle("slow");
$("#mydiv").slideUp("slow");
$("#mydiv2").slideUp("slow");
}
function login(){
$("#mydiv2").slideToggle("slow")
$("#mydiv1").slideUp("slow");
$("#mydiv").slideUp("slow");
}
function username(){
	var x=document.getElementById("name").value;
	//var z=document.getElementById("passdword").value;
	var y=document.getElementById("id").value;
	alert(y);
	if(x==""){
	alert ("يجب ادخل الاسم ");
	return false;	
	}
		else {
	// alert(x);
if (window.XMLHttpRequest)
  {
	  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
	 // alert(xmlhttp.responseText);
 $("#mydiv").hide();  
 window.location.reload();
  }
  }
xmlhttp.open("GET","db/changename.php?name="+x+"&id="+y,true);
xmlhttp.send();
}
}
function password(){
	//var x=document.getElementById("name").value;
	var z=document.getElementById("passdword").value;
	var y=document.getElementById("id").value;
	
	if(z==""){
	alert ("يجب ادخل الباسورد ");
	return false;	
	}
	else {
	//alert(y);
if (window.XMLHttpRequest)
  {
	  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
	//  alert(xmlhttp.responseText);
$("#mydiv1").hide();  
 window.location.reload();
  }
  }
xmlhttp.open("GET","db/changepass.php?id="+y+"&password="+z,true);
xmlhttp.send();
	}}
	
function login_change(){
	var x=document.getElementById("nameg").value;
	var z=document.getElementById("pass").value;
	var y=document.getElementById("id").value;
	//alert(x);
	if(x==""){
	alert ("يجب ادخل الاسم ");
	return false;	
	}
	if(z==""){
	alert ("يجب ادخل الباسورد ");
	return false;	
	}
		else {
	// alert(x);
if (window.XMLHttpRequest)
  {
	  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
	// alert(xmlhttp.responseText);
 $("#mydiv2").hide();  
 window.location.reload();
  }
  }
xmlhttp.open("GET","db/change_info.php?name="+x+"&id="+y+"&pass="+z,true);
xmlhttp.send();
}
}

</script>
</head>
<body class="scripts-async">
	
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden">
		
				<!-- Sidebar Menu -->
<?php 
include ("inc/sidebar.inc");
?>
		<!-- // Sidebar Menu END -->
				
		<!-- Content -->
		<div id="content">

			<div class="navbar hidden-print main" role="navigation">
	<div class="user-action user-action-btn-navbar pull-left border-right">
		<button class="btn btn-sm btn-navbar btn-inverse btn-stroke"><i class="fa fa-bars fa-2x"></i></button>
	</div>
	<?php 
	include ("inc/header.inc");
	?>
	
	
</div>
<!-- // END navbar -->



<div class="innerLR">

	<h2 class="margin-none" style="position:relative">Admin Setting &nbsp;<div class="admin_info" style="position:absolute; top:0px; left:175px"></div></h2>

	<div class="separator-h"></div>
				
	<div class="row">	</div>
<div class="widget widget-body-white overflow-hidden">
				<div class="widget-head innerAll half">
					<h4 class="margin-none"><i class="fa fa-fw icon-wallet"></i>Admin Setting</h4>
				</div>
				<div class="widget-body innerAll">
                  
        </div>
		<div id="main">
			<div style="text-align:center; margin-right:15px; margin-bottom:15px; color:#666; font-size:18px">
			<div>welcome:<?php echo $name_admin;?></div>
            
            <div style="text-align:center; margin-right:15px; margin-bottom:15px; color:#666; font-size:18px;" align="center">
           <div  style="width:300px; margin-left:20px"><span style="float:left">username</span>
           <span  style=" clear:both; "  dir="ltr">
           <input type="text"  value="<?php echo $name_admin?>" readonly style="border:1px solid #f5f5f5;font-weight:bold; font-family:Arial, Helvetica, sans-serif; color:#000;"  disabled align="middle"  readonly></span>
             <span style="float:right; cursor:pointer;" class="b3" onClick="changeusername()">edit</span>
              <div style="border:1px solid  #f5f5f5;   border-radius:.4em; margin-top:20px; display:none"  id="mydiv">
             
              <label for="username" style="float:left">username</label>
              <input type="text" value="<?php echo $name_admin?>" name="username" id="name">
              <input type="hidden" name="id" id="id" value="<?php echo $id_admin?>">
              <button class="add"  onClick="return username()"  style="margin-left:20px; margin-top:20px;">Saved Data</button>
             
              </div>
              </div>
             <div  style="clear:both;width:327px; margin-top:30px">
            <span   style="float:left;margin-left:20px">password</span>
           <span dir="ltr" style="margin-left:0px"><input type="password"  value="<?php echo $pass;?>" 
           style="border:1px solid #f5f5f5;font-weight:bold; font-family:Arial, Helvetica, sans-serif; color:#000;"  readonly  border="none"  disabled>
           </span>
             <span style="float:right; cursor:pointer; margin-left:8px " class="b3" onClick="changepassword()">edit</span>
          <div style="border:1px solid  #f5f5f5;   border-radius:.4em; margin-top:20px; display:none"  id="mydiv1">
             
              <label for="username" style="float:left">password</label>
              <input type="password" value="<?php echo $pass_admin?>" name="passdword" id="passdword">
              <input type="hidden" name="id" id="id" value="<?php echo $id_admin?>">
              <button class="add"  onClick="return password()"  style="margin-left:20px; margin-top:20px;">Saved Data</button>
             
              </div>
           </div>
           <div  style="width:600px; height:50px; margin-top:80px;"  class="b3">
           <!--
            <?php echo $type_admin;?> يمكنك الان تعديل بيانات دخولك  بالضغط <span  style="cursor:pointer; color:#00F;" onClick="login()">هنا</span>
           ------------>
           <div style="border:1px solid  #f5f5f5;   border-radius:.4em; margin-top:20px; display:none"  id="mydiv2">
             <div style="width:400px" dir="ltr">
              <label for="username" style="float:left">username</label>
              <input type="text" value="<?php echo $name_admin?>" name="username" id="nameg">
              </div>
              <div style="width:400px" dir="ltr">
              <input type="hidden" name="id" id="id" value="<?php echo $id?>">
              <label for="username" style="float:left">password</label>
              <input type="password" value="<?php echo $pass_admin?>" name="password" id="pass">
              </div>
              <div>
              <button class="add"  onClick="return login_change()"  style="margin-left:20px; margin-top:20px;">Saved Data</button>
</div>
              </div>

           </div>
			</div>
			</div>
		</div>
       <div class="clear"></div>
</div>
                   
<div id="chart_horizontal_bars" class="flotchart-holder" style="height:120px; margin-top:0px;"></div>
</div>
</div>
</div>
		<!-- // Content END -->
		
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->
		
		<div id="footer" class="hidden-print">
			
			<!--  Copyright Line -->
			<?php include ("inc/footer.inc");?>
			<!--  End Copyright Line -->
	
		</div>
		
		<!-- // Footer END -->
		
	</div>
	<!-- // Main Container Fluid END -->
	

	<!-- Global -->
	<script data-id="App.Config">
		var basePath = '',
		commonPath = 'assets/',
		rootPath = '../',
		DEV = false,
		componentsPath = 'assets/components/';
	
	var primaryColor = '#3695d5',
		dangerColor = '#b55151',
		successColor = '#609450',
		infoColor = '#4a8bc2',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	
	var themerPrimaryColor = primaryColor;

		App.Config = {
		ajaxify_menu_selectors: ['#menu'],
		ajaxify_layout_app: false	};
		</script>
	
		
</body>
</html>