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
						<?php foreach($data as $res):
						$type=$res->type;
						switch($type){
							case 0:
								$word="Owner";
								break;
							case 1:
								$word="Client";
								break;
							default:
								break; 
						}
						endforeach;	
						?>
						<li>
							<a href="<?=$dd."admin/clients/type/?t=".$type?>"><?=$word;?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">Details</span>
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
															<i class="fa fa-gift"></i>View Details </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-body">
															<!-- BEGIN FORM-->
															<?php foreach($data as $res):
															$city = $this->data->get_table_data('state',array('id_state'=>$res->city_id));
															$active=$res->active;
															switch($active){
																case 0:
																  $active="<span class='label label-sm label-danger'>Not Active</span>";
																  break;
																case 1:
																  $active="<span class='label label-sm label-success'>Active</span>";
																  break;
																default:
																  break; 
															}
															$gender=$res->gender;
															switch($gender){
																case 1:
																  $gender="Male";
																  break;
																case 2:
																  $gender="Female";
																  break;
																default:
																  break; 
															}
															$type=$res->type;
															switch($type){
																case 0:
																  $type="<span class='label label-primary'> Owner </span>";
																  break;
																case 1:
																  $type="<span class='label label-success'> Client </span>";
																  break;
																default:
																  break; 
															}
															$active_mail=$res->active_mail;
															switch($active_mail){
																case 0:
																  $active_mail="<span class='label label-danger'> Not Active </span>";
																  break;
																case 1:
																  $active_mail="<span class='label label-success'> Active </span>";
																  break;
																default:
																  break; 
															}
															$active_phone=$res->active_phone;
															switch($active_phone){
																case 0:
																  $active_phone="<span class='label label-danger'> Not Active </span>";
																  break;
																case 1:
																  $active_phone="<span class='label label-success'> Active </span>";
																  break;
																default:
																  break; 
															}
															$active_img=$res->active_img;
															switch($active_img){
																case 0:
																  $active_img="<span class='label label-danger'> Not Active </span>";
																  break;
																case 1:
																  $active_img="<span class='label label-success'> Active </span>";
																  break;
																default:
																  break; 
															}
															?>
															<div class="table-responsive">
																<br>
																<table class="table table-striped table-bordered table-hover" style="width:70%;margin:0 auto;">
																<tbody>
																	<tr>
																		<td> <b>First Name</b> </td>
																		<td> <?=$res->fname;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Last Name</b> </td>
																		<td> <?=$res->lname;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Email</b> </td>
																		<td> <?=$res->email;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Phone</b> </td>
																		<td> <?=$res->phone;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Birth Date</b> </td>
																		<td> <?=$res->birth_date;?>  </td>
																	</tr>
																	<tr>
																		<td> <b>Gender</b> </td>
																		<td> <?=$gender;?>  </td>
																	</tr>
																	<tr>
																		<td> <b>Description</b> </td>
																		<td> <?=$res->description;?>  </td>
																	</tr>
																	<tr>
																		<td> <b>Job</b> </td>
																		<td> <?=$res->job;?>  </td>
																	</tr>
																	<tr>
																		<td> <b>Education</b> </td>
																		<td> <?=$res->education;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Speaks</b> </td>
																		<td> 
																			<?php
																				$speaks = explode(",", $res->speaks);
																				foreach($speaks as $speak):
																				$ids = trim($speak);
																				$langs = $this->data->get_table_data('speaks',array('id_speaks'=>$ids));
																				echo ' <span class="label label-info">'.$langs[0]->title.'</span> ';
																				endforeach;
																			?>
																		</td>
																	</tr>
																	<tr>
																		<td> <b>Type</b> </td>
																		<td> <?=$type;?> </td>
																	</tr>
																	<tr>
																		<td> <b>City</b> </td>
																		<td> <?=$city[0]->title;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Creation Date</b> </td>
																		<td> <?=$res->creation_date;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Budget</b> </td>
																		<td> <?=$res->budget;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Active</b> </td>
																		<td> <?=$active;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Active By Email</b> </td>
																		<td> <?=$active_mail;?> </td>
																	</tr>
																	<tr>
																		<td> <b>Active Phone</b> </td>
																		<td> <?=$active_phone?> </td>
																	</tr>
																	<tr>
																		<td> <b>Active Personal Photo</b> </td>
																		<td> <?=$active_img?> </td>
																	</tr>
																	<tr>
																		<td align="center" colspan="2"><button type="button" class="btn default cancelbutton">Back</button></td>
																	</tr>
																</tbody>
															</table>
															<br>
														</div>
															<?php endforeach;?>
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
$(document).ready(function(e) {
    $(".cancelbutton").click(function(e) {
        window.location.assign("type/?t=<?=$res->type;?>");
    });
});
</script>
</body>
</html>