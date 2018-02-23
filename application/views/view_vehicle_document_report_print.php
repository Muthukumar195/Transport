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
        
        
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />
        <link href="<?php echo base_url(); ?>/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="<?php echo base_url(); ?>/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen"/>

    </head>
		
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" ">
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12">
        	<br><br>
					 <?php echo form_open_multipart('vehicle_document_details/view_vehicle_document_report_print', array('class'=>'form-horizontal')); ?>
                  <span style="color:red; "><?php echo validation_errors(); ?></span> 
                  <div class="row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">M.Permit From:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'm_permit_from',
                                'id'          => 'm_permit_from',
                                'value'       => set_value('m_permit_from'),
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
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">M.Permit To:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'm_permit_to',
                                'id'          => 'm_permit_to',
                                'value'       => set_value('m_permit_to'),
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
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">N.Permit From:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'n_permit_from',
                                'id'          => 'n_permit_from',
                                'value'       => set_value('n_permit_from'),
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
                  </div>
        
                  <div class="row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">N.Permit To:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'n_permit_to',
                                'id'          => 'n_permit_to',
                                'value'       => set_value('n_permit_to'),
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
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">AP.Permit From:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'ap_permit_from',
                                'id'          => 'ap_permit_from',
                                'value'       => set_value('ap_permit_from'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    =>'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'From'
                              ); 
                          echo form_input($data1);?>
                        </div>
                      </div> 
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">AP.Permit To:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'ap_permit_to',
                                'id'          => 'ap_permit_to',
                                'value'       => set_value('ap_permit_to'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    =>'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'To'
                              ); 
                          echo form_input($data1);?>
                        </div>
                      </div> 
                    </div>                  
                  </div>
                  <div class="row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Insurance From:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'insurance_from',
                                'id'          => 'insurance_from',
                                'value'       => set_value('insurance_from'),
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
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Insurance To:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'insurance_to',
                                'id'          => 'insurance_to',
                                'value'       => set_value('insurance_to'),
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
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Tax From:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'tax_from',
                                'id'          => 'tax_from',
                                'value'       => set_value('tax_from'),
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
                  </div>
        
                  <div class="row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Tax To:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'tax_to',
                                'id'          => 'tax_to',
                                'value'       => set_value('tax_to'),
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
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Fc From:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'fc_from',
                                'id'          => 'fc_from',
                                'value'       => set_value('fc_from'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    =>'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'Fc'
                              ); 
                          echo form_input($data1);?>
                        </div>
                      </div> 
                    </div>                 
                  
                  <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">Fc To:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                           <?php  $data1 = array(
                                'name'        => 'fc_to',
                                'id'          => 'fc_to',
                                'value'       => set_value('fc_to'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    =>'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'Fc'
                              ); 
                          echo form_input($data1);?>
                        </div>
                      </div> 
                    </div>
                    </div>
                  <div class="row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">P.Certificate From:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                          <?php  $data1 = array(
                                'name'        => 'pc_from',
                                'id'          => 'pc_from',
                                'value'       => set_value('pc_from'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    =>'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'P Certificate'
                              ); 
                          echo form_input($data1);?>
                        </div>
                      </div> 
                    </div>           
                    <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group" >
                        <label class="col-lg-6 col-md-6 col-sm-6 control-label">P.Certificate To:</label>
                        <div class="col-lg-6 col-md-6 col-sm-6" >              
                           <?php  $data1 = array(
                                'name'        => 'pc_to',
                                'id'          => 'pc_to',
                                'value'       => set_value('pc_to'),
                                'maxlength'   => '20',
                                'class'       => 'form-control datepicker',
                                'readonly'    =>'true',
                                'data-format' => 'dd MM yyyy',
                                'placeholder' => 'P Certificate'
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
                                    'name'        => 'Vehicle_number',
                                    'id'          => 'Vehicle_number',
                                    'value'       => set_value('Vehicle_number'),
                                    'maxlength'   => '160',
                                    'class'       => 'form-control',
                                    'placeholder' => 'Enter Vehicle Number'
                                  ); 
                              echo form_input($data1);
                          ?>
                        </div>
                      </div> 
                     </div>               
                  </div>
                 <div class="row"> 
                    <div class="col-lg-3 col-md-3 col-sm-3" >
                         
                    </div>           
                    <div class="col-lg-4 col-md-4 col-sm-4" > 
                      <div class="form-group" >
                        <div class="col-lg-8 col-md-8 col-sm-8"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4" >              
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
                                <h3 class="title"><strong>Vehicle Document Details</strong></h3>
                             </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="table-responsive" data-pattern="priority-columns">
                                        <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Vehicle Number</th>
                                            <th>M.Permit</th>
                                            <th>N.permit</th>
                                            <th>AP.permit</th>
                                            <th>Insurance</th>
                                            <th>FC</th>
                                            <th>Tax</th>
                                            <th>Pollution Certificate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $sno=1; 
                                                                
                                        foreach ($vehicle_document_details_list->result() as $row)
                                        {                                                              
                                    ?>
                                      <tr>
                                            <td><?php echo $sno; ?></td>
                                           <td>
                                            <?php 
                                                echo $row->Vehicle_dtl_number;
                                             ?>
                                            </td>
                                            <td><?php if($row->Vehicle_doc_dtl_m_permit_from=="1970-01-01"&&$row->Vehicle_doc_dtl_m_permit_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_m_permit_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_m_permit_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_n_permit_from=="1970-01-01"&&$row->Vehicle_doc_dtl_n_permit_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_n_permit_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_n_permit_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_ap_permit_from=="1970-01-01"&&$row->Vehicle_doc_dtl_ap_permit_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_ap_permit_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_ap_permit_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_insurance_from=="1970-01-01"&&$row->Vehicle_doc_dtl_insurance_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_insurance_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_insurance_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_fc_from=="1970-01-01"&&$row->Vehicle_doc_dtl_fc_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_fc_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_fc_to)); } ?></td>
                                           <td><?php if($row->Vehicle_doc_dtl_tax_from=="1970-01-01"&&$row->Vehicle_doc_dtl_tax_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_tax_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_tax_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_pc_from=="1970-01-01"&&$row->Vehicle_doc_dtl_pc_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_pc_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_pc_to)); } ?></td>               
                                            
                                            
                                        </tr>
                                    <?php $sno++;   } ?>
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
        