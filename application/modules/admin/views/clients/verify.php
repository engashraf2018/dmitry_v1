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
?>
<!DOCTYPE html>
<!--[if !IE]><!-->
<html class="sidebar sidebar-discover">
<!-- <![endif]-->

<head>
	<meta charset="utf-8">
	<?php include ("design/inc/head1.inc");?>
</head>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
	<!-- Main Container Fluid -->


	<div class="container-fluid menu-hidden">
	</div>
	<div id="content">
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
							<a href="<?=$dd."admin"?>">Home</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<a href="<?=$dd."admin/clients/type/?t=0"?>">Owner</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">Verify Account</span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->
					<!-- BEGIN PAGE BASE CONTENT -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PROFILE SIDEBAR -->
							<div class="profile-sidebar">
								<!-- PORTLET MAIN -->
								<!-- END PORTLET MAIN -->
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
															<i class="fa fa-gift"></i> Verify Account</div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-body form">
														<!-- BEGIN FORM-->
														<div class="form-actions">
															<div class="row">
															<div class="col-md-2"></div>
																<div class="col-md-8">
																	<?php 
																	foreach($data as $data) {
																		$active_mail=$data->active_mail;
																		switch($active_mail){
																			case 0:
																			  $active_mail="<span class='label label-sm label-danger'>Not Active</span>";
																			  break;
																			case 1:
																			  $active_mail="<span class='label label-sm label-success'>Active</span>";
																			  break;
																			default:
																			  break; 
																		}
																		$active_phone=$data->active_phone;
																		switch($active_phone){
																			case 0:
																			  $active_phone="<span class='label label-sm label-danger'>Not Active</span>";
																			  break;
																			case 1:
																			  $active_phone="<span class='label label-sm label-success'>Active</span>";
																			  break;
																			default:
																			  break; 
																		}
																		$active_img=$data->active_img;
																		switch($active_img){
																			case 0:
																			  $active_img="<span class='label label-sm label-danger'>Not Active</span>";
																			  break;
																			case 1:
																			  $active_img="<span class='label label-sm label-success'>Active</span>";
																			  break;
																			default:
																			  break; 
																		}
																	}
																	?>
																<table class="table table-bordered table-striped">
																	<tbody>
																		<tr>
																			<td width="30%"> Verify Email </td>
																			<td width="70%">
																				<span class="code_mail-<?php echo $data->id_clients;?>"><?php echo $active_mail;?></span>
																				<!--<a data-id="<?=$data->id_clients;?>" class="btn btn-xs purple email" style="padding: 1px 0px;"><i class="fa fa-edit"></i></a>-->
																			</td>
																		</tr>
																		<tr>
																			<td> Verify SMS </td>
																			<td>
																				<span class="code_phone-<?php echo $data->id_clients;?>"><?php echo $active_phone;?></span>
																				<!--<a data-id="<?=$data->id_clients;?>" class="btn btn-xs purple phone" style="padding: 1px 0px;"><i class="fa fa-edit"></i></a>-->
																			</td>
																		</tr>
																		<tr>
																			<td colspan="2">
																			
																			<div class="col-md-6">
																				<div class="fileinput-new thumbnail">
																				<?php
																				if($data->img_id==''){
																					$img_id = "no-image.jpg";
																				}else{
																					$img_id = $data->img_id;
																				}
																				?>
																				<img src="<?php echo $dd."uploads/guests/".$img_id;?>">
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="fileinput-new thumbnail">
																				<?php
																				if($data->img_live==''){
																					$img_live = "no-image.jpg";
																				}else{
																					$img_live = $data->img_live;
																				}
																				?>
																				<img src="<?php echo $dd."uploads/guests/".$img_live;?>">
																				</div>
																			</div>
																			
																			</td>
																		</tr>
																		<tr>
																			<td>Verify IMG</td>
																			<td>
																			<span class="code_img-<?php echo $data->id_clients;?>"><?php echo $active_img;?></span>
																				<a data-id="<?=$data->id_clients;?>" class="btn btn-xs purple img" style="padding: 1px 0px;"><i class="fa fa-edit"></i></a>
																			</td>
																		</tr>
																	</tbody>
																</table>
																</div>
																<div class="col-md-2"></div>
																<div class="col-md-offset-1 col-md-11">
																	<button type="button" class="btn default cancelbutton">Back</button>
																</div>
															</div>
														</div>
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
							</div>
						</div>
						<?php include ("design/inc/headf1.inc");?>
<script>
$(".email").click(function(e) {
var id = $(this).data("id");
//alert(id);
var data={id:id};
	$.ajax({
		url: '<?php echo base_url("admin/clients/active_mail") ?>',
		type: 'POST',
		data: data,				
		success: function( data ) {
		if (data == "1") {
			// alert(data);
			$(".code_mail-"+id).html("<span class='label label-sm label-success'>Active</span>");
		}
		if (data == "0") {
			$(".code_mail-"+id).html("<span class='label label-sm label-danger'>Not Active</span>");
		}
		}
		});
	});

$(".phone").click(function(e) {
var id = $(this).data("id");
//alert(id);
var data={id:id};
	$.ajax({
		url: '<?php echo base_url("admin/clients/active_phone") ?>',
		type: 'POST',
		data: data,				
		success: function( data ) {
		if (data == "1") {
			// alert(data);
			$(".code_phone-"+id).html("<span class='label label-sm label-success'>Active</span>");
		}
		if (data == "0") {
			$(".code_phone-"+id).html("<span class='label label-sm label-danger'>Not Active</span>");
		}
		}
		});
	});

$(".img").click(function(e) {
var id = $(this).data("id");
//alert(id);
var data={id:id};
	$.ajax({
		url: '<?php echo base_url("admin/clients/active_img") ?>',
		type: 'POST',
		data: data,				
		success: function( data ) {
		if (data == "1") {
			// alert(data);
			$(".code_img-"+id).html("<span class='label label-sm label-success'>Active</span>");
		}
		if (data == "0") {
			$(".code_img-"+id).html("<span class='label label-sm label-danger'>Not Active</span>");
		}
		}
		});
	});
</script>
<script>
$(document).ready(function(e) {
    $(".cancelbutton").click(function(e) {
        window.location.assign("type?t=<?=$_GET['t']?>");
    });
});
</script>
</body>
</html>