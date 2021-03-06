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
    <div id='printablediv'>
   
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">
            <!-- START CONTENT -->
            <section id="=main-content" class=" ">
                <section class="wrapper =main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="text-center">
                                <h1 class="title">Report</h1>
                                <h3 class="title"><strong>Date : <?php echo date('l jS \of F Y'); ?></strong></h3>
                                <h3 class="title">Transaction Details</h3>
                             </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Total Number of Records &nbsp; - &nbsp; <strong><?php echo count($read_party_billing->result()); ?></strong></h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>                                    
                                    <a href='#' onclick='javascript:printDiv("printablediv")' style="text-decoration:none; color:#000000;" ><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                    <!--<i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                                    <i class="box_close fa fa-times"></i>-->
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                     <?php                                              
                                    foreach ($read_party_billing->result() as $row)
                                    {                                                               
                                    ?>
                                    <div class="table-responsive" data-pattern="priority-columns">
                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php echo date('d-m-y', strtotime($row->Party_billing_date)); ?></h3>  
                                    <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped" width="50%">
                                    <thead>
                                  <tbody>   
                                  <tr>
                                  <th width="50%"  style="text-align:center">Date</th>
                                  <td width="50%" style="text-align:center"><?php echo date('d-m-y', strtotime($row->Party_billing_date)); ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Party Name</th>
                                  <td width="50%" style="text-align:center"><?php echo $row->Party_dtl_name; ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Container Number</th>
                                  <td width="50%" style="text-align:center"> <?php echo $row->Party_billing_container_no; ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Consignee</th>
                                  <td width="50%" style="text-align:center"> <?php echo $row->Party_billing_consignee; ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Consignor</th>
                                  <td width="50%" style="text-align:center"><?php echo $row->Party_billing_consignor; ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Material</th>
                                  <td width="50%" style="text-align:center"><?php echo $row->Party_billing_material; ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">INV No</th>
                                  <td width="50%" style="text-align:center"><?php echo $row->Party_billing_ini_no; ?> </td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Phone No</th>
                                  <td width="50%" style="text-align:center"><?php echo $row->Party_billing_ph_no; ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">From</th>
                                  <td width="50%" style="text-align:center"><?php echo $row->Party_billing_from; ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">To</th>
                                  <td width="50%" style="text-align:center"><?php echo $row->Party_billing_to; ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Bill Received Date</th>
                                 <td width="50%" style="text-align:center"><?php echo date('d-m-Y', Strtotime($row->Party_billing_bill_recd_dt)) ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">EY Vaild Date</th>
                                  <td width="50%" style="text-align:center"><?php echo date('d-m-Y', Strtotime($row->Party_billing_ey_valid_dt)) ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">CNS No</th>
                                  <td width="50%" style="text-align:center"><?php echo $row->Party_billing_cni_no; ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Train No</th>
                                  <td width="50%" style="text-align:center"><?php if($row->Party_billing_train_no){ echo $row->Party_billing_train_no; } else{ '--';} ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">U/L Date</th>
                                  <td width="50%" style="text-align:center"><?php if($row->Party_billing_ul_date=="1970-01-01"){ echo '--'; } else{ echo $row->Party_billing_ul_date; } ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Last Date</th>
                                   <td width="50%" style="text-align:center"><?php if($row->Party_billing_last_date=="1970-01-01"){ echo '--'; } else{ echo $row->Party_billing_last_date; } ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Empty</th>
                                  <td width="50%" style="text-align:center"><?php if($row->Party_billing_empty){ echo $row->Party_billing_empty; } else{ '--';}  ?></td>
                                  </tr>
                                  <tr>
                                  <th width="50%"  style="text-align:center">Remark</th>
                                  <td width="50%" style="text-align:center"><?php if($row->Party_billing_remark){ echo $row->Party_billing_remark; } else{ '--'; } ?></td>
                                  </tr>
                                 
                                  </tbody> 
                                  </thead>
                                  </table>               
                                    </div>  
                                   <?php } ?>

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
        