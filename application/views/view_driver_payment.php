<?php include('include/header.php'); ?>
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
                                <h1 class="title">View Driver Payment Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
					<?php 
					$id = $this->input->get('id'); 
                    $dr_name = $this->input->get('dr_name');
                    ?>
                    <div class="col-lg-12">
                     <?php echo form_open_multipart('driver_payment/view_driver_payment?id='.$id.'&dr_name='.$dr_name.'', array('class'=>'form-horizontal')); ?>
                  <span style="color:red; "><?php echo validation_errors(); ?></span> 
					<div class="row"> 
                    <div class="col-lg-3 col-md-3 col-sm-3" >
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
                    <div class="col-lg-3 col-md-3 col-sm-3" > 
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
                    <div class="col-lg-3 col-md-3 col-sm-3" > 
                      <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Movement Status:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  
							if(set_value('driver_pay_status')=='P'){ $checked='checked';  }else{ $checked=''; } 
							$data6 = array(
											'name'        => 'driver_pay_status',
											'id'          => 'driver_pay_status',
											'value'       => 'P',
											'checked'     =>  $checked,
										  ); 
							echo form_radio($data6);
						   ?> <strong>Paid</strong> &nbsp;&nbsp; 
						   <?php   
							if(set_value('driver_pay_status')=='U'){ $checked='checked';  }else{ $checked=''; } 
							$data6 = array(
											'name'        => 'driver_pay_status',
											'id'          => 'driver_pay_status',
											'value'       => 'U',
											'checked'     =>  $checked,
										  ); 
							echo form_radio($data6);
						   ?> <strong>Unpaid</strong>
                        </div>
                      </div> 
                    </div>
                    <div class="col-lg-43 col-md-3 col-sm-3" >
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
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php $driver_name=$this->input->get('dr_name');  echo $driver_name;  ?></h3> 
                                                    <?php 
													$driver_id="";
													foreach ($view_driver_payment->result() as $row)
                                                     {
														$driver_id=$row->Driver_pymnt_di_driver_name ; 
													 }
													?>
                                                </div>
                                                <div class="col-md-1 col-sm-1 col-xs-1">
                                                    <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/driver_payment/view_driver_payment_print?id=<?php echo $driver_id.'&dr_name='.$driver_name; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">  
                                                  <section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Driver Paid Amount Detail</h2>
                                                            <div class="actions panel_actions pull-right">
                                                            <a href="add_driver_payment_details?id=<?php echo $driver_id; ?>" target="_blank" alt="add Driver payment" ><button class="btn btn-success">Add Driver Payment</button></a>
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
                                                                        <th>Paid Date</th>
                                                                        <th>Remarks</th>                                      
                                                                        <th>Paid Status</th> 
                                                                        <th>Paid Amount (<i class="fa fa-inr"></i>)</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Sno</th>
                                                                        <th>Paid Date</th>
                                                                        <th>Remarks</th>                                      
                                                                        <th>Paid Status</th> 
                                                                        <th>Paid Amount (<i class="fa fa-inr"></i>)</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;  $paid_amt=0;                                                   
                                                                    foreach ($view_driver_payment->result() as $row)
                                                                    {                                                               
                                                                ?>
                                                                    <tr>
                                                                    	  <td><?php  echo $sno; ?></td>
                                                                          <td><?php echo date('d-M-Y', strtotime($row->Driver_pymnt_pay_date)); ?></td>
                                                                          <td><?php echo $row->Driver_pymnt_remarks; ?></td>
                                                                          <td>
                                                                          <?php
																		 
                                                                            if($row->Driver_pymnt_pay_status=='U')
                                                                            {
                                                                                echo '<strong style="color:red;">Unpaid</strong>';
                                                                            }
                                                                            else
                                                                            {
                                                                                echo '<strong style="color:green;">Paid</strong>';
                                                                            }									  	
                                                                          ?>
                                                                          </td>
                                                                          <td>
                                                                            <?php $paid_amt=intval($paid_amt)+intval($row->Driver_pymnt_amount); ?>
                                                                            <span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Driver_pymnt_amount; ?></span>
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
                                                            <h2 class="title pull-left">ISO Movement Amount Detail</h2>
                                                            <div class="actions panel_actions pull-right">
                                                                <i class="box_toggle fa fa-chevron-down"></i>
                                                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                                                <i class="box_close fa fa-times"></i>
                                                            </div>
                                                        </header>
                                                        <div class="content-body">    <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                 <?php echo form_open_multipart('driver_payment/driver_paid_iso_movement', array('class'=>'form-horizontal')); ?>
                                                            <table id="example-2" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                      <th>Sno</th>
                                                                      <th>Movement Date</th>
                                                                      <th>Vehicle No</th>                                      
                                                                      <th>Container No</th> 
																	  <th>D/N Padi</th> 
																	  <th>Trip Padi</th> 
																	  <th>Mamul</th> 
																	  <th>Other Expense</th> 
																	  <th>PO Expense</th> 
																	  <th>PC Expenses</th> 
																	  <th>Driver Advance</th> 
																	   <th>Driver Balance</th> 
                                                                      <th>Status</th>
                                                                      <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                      <th>Sno</th>
                                                                      <th>Movement Date</th>
                                                                      <th>Vehicle No</th>                                      
                                                                      <th>Container No</th> 
																	  <th>D/N Padi</th> 
																	  <th>Trip Padi</th> 
																	  <th>Mamul</th> 
																	  <th>Other Expense</th> 
																	  <th>PO Expense</th> 
																	  <th>PC Expenses</th> 
																	  <th>Driver Advance</th> 
																	  <th>Driver Balance</th> 
                                                                      <th>Status</th>
                                                                      <th>Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1; $driver_amt = 0; $driver_trip_amt = 0; $driver_mamul = 0;
																	$driver_oth_ex = 0; $driver_po_ex = 0; $driver_pc_ex = 0; $driver_adv = 0;
																	$total_driver_bal = 0;
                                                        			foreach ($view_iso_movement_payments->result() as $row)
                                                                    { 
																	$driver_amt = intval($driver_amt)+intval($row->Iso_mvnt_driver_amount);
																	$driver_trip_amt = intval($driver_trip_amt)+intval($row->Iso_mvnt_driver_trip_amount);
																	$driver_mamul = intval($driver_mamul)+intval($row->Iso_mvnt_driver_mamul);
																	$driver_oth_ex = intval($driver_oth_ex)+intval($row->Iso_mvnt_driver_other_ex);
																	$driver_po_ex = intval($driver_po_ex)+intval($row->Iso_mvnt_driver_po_ex);
																	$driver_pc_ex = intval($driver_pc_ex)+intval($row->Iso_mvnt_driver_pc_ex);
																	$driver_adv = intval($driver_adv)+intval($row->Iso_mvnt_driver_adv);																
																	$driver_bal = intval($row->Iso_mvnt_driver_amount) + intval($row->Iso_mvnt_driver_trip_amount)+ intval($row->Iso_mvnt_driver_mamul)+ intval($row->Iso_mvnt_driver_other_ex)+ intval($row->Iso_mvnt_driver_po_ex)+ intval($row->Iso_mvnt_driver_pc_ex) - intval($row->Iso_mvnt_driver_adv);
																	$total_driver_bal = intval($total_driver_bal)+intval($driver_bal);
                                                                ?>
                                                                    <tr>
                                                                      <td><?php  echo $sno; ?></td>
                                                                      <td>
																	  <?php 
																	  	echo  date('d-M-Y', strtotime($row->Iso_mvnt_date));
                                             						  ?>																	  
																	  </td>
                                                                      <td>
																	  <?php 
																	  if($row->Iso_mvnt_vehicle_type =='O'){		
																			$vehicle_no = $row->Iso_mvnt_other_vehicle_no;
																		}else{
																			$vehicle_no = $row->Vehicle_dtl_number;
																		}
																	  	echo $vehicle_no;
                                             						  ?>
																	  </td>
                                                                      <td><?php 
																	    $container = $row->Iso_mvnt_container_no;
																		if($row->Iso_mvnt_container_no2 != ""){
																			$container .= "-".$row->Iso_mvnt_container_no2;
																		}
																		echo $container;
																		?></td>
																	  <td><?php echo $row->Iso_mvnt_driver_amount;  ?></td>
																	  <td><?php echo $row->Iso_mvnt_driver_trip_amount; ?></td>
																	  <td><?php echo $row->Iso_mvnt_driver_mamul; ?></td>
																	  <td><?php echo $row->Iso_mvnt_driver_other_ex; ?></td>
																	  <td><?php echo $row->Iso_mvnt_driver_po_ex; ?></td>
																	  <td><?php echo $row->Iso_mvnt_driver_pc_ex; ?></td>
																	  <td><?php echo $row->Iso_mvnt_driver_adv; ?></td>
																	  <td><?php echo $driver_bal; ?></td>
                                                                      <td>
                                                                      <?php 
																		if($row->Iso_mvnt_driver_pay_status=='P')
																		{
																		   echo '<strong style="color:green;"> Paid</strong>';   
																		}
																		else
																		{
																			echo '<strong style="color:red;"> Unpaid</strong>';
																		}
																		?> 
                                                                     
                                                                      </td>
                                                                      <td>
                                                                       <?php 
																		if($row->Iso_mvnt_driver_pay_status=='P')
																		{
																		   echo '--';   
																		}
																		else
																		{?>
																			<input type="checkbox" name="daily_id[]"  value="<?php echo $row->Iso_mvnt_id; ?>">
                                                                       <?php 
																		}
																		?> 
                                                                       
                                                                       <input type="hidden" name="driver_id"  value="<?php echo $this->input->get('id'); ?>">
                                                                       <input type="hidden" name="driver_name"  value="<?php echo $this->input->get('dr_name'); ?>">
                                                                      </td>                                                                                                                                                                      
                                                                    </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               	<tfoot>
                                                                  <tr> 
                                                                      <th colspan="4" align="right"><span style="float:right;">Total </span></th>  
                                                                      <th><?php echo $driver_amt; ?></th> 
                                                                      <th><?php echo $driver_trip_amt; ?></th> 
                                                                      <th><?php echo $driver_mamul; ?></th> 
                                                                      <th><?php echo $driver_oth_ex; ?></th> 
                                                                      <th><?php echo $driver_po_ex; ?></th> 
                                                                      <th><?php echo $driver_pc_ex; ?></th> 
                                                                      <th><?php echo $driver_adv; ?></th> 
                                                                      <th><?php echo '<span style="color:red;">'.$total_driver_bal.'</span>'; ?></th>                                
                                                                  </tr>
                                                                </tfoot>
                                                        </table>                                                          
															<input style="float:right;" type="submit" name="submit" value="Paid Bill" class="btn btn-success">
															</form>                                                      
                                                       </div>
                                                        </div>
                                                </section>   
                                                   
                                                   
                                                   
                                                   <section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Movement Amount Detail</h2>
                                                            <div class="actions panel_actions pull-right">
                                                                <i class="box_toggle fa fa-chevron-down"></i>
                                                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                                                <i class="box_close fa fa-times"></i>
                                                            </div>
                                                        </header>
                                                        <div class="content-body">    <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                 <?php echo form_open_multipart('driver_payment/driver_paid_daily_movement', array('class'=>'form-horizontal')); ?>
                                                            <table id="example-2" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                      <th>Sno</th>
                                                                      <th>Movement Date</th>
                                                                      <th>Vehicle No</th>                                      
                                                                      <th>Container No</th> 
                                                                      <th>Place Name</th>  
                                                                      <th>Rent</th>  
                                                                      <th>Advance</th>
                                                                      <th>Oth.Exp</th>  
                                                                      <th>Balance</th>
                                                                      <th>Status</th>
                                                                      <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                      <th>Sno</th>
                                                                      <th>Movement Date</th>
                                                                      <th>Vehicle No</th>                                      
                                                                      <th>Container No</th> 
                                                                      <th>Place Name</th>  
                                                                      <th>Rent</th>  
                                                                      <th>Advance</th>
                                                                      <th>Oth.Exp</th>  
                                                                      <th>Balance</th>
                                                                      <th>Status</th>
                                                                      <th>Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;  $mvnt_balc=0; $ttl_rent=0; $ttl_avnc=0; $ttl_balance=0; $blnc_total=0;  $ttl_oex="0";							                                                                                          
                                                        			foreach ($view_movement_payments->result() as $row)
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
                                                                      <td><?php 
																		if($row->Daily_mvnt_dtl_container_type=="BC"){
																			echo $row->Party_billing_container_no;
																		}else{
																			echo $row->Daily_mvnt_dtl_new_container_no;
																		}
																			
																		 ?></td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('driver_pay_rate/view_driver_pay_details?id='.$row->Daily_mvnt_dtl_place.'', $row->Driver_pay_rate_place_name, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Place Detail" data-placement="bottom"' );
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_driver_total_pay, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );                                             						  
                                             						  
                                                                        $ttl_rent = intval($ttl_rent)+intval($row->Daily_mvnt_dtl_driver_total_pay);
                                                                      ?></td>
                                                                      <td><?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_advance, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );   								  	
                                                                        $ttl_avnc = intval($ttl_avnc)+intval($row->Daily_mvnt_dtl_advance);
                                                                      ?></td>
                                                                      <td><?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_other_expences, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );   								  	
                                                                        $ttl_oex = intval($ttl_oex)+intval($row->Daily_mvnt_dtl_other_expences);
                                                                      ?></td>
                                                                      <td>
                                                                      <?php
                                                                        $mvnt_total = intval($row->Daily_mvnt_dtl_driver_total_pay)-intval($row->Daily_mvnt_dtl_advance);
																		$mvnt_balc = intval($mvnt_total)+intval($row->Daily_mvnt_dtl_other_expences);
																		
                                                                        $ttl_balance = intval($ttl_balance)+intval($mvnt_balc);
                                                                        echo '<span style="color:red;">'.$mvnt_balc.'</span>';								  	
                                                                      ?>
                                                                      </td>
                                                                      <td>
                                                                      <?php 
																		if($row->Daily_mvnt_dtl_driver_pay_status=='P')
																		{
																		   echo '<strong style="color:green;"> Paid</strong>';   
																		}
																		else
																		{
																			echo '<strong style="color:red;"> Unpaid</strong>';
																		}
																		?> 
                                                                     
                                                                      </td>
                                                                      <td>
                                                                       <?php 
																		if($row->Daily_mvnt_dtl_driver_pay_status=='P')
																		{
																		   echo '--';   
																		}
																		else
																		{?>
																			<input type="checkbox" name="daily_id[]"  value="<?php echo $row->Daily_mvnt_dtl_id; ?>">
                                                                       <?php 
																		}
																		?> 
                                                                       
                                                                       <input type="hidden" name="driver_id"  value="<?php echo $this->input->get('id'); ?>">
                                                                       <input type="hidden" name="driver_name"  value="<?php echo $this->input->get('dr_name'); ?>">
                                                                      </td>                                                                                                                                                                      
                                                                    </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               	<tfoot>
                                                                  <tr> 
                                                                      <th colspan="5" align="right"><span style="float:right;">Total </span></th>  
                                                                      <th><?php echo $ttl_rent; ?></th>  
                                                                      <th><?php echo $ttl_avnc; ?></th>
                                                                      <th><?php echo $ttl_oex; ?></th>  
                                                                      <th><?php echo '<span style="color:red;">'.$ttl_balance.'</span>'; ?></th>                                
                                                                  </tr>
                                                                </tfoot>
                                                        </table>
                                                                 <?php if($ttl_rent!=""){?>
                                                        <input style="float:right;" type="submit" name="submit" value="Paid Bill" class="btn btn-success">
                                                        </form>
                                                        <?php } ?>
                                                       </div>
                                                        </div>
                                                </section> 
                                                  
                                                  <?php 
												  $cal_bal=0;
												  $cal_bal=intval($ttl_rent)-intval($ttl_avnc);
												  $blnc_total = intval($cal_bal)+intval($ttl_oex)+intval($total_driver_bal);
												   $total_bal = intval($blnc_total)-intval($paid_amt);
												  ?>
                                                  <h4><strong>Net Amount (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $ttl_rent; ?></span></h4>
                                                  <h4><strong>Total Advance (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $ttl_avnc; ?></span></h4>
                                                  <h4><strong>Total Paid (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $paid_amt; ?></span></h4>
                                                  <h4><strong>Total Other Expenses (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $ttl_oex; ?></span></h4>
                                                  <h4><strong>Total ISO Balance (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $total_driver_bal; ?></span></h4>
                                                  <h4><strong>Balance Amount</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $total_bal; ?></span></h4>                                      
                                      
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
        