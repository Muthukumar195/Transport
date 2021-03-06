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
                                <h1 class="title">View Party Payment Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">
                    <?php 
					$id = $this->input->get('id'); 
                    $pr_nme = $this->input->get('pr_nme');
                    ?>
                    <div class="col-lg-12">
                     <?php echo form_open_multipart('party_payments/view_party_payments?id='.$id.'&pr_nme='.$pr_nme.'', array('class'=>'form-horizontal')); ?>
                  <span style="color:red; "><?php echo validation_errors(); ?></span> 
					<div class="row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Movement Date From:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'm_date_from',
                                'id'          => 'm_date_from',
                                'value'       => set_value('m_date_from'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    => 'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'From'
                              ); 
                          echo form_input($data1);?>
                          
                        </div>
                      </div> 
                    </div>           
                    <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Movement Date To:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'm_date_to',
                                'id'          => 'm_date_to',
                                'value'       => set_value('m_date_to'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    => 'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'To'
                              ); 
                          echo form_input($data1);?>
                        </div>
                      </div> 
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <div class="form-group" >
                        <?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>
                        
                      </div> 
                    </div>           
                  </div>
                  </form> 

                         <!-- start mail box for read daily movement details -->
                                
                                    <div class="mail_content">

                                            <div class="row">
                                                 <div class="col-md-11 col-sm-11 col-xs-11">
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php $party_name=$this->input->get('pr_nme');  echo $party_name;  ?></h3> 
                                                    <?php
													$party_id=""; 
													foreach ($view_party_payments->result() as $row)
                                                     {
														$party_id=$row->Party_dtl_id ; 
													 }
													?>
                                                </div>
                                                <div class="col-md-1 col-sm-1 col-xs-1">
                                                   
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">  
                                                  <section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Party Paid Amount Detail</h2>
															
                                                            <div class="actions panel_actions pull-right">
                                                                   <a href="add_party_payment_details?id=<?php echo $party_id; ?>" target="_blank" alt="add Party payment" ><button class="btn btn-success">Add Party Payment</button></a>
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
                                                                        <th>Date</th>
                                                                        <th>Remarks</th>
                                                                         <th>Create Date</th>
                                                                        <th>Amount (<i class="fa fa-inr"></i>)</th>
                                                                       
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Sno</th>
                                                                        <th>Date</th>
                                                                        <th>Remarks</th>
                                                                        <th>Create Date</th>
                                                                        <th>Amount (<i class="fa fa-inr"></i>)</th>
                                                                      
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;  $paid_amt=0;                                                   
                                                                    foreach ($view_party_payments->result() as $row)
                                                                    {                                                               
                                                                ?>
                                                                    <tr>
                                                                    	  <td><?php  echo $sno; ?></td>
                                                                          <td><?php echo date('d-M-Y', strtotime($row->Party_payment_pay_date)); ?></td>
                                                                          <td><?php echo $row->Party_payment_remarks; ?></td>
                                                                         
                                                                           <td><?php echo date('d-M-Y', strtotime($row->Party_payment_creatred_dt_tme)); ?></td>
                                                                          <td>
                                                                            <?php $paid_amt=intval($paid_amt)+intval($row->Party_payment_paid_amount); ?>
                                                                            <span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Party_payment_paid_amount; ?></span>
                                                                          </td>                                                                         
                                                                                           
                                                                      </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               	<tfoot>
                                                                  <tr>
                                                                      <th colspan="4"><span style="float:right;">Total</span></th>  
                                                                      <th><?php echo '<span class="text-primary"><i class="fa fa-inr"></i> '.$paid_amt.'</span>'; ?></th>                                                                                         
                                                                  </tr>
                                                                </tfoot>
                                                        </table>
                                                       </div>
                                                        </div>
                                                </section> 
                                                   
                                                   <section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Movement Paid Detail</h2>
															<a  style="float:right;"href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/party_payments/view_party_payments_print?id=<?php echo $party_id.'&pr_nme='.$party_name; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                                            <div class="actions panel_actions pull-right">
															
                                                               <!-- <i class="box_toggle fa fa-chevron-down"></i>-->
                                                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                                               <!-- <i class="box_close fa fa-times"></i>-->
                                                            </div>
                                                            
                                                        </header>
                                                        <div class="content-body">    <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                      <th>Sno</th>
                                                                      <th>Date</th>
                                                                      <th>Vehicle No</th>                                      
                                                                      <th>Container No</th> 
                                                                      <th>Place Name</th>  
                                                                      <th>Rent</th>  
                                                                      <th>Mamul</th>  
                                                                      <th>Advance</th>  
                                                                      <th>Balance</th>
																	  <th>Status</th>
																	 
                                                                    </tr>
                                                                </thead>
                                                                
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;  $mvnt_balc=0; $ttl_mamul="0"; $ttl_rent=0; $ttl_avnc=0; $ttl_balance=0; $blnc_total=0; 							                                                                                          
                                                        			foreach ($view_movement_payments_paid->result() as $row)
                                                                    {                                                               
                                                                ?>
                                                                    <tr>
                                                                      <td><?php  echo $sno; ?></td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', date('d-M-Y', strtotime($row->Daily_mvnt_dtl_date)), 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );
                                             						  ?>																	  
																	  </td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('vehicle_details/view_vehicle_details?id='.$row->Daily_mvnt_dtl_vehicle_no.'', $row->Vehicle_dtl_number, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  if($row->Daily_mvnt_dtl_container_type=='NC'){														
																		echo $row->Daily_mvnt_dtl_new_container_no;
																		}
																		elseif($row->Daily_mvnt_dtl_container_type=='BC'){ 
																		echo $row->Party_billing_container_no; }
																	 ?>
                                                                    </td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('driver_pay_rate/view_driver_pay_details?id='.$row->Daily_mvnt_dtl_place.'', $row->Driver_pay_rate_place_name, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Place Detail" data-placement="bottom"' );
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_rent, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );                                             						  
                                             						  
                                                                        $ttl_rent = intval($ttl_rent)+intval($row->Daily_mvnt_dtl_rent);
                                                                      ?></td>
                                                                       <td>
																	  <?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_party_mamul, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );                                             						  $grand_tot= intval($row->Daily_mvnt_dtl_rent)+intval($row->Daily_mvnt_dtl_party_mamul);
                                             						  
                                                                        $ttl_mamul = intval($ttl_mamul)+intval($row->Daily_mvnt_dtl_party_mamul);
                                                                      ?></td>
                                                                      <td><?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_party_adv, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );   								  	
                                                                        $ttl_avnc = intval($ttl_avnc)+intval($row->Daily_mvnt_dtl_party_adv);
                                                                      ?></td>
                                                                      <td>
                                                                      <?php
                                                                        $mvnt_balc = intval($grand_tot)-intval($row->Daily_mvnt_dtl_party_adv);
                                                                        $ttl_balance = intval($ttl_balance)+intval($mvnt_balc);
                                                                        echo '<span style="color:red;">'.$mvnt_balc.'</span>';								  	
                                                                      ?>
                                                                      </td>	
																	  <td>
																	<?php 
																	if($row->Daily_mvnt_dtl_party_pay_status=='P')
																	{
																	   echo '<strong style="color:green;"> Paid</strong>';   
																	}
																	else
																	{
																		echo '<strong style="color:red;"> Unpaid</strong>';
																	}
																	?> 
																	</td>
                                                                   </td>                                                                                   
                                                                    </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               	<tfoot>
                                                                  <tr> 
                                                                      <th colspan="5" align="right"><span style="float:right;">Total </span></th>  
                                                                      <th><?php echo $ttl_rent; ?></th> 
                                                                      <th><?php echo $ttl_mamul; ?></th>  
                                                                      <th><?php echo $ttl_avnc; ?></th>  
                                                                      <th><?php echo '<span style="color:red;">'.$ttl_balance.'</span>'; ?></th>                                
                                                                  </tr>
                                                                </tfoot>
                                                        </table>
                                                       </div>
                                                        </div>
                                                </section>
												<section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Movement Amount Unpaid Detail</h2>
															<a  style="float:right;"href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/party_payments/view_party_payments_unpaid_print?id=<?php echo $party_id.'&pr_nme='.$party_name; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                                            <div class="actions panel_actions pull-right">
                                                               <!-- <i class="box_toggle fa fa-chevron-down"></i>-->
                                                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                                               <!-- <i class="box_close fa fa-times"></i>-->
                                                            </div>
                                                        </header>
                                                        <div class="content-body">    <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                     <?php echo form_open_multipart('party_payments/paid_daily_movement', array('class'=>'form-horizontal')); ?>
                                                            <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                      <th>Sno</th>
                                                                      <th>Date</th>
                                                                      <th>Vehicle No</th>                                      
                                                                      <th>Container No</th> 
                                                                      <th>Place Name</th>  
                                                                      <th>Rent</th>  
                                                                      <th>Mamul</th>  
                                                                      <th>Advance</th>  
                                                                      <th>Balance</th>
																	  <th>Status</th>
																	  <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                               
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;  $mvnt_bal=0; $tt_mamul="0"; $tt_rent=0; $tt_avnc=0; $tt_balance=0; $bln_total=0; 							                                                                                          
                                                        			foreach ($view_movement_payments_unpaid->result() as $row)
                                                                    {                                                               
                                                                ?>
                                                                    <tr>
                                                                      <td><?php  echo $sno; ?></td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', date('d-M-Y', strtotime($row->Daily_mvnt_dtl_date)), 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );
                                             						  ?>																	  
																	  </td>
                                                                      <td>
																	   <?php 
																	  	echo anchor('vehicle_details/view_vehicle_details?id='.$row->Daily_mvnt_dtl_vehicle_no.'', $row->Vehicle_dtl_number, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );	
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  if($row->Daily_mvnt_dtl_container_type=='NC'){														
																		echo $row->Daily_mvnt_dtl_new_container_no;
																		}
																		elseif($row->Daily_mvnt_dtl_container_type=='BC'){ 
																		echo $row->Party_billing_container_no; }
																	 ?>
                                                                      </td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('driver_pay_rate/view_driver_pay_details?id='.$row->Daily_mvnt_dtl_place.'', $row->Driver_pay_rate_place_name, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Place Detail" data-placement="bottom"' );
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_rent, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );                                             						  
                                             						  
                                                                        $tt_rent = intval($tt_rent)+intval($row->Daily_mvnt_dtl_rent);
                                                                      ?></td>
                                                                       <td>
																	  <?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_party_mamul, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );                                             						  $grand_tota= intval($row->Daily_mvnt_dtl_rent)+intval($row->Daily_mvnt_dtl_party_mamul);
                                             						  
                                                                        $tt_mamul = intval($tt_mamul)+intval($row->Daily_mvnt_dtl_party_mamul);
                                                                      ?></td>
                                                                      <td><?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_party_adv, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );   								  	
                                                                        $tt_avnc = intval($tt_avnc)+intval($row->Daily_mvnt_dtl_party_adv);
                                                                      ?></td>
                                                                      <td>
                                                                      <?php
                                                                        $mvnt_bal = intval($grand_tota)-intval($row->Daily_mvnt_dtl_party_adv);
                                                                        $tt_balance = intval($tt_balance)+intval($mvnt_bal);
                                                                        echo '<span style="color:red;">'.$mvnt_bal.'</span>';								  	
                                                                      ?>
                                                                      </td>	
																	  <td>
																	<?php 
																	if($row->Daily_mvnt_dtl_party_pay_status=='P')
																	{
																	   echo '<strong style="color:green;"> Paid</strong>';   
																	}
																	else
																	{
																		echo '<strong style="color:red;"> Unpaid</strong>';
																	}
																	?> 
																	</td>				                                                                      <td>
																	<?php 
																	/*if($row->Daily_mvnt_dtl_party_pay_status=='P')
																	{
																	   echo '<a href="unpaid_daily_movement?id='.$row->Daily_mvnt_dtl_id.'" alt="Update Status" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Daily Movement" data-placement="bottom" ><button type="button" class="btn btn-primary"> Unpaid</button> </a>';   
																	}
																	else
																	{
																		echo '<a href="paid_daily_movement?id='.$row->Daily_mvnt_dtl_id.'&party_id='.$this->input->get('id').'" alt="Update Status" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Paid Party Bill" data-placement="bottom"> <button type="button" class="btn btn-purple "> paid</button></a>';
																	}*/
																	
                                                                   ?> 
                                                                   <input type="checkbox" name="daily_id[]"  value="<?php echo $row->Daily_mvnt_dtl_id; ?>">
                                                
                                                            </td>                                                                                   
                                                                    </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               	<tfoot>
                                                                  <tr> 
                                                                      <th colspan="5" align="right"><span style="float:right;">Total </span></th>  
                                                                      <th><?php echo $tt_rent; ?></th> 
                                                                      <th><?php echo $tt_mamul; ?></th>  
                                                                      <th><?php echo $tt_avnc; ?></th>  
                                                                      <th><?php echo '<span style="color:red;">'.$tt_balance.'</span>'; ?></th>                                
                                                                  </tr>
                                                                </tfoot>
                                                        </table>
                                                        <input name="party_id" type="hidden" value="<?php echo $this->input->get('id') ?>">
                                                        <?php if($tt_rent!=""){?>
                                                        <input style="float:right;" type="submit" name="submit" value="Paid Bill" class="btn btn-success">
                                                        <?php } ?>
                                                        </form>
                                                       </div>
                                                        </div>
                                                </section> 
                                                  
                                                  <?php 
												  $cal_bal=0; 
												  $cal_bal=intval($ttl_avnc)+intval($paid_amt);
												  $grand_total=intval($ttl_rent)+intval($ttl_mamul);
												  $blnc_total = intval($grand_total)-intval($cal_bal);
												  ?>
												   <?php 
												  $call_bal=0; 
												  $call_bal=intval($tt_avnc)+intval($paid_amt);
												  $grand_tot=intval($tt_rent)+intval($tt_mamul);
												  $blnc_tot = intval($grand_tot)-intval($grand_tot);
												  ?>
												  <?php 
												 $grand_call_balance= intval($cal_bal)+intval($tt_avnc);
												 $grand_total_balance= intval($grand_total)+intval($grand_tot);
												 $balance_total = intval($grand_total_balance)-intval($grand_call_balance);
												  ?>
                                                  <h4><strong>Gross Amount (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php  echo $grand_total_balance; ?></span></h4>
                                                  <h4><strong>Total Paid (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $grand_call_balance; ?></span></h4>
                                                  <h4><strong>Net Amount</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $balance_total; ?></span></h4>                                     
                                                  <h4><strong>Advance Amount</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $tt_avnc; ?></span></h4>                                     
                                                  <h4><strong>Balance Amount</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $tt_balance; ?></span></h4>                                      
                                      
                                                </div>
                                            </div> 

                                        </div>

                                    
                         <!-- end mail box for read daily movement details -->   
                     

                     </div>   
                            


                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        