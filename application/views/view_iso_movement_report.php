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
                                <h1 class="title">Iso Movement Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                <?php echo form_open_multipart('iso_movement_details/view_iso_movement_report', array('class'=>'form-horizontal')); ?>
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
                  <?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>  
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
               
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                    
                </div>
              </div> 
            </div>          
          </div>
          
      </form>  
      <!-- start list driver details -->
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Iso Movement Details List </h2>
                            <div class="actions panel_actions pull-right">
                                <i class="box_toggle fa fa-chevron-down"></i>
                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                <i class="box_close fa fa-times"></i>
                                <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/iso_movement_details/view_iso_movement_report_print');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                            </div>
                        </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
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

                                    <tfoot>
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
                                    </tfoot>

                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($view_iso_movement_report->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><a href="view_iso_movement_details?id=<?php echo $row->Iso_mvnt_id; ?>" target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View ISO Movement Detail" data-placement="bottom"><?php echo date('d-m-Y', strtotime($row->Iso_mvnt_date)); ?></a></td>
                                            <td> <?php 
											if($row->Iso_mvnt_vehicle_type=="O"){
												echo $row->Iso_mvnt_other_vehicle_no;
											}else{
                                                    echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
											}
                                                 ?>  </td>
                                            <td> <?php
                                            echo  $row->Iso_mvnt_container_no;
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
                                                    echo anchor('transport_details/view_transport_details?id='.$row->Transport_dtl_id.'', $row->Transport_dtl_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Transport Detail" data-placement="bottom"' );
                                                 ?></td>
                                                 <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Iso_mvnt_tp_amount; ?></span></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Iso_mvnt_amount; ?></span></td>
                                        </tr>
                                    <?php $sno++; } ?>
                                    </tbody>
                            </table>

                           </div>

                            </div>
                    </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        