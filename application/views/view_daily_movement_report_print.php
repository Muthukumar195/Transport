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
		<link href="<?php echo base_url(); ?>/assets/plugins/daterangepicker/css/daterangepicker-bs3.css" rel="stylesheet" type="text/css" media="screen"/>
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
		 <link href="<?php echo base_url(); ?>/assets/plugins/datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
		<!-- DATE PICKER --> 
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 

        <!-- CORE CSS TEMPLATE - START -->
        <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->
      
        <!-- Date Pickers - END -->
        
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" ">
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12">
        	<br><br>
        	<?php echo form_open_multipart('daily_movement/view_daily_movement_report_print', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4"  >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Date:</label>
                <div class="col-lg-6 col-md-6 col-sm-6"  >              
                   <?php  
                $data1 = array(
                        'name'        => 'daily_movement_date',
                        'id'          => 'daily_movement_date daterange-1',
                        'value'       => set_value('daily_movement_date'),
                        'maxlength'   => '20',
                        'class'       => 'form-control daterange',
                        'data-format' => 'dd MM yyyy',
                        'placeholder' => 'Select a Date',
						'readonly'    => 'readonly'
                      ); 
                echo form_input($data1);?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Vehicle Number:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'vehicle_no',
                            'id'          => 'vehicle_no',
                            'value'       => set_value('vehicle_no'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Vehicle Name'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Conatiner Number:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'container_no',
                            'id'          => 'container_no',
                            'value'       => set_value('container_no'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Conatiner Name'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>
            </div>
             <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Place Name:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'place_name',
                            'id'          => 'place_name',
                            'value'       => set_value('place_name'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Place Name'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Party Name:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'party_name',
                            'id'          => 'party_name',
                            'value'       => set_value('party_name'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Party Name'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Driver Name:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'driver_name',
                            'id'          => 'driver_name',
                            'value'       => set_value('driver_name'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Driver Name'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>
            </div>
             <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Party Rent:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
                  $data2 = array(
                        'name'        => 'rent',
                        'id'          => 'rent',
                        'value'       => set_value('rent'),
                        'maxlength'   => '8',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Rent'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Transport Name:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
                  $data2 = array(
                        'name'        => 'tp_name',
                        'id'          => 'tp_name',
                        'value'       => set_value('tp_name'),
                        'maxlength'   => '8',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Transport Name'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
             <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Load Status:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php  
                if(set_value('loading_status')=='L'){ $checked='checked';  }else{ $checked=''; } 
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status_1',
                                'value'       => 'L',
                                'checked'     =>  $checked,
                              ); 
                echo form_radio($data6);
               ?> <strong>Loading</strong> &nbsp;&nbsp; 
               <?php   
                if(set_value('loading_status')=='U'){ $checked='checked';  }else{ $checked=''; } 
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status_2',
                                'value'       => 'U',
                                'checked'     =>  $checked,
                              ); 
                echo form_radio($data6);
               ?> <strong>Unloading</strong>
                </div>
              </div>  
            </div>
            </div>
             
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
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
    <a href='#' onclick='javascript:printDiv("printablediv")' style=" float:right;text-decoration:none; color:#000000;" ><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
    <div id='printablediv'>
   
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">
            <!-- START CONTENT -->
            <section id="=main-content" class=" ">
                <section class="wrapper =main-wrapper" style=''>
                    <div class="clearfix"></div>
  
                    <div class="col-lg-12">
                        <section class="box ">
                             <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="text-center">
                                <h3 class="title"><strong>Daily Movement Report</strong></h3>
                                        </div>
                                        <div class="table-responsive" data-pattern="priority-columns">
                                        <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped" width="100%" >
                                         <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>Place Name</th> 
                                            <th>Party Name</th> 
                                            <th>Driver Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
											$sno=1;                                                  
											foreach ($daily_movement_details_list->result() as $row)
											{                                                               
										?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)); ?></td>
                                            <td><?php if($row->Daily_mvnt_dtl_transport_type=="T"){ echo $row->Vehicle_dtl_number; } else{ echo $row->Daily_mvnt_dtl_other_vehicle_no; } ?></td>
                                            <td><?php 
											if($row->Daily_mvnt_dtl_container_type=='NC'){
												
												echo $row->Daily_mvnt_dtl_new_container_no;
											}
											elseif($row->Daily_mvnt_dtl_container_type=='BC'){ 
											echo $row->Party_billing_container_no; }
											 ?></td> 
                                            <td><?php echo $row->Driver_pay_rate_place_name; ?></td>
                                            <td><?php echo $row->Party_dtl_name; ?></td>
                                            <td><?php 
											if($row->Daily_mvnt_dtl_transport_type=='O'){
													echo "--";
												}
											else{
											     echo $row->Driver_dtl_name;
											 }
											 ?></td>
                                        </tr>
                                    <?php $sno++; } ?>
                                    </tbody>
                                 </table>
                                   </div>  
                                    </div>
                                </div>
                          
                        </section></div>
                </section>
	</section>
            <!-- END CONTENT -->
</div>
</div> 
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
         <!-- Date Picker --> 
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>/assets/plugins/daterangepicker/js/moment.min.js" type="text/javascript"></script> 
		<script src="<?php echo base_url(); ?>/assets/plugins/daterangepicker/js/daterangepicker.js" type="text/javascript"></script>		
        <!-- END Date Picker - END -->

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url(); ?>/assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/assets/js/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 

      </div>
    </body>

</html>
        