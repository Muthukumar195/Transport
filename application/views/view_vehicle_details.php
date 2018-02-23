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
                                <h1 class="title">View Vehicle Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                                <?php                                                                                         
                                    foreach ($view_vehicle_details->result() as $row)
                                    {                                                               
                                ?>
                                    <div class="mail_content">

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php echo $row->Vehicle_dtl_number; ?></h3>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                	<?php if($row->Vehicle_dtl_transport=="T"){ ?>
                                                    <h4><strong >Make</strong> : <?php echo $row->Vehicle_dtl_make; ?></h4>
                                                    <h4><strong>Permit</strong> : <?php echo $row->Vehicle_dtl_permit; ?></h4>
                                                    <?php }else{ ?>
                                                    <h4><strong >Transport</strong> : <?php echo $row->Transport_dtl_name; ?></h4>
													<?php } ?>	
                                                      
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
        