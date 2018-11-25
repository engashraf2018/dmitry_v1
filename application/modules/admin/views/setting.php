<?php
//session_start();
ob_start();
$dd=base_url();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:$dd"."admin/login"); 
}

else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];	
}

///print_r($data['site_info']);
$site_info=$this->db->get_where('site_info')->result();
//echo $this->db->last_query();
 //print_r
///die();
foreach($site_info as $site_info){
	$logo=$site_info->logo;
	$logo2=$site_info->logo2;
	$favicon=$site_info->favicon;
	$site_name_title=$site_info->site_name;
	$face=$site_info->facebook;
	$twitter=$site_info->twitter;
	$google_pluse=$site_info->google_pluse;
	$linkedin=$site_info->linkedin;
	$key_words=$site_info->key_words;
	$meta_desc=$site_info->meta_desc;
	$email_sales=$site_info->email_sales;
	$email_support=$site_info->email_support;
	$commision=$site_info->commision;
	$offline_website=$site_info->offline_website;
	}
	if($offline_website==0)
	{
		  $value_off="الموقع الان اون لاين";
	}
	else
	{
	$value_off="الموقع الان اوف لاين";
    }
    //echo "dfsdfdsf".$site_name;
	
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
                            <span>Site</span>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Site Setting</span>
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
                                                    <i class="fa fa-gift"></i>Site Setting</div>
                                                
                                            </div>
                                
                                        <div class="portlet light bordered form-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    
                                                    
                                                    
                                                </div>
                                                <div class="actions"></div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="<?php echo base_url()?>admin/update_setting" class="form-horizontal form-bordered"  method="post" enctype="multipart/form-data">
                                                    <div class="form-body">
                                                        
														<div class="form-group">
                                                            <div class="col-md-4" style="text-align:center">
																<div class="fileinput fileinput-new" data-provides="fileinput">
																	<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																		<img src="<?php echo base_url()?>site/ar/images/site_setting/<?php echo $logo?>" alt="" />
																	</div>
																	<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																	<div>
																		<span class="btn default btn-file">
																		<span class="fileinput-new"> First Logo </span>
																		<span class="fileinput-exists">Change</span>
																		<input type="file" name="file"> </span>
																		<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
																	</div>
																</div>
															</div>
															<div class="col-md-4" style="text-align:center">
																<div class="fileinput fileinput-new" data-provides="fileinput">
																	<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																		<img src="<?php echo base_url()?>site/ar/images/site_setting/<?php echo $logo2?>" alt="" />
																	</div>
																	<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																	<div>
																		<span class="btn default btn-file">
																		<span class="fileinput-new"> Second Logo </span>
																		<span class="fileinput-exists">Change</span>
																		<input type="file" name="file2"> </span>
																		<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
																	</div>
																</div>
															</div>
															<div class="col-md-4" style="text-align:center">
															
															<div class="fileinput fileinput-new" data-provides="fileinput">
																			<div class="fileinput-new thumbnail" style="width:32px; height:32px;">
																				<img src="<?php echo base_url()?>site/ar/images/site_setting/<?php echo $favicon?>" alt="" /> </div>
																			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																			<div>
																				<span class="btn default btn-file">
																					<span class="fileinput-new"> Favicon</span>
																					<span class="fileinput-exists"> Change </span>
																					<input type="file" name="file1"> </span>
																				<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
																			</div>
																		</div>
															
															</div>
                                                        </div>
                                                        
                                                       

                                                        
                                                        
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Site Name</span>
                                              <input type="text" placeholder="Site name" class="form-control" name="site_name" value="<?php echo $site_name_title?>">
                                                                
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Commision</span>
                                              <input type="text" placeholder="commision" class="form-control" name="commision" value="<?php echo $commision?>">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Facebook link</span>
                                              <input type="text" placeholder="Facebook link" class="form-control" name="facebook" value="<?php echo $face?>">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>


                                                     <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Twitter link</span>
                                              <input type="text" placeholder="Twitter link" class="form-control" name="twitter" value="<?php echo $twitter?>">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Google Pluse link</span>
                                              <input type="text" placeholder="Google Pluse link" class="form-control" name="google_pluse" value="<?php echo $google_pluse?>">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Linkedin link</span>
                                              <input type="text" placeholder="Linkedin link" class="form-control" name="linkedin" value="<?php echo $linkedin?>">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Email sales</span>
                                              <input type="text" placeholder="Email sales" class="form-control" name="email_sales" value="<?php echo $email_sales?>">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Email support</span>
                                              <input type="text" placeholder="Email support" class="form-control" name="email_support" value="<?php echo $email_support?>">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>


                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Meta Description</span>
                                                            <textarea class="form-control autosizeme" rows="4" placeholder="Meta Description" data-autosize-on="true" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px;" name="meta_desc"><?=$meta_desc?></textarea>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                       
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Meta Keywords</span>
                                                            <textarea class="form-control autosizeme" rows="4" placeholder="Meta Keywords" data-autosize-on="true" style="overflow: hidden; 
                                                            word-wrap: break-word; resize: horizontal; height: 90px;" name="key_words"><?php echo  $key_words?></textarea>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                      
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <label class="col-md-3 control-label">On/Off Website</label>
                                                            <select class="form-control" name="on_off">
                                                            <option value="">Select website status</option>
                                                        <option value="1">On</option>
                                                        <option value="0">Off</option>
                                                        
                                                        
                                                    </select>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>


                                                        
														
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">
                                                                <i class="fa fa-check"></i>Update</button>
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