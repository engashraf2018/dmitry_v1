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
							<a href="index.html">Home</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">Messages</span>
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
															<i class="fa fa-gift"></i>View message </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption">



															</div>
															<div class="actions"></div>
														</div>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<?php
												foreach ($viewmessage as $res){
												$sender_id=$res->sender_id;
												$receiver_id=$res->receiver_id;
												$id_list=$res->id_list;
												$creation_date=$res->creation_date;
												
								$client_sender= $this->db->get_where("clients",array("id_client"=>$sender_id))->result();
								$client_reciver= $this->db->get_where("clients",array("id_client"=>$receiver_id))->result();
								$list= $this->db->get_where("list",array("id_list"=>$id_list))->result();
								foreach($client_sender as $client_sender){$sender_phone=$client_sender->phone;
									$sender_phone=$client_sender->phone;
									$sender_fname=$client_sender->fname;
									$sender_email=$client_sender->email;
								}
								foreach($client_reciver as $client_reciver)
								{$reciver_phone=$client_reciver->phone;
									$reciver_phone=$client_reciver->phone;
									$reciver_fname=$client_reciver->fname;
									$reciver_email=$client_reciver->email;
								}
								foreach($list as $list){
									
									$list_code=$list->code_list;
									$list_title=$list->title;
									$id_list_type=$list->id_list_type;
								}
			$state= $this->db->get_where("state",array("id_state"=>$id_list_type))->result();
			foreach($state as $state){
									
				$state_title=$state->title;
	
			}
		}
																?>
															<form action="#" class="form-horizontal form-bordered"
															 method="post">
																<div class="form-body">
																	<div class="form-group">
																	<h3 style="padding-left: 20px;">Reciver data</h3>
																	<div class="col-md-4">Name</div>
																		<div class="col-md-4">Phone</div>
																		<div class="col-md-4">Email</div>

																		<div class="col-md-4"><?=$reciver_fname?></div>
																		<div class="col-md-4"><?=$reciver_phone?></div>
																		<div class="col-md-4"><?=$reciver_email?></div>
																	</div>
																	<div class="form-group">
																	<h3 style="padding-left: 20px;">Sender data</h3>
																	<div class="col-md-4">Name</div>
																		<div class="col-md-4">Phone</div>
																		<div class="col-md-4">Email</div>

																		<div class="col-md-4"><?=$sender_fname?></div>
																		<div class="col-md-4"><?=$sender_phone?></div>
																		<div class="col-md-4" ><?=$sender_email?></div>
																	</div>
																	<div class="form-group">
																	<h3 style="padding-left: 20px;">List data</h3>
																	<div class="col-md-4" >Name</div>
																		<div class="col-md-4">state</div>
																		<div class="col-md-4" >code</div>

																		<div class="col-md-4" ><?=$list_title?></div>
																		<div class="col-md-4" ><?=$state_title?></div>
																		<div class="col-md-4" ><?=$list_code?></div>
																	</div>
																	<div class="form-group">
																		<div class="col-md-4"> Message </div>
																		<div class="col-md-8"><?=$res->message?></div>
																	</div>
																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
																				<button type="button" class="btn default cancelbutton">Back</button>
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
							</div>
						</div>
						<?php include ("design/inc/headf1.inc");?>
<script>
$(document).ready(function(e) {
    $(".cancelbutton").click(function(e) {
        window.location.assign("show");
    });
});
</script>
</body>
</html>