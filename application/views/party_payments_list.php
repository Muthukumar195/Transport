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
                             <h1 class="title">Party Payments Detail</h1>                            
                          </div>
                       </div>
                    </div>
                   
                    <div class="col-md-5 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-male icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong>Party Outstanding Balance</strong></h4>
                                                <span>
                                                <?php 
												 $grnd_tot_rent="0"; $party_mamul="0"; $party_adv="0";
												 foreach ($movement_outstand_payment->result() as $row)
												{ 
												 //echo $row->Daily_mvnt_dtl_rent; 
												 $grnd_tot_rent=$grnd_tot_rent+intval($row->Daily_mvnt_dtl_rent);
												 $party_mamul=$party_mamul+intval($row->Daily_mvnt_dtl_party_mamul);
												 $party_adv=$party_adv+intval($row->Daily_mvnt_dtl_party_adv);
												}
												$full_amt=intval($grnd_tot_rent)+intval($party_mamul);
												$grand_amt=intval($full_amt)-intval($party_adv);
												//echo $grand_amt;
												
												
												$grnd_payment_amt="0";   
												 foreach ($party_outstand_payment->result() as $row)
												{ 
												 $grnd_payment_amt=$grnd_payment_amt+intval($row->Party_payment_paid_amount);
												// echo $row->Party_payment_paid_amount; 
												}
												//echo $grnd_payment_amt;
												$outstanding_bal=intval($grand_amt)-intval($grnd_payment_amt);
												echo  '<h4 class="text-success"><strong>'.$outstanding_bal.'</strong></h4>';
												 
                                                ?>
                                                
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                   
                    <div class="clearfix"></div>
                   <div class="col-lg-12">
                            <?php if($this->session->flashdata('success_msg')!=null){ ?>
                            <div class="alert alert-success alert-dismissable">
                              <a class="panel-close close" data-dismiss="alert">×</a> 
                              <i class="fa fa-check-square"></i>
                              <?php echo $this->session->flashdata('success_msg'); ?>
                            </div>  
                            <?php } ?>
                            <?php if($this->session->flashdata('failear_msg')){ ?>
                                <div class="alert alert-error alert-dismissible fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <strong><?php echo $this->session->flashdata('failear_msg'); ?></strong>
                                </div>
                            <?php } ?>
                           <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Party Payments Detail List</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Party Name</th>
                                            <th>Movement Date</th>
                                            <th>Vehicle Number</th>
                                            <th>Place Name</th>
                                            <th>Container Number</th>
                                                                                        
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Party Name</th>
                                            <th>Movement Date</th>
                                            <th>Vehicle Number</th>
                                            <th>Place Name</th> 
                                            <th>Container Number</th>                          
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($party_payments_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php  echo $sno; ?></td>
                                            <td><?php echo anchor('party_details/view_party_details?id='.$row->Daily_mvnt_dtl_party_name.'', $row->Party_dtl_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Party Detail" data-placement="bottom"' );
                                             ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)); ?></td>
                                            <td><?php echo $row->Vehicle_dtl_number;?>
											</td>
                                            <td><?php echo $row->Driver_pay_rate_place_name; ?></td>
                                            <td><?php 
											if($row->Daily_mvnt_dtl_container_type=='NC'){
												
												echo $row->Daily_mvnt_dtl_new_container_no;
											}
											elseif($row->Daily_mvnt_dtl_container_type=='BC'){ 
											echo $row->Party_billing_container_no; }
											 ?></td>
                                                                                         
                                            <td>
                                            	<?php
												echo anchor('party_payments/view_party_payments?id='.$row->Party_payment_party_name.'&pr_nme='.$row->Party_dtl_name.'','View','class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Party Payment Details" data-placement="bottom"');
												?>
                                                <!-- <a href="edit_party_payment_details?id=<?php //echo $row->Party_payment_id; ?>"  alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Party Payment Detail" data-placement="bottom"> Edit </a> -->
                                                <?php if($this->session->userdata('username')=='admin'){ ?><i class="fa fa-ellipsis-v"></i>
                                                
                                               
                                                <a href="delete_party_payment?id=<?php echo $row->Party_payment_party_name;?>" onclick="return confirm('Are you sure you want to delete?')"alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a Party Payment" data-placement="bottom" > Delete </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php $sno++; } ?>
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
        