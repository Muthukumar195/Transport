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
                                <h1 class="title">Edit Driver Payment</h1>                            
                             </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body">

                    <div class="row">
                       
                       <!-- edit form column -->
                       <div class="col-md-12 col-sm-12 col-lg-12 personal-info">
                       <?php if($this->session->flashdata('success_msg')!=null){ ?>
                        <div class="alert alert-success alert-dismissable">
                          <a class="panel-close close" data-dismiss="alert">×</a> 
                          <i class="fa fa-check-square"></i>
                          <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>  
                        <?php } ?>    
                        
                        <!-- <form class="form-horizontal" role="form"> -->        
                        <?php echo form_open_multipart('driver_payment/validate_edit_driver_payment', array('class'=>'form-horizontal'));        
                        foreach ($driver_payment_data->result() as $row)
                        {            
                        ?>
                          <span style="color:red; "><?php echo validation_errors(); ?></span>   
                             <div class="form-group">
                            <label class="col-lg-3 control-label">Driver Name:</label>
                            <div class="col-lg-8">              
                             <?php
                                $driver_name['']='Select Driver Name';
                                foreach($movement_date->result() as $driver)
                                {                  
                                  $driver_name[$driver->Daily_mvnt_dtl_driver_name] = $driver->Driver_dtl_name;                   
                                } 
                                echo form_dropdown('driver_name', $driver_name, $row->Daily_mvnt_dtl_driver_name, 'class="form-control" id="driver_name"');
                              ?>
                            </div>
                          </div>
                            <div class="form-group">
                            <label class="col-lg-3 control-label">Daily Movement Date:</label>
                             <div class="col-lg-8">              
							 <?php
                                $options_date['']='Select Daily Movement Date';
                                foreach($movement_date->result() as $mvt_date)
                                {                  
                                  $options_date[$mvt_date->Daily_mvnt_dtl_id] = date('d-m-Y', strtotime($mvt_date->Daily_mvnt_dtl_date));                   
                                } 
                                echo form_dropdown('movement_date', $options_date, $row->Daily_mvnt_dtl_id, 'class="form-control" name="movement_date" id="driver_name_list" ');
                                
                              ?>
                            </div>
                          </div>                          
                          <input type="hidden" id="id" name="id" value="<?php echo $row->Driver_pymnt_id; ?>">
                         
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Date of Driver Pay:</label>
                            <div class="col-lg-8">              
                              <?php 
                                  $data2 = array(
                                        'name'        => 'pay_date',
                                        'id'          => 'pay_date',
                                        'value'       => date('d-m-Y', strtotime($row->Driver_pymnt_pay_date)),
                                        'maxlength'   => '10',
                                        'class'       => 'form-control datepicker',
                                        'data-format' => 'dd MM yyyy',
                                        'onkeyup'     => 'checkInt(this)',
                                        'placeholder' => 'Select Pay Date',
                                        'readonly'    => 'readonly'
                                      ); 
                                  echo form_input($data2);
                              ?>
                            </div>
                          </div>
                         <div class="form-group">
                        <label class="col-lg-3 control-label">Driver Pay Status:</label>
                        <div class="col-lg-8">              
                          <span id="driver_pay_status" class="">
                          <?php   
						  if($row->Driver_pymnt_pay_status=="U"){ $checked="checked"; } else{ $checked=''; }
                            $data6 = array(
                                            'name'        => 'driver_pay_status',
                                            'id'          => 'driver_pay_status',
                                            'value'       => 'U',
											'checked'     => $checked
                                          ); 
                            echo form_radio($data6);
                           ?> <strong>Unpaid</strong> &nbsp;&nbsp; 
                           <?php 
						   if($row->Driver_pymnt_pay_status=="P"){ $checked="checked"; } else{ $checked=''; }  
                            $data6 = array(
                                            'name'        => 'driver_pay_status',
                                            'id'          => 'driver_pay_status',
                                            'value'       => 'P',
											'checked'     => $checked
                                          ); 
                            echo form_radio($data6);
                           ?> <strong>Paid</strong><br>
                           </span> 
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Driver Remark:</label>
                        <div class="col-lg-8"> 
                        <?php  
							$data = array(
							  'name'        => 'driver_remark',
							  'id'          => 'driver_remark',
							  'value'       => $row->Driver_pymnt_remarks,
							  'rows'        => '5',
							  'cols'        => '10',
							  'style'       => '',
							  'class'	   => 'form-control'
							);
						
						  echo form_textarea($data); 
						?>          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Driver Advance:</label>
                        <div class="col-lg-8">              
                          <?php 
                              $data2 = array(
                                    'name'        => 'driver_advance',
                                    'id'          => 'driver_advance',
                                    'value'       => $row->Daily_mvnt_dtl_advance,
                                    'maxlength'   => '10',
                                    'class'       => 'form-control',
                                    'data-format' => 'dd MM yyyy',
                                    'onkeyup'     => 'checkInt(this)',
                                    'readonly'    => 'readonly',
                                    'placeholder' => 'Driver Advance'
                                  ); 
                              echo form_input($data2);
                          ?>
                        </div>
                      </div>
                      
                     <div class="form-group">
                        <label class="col-lg-3 control-label">Driver Other Expences:</label>
                        <div class="col-lg-8">              
                          <?php 
                              $data2 = array(
                                    'name'        => 'other_expences',
                                    'id'          => 'other_expences',
                                    'value'       => $row->Driver_pymnt_other_expences,
                                    'maxlength'   => '10',
                                    'class'       => 'form-control',
                                    'data-format' => 'dd MM yyyy',
                                    'placeholder' => 'Other Expences',
                                    
                                  ); 
                              echo form_input($data2);
                          ?>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Total:</label>
                        <div class="col-lg-8">              
                          <?php 
                              $data2 = array(
                                    'name'        => 'driver_total',
                                    'id'          => 'driver_total',
                                    'value'       =>  $row->Daily_mvnt_dtl_driver_total_pay,
                                    'maxlength'   => '10',
                                    'class'       => 'form-control',
                                    'data-format' => 'dd MM yyyy',
                                    'onkeyup'     => 'checkInt(this)',
                                    'placeholder' => 'Total Amount',
                                    'readonly'    => 'readonly'
                                  ); 
                              echo form_input($data2);
                          ?>
                        </div>
                      </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">              
                              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
                              <span></span>
                              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='driver_pay_rate_list'" >
                            </div>
                          </div> 
                          <?php } ?>
                      </form>
                       
                      </div>
                  </div>
                  <!-- End .row -->
                
                            </div>
                        </section></div>

                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->
        <script>
		$(document).ready(function(){
        $('#driver_name').change(function(){
			/*alert('dsfsd');*/
			var driver_name = document.getElementById('driver_name').value;
			/*alert(driver_name);*/
				$.ajax({
					type:"GET",
					url:"<?php echo base_url(); ?>/index.php/daily_movement/check_driver_name",
					data:{"driver_name": driver_name},
					success: function(data)
					{				
						/*alert(data);*/
						$('#driver_name_list').html(data);

						
					}
			 });
			
        });
   });
   	$(document).ready(function(){
        $('#driver_name_list').change(function(){
			/*alert('dsfsd');*/
			  var movement_adv = document.getElementById('driver_name_list').value;
			/*alert(driver_advance);*/
				$.ajax({
					type:"GET",
					url:"<?php echo base_url(); ?>/index.php/daily_movement/check_driver_adv",
					data:{"movement_adv": movement_adv},
					success: function(data)
					{				
						/*alert(data);*/
						document.getElementById('driver_advance').value=data;					
						
					}
			 });
			
        });
   });
   	$(document).ready(function(){
        $('#driver_name_list').change(function(){
			/*alert('dsfsd');*/
			  var driver_total = document.getElementById('driver_name_list').value;
			/*alert(driver_advance);*/
				$.ajax({
					type:"GET",
					url:"<?php echo base_url(); ?>/index.php/daily_movement/check_driver_total",
					data:{"driver_total": driver_total},
					success: function(data)
					{				
						/*alert(data);*/
						document.getElementById('driver_total').value=data;					
						
					}
			 });
			
        });
   });
   
	</script>

<?php include('include/footer.php');
include('validation/add_driver_payment_details.php');
?>
        