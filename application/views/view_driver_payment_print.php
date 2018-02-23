<!DOCTYPE html>
<html class=" ">
<head>

        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Thirumala Transport</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.png" type="image/x-icon" />    <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>/assets/images/apple-touch-icon-57-precomposed.png">	<!-- For iPhone -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>/assets/images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>/assets/images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>/assets/images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->


        <!-- CORE CSS FRAMEWORK - START -->
        <link href="<?php echo base_url(); ?>/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
		<!-- DATA TABLE --> 
		<link href="<?php echo base_url(); ?>/assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="screen"/>
		<!-- DATA TABLE -->
		<!-- DATE PICKER --> 
		<!--<link href="<?php echo base_url(); ?>/assets/plugins/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="<?php echo base_url(); ?>/assets/plugins/timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" media="screen"/>-->
		<link href="<?php echo base_url(); ?>/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="<?php echo base_url(); ?>/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
		<!-- DATE PICKER --> 
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 
         <link href="<?php echo base_url(); ?>/assets/plugins/datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>

        <!-- CORE CSS TEMPLATE - START -->
        <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->
        
        
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" ">
    <a href='#' onclick='javascript:printDiv("printablediv")' style="text-decoration:none; float:right; color:#000000;" ><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
    <?php 
					$id = $this->input->get('id'); 
                    $dr_name = $this->input->get('dr_name');
                    ?>
                    <div class="col-lg-12">
                     <?php echo form_open_multipart('driver_payment/view_driver_payment_print?id='.$id.'&dr_name='.$dr_name.'', array('class'=>'form-horizontal')); ?>
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
    <div id='printablediv'>
   
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">
            <!-- START CONTENT -->
            <section id="=main-content" class=" ">
                <section class="wrapper =main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">
 
                            <div class="text-center">
                                <h3  style="font-weight:bold;"class="title">Driver Payment Details</h3>
                             </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12">
                        <section class="box ">
                         
                               <div class="row">
                                   <div class="col-lg-12">
                                 
								 <?php 
								                   
											  $paid_amt=0;                                                   
											   foreach ($view_driver_payment->result() as $row)
											   {   
											   $paid_amt=intval($paid_amt)+intval($row->Driver_pymnt_amount);                                               }
										     ?>
                                    
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
												   <div class="text-center">
                                                      <h3 class="title"><?php echo $this->input->get('dr_name');  ?></h3>
                                                   </div>
                                                   <section class="box ">
                                                     <div class="content-body">  
                                                          <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped"  >
                                                                <thead>
                                                                    <tr>
                                                                      <th>Sno</th>
                                                                      <th>Date</th>
                                                                      <th>Vehicle</th>
                                                                      <th>Container</th>
																	  <th>LD/UL</th> 
                                                                      <th>Place</th>
																	  <th>Party</th> 
                                                                      <th>Rent</th>  
                                                                      <th>Adv</th>
                                                                      <th>Oth.Exp</th>  
                                                                      <th>Balance</th>
																	  <th>Remark</th>
                                                                    </tr>
                                                                </thead>
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
																	  echo date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date));
																	   ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  	echo $row->Vehicle_dtl_number;
                                             						  ?>
																	  </td>
                                                                      <td>
																	<?php 
																	if($row->Daily_mvnt_dtl_container_type=="BC"){
																		echo $row->Party_billing_container_no;
																	}else{
																		echo $row->Daily_mvnt_dtl_new_container_no;
																	}
																		
																	 ?>
                                                                      
                                                                      </td>
																	  <td><?php ;
																	  if($row->Daily_mvnt_dtl_loading_status=="L"){
																	  
																	  echo 'Load';
																	  }
																	  else{ echo 'Unloading'; }																																						                                                                        ?></td>
                                                                      <td>
																	  <?php 
																	  	echo $row->Driver_pay_rate_place_name;
                                             						  ?>
																	  </td>
																	  <td>
																	  <?php 
																	  	echo substr($row->Party_dtl_name,3,10);
                                             						  ?>
																	  </td>
                                                                      <td>
																	  <?php 
																	  	echo $row->Daily_mvnt_dtl_driver_total_pay;                                             						  
                                             						  
                                                                        $ttl_rent = intval($ttl_rent)+intval($row->Daily_mvnt_dtl_driver_total_pay);
                                                                      ?></td>
                                                                      <td><?php 
																	  	echo $row->Daily_mvnt_dtl_advance;
                                                                        $ttl_avnc = intval($ttl_avnc)+intval($row->Daily_mvnt_dtl_advance);
                                                                      ?></td>
                                                                      <td><?php 
																	  	echo $row->Daily_mvnt_dtl_other_expences;
                                                                        $ttl_oex = intval($ttl_oex)+intval($row->Daily_mvnt_dtl_other_expences);
                                                                      ?></td>
                                                                      <td>
                                                                      <?php
                                                                        $mvnt_total = intval($row->Daily_mvnt_dtl_driver_total_pay)-intval($row->Daily_mvnt_dtl_advance);
																		$mvnt_balc = intval($mvnt_total)+intval($row->Daily_mvnt_dtl_other_expences);
																		
                                                                        $ttl_balance = intval($ttl_balance)+intval($mvnt_balc);
                                                                        echo '<span style="color:red;">'.$mvnt_balc.'</span>';								  	
                                                                      ?>
                                                                      </td>                                                                                                                                                                      										<td></td>
                                                                    </tr>
                                                                <?php $sno++; } ?>
                                                                </tbody>
                                                               	<tfoot>
                                                                  <tr> 
                                                                      <th colspan="7" align="right"><span style="float:right;">Total </span></th>  
                                                                      <th><?php echo $ttl_rent; ?></th>  
                                                                      <th><?php echo $ttl_avnc; ?></th>
                                                                      <th><?php echo $ttl_oex; ?></th>  
                                                                      <th><?php echo '<span style="color:red;">'.$ttl_balance.'</span>'; ?></th>                                
                                                                  </tr>
                                                                </tfoot>
                                                        </table>
                                                       </div>
                                                       </div>
                                                       </div> 
                                                       
                                                </section> 
                                                  
                                                  <?php 
												  $cal_bal=0;
												  $cal_bal=intval($ttl_rent)-intval($ttl_avnc);
												  $blnc_total = intval($cal_bal)+intval($ttl_oex);
												   $total_bal = intval($blnc_total)-intval($paid_amt);
												  ?>
                                                  <h4><strong>Net Amount (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $ttl_rent; ?></span></h4>
                                                  <h4><strong>Total Advance (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $ttl_avnc; ?></span></h4>
                                                  <h4><strong>Total Paid (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $paid_amt; ?></span></h4>
                                                  <h4><strong>Total Other Expenses (<i class="fa fa-inr"></i>)</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $ttl_oex; ?></span></h4>
                                                  <h4><strong>Balance Amount</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $total_bal; ?></span></h4>                                      
                                      
                                                </div>
                                            </div> 

                                        

                                    
                         <!-- end mail box for read daily movement details -->   
                     

                     </div>   
                                </div>
                            </div>
                        </section></div>






                </section>
	</section>
            <!-- END CONTENT -->


</div>
</div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php //include('include/footer.php');?>

<!-- CORE JS FRAMEWORK - START --> 
        <script src="<?php echo base_url(); ?>/assets/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/js/jquery.easing.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
        <script src="<?php echo base_url(); ?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>/assets/plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
        <!-- CORE JS FRAMEWORK - END --> 


        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <script src="<?php echo base_url(); ?>/assets/plugins/autosize/autosize.min.js" type="text/javascript"></script>
		
		<!-- DATA TABLE -->
         <script src="<?php echo base_url(); ?>/assets/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
		 <script src="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
		 <script src="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
		 <script src="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
		 <!-- DATA TABLE -->
		 <!-- DATE PICKER --> 
		 <!--<script src="<?php echo base_url(); ?>/assets/plugins/datepicker/js/datepicker.js" type="text/javascript"></script> 
		 <script src="<?php echo base_url(); ?>/assets/plugins/timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>-->
		 <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript"></script> 
		 <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script> 
		 <!-- DATE PICKER -->
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 
  <!-- Date Picker --> 
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> 
        <!-- END Date Picker - END -->


        <!-- CORE TEMPLATE JS - START --> 
        <script src="<?php echo base_url(); ?>/assets/js/scripts.js" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS - END --> 

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url(); ?>/assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/assets/js/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 

      </div>
    </body>

</html>
        