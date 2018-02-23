<?php 
include('include/header.php');
?>

<style type="text/css">
div#partyerror span.ValidationErrors {
	position:relative !important;
	left:15px !important;
	margin-bottom: -13px !important;
}
span.ErrorField {
    color: rgba(118, 118, 118, 1.0) !important;
}
</style>
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Add Driver Payment Details</h1>                            
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
        <?php echo form_open_multipart('driver_payment/validate_driver_payment_details', array('class'=>'form-horizontal')); 
       
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span> 
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Driver Name:</label>
            <div class="col-lg-8">              
             <?php
			 $id = $this->input->get('id');
                $driver_name['']='Select Driver Name';
                foreach($driver_list->result() as $driver)
                {                  
                  $driver_name[$driver->Driver_dtl_id] = $driver->Driver_dtl_name;                   
                } 
                echo form_dropdown('driver_name', $driver_name, $id, 'class="form-control" id="driver_name"');
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Amount ( <i class="fa fa-inr"></i> ):</label>
            <div class="col-lg-8">              
             <?php 
                  $data2 = array(
                        'name'        => 'driver_amount',
                        'id'          => 'driver_amount',
                        'value'       => '',
                        'maxlength'   => '10',
                        'class'       => 'form-control',
						'onkeyup'     => 'checkInt(this)',
                        'placeholder' => 'Enter Amount',
						
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Date of Driver Pay:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'pay_date',
                        'id'          => 'pay_date',
                        'value'       => '',
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
                $data6 = array(
                                'name'        => 'driver_pay_status',
                                'id'          => 'driver_pay_status',
                                'value'       => 'U'
                              ); 
                echo form_radio($data6);
               ?> <strong>Unpaid</strong> &nbsp;&nbsp; 
			   <?php   
                $data6 = array(
                                'name'        => 'driver_pay_status',
                                'id'          => 'driver_pay_status',
                                'value'       => 'P'
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
				  'id'          => '', 
				  'value'       => '',
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
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='driver_payment_list'" >
            </div>
          </div> 
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
        