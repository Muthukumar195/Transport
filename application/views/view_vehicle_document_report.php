<?php include('include/header.php'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Vehicle Document Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
         <?php echo form_open_multipart('vehicle_document_details/view_vehicle_document_report', array('class'=>'form-horizontal')); ?>
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

      <!-- start list driver details -->
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Vehicle Document Details List </h2>
                            <div class="actions panel_actions pull-right">
                                <i class="box_toggle fa fa-chevron-down"></i>
                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                <i class="box_close fa fa-times"></i>
                                <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/vehicle_document_details/view_vehicle_document_report_print');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                            </div>
                        </header>
                        <div class="content-body">    <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
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
                                    <tfoot>
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
                                    </tfoot>
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
                                                echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank"  alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
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
                </section>
      <!-- end list driver details -->   
                         <!-- end mail box for read daily movement details -->   
                     

                     </div>   
                            


                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        