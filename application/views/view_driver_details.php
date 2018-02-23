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
                                <h1 class="title">View Driver Details</h1>                            
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12 col-md-12 col-sm-12">

                         <!-- start mail box for read daily movement details -->
                                <?php                                                                                         
                                    foreach ($view_driver_details->result() as $row)
                                    {                                                               
                                ?>
                                    <div class="mail_content">
                                            <div class="row">
                                                <div class="col-md-11 col-sm-11 col-xs-11">
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php echo $row->Driver_dtl_name; ?></h3>
                                                </div>
                                                 <div class="col-md-1 col-sm-1 col-xs-1">
                                                  <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/driver_details/view_driver_details_print?id=<?php echo $row->Driver_dtl_id;?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a> 
                                                </div>
                                                 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <h4><strong >Phone Number</strong> : <?php echo $row->Driver_dtl_phone; ?></h4>
                                                    <h4><strong>Address</strong> : <?php echo $row->Driver_dtl_address; ?></h4>  

                                                    <h4><strong>Driver Type</strong> : 
                                                    <?php 
                                                    if($row->Driver_dtl_type=='P')
                                                    {
                                                       echo 'Permanent';   
                                                    }
                                                    else
                                                    {
                                                        echo "Acting";
                                                    }
                                                    ?></h4>  
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4">
                                                    <h4><strong>License</strong> : <a href="<?php echo base_url(); ?>/uploads/license/<?php echo $row->Driver_dtl_license_file; ?>" target="_blank" class="preview" title="Driver Licence" rel="prettyPhoto"><img src="<?php echo base_url(); ?>/uploads/license/<?php echo $row->Driver_dtl_license_file; ?>" title="Driver License Copy" alt="<?php echo $row->Driver_dtl_license_file; ?>" class="img-thumbnail" width="100%" /></a></h4>
                                                </div>
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12 col-lg-12 col-sm-12">                                                
                                                    <hr>
                                                    <h4>Movement Details</h4><br>
                                                    <div class="table-responsive">
                                                        <table class="table table-hover invoice-table table-bordered" >
                                                            <thead>
                                                                <tr>
                                                                    <td  class="text-center" ><h4>Movement Date</h4></td>
                                                                    <td  class="text-center" ><h4>Place Name</h4></td>
                                                                    <td  class="text-center"><h4>Vehicle No</h4></td>
                                                                    <td  class="text-center"><h4>Rent (<i class="fa fa-inr"></i>)</h4></td>
                                                                    <td  class="text-center"><h4>Advance (<i class="fa fa-inr"></i>)</h4></td>
                                                                    <td class="text-center"><h4>Other Expences(<i class="fa fa-inr"></i>)</h4></td>
                                                                    <td  class="text-center"><h4>Balance (<i class="fa fa-inr"></i>)</h4></td>
                                                                   
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                                <?php
                                                                $total_advnce=0; $driver_total="0";   $total_oth_ex=0;
                                                                foreach ($view_driver_pay_amount->result() as $dri_pay) 
                                                                {
													              $driver_total = intval($driver_total)+intval($dri_pay->Daily_mvnt_dtl_driver_total_pay);  
																	$add_adv=intval($dri_pay->Daily_mvnt_dtl_driver_total_pay)-intval($dri_pay->Daily_mvnt_dtl_advance);
                                                                    $total_advnce=intval($total_advnce)+intval($dri_pay->Daily_mvnt_dtl_advance);
																	$total_oth_ex=intval($total_oth_ex)+intval($dri_pay->Daily_mvnt_dtl_other_expences);
                                                                    
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center" >
                                                                    <?php 
                                                                        echo anchor('daily_movement/read_daily_movement_details?id='.$dri_pay->Daily_mvnt_dtl_id.'', date('d-m-Y' ,strtotime($dri_pay->Daily_mvnt_dtl_date)), 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Daily Movement Detail" data-placement="bottom"' );
                                                                    ?>
                                                                    </td>
                                                                    <td class="text-center" >
                                                                    <?php 
                                                                        echo anchor('driver_pay_rate/view_driver_pay_details?id='.$dri_pay->Daily_mvnt_dtl_place.'', $dri_pay->Driver_pay_rate_place_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Pay Rate Detail" data-placement="bottom"' );
                                                                     ?> 
                                                                    </td>
                                                                    <td class="text-center" >
                                                                    <?php 
                                                                        echo anchor('vehicle_details/view_vehicle_details?id='.$dri_pay->Daily_mvnt_dtl_vehicle_no.'', $dri_pay->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
                                                                     ?>
                                                                    </td>
                                                                     <td class="text-center" ><?php echo $dri_pay->Daily_mvnt_dtl_driver_total_pay; ?></td>
                                                                    <td class="text-center" ><?php echo $dri_pay->Daily_mvnt_dtl_advance; ?></td>
                                                                    <td class="text-center" ><?php
																	 if($dri_pay->Daily_mvnt_dtl_other_expences){ echo $dri_pay->	Daily_mvnt_dtl_other_expences; } else{ echo '0'; }
																	  ?></td>
                                                                    <td class="text-center" ><?php echo intval($add_adv)+intval($dri_pay->Daily_mvnt_dtl_other_expences); ?></td>
                                                                    
                                                                    
                                                                   
                                                                </tr> 
                                                                <?php } ?>                                                               
                                                            </tbody>
                                                        </table>
                                                         <h4>Net Amount (<i class="fa fa-inr"></i>): <?php echo $driver_total; ?></h4>
                                                        <h4>Total Advance (<i class="fa fa-inr"></i>): <?php echo $total_advnce; ?></h4>
                                                        <h4>Total Other Expenses (<i class="fa fa-inr"></i>): <?php echo $total_oth_ex; ?></h4>
                                                        <h4><span style='color:green;'>Total Balance (<i class="fa fa-inr"></i>): <?php  $net_bal=intval($driver_total)-intval($total_advnce); echo intval($net_bal)+intval($total_oth_ex); ?></span></h4>
                                                       
                                                    </div>
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
        