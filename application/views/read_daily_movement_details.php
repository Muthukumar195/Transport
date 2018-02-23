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
                                <h1 class="title">READ DAILY MOVEMENT DETAILS</h1>                            
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                     <div class="col-lg-12">
                            <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">READ DAILY MOVEMENT DETAILS</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                    <i class="box_close fa fa-times"></i>
                                    <?php foreach($read_daily_movement_details->result() as $row){
										 $daily=$row->Daily_mvnt_dtl_id;
									}?> 
                                    <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/daily_movement/read_daily_movement_details_print?id=<?php echo $daily; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                </div>
                            </header>
                            <div class="content-body">    
                             <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        <th>Movement Date</th>
                                        <th>Vehicle Number</th>
                                        <th>Container Number</th>
                                        <th>Place Name</th>
                                        <th>Pick Up</th>
                                        <th>Load Status</th>
                                        <th>Party Name</th>
                                        <th>Party Advance Amount</th>
                                         <th>Party Mamul</th>
                                        <th>Party Balance Amount</th>
                                        <th>Driver Name</th>
                                        <th>Driver Advance</th>
                                        <th>Other Expenses</th>
                                        <th>Other Expenses Remarks</th>
                                        <th>Diesel status & rate</th>
                                        <th>Driver Rent</th>
                                        <th>Balance Amount To Driver</th>
                                        <th>Rent</th>
                                        <th>Transport Name</th>
                                        <th>Transport Advance</th>
                                        <th>Transport Rent</th>
                                        
                                        <th>Transport Expences</th>
                                        <th>Transport remark</th>
                                        <th>Transport Amount Balance</th>
                                        <!--<th>Profit</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php                                                 
                                        foreach ($read_daily_movement_details->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)); ?></td>
                                            <td><?php echo $row->Vehicle_dtl_number; ?></td>
                                            <td><?php 
											if($row->Daily_mvnt_dtl_container_type=='NC'){
												
												echo $row->Daily_mvnt_dtl_new_container_no;
											}
											elseif($row->Daily_mvnt_dtl_container_type=='BC'){ 
											echo $row->Party_billing_container_no; }
											 ?></td>
                                            <td><?php echo $row->Driver_pay_rate_place_name; ?></td>
                                            <td><?php echo $row->Daily_mvnt_dtl_pickup_place; ?></td>
                                            <td>
                                            <?php 
											if($row->Daily_mvnt_dtl_loading_status=='L')
											{
												echo "Loading";
											}
											else
											{
												echo "Unloading";
											}
											?>
                                            </td>
                                            <td><?php echo $row->Party_dtl_name; ?></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i> <?php if($row->Daily_mvnt_dtl_party_adv){ echo $row->Daily_mvnt_dtl_party_adv; } else{ echo '0'; }  ?> </span></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i> <?php if($row->Daily_mvnt_dtl_party_mamul){ echo $row->Daily_mvnt_dtl_party_mamul; } else{ echo '0'; }  ?> </span></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i> <?php  $party_total=intval($row->Daily_mvnt_dtl_rent)-intval($row->Daily_mvnt_dtl_party_adv); echo intval($party_total)+intval($row->Daily_mvnt_dtl_party_mamul)  ?></span></td>                              
                                            <td><?php if($row->Daily_mvnt_dtl_transport_type=='O'){ echo "--"; }else{ echo $row->Driver_dtl_name;}?></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i> <?php
											 if($row->Daily_mvnt_dtl_advance!=""){ echo $row->Daily_mvnt_dtl_advance; }else{ echo '0';} ?></span></td>
                                             
                                            <td><span class="text-primary"><i class="fa fa-inr"></i> <?php 
											if($row->Daily_mvnt_dtl_other_expences!=""){echo $row->Daily_mvnt_dtl_other_expences; } else{ echo '0'; } ?></span></td>
                                            <td><?php echo $row->Daily_mvnt_dtl_driver_remark; ?></td>
                                            <td><?php if($row->Daily_mvnt_dtl_diesel_rate_status=="N"){ echo "Current rate - ".$row->Daily_mvnt_dtl_diesel_rate; }
											else{ echo "Default rate - ".$row->Driver_pay_rate_diesel_rate; } ?></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i> <?php $driver_total=intval($row->Daily_mvnt_dtl_driver_total_pay)-intval($row->Daily_mvnt_dtl_advance); echo $row->Daily_mvnt_dtl_driver_total_pay; ?></span></td>
                                            <td> <span class="text-primary"><i class="fa fa-inr"></i> <?php echo intval($driver_total)+intval($row->Daily_mvnt_dtl_other_expences); ?></span></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i> <?php echo $row->Daily_mvnt_dtl_rent; ?></span></td>
                                            <td><?php if($row->Transport_dtl_name!=""){ echo $row->Transport_dtl_name; } else{ echo '--';} ?></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i><?php if($row->Daily_mvnt_dtl_trp_adv!=""){ echo $row->Daily_mvnt_dtl_trp_adv; } else{ echo '0';} ?></span></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i><?php if($row->Daily_mvnt_dtl_trp_rent!=""){ echo $row->Daily_mvnt_dtl_trp_rent; } else{ echo '0';} ?></span></td>
                                             <td><?php echo $trans_ex = $row->Daily_mvnt_dtl_trp_expences; ?></td>
                                            <td><?php echo $row->Daily_mvnt_dtl_trp_exp_remark; ?></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i>
											<?php $transport_bal=intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_trp_adv);
											if($row->Daily_mvnt_dtl_trp_sum=="A"){
												echo intval($transport_bal)+intval($trans_ex);
											 } 
											 else{
												 echo intval($transport_bal)-intval($trans_ex);
											 }
											?>
                                            </span></td>
                                           
                                            
                                           <!-- <td><span class="text-primary"><i class="fa fa-inr"></i> <?php //echo $row->Daily_mvnt_dtl_profit; ?></span></td>-->
                                        </tr>
                                   <?php   } ?>
                                    </tbody>
                            </table>
                           </div>
                           </div>
                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
  