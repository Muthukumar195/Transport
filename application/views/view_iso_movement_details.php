<?php 
include('include/header.php');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">View Iso Movement Details</h1>                            
                            </div>

                        </div>
                        
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                                <?php                                                                                         
                                    foreach ($view_iso_movement_details->result() as $row)
                                    {                                                               
                                ?>
                                    <div class="mail_content">

                                            <div class="row">
                                                <div class="col-md-11 col-sm-11 col-xs-11">
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php echo date('d-m-y', strtotime($row->Iso_mvnt_date)); ?></h3>
                                                </div> 
                                                <div class="col-md-1 col-sm-1 col-xs-1">
                                                   <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/iso_movement_details/view_iso_movement_details_print?id=<?php echo $row->Iso_mvnt_id; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                                </div> 
                                                 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h4><strong >Date</strong> : <?php echo date('d-m-y', strtotime($row->Iso_mvnt_date)); ?></h4>
                                                    
                                                      <h4><strong>Vehicle Number</strong> : <?php if($row->Iso_mvnt_vehicle_type=="T"){ echo $row->Vehicle_dtl_number; } else{ echo $row->Iso_mvnt_other_vehicle_no; } ?></h4>  

                                                    <h4><strong>Container Size</strong> : 
                                                    <?php 
                                                    if($row->Iso_mvnt_container_type=='F')
                                                    {
                                                       echo 'Fourty Feet';   
                                                    }
                                                    else
                                                    {
                                                        echo "Twenty Feet";
                                                    }
                                                    ?></h4>  
												   <h4><strong>EY/LO</strong> : <?php
												   if($row->Iso_mvnt_ey_lo=="E"){
												    echo 'Empty';
												   }else{
													 echo 'Load';
												   }
													?></h4>
                                                    <h4><strong>Load Type</strong> : <?php
												   if($row->Iso_mvnt_im_ex=="I"){
												    echo 'Import';
												   }else{
													 echo 'Export';
												   }
													?></h4>
                                                   <h4><strong>Container Number</strong> : <?php 
                                                   echo  $row->Iso_mvnt_container_no;
                                                    if($row->Iso_mvnt_container_no2){
                                                        echo ' - '.$row->Iso_mvnt_container_no2;
                                                        } ?>
                                                  </h4> 
                                                   
                                                   <h4><strong>Pick up</strong> : <?php echo $row->Iso_mvnt_pickup_place; ?></h4>
                                                   <h4><strong>Drop</strong> : <?php echo $row->Iso_mvnt_drop_place; ?></h4>
                                                   <h4><strong>Load Status</strong> :
                                                    <?php
													if($row->Iso_mvnt_loading_status=="L"){
														echo 'Loading';
													}
													else{
														echo 'Unloading';
													}
													 ?></h4>
                                                   <h4><strong>From</strong> : <?php if($row->Iso_mvnt_from){ echo $row->Iso_mvnt_from; }else{ echo 'Null'; } ?></h4> 
                                                   <h4><strong>To</strong> : <?php if($row->Iso_mvnt_to){ echo $row->Iso_mvnt_to; }else{ echo 'Null'; } ?></h4> 
                                                    <h4><strong>Drop</strong> : <?php if($row->Iso_mvnt_load_drop){ echo $row->Iso_mvnt_load_drop; }else{ echo 'Null'; } ?></h4> 
                                                   <h4><strong>Transport Name</strong> : <?php echo $row->Transport_dtl_name; ?></h4> 												   <h4><strong>Transport Amount</strong> :<span class="text-primary"><i class="fa fa-inr"></i>&nbsp; <?php echo $row->Iso_mvnt_tp_amount; ?></span></h4> 
                                                   <h4><strong>Iso Amount</strong> : <span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Iso_mvnt_amount; ?></span></h4> 
                                                  
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
        