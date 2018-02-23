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
        
         <!-- Date Picker --> 
       <link href="<?php echo base_url(); ?>/assets/plugins/datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
        <!-- END Date Picker - END -->

        
        
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" ">
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12">
        	<br><br>
        	 <?php echo form_open_multipart('iso_movement_details/view_iso_movement_report_print', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Iso Date:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php  $data1 = array(
                        'name'        => 'iso_date',
                        'id'          => 'iso_date',
                        'value'       => set_value('iso_date'),
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
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Vehicle Number:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'vehicle_no',
                            'id'          => 'vehicle_no',
                            'value'       => set_value('vehicle_no'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Vehicle Number'
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
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Container Size:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
				   if(set_value('container_size')=="F"){ $checked="checked";}else{ $checked=""; }  
                $data6 = array(
                                'name'        => 'container_size',
                                'id'          => 'container_size',
                                'value'       => 'F',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Fourty</strong> &nbsp;
			   <?php
			   if(set_value('container_size')=="T"){ $checked="checked";}else{ $checked=""; }   
                $data6 = array(
                                'name'        => 'container_size',
                                'id'          => 'container_size',
                                'value'       => 'T',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Twenty</strong><br>
                </div>
              </div> 
            </div> 
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Ey/Lo:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
				   if(set_value('ey_lo')=="E"){ $checked="checked";}else{ $checked=""; }  
                $data6 = array(
                                'name'        => 'ey_lo',
                                'id'          => 'ey_lo',
                                'value'       => 'E',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Empty</strong> &nbsp;
			   <?php
			   if(set_value('ey_lo')=="L"){ $checked="checked";}else{ $checked=""; }   
                $data6 = array(
                                'name'        => 'ey_lo',
                                'id'          => 'ey_lo',
                                'value'       => 'L',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Load</strong><br>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Load Type:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
				   if(set_value('im_ex')=="I"){ $checked="checked";}else{ $checked=""; }  
                $data6 = array(
                                'name'        => 'im_ex',
                                'id'          => 'im_ex',
                                'value'       => 'I',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Import</strong> &nbsp;
			   <?php
			   if(set_value('ey_lo')=="E"){ $checked="checked";}else{ $checked=""; }   
                $data6 = array(
                                'name'        => 'im_ex',
                                'id'          => 'im_ex',
                                'value'       => 'E',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Export</strong><br>
                </div>
              </div> 
            </div>
            </div>
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">From:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'from',
                            'id'          => 'from',
                            'value'       => set_value('from'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'From'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">To:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'to',
                            'id'          => 'to',
                            'value'       => set_value('to'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'To'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>
             <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Transport Name:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'transport_name',
                            'id'          => 'transport_name',
                            'value'       => set_value('transport_name'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Transport Name'
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
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Transport Amount:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                      $data1 = array(
                            'name'        => 'tp_amount',
                            'id'          => 'tp_amount',
                            'value'       => set_value('tp_amount'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Transport Amount'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Iso Amount:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'amount',
                            'id'          => 'amount',
                            'value'       => set_value('amount'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Amount'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>
              
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Load status:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
				   if(set_value('loading_status')=="L"){ $checked="checked";}else{ $checked=""; }  
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status',
                                'value'       => 'L',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Loading</strong> &nbsp;
			   <?php
			   if(set_value('loading_status')=="U"){ $checked="checked";}else{ $checked=""; }   
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status',

                                'value'       => 'U',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Unloading</strong>
                </div>
              </div> 
            </div>                
          </div>

          <div class="row"> 
          <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <div class="col-lg-6 col-md-6 col-sm-6"></div>
                <div class="col-lg-6 col-md-6 col-sm-6" >
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <div class="col-lg-6 col-md-6 col-sm-6"></div>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
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
                                <h3 class="title"><strong>ISO Movement Report</strong></h3>
                             </div>

                                        <div class="table-responsive" data-pattern="priority-columns">
                                        <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                           <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>EY/LO</th>
                                            <th>Load Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Transport Name</th>
                                            <th>Transport Amount</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($view_iso_movement_report->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Iso_mvnt_date)); ?></td>
                                            <td><?php if($row->Iso_mvnt_vehicle_type=="T"){ echo $row->Vehicle_dtl_number; } else{ echo $row->Iso_mvnt_other_vehicle_no; } ?></td>
                                            <td><?php
                                            echo $row->Iso_mvnt_container_no;
                                            if($row->Iso_mvnt_container_no2){
                                                echo '-'.$row->Iso_mvnt_container_no2;
                                            }
											 ?>
											</td> 
                                            <td><?php if($row->Iso_mvnt_ey_lo=="E"){ echo 'Empty'; } else { echo 'Load'; } ?></td> 
                                            <td><?php if($row->Iso_mvnt_im_ex=="I"){ echo 'Import'; } else { echo 'Export'; }  ?></td> 
                                            <td><?php if($row->Iso_mvnt_pickup_place){ echo $row->Iso_mvnt_pickup_place; } else{ '--';} ?></td>
                                            <td><?php if($row->Iso_mvnt_drop_place){ echo $row->Iso_mvnt_drop_place; } else{ '--';} ?></td>
                                            <td><?php 
                                                    echo $row->Transport_dtl_name;
                                                 ?>
                                            </td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Iso_mvnt_tp_amount; ?></span></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Iso_mvnt_amount; ?></span></td>
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
         <!-- Date Picker --> 
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> 
        <!-- END Date Picker - END -->


      </div>
    </body>

</html>
        