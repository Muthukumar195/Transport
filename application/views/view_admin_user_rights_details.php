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
                                <h1 class="title">View Admin User Rights Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                        
                                <?php                                                                                         
                                    foreach ($view_admin_user_rights->result() as $row)
                                    {                                                               
                                ?>
                                    <div class="mail_content">

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php echo $row->User_rights_name; ?></h3>
                                                </div> 
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h4><strong >User Type</strong> : <?php echo $row->User_rights_name; ?></h4>
                                                    <h4><strong>User Rights</strong> : <?php echo $row->User_rights_type_value; ?></h4>
                                                </div>
                                            </div> 

                                        </div>

                                    <?php } ?>

                     </div>   
                </section>
            </section>
            <!-- END CONTENT -->
                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        