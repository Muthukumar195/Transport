<?php 
include('include/header.php');
?>

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">View User Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                                <?php                                                                                         
                                    foreach ($view_user_details->result() as $row)
                                    {                                                               
                                ?>
                                    <div class="mail_content">

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php echo $row->Admin_fullname; ?></h3>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h4><strong >Email</strong> : <?php echo $row->Admin_email; ?></h4>
                                                    <h4><strong>Phone Number</strong> : <?php echo $row->Admin_phone; ?></h4> 
                                                    <h4><strong>User Name</strong> : <?php echo $row->Admin_username; ?></h4>
                                                    <h4><strong>User Rights</strong> : <?php echo $row->User_rights_type_value; ?></h4>  
                                                    <h4><strong>Profile</strong> : <a href="<?php echo base_url(); ?>/uploads/admin_profie/<?php echo $row->Admin_profile; ?>" target="_blank" class="preview" title="User Profile" rel="prettyPhoto"><img src="<?php echo base_url(); ?>/uploads/admin_profie/<?php echo $row->Admin_profile; ?>" title="Profile Photo" alt="<?php echo $row->Admin_profile; ?>" class="img-thumbnail" width="45%" /></a></h4>                          

                                                </div>
                                            </div> 

                                        </div>

                                    <?php } ?>
                         <!-- end mail box for read daily movement details -->   
                     

                     </div>   
                            


                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        