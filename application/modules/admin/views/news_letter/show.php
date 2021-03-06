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
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">
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
							<span class="active">Subscribers List</span>
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
										<span class="caption-subject bold uppercase">Subscribers List</span>
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6 col-xs-8">
												<?php if($result_amount>0){?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton"> Delete Group
															<i class="fa fa-remove"></i>
														</button>
													</div>
												<?php }?>
												<?php if($result_amount>0){?>
													<div class="btn-group">
															<button data-toggle="modal" href="#draggable_all" id="sample_editable_1_2_new" class="btn sbold green addbutton"> Send To All
																<i class="fa fa-send"></i>
															</button>
													</div>
												<?php }?>
											</div>
											<div class="col-md-6 col-xs-4">
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
									<form action="<?php echo $dd?>admin/news_letter/delete" method="POST" id="form">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th> Email </th>
												<th> Actions </th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th> </th>
												<th> </th>
												<th> </th>
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($results as $data) {
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id_news_letter;?>" />
														<span></span>
													</label>
												</td>

												<td> <?=$data->email;?> </td>
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
														<li><a href="<?php echo $dd?>admin/news_letter/delete?id=<?=$data->id_news_letter;?>"><i class="fa fa-remove"></i> Delete </a></li>
															<li><a data-toggle="modal" href="#draggable_<?=$data->id_news_letter;?>"><i class="fa fa-reply"></i> Send Message </a></li>
														</ul>
													</div>
												</td>
											</tr>
											<div class="modal fade draggable-modal" id="draggable_<?=$data->id_news_letter;?>" tabindex="-1" role="basic" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
															<h4 class="modal-title">Send Message To :: <?=$data->email;?></h4>
														</div>
														<form action="<?php echo $dd?>admin/news_letter/send_action" class="form-horizontal form-bordered" method="post">
														<div class="modal-body"> 
															<div class="form-body">
																<div class="form-group">
																	<div class="col-md-12">
																	<textarea name="message" type="text" placeholder="Message" class="form-control" rows="5" required></textarea>
																	<input type="hidden" name="email" value="<?=$data->email;?>">
																	<span class="help-block"> Your Message </span>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn green">Send</button>
																<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
															</div>
														</div>
														</form>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
                                            <?php }?>
										</tbody>
									</table>
									</form>
								
								<!-- <div class="row">
								<div class="col-md-12 col-sm-12">
									<?php if($result_amount>0){?>
										<div class="btn-group">
												<button id="sample_editable_1_2_new" class="btn sbold red delbutton"> Delete Group
													<i class="fa fa-remove"></i>
												</button>
										</div>
									<?php }?>
									<?php if($result_amount>0){?>
										<div class="btn-group">
												<button data-toggle="modal" href="#draggable_all" id="sample_editable_1_2_new" class="btn sbold green addbutton"> Send To All
													<i class="fa fa-send"></i>
												</button>
										</div>
									<?php }?>
								</div>
								</div> -->

								<div class="modal fade draggable-modal" id="draggable_all" tabindex="-1" role="basic" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
															<h4 class="modal-title">Send Message To All Or Custome</h4>
														</div>
														<form action="<?php echo $dd?>admin/news_letter/send_all" class="form-horizontal form-bordered" method="post">
														<div class="modal-body">
														<div class="form-body">

                                                        <div class="form-group">
																<div class="col-md-12">
																<h4>Select Template</h4>
																
	
	<div class="mt-radio-list">
	<div class="col-md-4">											
	<label class="mt-radio mt-radio-outline">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios22" value="option1" checked=""> Template 1
															<span></span>
															<a id="LiveDemo" class="btn_link green" href="#" target="_blank">
	  <i class="glyphicon glyphicon-eye-open"></i> Demo</a>
														</label></div>
														<div class="col-md-4">
                                                        <label class="mt-radio mt-radio-outline">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios23" value="option2" > Template 2
															<span></span>
															<a id="LiveDemo" class="btn_link green" href="#" target="_blank">
	  <i class="glyphicon glyphicon-eye-open"></i> Demo</a>
														</label></div>
														<div class="col-md-4">
                                                        <label class="mt-radio mt-radio-outline mt-radio-">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios24" value="option3"> Template 3
															<span></span>
	<a id="LiveDemo" class="btn_link green" href="#" target="_blank">
	  <i class="glyphicon glyphicon-eye-open"></i> Demo</a>
                                                        </label></div>
                                                    </div>

																</div>
															</div>

															<div class="form-group">
																<div class="col-md-12">
																<h4>Select All</h4>
																<select name="to[]" class="mt-multiselect btn btn-default" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true">
																<?php foreach($results as $data):?>	
																<option value="<?=$data->email?>"><?=$data->email?></option>
																<?php endforeach;?>
																</select>
																</div>
															</div>
															<div class="form-body">
																<div class="form-group">
																	<div class="col-md-12">
																	<textarea name="message" type="text" placeholder="Message" class="form-control" rows="5" required></textarea>
																	<span class="help-block"> Your Message </span>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn green">Send</button>
																<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
															</div>
														</div>
														</div>
														</form>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>

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
<script>
$(document).ready(function(e) {
	$(".delbutton").click(function(e) {
        window.location.assign("delete");
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
	$(".delbutton").click(function(){
		if($('input[type=checkbox]:not("#checkAll"):checked').length>0){
			$('#form').unbind('submit').submit();//renable submit
		}
	    else{
			window.stop();
		alert("Select at least one to delete");		
	}
	});
});
</script>
<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){?>
<script>
$(document).ready(function(e) {
	toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>
</body>
</html>