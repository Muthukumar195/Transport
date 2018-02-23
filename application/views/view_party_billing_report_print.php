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
        	<?php echo form_open_multipart('party_billing/view_party_billing_report_print', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4"  >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Date:</label>
                <div class="col-lg-6 col-md-6 col-sm-6"  >              
                   <?php 
                  $data2 = array(
                        'name'        => 'billing_date',
                        'id'          => 'billing_date',
                        'value'       => set_value('billing_date'),
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
						'placeholder' => 'Select Bill Date'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Party Name:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                               
              <?php
                $options_party['']='Select Party Name';
                foreach($party_name_list->result() as $party)
                {                  
                  $options_party[$party->Party_dtl_id] = $party->Party_dtl_name;
				                  
                } 
                echo form_dropdown('party_name', $options_party, set_value('party_name'), 'class="form-control" id="party_name"');
              ?>
                
              </div> 
            </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Conatiner Number:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
                  $data2 = array(
                        'name'        => 'container_no',
                        'id'          => 'container_no',
                        'value'       => set_value('container_no'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Container Number'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            </div>
             <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Material:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                    <?php 
                  $data2 = array(
                        'name'        => 'material',
                        'id'          => 'material',
                        'value'       => set_value('material'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Material'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Consignee:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php 
                  $data2 = array(
                        'name'        => 'consignee',
                        'id'          => 'consignee',
                        'value'       => set_value('consignee'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Consignee'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Consignor:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
                  $data2 = array(
                        'name'        => 'consignor',
                        'id'          => 'consignor',
                        'value'       => set_value('consignor'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Consignor'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            </div>
             <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">INV No:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                    <?php 
                  $data2 = array(
                        'name'        => 'int_no',
                        'id'          => 'int_no',
                        'value'       => set_value('int_no'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter INT No'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">From:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                $data1 = array(
                        'name'        => 'billing_from',
                        'id'          => 'billing_from',
                        'value'       => set_value('billing_from'),
                        'maxlength'   => '20',
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
                        'name'        => 'billing_to',
                        'id'          => 'billing_to',
                        'value'       => set_value('billing_to'),
                        'maxlength'   => '20',
                        'class'       => 'form-control',
					    'placeholder' => 'To'
                      ); 
                  echo form_input($data1);
              ?>
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
                            <div class="text-center">
                                <h3 class="title"><strong>Party Billing Report</strong></h3>
                             </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="table-responsive" data-pattern="priority-columns">
                                        <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">  
                                          <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Party Name</th>
                                            <th>Container No</th>
                                            <th>Consignee</th>
                                            <th>Consignor</th>
                                            <th>Material</th>
                                            <th>INI No</th>
                                            <th>From</th>
                                            <th>To</th>
                                           
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($party_billing_report->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php  echo $sno; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Party_billing_date)); ?></td>
                                            <td><?php echo $row->Party_dtl_name; ?></td>
                                            <td><?php echo $row->Party_billing_container_no; ?></td>
                                            <td><?php echo $row->Party_billing_consignee; ?></td>
                                            <td><?php echo $row->Party_billing_consignor; ?></td>
                                            <td><?php echo $row->Party_billing_material; ?></td>
                                            <td><?php echo $row->Party_billing_ini_no; ?></td>
                                            <td><?php echo $row->Party_billing_from; ?></td>
                                            <td><?php echo $row->Party_billing_to; ?></td>
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
        <!-- END Date Picker - END -->

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url(); ?>/assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/assets/js/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 

      </div>
    </body>

</html>
        