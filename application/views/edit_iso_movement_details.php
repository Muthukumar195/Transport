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
                                <h1 class="title">Edit ISO Movement Details</h1>                            
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
        <?php echo form_open_multipart('iso_movement_details/validate_edit_iso_movement_details', array('class'=>'form-horizontal','name'=>'iso_movement' , "onsubmit"=>"return validate()"));
        foreach ($iso_movement_details_data->result() as $row)
        {            
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
           <div class="form-group">
            <label class="col-lg-3 control-label">ISO Date:</label>
            <div class="col-lg-8">              
              <?php
                 $data1 = array(
                        'name'        => 'iso_date',
                        'id'          => 'iso_date',
                        'value'       => date("d M Y", strtotime($row->Iso_mvnt_date)),
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'data-format' => 'dd MM yyyy',
						'readonly'    =>'true',
                        'placeholder' => 'From'
                      ); 
                  echo form_input($data1);
              ?>
               <input type="hidden" id="id" name="id" value="<?php echo $row->Iso_mvnt_id; ?>">
            </div>
          </div>         
          <div class="form-group">
            <label class="col-lg-3 control-label">Transport:</label>
            <div class="col-lg-8"> 
             <span id="transport_vehicle_type" class="" >              
             <?php
			 if($row->Iso_mvnt_vehicle_type=="T"){ $checked="checked"; } else{ $checked=""; }
			 $data = array(
			 'name' => 'transport_type',
			 'id'   => 'thirumala_transport',
			 'value'=> 'T',
			 'checked'=>$checked,
			 'onclick' => 'check_vehicle_type()'
			 );
			 echo form_radio($data);
			  ?>
              <strong>Thirumala Transport</strong>
              <?php
			  if($row->Iso_mvnt_vehicle_type=="O"){ $checked="checked"; } else{ $checked=""; } 
			  $data = array(
			  'name' => 'transport_type',
			  'id'   => 'other_transport',
			  'value'=> 'O',
			  'checked'=>$checked,
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
                echo form_dropdown('vehicle_no', $options_vehicle, $row->Iso_mvnt_vehicle_no, 'class="form-control" name="vehicle_no" id="vehicle_no"')               ?>
             
            </div>
            
              <div class="col-lg-3">
              <?php 
			  $data1 = array(
			  'name'  => 'other_vehicle',
			  'id'    => 'other_vehicle',
			  'value' => $row->Iso_mvnt_other_vehicle_no,
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
              <?php 
			   if($row->Iso_mvnt_container_type=='F'){ $checked='checked';  }else{ $checked=''; }  
                $data6 = array(
                                'name'        => 'container_feet',
                                'id'          => 'container_feet',
                                'value'       => 'F',
								'checked'     =>  $checked,
								'class'       => 'container_feet',
								'onclick'     => 'check_validation_javascript()'
								
                              ); 
                echo form_radio($data6);
               ?> <strong>Fourty Feet</strong> &nbsp;&nbsp; 
              <?php   
			   if($row->Iso_mvnt_container_type=='T'){  $checked='checked';   }else{ $checked=''; }
                $data6 = array(
                                'name'        => 'container_feet',
                                'id'          => 'container_twenty',
                                'value'       => 'T',
								'checked'     =>  $checked,
								'class'       => 'container_feet',
								'onclick'     => 'check_validation_javascript()'
								
                              ); 
                echo form_radio($data6);
               ?> <strong>Twenty Feet</strong>
              </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Ey/lo Type:</label>
            <div class="col-lg-8"> 
            <span id="ey_lo_type" class="" >              
              <?php
			  if($row->Iso_mvnt_ey_lo=="E"){ $checked="checked"; } else{ $checked=""; }   
                $data6 = array(
                                'name'        => 'ey_lo',
                                'id'          => 'empty',
                                'value'       => 'E',
								'checked'     => $checked
								
    							   
                              ); 
                echo form_radio($data6);
               ?> <strong>Empty</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               
              <?php  
			  if($row->Iso_mvnt_ey_lo=="L"){ $checked="checked"; } else{ $checked=""; }  
                $data7 = array(
                                'name'        => 'ey_lo',
                                'id'          => 'load',
                                'value'       => 'L',
							    'checked'     => $checked
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
			  if($row->Iso_mvnt_im_ex=="I"){ $checked="checked"; } else{ $checked=""; }    
                $data6 = array(
                                'name'        => 'im_ex',
                                'id'          => 'import',
                                'value'       => 'I',
    							 'checked'     => $checked  
                              ); 
                echo form_radio($data6);
               ?> <strong>Import</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <?php  
			  if($row->Iso_mvnt_im_ex=="E"){ $checked="checked"; } else{ $checked=""; }     
                $data7 = array(
                                'name'        => 'im_ex',
                                'id'          => 'export',
                                'value'       => 'E',
								'checked'     => $checked
                              ); 
                echo form_radio($data7);
               ?> <strong>Export</strong>
               </span>
              </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Container Number:</label>
            <div class="col-lg-3">
            <?php
                 $data2 = array(
                        'name'        => 'container_f',
                        'id'          => 'container_type',
                        'value'       => $row->Iso_mvnt_container_no,
                        'maxlength'   => '11',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Container Number',
						
                      ); 
                  echo form_input($data2); 
              ?>
            </div>
            <span id="container_twenty_size" style="color:#036;"  class="" ></span>
             <div class="col-lg-3">
             <?php
                $data2 = array(
                        'name'        => 'container_t',
                        'id'          => 'container_t',
                        'value'       => $row->Iso_mvnt_container_no2,
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
                        'value'       => $row->Iso_mvnt_pickup_place,
                        'maxlength'   => '150',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Pick up'
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
                        'value'       => $row->Iso_mvnt_drop_place,
                        'maxlength'   => '150',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Drop'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
         <div class="form-group">
            <label class="col-lg-3 control-label">Load Status:</label>
            <div class="col-lg-8"> 
            <span id="loading_status" class="" >              
              <?php
			  if($row->Iso_mvnt_loading_status=="L"){ $checked='checked'; }else{ $checked='';}   
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status_1',
                                'value'       => 'L',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Loading</strong> &nbsp;&nbsp; 
               <?php
			   if($row->Iso_mvnt_loading_status=="U"){ $checked='checked'; }else{ $checked='';}      
                $data6 = array(
                                'name'        => 'loading_status',
                                'id'          => 'loading_status_2',
                                'value'       => 'U',
								'checked'     => $checked
                              ); 
                echo form_radio($data6);
               ?> <strong>Unloading</strong>&nbsp;&nbsp; 
                <?php
				 if($row->Iso_mvnt_loading_status=="OL"){ $checked='checked'; }else{ $checked='';}  
               $data6 = array(
			        'name' => 'loading_status',
					'id'   => 'loading_status_3',
					'value' => 'OL',
					'checked' => $checked
			   );
			
			   echo form_radio($data6);
			    ?>
               </span>
              </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">From:</label>
            <div class="col-lg-3">              
              <?php
                $data1 = array(
                        'name'        => 'iso_from',
                        'id'          => 'iso_from',
                        'value'       => $row->Iso_mvnt_from,
                        'maxlength'   => '50',
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
                        'value'       => $row->Iso_mvnt_to,
                        'maxlength'   => '50',
                        'class'       => 'form-control',
					    'placeholder' => 'To'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
          </div> 
            <div class="form-group">
            <label class="col-lg-3 control-label">Drop:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'load_drop',
                        'id'          => 'load_drop',
                        'value'       => '',
                        'maxlength'   => '150',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Drop'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Transport Name:</label>
            <div class="col-lg-8">              
              <?php 
                 $options_transport['']='Transport Name';
                foreach($transport_name_list->result() as $transport_name)
                {                  
                  $options_transport[$transport_name->Transport_dtl_id] = $transport_name->Transport_dtl_name;                   
                } 
                echo form_dropdown('transport_name', $options_transport, $row->Iso_mvnt_transport_name, 'class="form-control" name="transport_name" id="transport_name"');
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
                        'value'       =>  $row->Iso_mvnt_tp_amount,
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
            <label class="col-lg-3 control-label">Iso Amount:</label>
            <div class="col-lg-8">              
              <?php 
                 $data1 = array(
                        'name'        => 'iso_amount',
                        'id'          => 'iso_amount',
                        'value'       => $row->Iso_mvnt_amount,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Name'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
          </div> 
          <div class="form-group">
            <label class="col-lg-3 control-label">Paid Date:</label>
            <div class="col-lg-8">              
              <?php 
                 $data1 = array(
                        'name'        => 'paid_date',
                        'id'          => 'paid_date',
                        'value'       => date("d M Y", strtotime($row->Iso_mvnt_paid_date)),
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'data-format' => 'dd MM yyyy',
						'readonly'    =>'true',
                        'placeholder' => 'Paid Date'
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
         LOAD FILES AT PAGE END FOR FASTER LOADING 

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
function validate() 
{
if( document.iso_movement.vehicle_no.value == "-1" )
   {
     alert( "Please select Vehicle Number!" );
     return false;
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
   }
   else if(document.getElementById('other_transport').checked){
	   
	   document.getElementById('vehicle_no').disabled=true;
	   document.getElementById('other_vehicle').disabled=false;
   }
   
}

if(document.getElementById('thirumala_transport').checked)
   {
    	 document.getElementById('other_vehicle').disabled=true;
		 document.getElementById('vehicle_no').disabled=false;
		 document.getElementById('transport_name').disabled=true;
   }
   else if(document.getElementById('other_transport').checked){
	   
	   document.getElementById('vehicle_no').disabled=true;
	   document.getElementById('other_vehicle').disabled=false;
	   document.getElementById('transport_name').disabled=true;
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
</script>
<?php include('include/footer.php');
include('validation/add_iso_movement_details.php');
?>