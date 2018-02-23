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
   <a href='#' onclick='javascript:printDiv("printablediv")' style=" float:right;text-decoration:none; color:#000000;" ><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
    <div id='printablediv'>
   
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">
            <!-- START CONTENT -->
            <section id="=main-content" class=" ">
                <section class="wrapper =main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="text-center">
                                <h3 class="title"><strong>Sri Thirumala Transport</strong></h3>
                             </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <div class="content-body">    <div class="row">
                                     <div class="col-lg-12 col-md-12 col-sm-12">

                         <!-- start mail box for read daily movement details -->
                                <?php                                                                                         
                                    foreach ($view_driver_details->result() as $row)
                                    {                                                               
                                ?>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="mail_head" style="font-weight:bold;" ><?php echo $row->Driver_dtl_name; ?></h3>
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
                                                    <h4><strong>License</strong> : <img src="<?php echo base_url(); ?>/uploads/license/<?php echo $row->Driver_dtl_license_file; ?>" title="Driver License Copy" alt="<?php echo $row->Driver_dtl_license_file; ?>" class="img-thumbnail" width="100%" /></h4>
                                                </div>
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12 col-lg-12 col-sm-12">                                                
                                                    <hr>
                                                    <h3>Movement Details</h3><br>
                                                    <div class="table-responsive">
                                                        <table  cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <td class="text-center" ><h4>Movement Date</h4></td>
                                                                    <td class="text-center" ><h4>Place Name</h4></td>
                                                                    <td class="text-center"><h4>Vehicle No</h4></td>
                                                                    <td class="text-center"><h4>Rent</h4></td>
                                                                    <td class="text-center"><h4>Adv</h4></td>
                                                                    <td class="text-center"><h4>O.Exp</h4></td>
                                                                    <td class="text-center"><h4>Balance</h4></td>
                                                                   
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                                <?php
                                                                $total_advnce=0; $driver_total="0";   $total_oth_ex=0;
                                                                foreach ($view_driver_pay_amount->result() as $dri_pay) 
                                                                {
													                $driver_total=intval($dri_pay->Daily_mvnt_dtl_driver_total_pay);  
																	$add_adv=intval($dri_pay->Daily_mvnt_dtl_driver_total_pay)+intval($dri_pay->Daily_mvnt_dtl_advance);
                                                                    $total_advnce=intval($total_advnce)+intval($dri_pay->Daily_mvnt_dtl_advance);
																	$total_oth_ex=intval($total_oth_ex)+intval($dri_pay->Daily_mvnt_dtl_other_expences);
                                                                    
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center" >
                                                                    <?php 
                                                                    echo date('d-m-Y' ,strtotime($dri_pay->Daily_mvnt_dtl_date));
                                                                    ?>
                                                                    </td>
                                                                    <td class="text-center" >
                                                                    <?php 
                                                                        echo $dri_pay->Driver_pay_rate_place_name;
                                                                     ?> 
                                                                    </td>
                                                                    <td class="text-center" >
                                                                    <?php 
                                                                        echo $dri_pay->Vehicle_dtl_number;
                                                                     ?>
                                                                    </td>
                                                                     <td class="text-center" ><?php echo $dri_pay->Daily_mvnt_dtl_driver_total_pay; ?></td>
                                                                    <td class="text-center" ><?php echo $dri_pay->Daily_mvnt_dtl_advance; ?></td>
                                                                    <td class="text-center" ><?php
																	 if($dri_pay->Daily_mvnt_dtl_other_expences){ echo $dri_pay->	Daily_mvnt_dtl_other_expences; } else{ echo '0'; }
																	  ?></td>
                                                                    <td class="text-center" ><?php echo intval($add_adv)-intval($dri_pay->Daily_mvnt_dtl_other_expences); ?></td>
                                                                    
                                                                    
                                                                   
                                                                </tr> 
                                                                <?php } ?>                                                               
                                                            </tbody>
                                                        </table>
                                                         <h4>Net Amount (<i class="fa fa-inr"></i>): <?php echo $driver_total; ?></h4>
                                                        <h4>Total Advance (<i class="fa fa-inr"></i>): <?php echo $total_advnce; ?></h4>
                                                        <h4>Total Other Expenses (<i class="fa fa-inr"></i>): <?php echo $total_oth_ex; ?></h4>
                                                        <h4><span style='color:green;'>Total Balance (<i class="fa fa-inr"></i>): <?php  $net_bal=intval($driver_total)+intval($total_advnce); echo intval($net_bal)-intval($total_oth_ex); ?></span></h4>
                                                       
                                                    </div>
                                                </div>
                                            </div> 
                                        <?php } ?>
                                        

                                    
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
        