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
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
							<a href="<?=$dd.'admin';?>">Home</a>
							<i class="fa fa-circle"></i>
						</li>
                        <li>
                            <span>Profile</span>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
							<span class="active">User Profile</span>
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
                                        <div class="portlet light bordered">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_2" data-toggle="tab">Change image</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <?php
                $id_admin=$this->session->userdata('id_admin');
                //@$_SESSION['site_favicon']
                                            foreach($data_admin as $data_admin)
                                            ?>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="tab_1_1">
                                                        <form role="form" action="<?php echo base_url()?>admin/update_profile" method="post">
                                                            <div class="form-group">
                                                                <label class="control-label">First Name</label>
                                                                <input type="text" placeholder="John" value="<?php echo $data_admin->fname;?>" class="form-control" name="fname"> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Last Name</label>
                                                                <input type="text" placeholder="Doe" value="<?php echo $data_admin->lname;?>" class="form-control" name="lname"> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Mobile Number</label>
                                                                <input type="text" placeholder="+1 646 580 DEMO (6284)" value="<?php echo $data_admin->phone;?>" name="phone" class="form-control"> </div>
                                           
                                                            <div class="form-group">
                                                                <label class="control-label">Email</label>
                                                                <input type="text" name="email" value="<?php echo $data_admin->mail;?>" placeholder="Your email" class="form-control"> </div>
                                                            <div class="margiv-top-10">
                                                            <input type="submit" value="Save Changes" class="btn green">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <!-- CHANGE AVATAR TAB -->
                                                    <div class="tab-pane" id="tab_1_2">
                                                        
                                                        <form action="<?php echo base_url()?>admin/profileimg" method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="<?php echo base_url()?>site/ar/images/site_setting/<?php echo $data_admin->img;?>" alt=""> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="file"> </span>
                                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                            <input type="submit" value="Save Changes" class="btn green">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div class="tab-pane" id="tab_1_3">
                                                        <form action="<?php echo base_url()?>admin/editpassword" id="form" method="post">
                                                            <div class="form-group">
                                                            <label class="control-label">Current Password</label>
                                                            <input type="password" name="oldpassword" id="newpass" class="form-control">
                                                            <div class="alert alert-danger" id="oldpa" style="display:none">
                                                            <strong>Error!</strong> Old password not correct.</div>
                                                            </div>
                                                            <div class="form-group">
                                                            <label class="control-label">New Password</label>
                                                            <input type="password" name="newpassword" id="pass" class="form-control"> </div>
                                                            <div class="form-group">
                                                            <label class="control-label">Re-type New Password</label>
                                                            <input type="password" name="confirmpassword" id="retpass" class="form-control"> 
                                                            <div class="alert alert-danger" id="confirm" style="display:none">
                                                            <strong>Error!</strong>password not match.</div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                            <input type="button" value="Save Changes" class="btn green" id="cvcx">
                                                            <input type="reset" value="Reset" class="btn default">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END CHANGE PASSWORD TAB -->
                                                    <!-- PRIVACY SETTINGS TAB -->
                                                    <!-- END PRIVACY SETTINGS TAB -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

<script type="text/javascript">
        $('#retpass').focusout(function(e){
	        $(".n_error").hide();
		    e.preventDefault();
		    var data=$("#form").serialize();
		    //alert(data);
            $.ajax({
                url: '<?php echo base_url()?>admin/check_password',
                type: 'POST',
                dataType: 'json',
                data:data,
                success: function( data ) {
			    ///alert(data);
                    if(data==1){ $("#confirm").show();$('#cvcx').prop("type", "button");}
			        else {$("#confirm").hide();$('#cvcx').prop("type", "submit");}
		        }

            });
        });
    </script>





    <script type="text/javascript">
        $('#newpass').focusout(function(e){
	        $(".n_error").hide();
		    e.preventDefault();
		    var data=$("#form").serialize();
		    //alert(data);
            $.ajax({
                url: '<?php echo base_url()?>admin/old_password',
                type: 'POST',
                dataType: 'json',
                data:data,
                success: function( data ) {
			    //alert(data);
                    if(data==1){$("#oldpa").hide();$('#cvcx').prop("type", "submit");}
			        else {$("#oldpa").show();$('#cvcx').prop("type", "button");}
		        }

            });
        });
    </script>

</body></html>