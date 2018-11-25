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

	<link rel="stylesheet" href="<?php echo base_url()?>design/lightbox2-master/dist/css/lightbox.min.css" type="text/css" media="screen" />
<script src="<?php echo base_url()?>design/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
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
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">
					<!-- BEGIN PAGE BREADCRUMB -->
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<a href="<?=$dd.'admin';?>">Home</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span>TeamWork</span>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">TeamWork List</span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->

					<!-- Start Table Data -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption font-dark">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject bold uppercase">state List</span>
									</div>
								</div>
								<div class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton"> Add New
														<i class="fa fa-plus"></i>
													</button>
												</div>
												<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold red cancel"> Delete Group
														<i class="fa fa-remove"></i>
													</button>
												</div>
											</div>
											<div class="col-md-6 col-xs-6">
												<div class="btn-group pull-right">
													<button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
														<i class="fa fa-angle-down"></i>
													</button>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="javascript:;">
																<i class="fa fa-print"></i> Print </a>
														</li>
														<li>
															<a href="javascript:;">
																<i class="fa fa-file-pdf-o"></i> Save as PDF </a>
														</li>
														<li>
															<a href="javascript:;">
																<i class="fa fa-file-excel-o"></i> Export to Excel </a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<form action="<?php echo $base_url?>admin/delete_admin" method="POST" id="form">

									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th>Username</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Image</th>
												<th>Role</th>
												<th> Status </th>
												<th> Actions </th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
											</tr>
										</tfoot>
										<tbody>
                                        <?php
										 $tt=$this->db->get_where('admin')->result();
										 if(count($tt)>0){
                                            foreach($results as $data) {

												$view=$data->view;
												$username=$data->username;
												$mail=$data->mail;
												$phone=$data->phone;
												$type=$data->type;
												$img=$data->img;
												switch($view){
													case 0:
													  $view="<span class='label label-sm label-danger'>Not Active</span>";
													  break;
													case 1:
													  $view="<span class='label label-sm label-success'>Active</span>";
													  break;
													default:
													  break; 
												}

												switch($type){
													case 0:
													  $type="<span class='label label-sm label-danger'>Administrator</span>";
													  break;
													case 1:
													  $type="<span class='label label-sm label-success'>Admin</span>";
													  break;
													  case 2:
													  $type="<span class='label label-sm label-success'>Editor</span>";
													  break;
													default:
													  break; 
												}

												$image=$data->img;
												$img="../site/ar/images/site_setting/".$image; 
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input type="checkbox" class="checkboxes" value="<?=$data->id;?>" name="check[]" />
														<span></span>
													</label>
												</td>
												<td> <?=$username;?> </td>
												<td><?=$mail;?></td>
												<td><?=$phone;?></td>
												<td><a title="view image" class="example-image-link" href="<?php echo $img;?>" data-lightbox="example-1">View</a></td>
												<td><?=$type;?></td>
												<td><span class="code_actvation-<?php echo $data->id;?>"><?php echo $view;?></span>
												<a  data-id="<?php echo $data->id;?>" class="btn btn-xs purple table-icon edit" title="change status" style="padding: 1px 0px;">
												<i class="fa fa-edit" title="edit status"></i>
											</a></td> 
										
												
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<!--<li><a href="javascript:;"><i class="fa fa-eye"></i> Details </a></li>-->
															<li><a href="<?php echo base_url()?>admin/update_admin?id_type=<?php echo $data->id;?>"><i class="fa fa-pencil"></i> Edit </a></li>
															<li><a href="<?php echo base_url()?>admin/delete_admin?id_type=<?php echo $data->id;?>"><i class="fa fa-remove"></i> Delete </a></li>

														</ul>
													</div>
												</td>
											</tr>
                                            <?php }?>
										<?php } ?>
										</tbody>
									</table>
											</form>
								</div>
								<!-- <div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton"> Add New
														<i class="fa fa-plus"></i>
													</button>
									</div>
									<div class="btn-group">
											<button id="sample_editable_1_2_new" class="btn sbold red cancel"> Delete Group
												<i class="fa fa-remove"></i>
											</button>
										</div>
									</div>
								</div> -->
								<div class="row">
                                    <div class="col-md-5 col-sm-5">
									<br>
                                        <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                                        <ul class="nav nav-pills">
                                            <li>
                                            <a href="javascript:;"> Total Records :
                                                <span class="badge badge-success pull-right"> <?php echo $result_amount; ?> </span>
                                            </a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div style="text-align: right;" class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
                                            <ul class="pagination" style="visibility: visible;">
                                                <?php echo $pagination; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
							</div>
							<!-- END EXAMPLE TABLE PORTLET-->
						</div>
					</div>
					<!-- END Table Data-->

				</div>
				<!-- END CONTENT -->
			</div>
			<!-- END CONTAINER -->
			<div id="footer" class="hidden-print">
				<?php include ("design/inc/footer.inc");	?>
			</div>
		</div>
		<?php include ("design/inc/headf1.inc");?>
		<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){?>
<script>
$(document).ready(function(e) {
 toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>
	<script>
$(document).ready(function(e) {
    $(".addbutton").click(function(e) {
        window.location.assign("add_admin");
    });
});
</script>

<script>
$(document).ready(function(e) {
$(".edit").click(function(e) {
var id = $(this).data("id");
//alert(id);
var data={id:id};
			$.ajax({
				url: '<?php echo base_url("admin/check_view_teamwork") ?>',
                type: 'POST',
                data: data,				
                success: function( data ) {
                	if (data == "1") {
					// alert(data);
                		$(".code_actvation-"+id).html("<span class='label label-sm label-success'>Active</span>");
                	}
                	if (data == "0") {
                		$(".code_actvation-"+id).html("<span class='label label-sm label-danger'>Not Active</span>");
                	}
				}
         });
	});
});
</script>


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
		alert("Select at least one to delete");
	}
	});
});
</script>

</body>
</html>