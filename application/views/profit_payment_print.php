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
        <link href="<?php echo base_url(); ?>/assets/plugins/datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
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
                          
                    <div class="col-lg-12">                
                         <div id='printablediv'>
                               <section class="box ">
                                      <div class="row" style="margin-top:250px;">
                                    
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h3 class="text-left" style="font-weight:bold;">l</h5>
                                <h6 class="text-right"><strong>Date : <?php echo date('d-m-Y'); ?></strong></h6>
                                         <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Movement Date</th>
                                                        <th data-priority="1">Transport Type</th>
                                                        <th data-priority="1">Vehicle No</th>
                                                        <th data-priority="1">Place Name</th>
                                                        <th data-priority="3">Party name</th>
                                                        <th data-priority="3">Driver Name</th>
                                                        <th data-priority="6">Party Rent</th>
                                                        <th data-priority="6">Driver rent</th>
                                                        <th data-priority="6">Transport rent</th>
                                                        <th data-priority="6">Expences</th>
                                                        <th data-priority="6">Mamul</th>
                                                        <th data-priority="6">Profit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sno=1; 
												$p_rent='';  $d_rent=''; $t_rent='';  $o_ex='';  $tot_profit='';  $d_rent_cal=''; $mamul='';                                            
											      foreach ($daily_movement_details_list->result() as $row){                                                               
										         ?>
                                                    <tr>
                                                        <th><?php 
														 echo date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date));
														  ?></th>
                                                        <td>
														<?php if($row->Daily_mvnt_dtl_transport_type=="T"){ echo "Thirumala";}
																	else{ echo $row->Transport_dtl_name;} ?>
                                                        </td>
                                                        <td><?php 
                                                    echo  $row->Vehicle_dtl_number; ?> 
                                                       </td>
                                                        <td><?php 
                                                    echo $row->Driver_pay_rate_place_name; ?> 
                                                    	</td>
                                                        <td><?php echo  $row->Party_dtl_name;  ?>
                                                        </td>
                                                        <td><?php 
														if(empty($row->Daily_mvnt_dtl_driver_name)=='True'){
															echo "--";
														}
														else{
													echo $row->Driver_dtl_name;	} ?>
                                                    	</td>
                                                        <td><span class="text-info"> 
														<?php echo $row->Daily_mvnt_dtl_rent?></span></td>
                                                        <td><span class="text-purple">
                                                         <?php 
														if(empty($row->Daily_mvnt_dtl_driver_name)=='True'){
															echo "--"; $d_rent_cal=0;
														}else{
														 echo $d_rent_cal = $row->Daily_mvnt_dtl_driver_total_pay;
														}
												 		 ?></span></td>
                                                         <td><span class="text-orange">
                                                         <?php echo $row->Daily_mvnt_dtl_trp_rent; ?></span></td>
                                                        <td><span class="text-purple">
                                                         <?php
														 if(($row->Daily_mvnt_dtl_driver_name=='')&&($row->Daily_mvnt_dtl_transport_type=="O")){
															 $expences = 'T:'.$row->Daily_mvnt_dtl_trp_expences;
														 }
														 if(($row->Daily_mvnt_dtl_driver_name!='')&&($row->Daily_mvnt_dtl_transport_type=="O")){
															$expences = 'D:'.$row->Daily_mvnt_dtl_trp_expences.'/ T:'.$row->Daily_mvnt_dtl_trp_expences; 
														 }
														 if($row->Daily_mvnt_dtl_transport_type=="T"){
														 $expences ='D:'.$row->Daily_mvnt_dtl_other_expences;
														 }
														 echo $expences;
														   ?></span></td>
                                                            <td><span class="text-info">
                                                         <?php echo $row->Daily_mvnt_dtl_party_mamul; ?></span></td>
                                                        <td><span class="text-success">
														<?php
														//other Transport
														if(($row->Daily_mvnt_dtl_driver_name=='')&&($row->Daily_mvnt_dtl_transport_type=="O")){
															if($row->Daily_mvnt_dtl_trp_sum=='A'){
															 $balance = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_trp_expences);
															}else{
															 $balance = intval($row->Daily_mvnt_dtl_trp_rent)+intval($row->Daily_mvnt_dtl_trp_expences);
															}
														}
														if(($row->Daily_mvnt_dtl_driver_name!='')&&($row->Daily_mvnt_dtl_transport_type=="O")){
															if($row->Daily_mvnt_dtl_trp_sum=='A'){
																$trns_cal = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_trp_expences);
															}else{
																$trns_cal = intval($row->Daily_mvnt_dtl_trp_rent)+intval($row->Daily_mvnt_dtl_trp_expences);
															}
															
															$dr_cal = intval($row->Daily_mvnt_dtl_driver_total_pay)+intval($row->Daily_mvnt_dtl_other_expences);
															$balance = intval($trns_cal)+intval($dr_cal);
														}
														//Thirumala Transport
														if($row->Daily_mvnt_dtl_transport_type=="T"){
														 $balance = intval($row->Daily_mvnt_dtl_driver_total_pay)+intval($row->Daily_mvnt_dtl_other_expences);
														}
														
														 
														 
														 //sabari and murugan transport
														 if(($row->Daily_mvnt_dtl_transport_type=="O")&&($row->Daily_mvnt_dtl_trp_name=="13")||($row->Daily_mvnt_dtl_trp_name=="14")){
															if($row->Daily_mvnt_dtl_trp_sum=='A'){
															 $balance = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_trp_expences);
															}else{
															 $balance = intval($row->Daily_mvnt_dtl_trp_rent)+intval($row->Daily_mvnt_dtl_trp_expences);																																						                                                                 } 															
														   }
														 $tot_rent = intval($row->Daily_mvnt_dtl_rent)-intval($balance);  
														echo $profit = intval($tot_rent)+intval($row->Daily_mvnt_dtl_party_mamul)
														 ?></span></td>
                                                    </tr> 
                                                    <?php 
													$p_rent = intval($p_rent)+intval($row->Daily_mvnt_dtl_rent);
													$d_rent = intval($d_rent)+intval($d_rent_cal);
													$t_rent = intval($t_rent)+intval($row->Daily_mvnt_dtl_trp_rent);
													$o_ex = intval($o_ex)+intval($row->Daily_mvnt_dtl_other_expences)+intval($row->Daily_mvnt_dtl_trp_expences);
													$mamul = intval($mamul)+intval($row->Daily_mvnt_dtl_party_mamul);
													$tot_profit = intval($tot_profit)+intval($profit);
													?>
                                                    <?php $sno++; } ?>
                                                </tbody>
                                                 <tfoot>
                                                <tr>
                                                   <th colspan="6" align="right"><span style="float:right;"  class="text-success">Total </span></th>
                                                    <th><span class="text-info"><i class="fa fa-inr"></i> <?php echo $p_rent;?></span></th>
                                                    <th><span class="text-purple"><i class="fa fa-inr"></i> <?php echo $d_rent;?></span></th>
                                                    <th><span class="text-orange"><i class="fa fa-inr"></i> <?php echo $t_rent;?></span></th>
                                                    <th><span class="text-purple"><i class="fa fa-inr"></i> <?php echo $o_ex;?></span></th>
                                                    <th><span class="text-info"><i class="fa fa-inr"></i> <?php echo $mamul;?></span></th>
                                                    <th><span class="text-success"><i class="fa fa-inr"></i> <?php echo $tot_profit;?></span></th>
                                                </tr>
                                            </tfoot>
                                            </table>
                                   </div>
                                    </div>
                            </section>
                          
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
        