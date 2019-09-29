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
                                <h1 class="title">Add Iso Movement Details</h1> 
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
        <?php echo form_open_multipart('iso_movement_details/validate_iso_movement_details', 
		array('class'=>'form-horizontal', 'name'=>'iso_movement')); ?>
        
          <span style="color:red; "><?php echo validation_errors(); ?></span> 
          <div class="form-group">
            <label class="col-lg-3 control-label">ISO Date:</label>
            <div class="col-lg-8">              
              <?php
                 $data1 = array(
                        'name'        => 'iso_date',
                        'id'          => 'iso_date',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'data-format' => 'dd MM yyyy',
						'readonly'    =>'true',
                        'placeholder' => 'From'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Transport:</label>
            <div class="col-lg-8"> 
             <span id="transport_vehicle_type" class="" >              
             <?php
			 $data = array(
			 'name' => 'transport_type',
			 'id'   => 'thirumala_transport',
			 'value'=> 'T',
			 'onclick' => 'check_vehicle_type()'
			 );
			 echo form_radio($data);
			  ?>
              <strong>Thirumala Transport</strong>
              <?php 
			  $data = array(
			  'name' => 'transport_type',
			  'id'   => 'other_transport',
			  'value'=> 'O',
			  'onclick' => 'check_vehicle_type()'
			  );
			  echo form_radio($data);
			  ?>
              <strong>Other Transport</strong>
               </span>
            </div>
          </div>         
          <div class="form-group">
            <label class="col-lg-3 control-label">Vehicle Number:</label>
            <div class="col-lg-3">
             <?php
              $options_vehicle['']='Select Thirumala Vehicle';
                foreach($vehicle_number_list->result() as $Vehicle)
                {                  
                  $options_vehicle[$Vehicle->Vehicle_dtl_id] = $Vehicle->Vehicle_dtl_number;                   
                } 
                echo form_dropdown('vehicle_no', $options_vehicle, '', 'class="form-control" name="vehicle_no" id="vehicle_no"')               ?>
            </div>
            
              <div class="col-lg-3">
              <?php 
			  $data1 = array(
			  'name'  => 'other_vehicle',
			  'id'    => 'other_vehicle',
			  'value' => '',
			  'class' => 'form-control',
			  'placeholder' => 'Enter Other Vehicle Number'
			   ); 
			   echo form_input($data1);
			   ?>
              </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Container Size:</label>
            <div class="col-lg-8"> 
            <span id="container_feet_size" class="" >              
              <?php   
                $data6 = array(
                                'name'        => 'container_feet',
                                'id'          => 'container_feet',
								'class'       => 'container_feet',
                                'value'       => 'F',
								'onclick'     => 'check_validation_javascript()'
    							   
                              ); 
                echo form_radio($data6);
               ?> <strong>Fourty Feet</strong> &nbsp;&nbsp;
               
              <?php   
                $data7 = array(
                                'name'        => 'container_feet',
                                'id'          => 'container_twenty',
							    'class'       => 'container_feet',
                                'value'       => 'T',
								'onclick'     => 'check_validation_javascript()'
                              ); 
                echo form_radio($data7);
               ?> <strong>Twenty Feet</strong>
               </span>
              </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Ey/lo Type:</label>
            <div class="col-lg-8"> 
            <span id="ey_lo_type" class="" >              
              <?php   
                $data6 = array(
                                'name'        => 'ey_lo',
                                'id'          => 'empty',
                                'value'       => 'E',
								
    							   
                              ); 
                echo form_radio($data6);
               ?> <strong>Empty</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               
              <?php   
                $data7 = array(
                                'name'        => 'ey_lo',
                                'id'          => 'load',
                                'value'       => 'L',
							
                              ); 
                echo form_radio($data7);
               ?> <strong>Load</strong>
               </span>
              </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Load Type:</label>
            <div class="col-lg-8"> 
            <span id="im_ex_type" class="" >              
              <?php   
                $data6 = array(
                                'name'        => 'im_ex',
                                'id'          => 'import',
                                'value'       => 'I',
    							   
                              ); 
                echo form_radio($data6);
               ?> <strong>Import</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               
              <?php   
                $data7 = array(
                                'name'        => 'im_ex',
                                'id'          => 'export',
                                'value'       => 'E',
                              ); 
                echo form_radio($data7);
               ?> <strong>Export</strong>
               </span>
              </div>
          </div>
		   <div class="form-group">
            <label class="col-lg-3 control-label">Load Status:</label>
            <div class="col-lg-8"> 
            <span id="loading_status" class="" >              
              <?php   
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status_1',
                                'value'       => 'L',
								'class'       => 'loading_status'
                              ); 
                echo form_radio($data6);
               ?> <strong>Loading</strong> &nbsp;&nbsp; 
               <?php   
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status_2',
                                'value'       => 'U',
								'class'       => 'loading_status'
                              ); 
                echo form_radio($data6);
               ?> <strong>Unloading</strong> &nbsp;&nbsp; 
               <?php
               $data6 = array(
			        'name' => 'loading_status',
					'id'   => 'loading_status_3',
					'value' => 'OL',
					'class'       => 'loading_status'
			   );
			
			   echo form_radio($data6);
			    ?>
                <strong>OFF Loading</strong>
               </span>
              </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Container Number:</label>
            <div class="col-lg-3">
            <?php
			 $data2 = array(
                        'name'        => 'container_f',
                        'id'          => 'container_f',
                        'value'       => '',
                        'maxlength'   => '11',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Container Number',
						
                      ); 
                  echo form_input($data2);
                 
              ?>
           </div>
           <span id="container_twenty_size"></span>
           <span id="container_size"></span>
             <div class="col-lg-3" id="container_msg" >
            <?php
			 $data2 = array(
                        'name'        => 'container_t',
                        'id'          => 'container_t',
                        'value'       => '',
                        'maxlength'   => '11',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Container Number',
						
						
						
                      ); 
                  echo form_input($data2);
              ?>
            </div>
            </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Pick up:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'pick_up',
                        'id'          => 'pick_up',
                        'value'       => '',
                        'maxlength'   => '150',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Pickup'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Drop:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'drop',
                        'id'          => 'drop',
                        'value'       => '',
                        'maxlength'   => '150',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Drop'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div> 
		<?php
		/* 		  
          <div class="form-group">
            <label class="col-lg-3 control-label">From:</label>
            <div class="col-lg-3">              
              <?php
                $data1 = array(
                        'name'        => 'iso_from',
                        'id'          => 'iso_from',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'From'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
            &nbsp;
            <div class="col-lg-3">              
              <?php
                $data1 = array(
                        'name'        => 'iso_to',
                        'id'          => 'iso_to',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
					    'placeholder' => 'To'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
          </div> 
		  */?>
          <div class="form-group" id="loading_group">
            <label class="col-lg-3 control-label">Loading/Unloading:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'load_drop',
                        'id'          => 'load_drop',
                        'value'       => '',
                        'maxlength'   => '150',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Loading/Unloading'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Transport Name:</label>
            <div class="col-lg-8">              
              <?php 
                 $options_transport['']='Select Transport';
                foreach($transport_name_list->result() as $transport_name)
                {                  
                  $options_transport[$transport_name->Transport_dtl_id] = $transport_name->Transport_dtl_name;                   
                } 
                echo form_dropdown('transport_name', $options_transport, '', 'class="form-control" name="transport_name" id="transport_name"');
              ?>
            </div>
          </div> 		  
          <div class="form-group">
            <label class="col-lg-3 control-label">Transport Amount:</label>
            <div class="col-lg-8">              
              <?php 
                 $data1 = array(
                        'name'        => 'tp_amount',
                        'id'          => 'tp_amount',
                        'value'       => '',
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Transport Amount'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
          </div>
		   <div class="form-group">
            <label class="col-lg-3 control-label">Driver Name:</label>
            <div class="col-lg-8"> 
			   <?php                
                $options_driver_nme['']='Select Driver ';
                foreach($driver_list->result() as $driver_nme)
                {                  
                  $options_driver_nme[$driver_nme->Driver_dtl_id] = $driver_nme->Driver_dtl_name;                   
                } 
                echo form_dropdown('driver_name', $options_driver_nme, '', 'class="form-control" id="driver_name"');
              ?> 
            </div>
          </div> 
		   <div class="form-group">
            <label class="col-lg-3 control-label">Driver Advance:</label>
            <div class="col-lg-8">              
              <?php 
                 $data1 = array(
                        'name'        => 'driver_amount',
                        'id'          => 'driver_amount',
                        'value'       => '',
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Driver Advance'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
          </div>
            <div class="form-group">
            <label class="col-lg-3 control-label"> Iso Amount:</label>
            <div class="col-lg-8">              
              <?php 
                 $data1 = array(
                        'name'        => 'iso_amount',
                        'id'          => 'iso_amount',
                        'value'       => '',
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Amount'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', ' onclick="return form_valid();" class="btn btn-primary"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='iso_movement_details_list'" >
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
         <!--LOAD FILES AT PAGE END FOR FASTER LOADING -->
        
<!--<script src="<?php //echo base_url(); ?>/assets/js/jquery.js" type="text/javascript"></script>-->
<script>
		 
function check_validation_javascript()
{
	doc = document.iso_movement;
	if((document.getElementById('container_twenty').checked))
	{
		document.getElementById('container_t').disabled=false;
	}
	else    
	{
	     document.getElementById('container_t').disabled=true;
	}
	
}
 
</script>

 <script type="text/JavaScript">  
function check_vehicle_type() 
{
   if(document.getElementById('thirumala_transport').checked)
   {
    	 document.getElementById('other_vehicle').disabled=true;
		 document.getElementById('vehicle_no').disabled=false;
		 document.getElementById('transport_name').disabled=true;
   }
   else if(document.getElementById('other_transport').checked){
	   
	   document.getElementById('vehicle_no').disabled=true;
	   document.getElementById('other_vehicle').disabled=false;
	   document.getElementById('transport_name').disabled=false;
   }
   
}
function form_valid(){
	if(document.getElementById('other_transport').checked){
		if(document.getElementById('other_vehicle').value==""){
			alert('Please Enter Other Vehicle Number');
			document.getElementById('other_vehicle').focus();
			return false;
		}
		if(document.getElementById('transport_name').value==""){
			alert('Please Select Transport Name');
			document.getElementById('transport_name').focus();
			return false;
		}
		
	}
	if(document.getElementById('thirumala_transport').checked){
		if(document.getElementById('vehicle_no').value==""){
			alert('Please Select Vehicle Number');
			document.getElementById('vehicle_no').focus();
			return false;
		}
	}
}


$('.loading_status').click(function(e){
	if(e.target.value == "OL"){
		$('#loading_group').hide();
	}else{
		$('#loading_group').show();
	}
})

</script>
<?php include('include/footer.php');
include('validation/add_iso_movement_details.php');
?>
