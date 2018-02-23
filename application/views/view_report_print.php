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
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12">
        	<br><br>
        	<?php echo form_open_multipart('driver_details/view_report_print', array('class'=>'form-horizontal')); ?>
                  <div class="row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4" align="left"  >
                        <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Driver Name:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php
                              $data1 = array(
                                    'name'        => 'full_name',
                                    'id'          => 'full_name',
                                    'value'       => set_value('full_name'),
                                    'maxlength'   => '160',
                                    'class'       => 'form-control',
                                    'placeholder' => 'Enter Name'
                                  ); 
                              echo form_input($data1);
                          ?>
                        </div>
                      </div> 
                    </div>           
                    <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Driver Category Type:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php
                            $options = array(
                              ''  => '-- Select Type --',
                              'P'    => 'Permanent',
                              'A'   => 'Acting'                  
                            );     
                            $class_nme = 'class="form-control" id="driver_type"';       
                            echo form_dropdown('driver_type', $options, set_value('driver_type'), $class_nme);
                          ?>
                        </div>
                      </div> 
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group">                
                        <div class="col-lg-12 col-md-12 col-sm-12" align="center">              
                          <?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>                                 
                        </div>
                      </div> 
                    </div>                    
                    </div> 
              </form>  
        </div>
    </div>
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
                                <h2 class="title pull-left">Total Number of Records &nbsp; - &nbsp; <strong><?php echo count($driver_details_list->result()); ?></strong></h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>                                    
                                    <a href='#' onclick='javascript:printDiv("printablediv")' style="text-decoration:none; color:#000000;" ><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                    <!--<i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                                    <i class="box_close fa fa-times"></i>-->
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="table-responsive" data-pattern="priority-columns">
                                        <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Name</th>
                                                    <th>Phone No</th>
                                                    <th>Address</th>
                                                    <th>License File</th>
                                                    <th>Driver Category</th>
                                                    
                                                </tr>
                                            </thead>
        
                                            <tfoot>
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Name</th>
                                                    <th>Phone No</th>
                                                    <th>Address</th>
                                                    <th>License File</th>
                                                    <th>Driver Category</th>                                      
                                                </tr>
                                            </tfoot>
        
                                            <tbody>
                                            <?php 
                                                $sno=1;                                                    
                                                foreach ($driver_details_list->result() as $row)
                                                {                                                               
                                            ?>
                                                <tr>
                                                    <td><?php echo $sno; ?></td>
                                                    <td>
                                                    <?php 
                                                      echo $row->Driver_dtl_name;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php 
                                                      echo $row->Driver_dtl_phone;
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php 
                                                      echo $row->Driver_dtl_address;
                                                    ?>
                                                    </td>
                                                    <td width="10%">
                                                        <img src="<?php echo base_url(); ?>/uploads/license/<?php echo $row->Driver_dtl_license_file; ?>"  title="Driver License" alt="<?php echo $row->Driver_dtl_license_file; ?>" class="img-rounded" width="65%" />
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        if($row->Driver_dtl_type=='P')
                                                        {
                                                           echo 'Permanent';   
                                                        }
                                                        else
                                                        {
                                                            echo "Acting";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php $sno++; } ?>
                                            </tbody>
                                    </table>
                                        </div>  


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
        