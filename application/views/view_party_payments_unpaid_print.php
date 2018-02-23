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
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">
            <!-- START CONTENT -->
            <section id="=main-content" class=" ">
                <section class="wrapper =main-wrapper" style=''>
                    <div class="clearfix"></div>
                     <div class="col-lg-12">
                        <section class="box ">
						 <a  href='#' onclick='javascript:printDiv("printablediv")'style="float:right; text-decoration:none; color:#000000;" ><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' >&nbsp;Print</a>
                         <?php 
					$id = $this->input->get('id'); 
                    $pr_nme = $this->input->get('pr_nme');
                    ?>
                    <div class="col-lg-12">
                     <?php echo form_open_multipart('party_payments/view_party_payments_unpaid_print?id='.$id.'&pr_nme='.$pr_nme.'', array('class'=>'form-horizontal')); ?>
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
                  </div>
                  </form> 
                         <div id='printablediv'>
                               <div class="row">
                                   <div class="col-lg-12">
                         <!-- start mail box for read daily movement details -->
									<?php
									 $address="";
									 foreach ($view_movement_payments_unpaid->result() as $row)
									{
									$address=$row->Party_dtl_address;
									}
									?>
                                       </div>
								   </div>
								   <?php
                                    $get_id= $this->input->get('id');
                                    if($get_id=="1"){
                                    ?>
                                    <div class="text-center">
                                        <h1 class="title"><strong>Sri Thirumala Transport</strong></h1>
                                        <h5 class="title"><strong>Contact : 9840602093</strong></h5>
                                        <h3 class="title"><strong>Import / Export</strong></h3>
                                     </div>
                                    <section class="box ">
                                    <div class="content-body">
                                    
                                      <div class="row">
                                    
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h3 class="text-left" style="font-weight:bold;"><?php echo $this->input->get('pr_nme');  ?></h3><h5 class="text-left"><?php echo $address;?>	</h5>
                                <h6 class="text-right"><strong>Date : <?php echo date('d-m-Y'); ?></strong></h6>
                                       <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                          
                                            <thead>
                                                <tr>
                                                  <th>Sno</th>
                                                  <th>Date</th>
                                                  <th>Vehicle No</th>                                      
                                                  <th>Container No</th>
                                                   <th>Type</th> 
                                                  <th>From</th> 
                                                  <th>To</th>  
                                                  <th>Rent</th>  
                                                  <th>Mamul</th>
                                                  <td>Total Amount</td>
                                                  <td>Remark</td>  
                                                 
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            <?php 
                                                $sno=1;  $mvnt_balc=0; $ttl_mamul="0"; $ttl_rent=0; $ttl_avnc=0; $ttl_balance=0; $blnc_total=0; 	                                                         
                                                foreach ($view_movement_payments_unpaid->result() as $row)
                                                {                                                               
                                            ?>
                                                <tr>
                                                  <td><?php  echo $sno; ?></td>
                                                  <td>
                                                  <?php 
                                                    echo date('d-M-Y', strtotime($row->Daily_mvnt_dtl_date));
                                                  ?>																	  
                                                  </td>
                                                  <td>
                                                 <?php echo $row->Vehicle_dtl_number; ?>
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
                                                  <td></td>
                                                   <td>
                                                  <?php 
                                                    echo $row->Party_billing_from;
                                                  ?>
                                                  </td>
                                                  <td>
                                                  <?php 
                                                    echo $row->Driver_pay_rate_place_name;
                                                  ?>
                                                  </td>
                                                  <td>
                                                  <?php 
                                                    echo $row->Daily_mvnt_dtl_rent;                                             						  
                                                  
                                                    $ttl_rent = intval($ttl_rent)+intval($row->Daily_mvnt_dtl_rent);
                                                  ?></td>
                                                   <td>
                                                  <?php
                                                  $ttl_avnc = intval($ttl_avnc)+intval($row->	Daily_mvnt_dtl_party_adv); 
                                                    echo $row->Daily_mvnt_dtl_party_mamul;                                             						  $grand_tot= intval($row->Daily_mvnt_dtl_rent)+intval($row->Daily_mvnt_dtl_party_mamul);
                                                  
                                                    $ttl_mamul = intval($ttl_mamul)+intval($row->Daily_mvnt_dtl_party_mamul);  
                                                    $grand_total = intval($ttl_rent)+intval($ttl_mamul)
                                                    
                                                  ?></td>
                               <td><?php echo intval($ttl_rent)-intval($row->Daily_mvnt_dtl_party_adv);  ?></td>                                                   <td></td>                                                                    
                                                </tr>
                                            <?php $sno++; } ?>
                                            </tbody>
                                            <tfoot>
                                              <tr> 
                                                  <th colspan="7" align="right"><span style="float:right;">Total </span></th>  
                                                   <?php $grandtotl=intval($ttl_rent)-intval($ttl_avnc); ?>
                                                  <th><?php echo $ttl_rent; ?></th>
                                                  <th><?php echo $ttl_mamul; ?></th> 
                                                  <th><?php echo '<span style="color:red;">'.$grandtotl.'</span>'; ?></th>                                
                                              </tr>
                                            </tfoot>
                                    </table>
                                   </div>
                                 </div>
                                </div>
                            </section>
                                    
                                    <?php }else{ ?> 
                                
                               <section class="box ">
                                    <div class="content-body">
                                    
                                      <div class="row" style="margin-top:250px;">
                                    
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h3 class="text-left" style="font-weight:bold;"><?php echo $this->input->get('pr_nme');  ?></h3><h5 class="text-left"><?php echo $address;?>	</h5>
                                <h6 class="text-right"><strong>Date : <?php echo date('d-m-Y'); ?></strong></h6>
                                       <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                          
                                            <thead>
                                                <tr>
                                                  <th>Sno</th>
                                                  <th>Date</th>
                                                  <th>Vehicle No</th>                                      
                                                  <th>Container No</th>
                                                  <th>CNS No</th> 
                                                  <th>From</th> 
                                                  <th>To</th>  
                                                  <th>Rent</th>  
                                                  <th>Mamul</th>
                                                  <td>Total Amount</td>  
                                                 
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            <?php 
                                                $sno=1;  $mvnt_balc=0; $ttl_mamul="0"; $ttl_rent=0; $ttl_avnc=0; $ttl_balance=0; $blnc_total=0; 	                                                         
                                                foreach ($view_movement_payments_unpaid->result() as $row)
                                                {                                                               
                                            ?>
                                                <tr>
                                                  <td><?php  echo $sno; ?></td>
                                                  <td>
                                                  <?php 
                                                    echo date('d-M-Y', strtotime($row->Daily_mvnt_dtl_date));
                                                  ?>																	  
                                                  </td>
                                                  <td>
                                                  <?php
                                                    echo $row->Vehicle_dtl_number;
                                                  ?>
                                                  </td>
                                                  <td><?php 
													if($row->Daily_mvnt_dtl_container_type=='NC'){
														
														echo $row->Daily_mvnt_dtl_new_container_no;
													}
													elseif($row->Daily_mvnt_dtl_container_type=='BC'){ 
													echo $row->Party_billing_container_no; }
													 ?></td>
                                                   <td>
                                                  <?php 
                                                  echo $row->Party_billing_cni_no;
                                                  ?>
                                                  </td>
                                                   <td>
                                                  <?php 
                                                    echo $row->Party_billing_from;
                                                  ?>
                                                  </td>
                                                  <td>
                                                  <?php 
                                                    echo $row->Driver_pay_rate_place_name;
                                                  ?>
                                                  </td>
                                                  <td>
                                                  <?php 
                                                    echo $row->Daily_mvnt_dtl_rent;                                             						  
                                                  
                                                    $ttl_rent = intval($ttl_rent)+intval($row->Daily_mvnt_dtl_rent);
                                                  ?></td>
                                                   <td>
                                                  <?php
                                                  $ttl_avnc = intval($ttl_avnc)+intval($row->	Daily_mvnt_dtl_party_adv); 
                                                    echo $row->Daily_mvnt_dtl_party_mamul;                                             						  $grand_tot= intval($row->Daily_mvnt_dtl_rent)+intval($row->Daily_mvnt_dtl_party_mamul);
                                                  
                                                    $ttl_mamul = intval($ttl_mamul)+intval($row->Daily_mvnt_dtl_party_mamul);  
                                                    $grand_total = intval($ttl_rent)+intval($ttl_mamul)
                                                    
                                                  ?></td>
                               <td><?php echo intval($ttl_rent)-intval($row->Daily_mvnt_dtl_party_adv);  ?></td>                                                                    
                                                </tr>
                                            <?php $sno++; } ?>
                                            </tbody>
                                            <tfoot>
                                              <tr> 
                                                  <th colspan="7" align="right"><span style="float:right;">Total </span></th>  
                                                   <?php $grandtotl=intval($ttl_rent)-intval($ttl_avnc); ?>
                                                  <th><?php echo $ttl_rent; ?></th>
                                                  <th><?php echo $ttl_mamul; ?></th> 
                                                  <th><?php echo '<span style="color:red;">'.$grandtotl.'</span>'; ?></th>                                
                                              </tr>
                                            </tfoot>
                                    </table>
                                   </div>
                                 </div>
                                </div>
                            </section>
                             
                          
                  
                             <?php } ?>
                
     <!-- end mail box for read daily movement details -->   
 

 </div>
                         </section>
                         </div>
                         
                </section>
	</section>
            <!-- END CONTENT -->


</div>
 <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


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

      
    </body>

</html>
        