<?php 
include('include/header.php');
?>

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Driver Payment Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('driver_payment/driver_payment_report', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
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
          </div>
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Paid Date From:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'Paid_from',
                            'id'          => 'Paid_from',
                            'value'       => set_value('Paid_from'),
                            'maxlength'   => '160',
                            'class'       => 'form-control datepicker',
							'data-format' => 'dd MM yyyy',
                            'placeholder' => 'Select Date',
							'readonly'    => 'readonly'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Paid Date To:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                 <?php
                      $data1 = array(
                            'name'        => 'Paid_to',
                            'id'          => 'Paid_to',
                            'value'       => set_value('Paid_to'),
                            'maxlength'   => '160',
                            'class'       => 'form-control datepicker',
							'data-format' => 'dd MM yyyy',
                            'placeholder' => 'Select Date',
							'readonly'    => 'readonly'
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
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Movement Date From:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'movement_from',
                            'id'          => 'movement_from',
                            'value'       => set_value('movement_from'),
                            'maxlength'   => '160',
                            'class'       => 'form-control datepicker',
							'data-format' => 'dd MM yyyy',
                            'placeholder' => 'Select Date',
							'readonly'    => 'readonly'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Movement Date To:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                 <?php
                      $data1 = array(
                            'name'        => 'movement_to',
                            'id'          => 'movement_to',
                            'value'       => set_value('movement_to'),
                            'maxlength'   => '160',
                            'class'       => 'form-control datepicker',
							'data-format' => 'dd MM yyyy',
                            'placeholder' => 'Select Date',
							'readonly'    => 'readonly'
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
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Driver Pay Status:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                 <?php 
				  if(set_value('driver_pay_status')=="U"){ $checked="checked";}else{ $checked=""; }   
                $data6 = array(
                                'name'        => 'driver_pay_status',
                                'id'          => 'driver_pay_status',
                                'value'       => 'U',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Unpaid</strong> &nbsp;&nbsp; 
			   <?php  
			   if(set_value('driver_pay_status')=="P"){ $checked="checked";}else{ $checked=""; }  
                $data6 = array(
                                'name'        => 'driver_pay_status',
                                'id'          => 'driver_pay_status',
                                'value'       => 'P',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Paid</strong><br>
                </div>
              </div> 
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2" > </div> 
            <div class="col-lg-3 col-md-3 col-sm-3" >  
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
                            <h2 class="title pull-left">Driver Details List </h2>
                            <div class="actions panel_actions pull-right">
                                <i class="box_toggle fa fa-chevron-down"></i>
                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                <i class="box_close fa fa-times"></i>
                            </div>
                        </header>
                        <div class="content-body">    <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
  <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        	<th>Sno</th>
                                            <th>Movement Date</th>
                                            <th>Driver Name</th>
                                            <th>Place Name</th>
                                            <th>Pay Date</th>
                                            <th>Advance</th>
                                            <th>Balance</th>
                                            <th>Pay Status</th>
                                            <th>Other Expences</th>
                                            <th>Total</th>
                                          
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                         	<th>Sno</th>
                                            <th>Movement Date</th>
                                            <th>Driver Name</th>
                                            <th>Place Name</th>
                                            <th>Pay Date</th>
                                            <th>Advance</th>
                                            <th>Balance</th>
                                            <th>Pay Status</th>
                                            <th>Other Expences</th>
                                            <th>Total</th>
                                          
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php  
										 $sno=1;                                                   
                                        foreach ($driver_payment_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                        	<td><?php echo $sno ?></td>
                                            <td><?php echo anchor('daily_movement/read_daily_movement_details?id='.$row->Driver_pymnt_di_mvnt_id.'', date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)), 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Daily Movement Detail" data-placement="bottom"' );
                                             ?></td>
                                            <td><?php echo anchor('driver_details/view_driver_details?id='.$row->Daily_mvnt_dtl_driver_name.'', $row->Driver_dtl_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Detail" data-placement="bottom"' );
                                             ?></td>
                                            <td><?php echo anchor('driver_pay_rate/view_driver_pay_details?id='.$row->Daily_mvnt_dtl_place.'', $row->Driver_pay_rate_place_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Pay Rate Detail" data-placement="bottom"' );
                                             ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Driver_pymnt_pay_date)); ?></td>
                                             <td><?php echo $row->Daily_mvnt_dtl_advance; ?></td>
                                              <td><?php $total=intval($row->Daily_mvnt_dtl_driver_total_pay)+intval($row->Driver_pymnt_other_expences);
											   echo intval($total)-intval($row->Daily_mvnt_dtl_advance);?></td>
                                            <td><?php
											 if($row->Driver_pymnt_status=="U"){
												  echo "<span style='color:red;'>Unpaid</span>";
											 }
											 else{
												  echo "<span style='color:green;'>Paid</span>";
												
											 }
											  ?></td>
                                            <td><?php echo $row->Driver_pymnt_other_expences; ?></td>
                                            <td><?php echo $total; ?></td>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                           
                                            <?php } ?>
                                        </tr>
                                   <?php  $sno++; } ?>
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
        