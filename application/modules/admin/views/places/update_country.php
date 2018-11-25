<?php
//session_start();
ob_start();
$dd=base_url();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
//header("Location:$dd"."admin/login"); 
}

else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];	
}
foreach($data as $data){
    $title=$data->title;
    $flag=$data->flag;
    $id=$data->id_country;
}
?>
<!DOCTYPE html>
<!--[if !IE]><!--><html class="sidebar sidebar-discover"><!-- <![endif]-->
<head>
<meta charset="utf-8">
	<?php include ("design/inc/head1.inc");?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
<!-- Main Container Fluid -->


<div class="container-fluid menu-hidden">
</div><div id="content">
<?php  include("design/inc/header.inc");?>		
<!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <?php include ("design/inc/sidebar.inc");?>

            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
			<div class="page-content" style="min-height: 1261px;">
                    <!-- BEGIN PAGE HEAD-->
                    
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                    <li>
							<a href="<?=$dd.'admin';?>">Home</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span>Places</span>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<a href="<?=$dd.'admin/country';?>">Country List</a>
							<i class="fa fa-circle"></i>
						</li>
                        <li>
                            <span class="active">Edit</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->

                                <!-- END PORTLET MAIN -->
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                       <!--Start from-->	
			<div class="tab-content">					
<div class="tab-pane active" id="tab_5">
<div class="portlet box blue ">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-gift"></i>update Country</div>
</div>
<div class="portlet light bordered form-fit">
<div class="portlet-title">
<div class="caption">
 </div>
<div class="actions"></div>
</div>
<div class="portlet-body form">
 <form action="<?php echo base_url()?>admin/update_country_action" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $id;?>" name="id">
<div class="form-body">
 <div class="form-group">
<div class="col-md-2"></div>
<div class="col-md-8">
<input type="text" placeholder="Country" class="form-control" name="id_country" value="<?php echo $title;?>">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                        
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
																			<div class="fileinput-new thumbnail" style="width:32px; height:32px;">
																				<img src="<?php echo base_url()?>site/ar/images/flag/<?php echo $flag;?>" alt="" /> </div>
																			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width:32px; max-height:32px;"> </div>
																			<div>
																				<span class="btn default btn-file">
																					<span class="fileinput-new">Flag</span>
																					<span class="fileinput-exists"> Change </span>
																					<input type="file" name="file"> </span>
																				<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
																			</div>
																		</div>
                                                                        </div>
															<div class="col-md-2"></div>
                                                        </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">
                                                                <i class="fa fa-check"></i>update</button>
                                                                <button type="reset" class="btn default">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                       
									</div>	
<!---END FROM-->
												
                                            
                                      
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>





<div id="footer" class="hidden-print">
<?php include ("design/inc/footer.inc");	?>
</div></div>
<?php include ("design/inc/headf1.inc");?>
<?php 
if(isset($_SESSION['msg'])){
?>
<script>
$(document).ready(function(e) {
 toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>

</body></html>