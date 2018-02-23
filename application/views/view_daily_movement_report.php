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
                                <h1 class="title">Daily Movement Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('daily_movement/view_daily_movement_report', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4"  >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Date:</label>
                <div class="col-lg-6 col-md-6 col-sm-6"  >              
                   <?php  
                $data1 = array(
                        'name'        => 'daily_movement_date',
                        'id'          => 'daily_movement_date',
                        'value'       => set_value('daily_movement_date'),
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
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

      <!-- start list driver details -->
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Daily Movement Details List </h2>
                            <div class="actions panel_actions pull-right">
                                <i class="box_toggle fa fa-chevron-down"></i>
                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                <i class="box_close fa fa-times"></i>
                                <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/daily_movement/view_daily_movement_report_print');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                            </div>
                        </header>
                        <div class="content-body">    <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">

                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Transport Type</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>Place Name</th> 
                                            <th>Party Name</th> 
                                            <th>Driver Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Transport Type</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>Place Name</th> 
                                            <th>Party Name</th> 
                                            <th>Driver Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php 
											$sno=1;                                                  
											foreach ($daily_movement_details_list->result() as $row)
											{                                                               
										?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><a href="read_daily_movement_details?id=<?php echo $row->Daily_mvnt_dtl_id;?>" target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Daily Movement Detail" data-placement="bottom"><?php echo date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)); ?></a></td>
                                            <td>
                                            <?php
											if($row->Daily_mvnt_dtl_transport_type=="T"){
												echo "Thirumala Transport"; 
											}
											else{
												echo $row->Transport_dtl_name;
											}
											?>
                                            </td>
                                            <td>
                                               <?php 
                                                    echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
												
                                                 ?>                                              
                                            </td>
                                            <td>
                                                <?php 
											if($row->Daily_mvnt_dtl_container_type=='NC'){
												
												echo $row->Daily_mvnt_dtl_new_container_no;
											}
											elseif($row->Daily_mvnt_dtl_container_type=='BC'){ 
											echo $row->Party_billing_container_no; }
											 ?>                                                 
                                            </td> 
                                            <td>
                                                <?php 
                                                    echo anchor('driver_pay_rate/view_driver_pay_details?id='.$row->Daily_mvnt_dtl_place.'', $row->Driver_pay_rate_place_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Pay Rate Detail" data-placement="bottom"' );
                                                 ?> 

                                            </td>
                                            <td><?php echo $row->Party_dtl_name; ?></td>
                                            <td><?php 
											if($row->Daily_mvnt_dtl_transport_type=='O'){
													echo "--";
												}
											else{
											     echo $row->Driver_dtl_name;
											 } ?></td>
                                             <td>
                                             <a href="edit_daily_movement_details?id=<?php echo $row->Daily_mvnt_dtl_id; ?>" alt="Edit" target="_blank" class="btn btn-purple" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Daily Movement Detail" data-placement="bottom"> Edit </a>
                                             
                                             </td>
                                             
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
        