<?php 
include('include/header.php');
?>
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
                                <h1 class="title">Vehicle Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('vehicle_details/view_vehicle_report', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Vehicle No:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'Vehicle_no',
                            'id'          => 'Vehicle_no',
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
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Vehicle Permit Type:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" > 
                  <?php
                      $data1 = array(
                            'name'        => 'vehicle_permit_type',
                            'id'          => 'vehicle_permit_type',
                            'value'       => set_value('vehicle_permit_type'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Vehicle Permit Type'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Transport Type:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" > 
                   <span id="transport_type" class="" style="width:100%;" >
					<?php 
					if(set_value('transport')=='T'){ $checked = "checked"; }else{ $checked = ""; }  
                    $data6 = array(
                                    'name'        => 'transport_type',
                                    'id'          => 'thiru_transport',
                                    'value'       => 'T',
                                    'onclick'     => 'check_trans_type()',
									'checked'     => $checked
                                  ); 
                    echo form_radio($data6);
                   ?> <strong>Thirumala</strong> &nbsp;&nbsp; 
                   <?php 
				   if(set_value('transport')=="O"){ $checked = "checked"; }else{ $checked = ""; } 
                    $data6 = array(
                                    'name'        => 'transport_type',
                                    'id'          => 'other_transport',
                                    'value'       => 'O',
                                    'onclick'     => 'check_trans_type()',
									'checked'     => $checked
                                  ); 
                    echo form_radio($data6);
                   ?> <strong>Other</strong>
                   </span>
                </div>
              </div> 
            </div>
              
          </div>
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" ></div>           
            <div class="col-lg-4 col-md-4 col-sm-4" >
              <div class="col-lg-4 col-md-4 col-sm-4" ></div>  
              <div class="col-lg-4 col-md-4 col-sm-4" >
                <?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4" ></div> 
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4" ></div>
              </div>  
          
          
      </form>  

      <!-- start list driver details -->
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Vehicle Details List </h2>
                            <div class="actions panel_actions pull-right">
                                <i class="box_toggle fa fa-chevron-down"></i>
                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                <i class="box_close fa fa-times"></i>
             <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/vehicle_details/view_vehicle_report_print');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                            </div>
                        </header>
                        <div class="content-body">    <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">


                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Vehicle Number</th>
                                            <th>Make</th>
                                            <th>Permit</th>
                                            <th>Transports</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Vehicle Number</th>
                                            <th>Make</th>
                                            <th>Permit</th>
                                            <th>Transports</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($vehicle_details_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php echo $row->Vehicle_dtl_number; ?></td>
                                            <td><?php if($row->Vehicle_dtl_transport=="T"){ echo $row->Vehicle_dtl_make; }else{ echo '--'; } ?></td>
                                            <td><?php if($row->Vehicle_dtl_transport=="T"){echo $row->Vehicle_dtl_permit; }else{ echo '--'; } ?></td>
                                            <td><?php if($row->Vehicle_dtl_transport=="T"){ echo 'Thirumala'; }else{ echo $row->Transport_dtl_name; } ?></td>
                                        </tr>
                                    <?php $sno++; } ?>
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
        