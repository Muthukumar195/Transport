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
                                <h1 class="title">Due Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('due_details/view_due_report', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Vehicle Number:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'vehicle_number',
                            'id'          => 'vehicle_number',
                            'value'       => set_value('vehicle_number'),
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
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Due Date:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'due_date',
                            'id'          => 'due_date',
                            'value'       => set_value('due_date'),
                            'maxlength'   => '160',
                            'class'       => 'form-control datepicker',
                            'data-format' => 'dd MM yyyy',
                            'placeholder' => 'Enter Due Date'
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
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Due Amount:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'due_amount',
                            'id'          => 'due_amount',
                            'value'       => set_value('due_amount'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Due Amount'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Mutual Date:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'mutual_date',
                            'id'          => 'mutual_date',
                            'value'       => set_value('mutual_date'),
                            'maxlength'   => '160',
                            'class'       => 'form-control datepicker',
                            'data-format' => 'dd MM yyyy',
                            'placeholder' => 'Enter Mutual Date'
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
                <label class="col-lg-6 col-md-6 col-sm-6 control-label"></label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
				   if(set_value('up_coming_due')=="1"){ $checked="checked";}else{ $checked=""; }  
                $data6 = array(
                                'name'        => 'up_coming_due',
                                'id'          => 'up_coming_due',
                                'value'       => '1',
								'checked'     => $checked,
								
                              ); 
                echo form_checkbox($data6);
               ?> <strong>Up coming Month Due</strong> &nbsp;&nbsp;
                </div>
              </div> 
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2" ></div>
            <div class="col-lg-4 col-md-4 col-sm-4" >                   
              <div class="form-group">                
                <div class="col-lg-12 col-md-12 col-sm-12">              
                  <?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>                                 
                </div>
              </div>   
            </div>
            </div>
            
      </form>  
  
      <!-- start list driver details -->
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Due Details List </h2>
                            <div class="actions panel_actions pull-right">
                                <i class="box_toggle fa fa-chevron-down"></i>
                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                <i class="box_close fa fa-times"></i>
                                <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/due_details/view_due_report_print');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                            </div>
                        </header>
                        <div class="content-body">    <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                             <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Vehicle Number</th>
                                            <th>Due Date</th>
                                            <th>Mutual Date</th>
                                            <th>Due Amount</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                         <th>Sno</th>
                                         <th>Vehicle Number</th>
                                         <th>Due Date</th>
                                         <th>Mutual Date</th>
                                         <th>Due Amount</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php 
                                        $sno=1;                     
                                        foreach ($view_due_report->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td>
                                            <?php 
                                                echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
                                             ?>
                                             </td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Vehicle_due_dtl_due_date)); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Vehicle_due_dtl_mutual_date)); ?></td>
                                            <td><?php echo $row->Vehicle_due_dtl_amount; ?></td>
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
        