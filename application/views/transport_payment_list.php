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
                             <h1 class="title">Transport Payments Detail</h1>                            
                          </div>
                       </div>
                    </div>
                   
                    <div class="col-md-5 col-sm-6 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-male icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong>Transport Outstanding Balance</strong></h4>
                                                <span>
                                                <?php 
												 $daily_trans_amt="0";  $trans_adv="0";
												 //Daily Movement total Payment amount
												 foreach ($daily_movement_payment->result() as $daily)
												{ 
												 $daily_trans_amt=intval($daily_trans_amt)+intval($daily->Daily_mvnt_dtl_trp_rent);
												 $trans_adv=intval($trans_adv)+intval($daily->Daily_mvnt_dtl_trp_adv);
												}
												$grand_daily_amt=intval($daily_trans_amt)-intval($trans_adv);
											
												//Iso Movement total Payment amount
												 $iso_trans_amt="0";
												 foreach ($iso_movement_payment->result() as $iso)
												{ 
												 $iso_trans_amt=intval($iso_trans_amt)+intval($iso->Iso_mvnt_tp_amount);
												}
												$grand_iso_amt=$iso_trans_amt;
											
												//Transport Payment Amount
												$grand_payment_amt="0";   
												 foreach ($transport_payment->result() as $trans)
												{ 
												 $grand_payment_amt=intval($grand_payment_amt)+intval($trans->Transport_payment_amount);
												}
												//Payment Calculation
												$grand_total=intval($grand_daily_amt)+intval($grand_iso_amt);
												$outstanding_bal=intval($grand_total)-intval($grand_payment_amt);
												
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
                                <h2 class="title pull-left">Transport Payments List</h2>
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
                                            <th>Transport Name</th>
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
                                            <th>Transport Name</th>
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
                                       foreach ($transport_payment_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php  echo $sno; ?></td>
                                            <td><?php echo $row->Transport_dtl_name;
                                             ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)); ?></td>
                                            <td><?php echo $row->Vehicle_dtl_number; ?>
											</td>
                                            <td><?php echo $row->Driver_pay_rate_place_name; ?></td>
                                            <td>
                                            <?php if($row->Daily_mvnt_dtl_container_type=="BC"){
												echo $row->Party_billing_container_no;
											}
											else{
												echo $row->Daily_mvnt_dtl_new_container_no;
											}
											?>
											</td>
                                                                                         
                                            <td>
                                            	<?php
												echo anchor('transport_payment/view_transport_payments?id='.$row->Transport_dtl_id.'&tr_nme='.$row->Transport_dtl_name.'','View','class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View" data-placement="bottom"');
												?>
                                                <?php if($this->session->userdata('username')=='admin'){ ?><i class="fa fa-ellipsis-v"></i>
                                                <a href="delete_transport_payment?id=<?php echo $row->Transport_dtl_id;?>" onclick="return confirm('Are you sure you want to delete?')"alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a " data-placement="bottom" > Delete </a>
                                                <?php  } ?>
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
        