<?php 
include('include/header.php');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />

        <!-- START CONTAINER -->
        <div class="page-container row-fluid"  >

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">View Transport Payment Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">
                    <?php 
					$id = $this->input->get('id'); 
                    $tr_nme = $this->input->get('tr_nme');
                    ?>
                    <div class="col-lg-12">
                     <?php echo form_open_multipart('transport_payment/view_transport_payments?id='.$id.'&tr_nme='.$tr_nme.'', array('class'=>'form-horizontal')); ?>
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
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php echo $tr_nme;  ?></h3> 
                                                </div>
                                                <div class="col-md-1 col-sm-1 col-xs-1">
                                                   
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">  
                                                  <section class="box ">
                                                        <header class="panel_header">
                                                            <h2 class="title pull-left">Transport Paid Amount Detail</h2>
															
                                                            <div class="actions panel_actions pull-right">
                                                            <a href="add_transport_payment?id=<?php echo $id; ?>" target="_blank" alt="add Transport payment" ><button class="btn btn-success">Add Transport Payment</button></a>
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
                                                                         <th>Create Date</th> 
                                                                        <th>Amount (<i class="fa fa-inr"></i>)</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Sno</th>
                                                                        <th>Paid Date</th>
                                                                        <th>Remarks</th>                                      
                                                                        <th>Create Date</th> 
                                                                        <th>Amount (<i class="fa fa-inr"></i>)</th>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php 
                                                                    $sno=1;  $paid_amt=0; $trans_id="";                                                   
                                                                    foreach ($view_transport_payments->result() as $row)
                                                                    { 
																	                                                             
                                                                ?>
                                                                    <tr>
                                                                    	  <td><?php  echo $sno; ?></td>
                                                                          <td><?php echo date('d-M-Y', strtotime($row->Transport_payment_date)); ?></td>
                                                                          <td><?php echo $row->Transport_payment_remark; ?></td>
                                                                         <td><?php echo date('d-M-Y', strtotime($row->Transport_payment_creatred_dt_tme)); ?></td>
                                                                          <td>
                                                                            <?php $paid_amt=intval($paid_amt)+intval($row->Transport_payment_amount); ?>
                                                                            <span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Transport_payment_amount; ?></span>
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
															<a  style="float:right;"href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/transport_payment/view_transport_payment_print?id=<?php echo $id.'&tr_nme='.$tr_nme; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
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
                                                                      <th>Advance</th>
                                                                      <th>Expences</th>  
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
																			echo $row->Vehicle_dtl_number;
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
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_trp_rent, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );                                             						  
                                             						  
                                                                        $ttl_rent = intval($ttl_rent)+intval($row->Daily_mvnt_dtl_trp_rent);
                                                                      ?></td>
                                                                      
                                                                      <td><?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_trp_adv, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );   								  	
                                                                        $ttl_avnc = intval($ttl_avnc)+intval($row->Daily_mvnt_dtl_trp_adv);
                                                                      ?></td>
                                                                      <td><?php echo $trans_ex =  $row->Daily_mvnt_dtl_trp_expences; ?></td>
                                                                      <td>
                                                                      <?php
                                                                        $balc = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_trp_adv);
																		if($row->Daily_mvnt_dtl_trp_sum=="A"){
																			$mvnt_balc = intval($balc)+intval($trans_ex);
																		 } 
																		 else{
																			 $mvnt_balc = intval($balc)-intval($trans_ex);
																		 }
                                                                        $ttl_balance = intval($ttl_balance)+intval($mvnt_balc);
                                                                        echo '<span style="color:red;">'.$mvnt_balc.'</span>';								  	
                                                                      ?>
                                                                      </td>	
																	  <td>
																	<?php 
																	if($row->Daily_mvnt_dtl_transport_pay_status=='P')
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
                                                                <!--Iso Movement Paid List-->
                                                                <tbody style="border-top:2px solid #9972b5;">
                                                                <?php
																	// $sno=1;  $mvnt_balc=0;  $ttl_rent=0; $ttl_avnc=0; $ttl_balance=0; $blnc_total=0;
                                                        			foreach ($view_iso_movement_payments_paid->result() as $iso)
                                                                    {                                                               
                                                                ?>
                                                                    <tr>
                                                                      <td><?php  echo $sno; ?></td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('iso_movement_details/view_iso_movement_details?id='.$iso->Iso_mvnt_id.'', date('d-M-Y', strtotime($iso->Iso_mvnt_date)), 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Iso Movement Detail" data-placement="bottom"' );
                                             						  ?>																	  
																	  </td>
                                                                      <td>
																	   <?php 
																			echo $iso->Iso_mvnt_other_vehicle_no;
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  if($iso->Iso_mvnt_container_type=='F'){														
																		echo $iso->Iso_mvnt_container_no;
																		}
																		elseif($iso->Iso_mvnt_container_type=='T'){ 
																		echo '('.$iso->Iso_mvnt_container_no.') - ('.$iso->Iso_mvnt_container_no2.')'; }
																	 ?>
                                                                      </td>
                                                                      <td>
																	  <?php 
																	  	echo $iso->Iso_mvnt_pickup_place.'<strong class="text-purple"> To </strong>'.$iso->Iso_mvnt_drop_place;
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('iso_movement_details/view_iso_movement_details?id='.$iso->Iso_mvnt_id.'', $iso->Iso_mvnt_tp_amount, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Iso Movement Detail" data-placement="bottom"' );                                             						  
                                             						  
                                                                        $ttl_rent = intval($ttl_rent)+intval($iso->Iso_mvnt_tp_amount);
                                                                      ?></td>
                                                                      
                                                                      <td> -- </td>
                                                                      <td> -- </td>	
																	  <td>
																	<?php 
																	if($iso->Iso_mvnt_paid_status=='P')
																	{
																	   echo '<strong style="color:green;"> Paid</strong>';   
																	}
																	else
																	{
																		echo '<strong style="color:red;"> Unpaid</strong>';
																	}
																	?> 
																	</td>				                                                                    
                                                                    </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               	<tfoot>
                                                                  <tr> 
                                                                      <th colspan="5" align="right"><span style="float:right;">Total </span></th>  
                                                                      <th><?php echo $ttl_rent; ?></th> 
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
															<a  style="float:right;"href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/transport_payment/view_transport_payments_unpaid_print?id=<?php echo $id.'&tr_nme='.$tr_nme; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
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
                                                                      <th>Advance</th> 
                                                                      <th>Expences</th>  
                                                                      <th>Balance</th>
																	  <th>Status</th>
																	  <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                               
                                                                <tbody>
                                                                 <?php echo form_open_multipart('transport_payment/paid_daily_movement', array('class'=>'form-horizontal')); ?>
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
																	
																			echo $row->Vehicle_dtl_number;
																		
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
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_trp_rent, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );                                             						  
                                             						  
                                                                        $tt_rent = intval($tt_rent)+intval($row->Daily_mvnt_dtl_trp_rent);
                                                                      ?></td>
                                                                      
                                                                      <td><?php 
																	  	echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', $row->Daily_mvnt_dtl_trp_adv, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Movement Detail" data-placement="bottom"' );   								  
                                                                        $tt_avnc = intval($tt_avnc)+intval($row->Daily_mvnt_dtl_trp_adv);
                                                                      ?></td>
                                                                      <td><?php echo $trans_ex = $row->Daily_mvnt_dtl_trp_expences; ?></td>
                                                                      <td>
                                                                      <?php
                                                                        $bal = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_trp_adv);
																		if($row->Daily_mvnt_dtl_trp_sum=="A"){
																			$mvnt_bal = intval($bal)+intval($trans_ex);
																		 } 
																		 else{
																			 $mvnt_bal = intval($bal)-intval($trans_ex);
																		 }
                                                                        $tt_balance = intval($tt_balance)+intval($mvnt_bal);
                                                                        echo '<span style="color:red;">'.$mvnt_bal.'</span>';								  	
                                                                      ?>
                                                                      </td>	
																	  <td>
																	<?php 
																	if($row->Daily_mvnt_dtl_transport_pay_status=='P')
																	{
																	   echo '<strong style="color:green;"> Paid</strong>';   
																	}
																	else
																	{
																		echo '<strong style="color:red;"> Unpaid</strong>';
																	}
																	?> 
																	</td><td>
																	<?php 
																	/*if($row->Daily_mvnt_dtl_transport_pay_status=='P')
																	{
																	   echo '<a href="unpaid_daily_movement?id='.$row->Daily_mvnt_dtl_id.'" alt="Update Status" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Daily Movement" data-placement="bottom" ><button type="button" class="btn btn-primary"> Unpaid</button> </a>';   
																	}
																	else
																	{
																		echo '<a href="paid_daily_movement?id='.$row->Daily_mvnt_dtl_id.'" alt="Update Status" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Paid Party Bill" data-placement="bottom"> <button type="button" class="btn btn-purple "> paid</button></a>';
																	}*/
                                                                   ?> 
                                                                   <input type="checkbox"  name="daily_id[]"   value="<?php echo $row->Daily_mvnt_dtl_id; ?>">
                                                                  
                                                            </td>                                                                                   
                                                                    </tr>
                                                                    
                                                                <?php $sno++; } ?>
                                                                <?php if($tt_rent!=""){ ?>
                                                                 <input name="trans_id" type="hidden" value="<?php echo $this->input->get('id') ?>">
                                                                 <input name="trans_name" type="hidden" value="<?php echo $this->input->get('tr_nme') ?>">
                                                                 <input style="float:right;" type="submit" name="submit" value="Paid Daily Bill" onClick="daily_id_chk()" class="btn btn-primary">
                                                                 <?php } ?>
                                                				</form>
                                                                </tbody>
                                                               <!-- start Iso Movement Unpaid Data-->
                                                                <tbody style="border-top:2px solid #9972b5;">
                                                                 <?php echo form_open_multipart('transport_payment/paid_iso_movement', array('class'=>'form-horizontal')); ?>
                                                                <?php 
                                                                  //$mvnt_bal=0; $tt_mamul="0"; $tt_rent=0; $tt_avnc=0; $tt_balance=0; $bln_total=0; 							                                                                                          
                                                        			foreach ($view_iso_movement_payments_unpaid->result() as $iso)
                                                                    {                                                               
                                                                ?>
                                                                    <tr>
                                                                      <td><?php  echo $sno; ?></td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('iso_movement_details/view_iso_movement_details?id='.$iso->Iso_mvnt_id.'', date('d-M-Y', strtotime($iso->Iso_mvnt_date)), 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Iso Movement Detail" data-placement="bottom"' );
                                             						  ?>																	  
																	  </td>
                                                                      <td>
																	   <?php 
																			echo $iso->Iso_mvnt_other_vehicle_no;
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  if($iso->Iso_mvnt_container_type=='F'){														
																		echo $iso->Iso_mvnt_container_no;
																		}
																		elseif($iso->Iso_mvnt_container_type=='T'){ 
																		echo '('.$iso->Iso_mvnt_container_no.') - ('.$iso->Iso_mvnt_container_no2.')'; }
																	 ?>
                                                                      </td>
                                                                      <td>
																	  <?php 
																	  	echo $iso->Iso_mvnt_pickup_place.'<strong class="text-purple"> To </strong>'.$iso->Iso_mvnt_drop_place;
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  	echo anchor('iso_movement_details/view_iso_movement_details?id='.$iso->Iso_mvnt_id.'', $iso->Iso_mvnt_tp_amount, 'target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Iso Movement Detail" data-placement="bottom"' );                                             						  
                                             						  
                                                                        $tt_rent = intval($tt_rent)+intval($iso->Iso_mvnt_tp_amount);
                                                                      ?></td>
                                                                      
                                                                      <td> -- </td>
                                                                      <td> -- </td>
                                                                      <td> -- </td>	
																	  <td>
																	<?php 
																	if($iso->Iso_mvnt_paid_status=='P')
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
																	/*if($iso->Iso_mvnt_paid_status=='P')
																	{
																	   echo '<a href="unpaid_iso_movement?id='.$iso->Iso_mvnt_id.'" alt="Update Status" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Daily Movement" data-placement="bottom" ><button type="button" class="btn btn-primary"> Unpaid</button> </a>';   
																	}
																	else
																	{
																		echo '<a href="paid_iso_movement?id='.$iso->Iso_mvnt_id.'" alt="Update Status" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Paid Tansport Bill" data-placement="bottom"> <button type="button" class="btn btn-purple "> paid</button></a>';
																	}*/
                                                                   ?> 
                                                     <input type="checkbox" name="iso_id[]"  value="<?php echo $iso->Iso_mvnt_id; ?>">
                                                            </td>                                                                                   
                                                                    </tr>
                                                                <?php $sno++; } ?>
                                                                <?php if($tt_rent!=""){ ?>
                                                                <input name="trans_id" type="hidden" value="<?php echo $this->input->get('id') ?>">
                                                                 <input name="trans_name"  type="hidden" value="<?php echo $this->input->get('tr_nme') ?>">
                                                                 <input style="float:right; " type="submit" name="submit" value="Paid Iso Bill" class="btn btn-success">
                                                                 <?php } ?>
                                                                 

                                                				</form>
                                                                </tbody>
                                                               	<tfoot>
                                                                  <tr> 
                                                                      <th colspan="5" align="right"><span style="float:right;">Total </span></th>  
                                                                      <th><?php echo $tt_rent; ?></th>  
                                                                      <th><?php echo $tt_avnc; ?></th>  
                                                                      <th><?php echo '<span style="color:red;">'.$tt_balance.'</span>'; ?></th>                                
                                                                  </tr>
                                                                </tfoot>
                                                        </table>
                                                    
                                                       </div>
                                                        </div>
                                                </section> 
                                                  
                                                  <?php 
												  //unpaid amount
												  $cal_bal=0; 
												  $cal_bal=intval($tt_avnc)+intval($paid_amt);
												  $grand_total=$tt_rent;
												  $blnc_total = intval($grand_total)-intval($cal_bal);
												 
												  //grand total
											
												 $grand_total_balance= intval($ttl_rent)+intval($tt_rent);
												 $balance_total = intval($grand_total_balance)-intval($paid_amt);
												  ?>
                                                  
                                      			<h4><strong>Gross Amount (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php  echo $grand_total_balance; ?></span></h4>
                                                
                                                  <h4><strong>Total Paid (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $paid_amt; ?></span></h4>
                                                  <h4><strong>Net Amount</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $balance_total; ?></span></h4>                                      
                                                  <h4><strong>Advance</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $tt_avnc; ?></span></h4>                                      
                                                  <h4><strong>balance</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $tt_balance; ?></span></h4>                                      
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
        