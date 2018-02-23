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
                                <h1 class="title">Edit Vehicle Details</h1>                            </div>


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
        <?php echo form_open_multipart('vehicle_details/validate_edit_vehicle_details', array('class'=>'form-horizontal'));
        foreach ($vehicle_details_data->result() as $row)
        {
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
          <div class="form-group">
            <label class="col-lg-3 control-label">Vehicle Number:</label>
            <div class="col-lg-8">              
              <?php
                  $data1 = array(
                        'name'        => 'vehicle_number',
                        'id'          => 'vehicle_number',
                        'value'       => $row->Vehicle_dtl_number,
                        'maxlength'   => '20',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Vehicle Number'
                      ); 
                  echo form_input($data1);
              ?>
              <input type="hidden" id="id" name="id" value="<?php echo $row->Vehicle_dtl_id; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Vehicle Make:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'vehicle_make',
                        'id'          => 'vehicle_make',
                        'value'       => $row->Vehicle_dtl_make,
                        'maxlength'   => '60',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Vehicle Make'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Vehicle Permit:</label>
            <div class="col-lg-8">             
              <?php 
                  $data2 = array(
                        'name'        => 'vehicle_permit',
                        'id'          => 'vehicle_permit',
                        'value'       => $row->Vehicle_dtl_permit,
                        'maxlength'   => '120',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Vehicle Permit'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div> 
           <div class="form-group">
            <label class="col-lg-3 control-label">Transport Type:</label>
            <div class="col-lg-8">   
            <span id="transport_type" class="" style="width:100%;" > 
                <?php  
				if($row->Vehicle_dtl_transport="T"){ $check = "checked"; }else{ $check =""; }
                $data6 = array(
                                'name'        => 'transport_type',
                                'id'          => 'thiru_transport',
                                'value'       => 'T',
								'onclick'     => 'check_trans_type()',
								'checked'     => $check
                              ); 
                echo form_radio($data6);
               ?> <strong>Thirumala Transport</strong> &nbsp;&nbsp; 
               <?php   
                $data6 = array(
                                'name'        => 'transport_type',
                                'id'          => 'other_transport',
                                'value'       => 'O',
								'onclick'     => 'check_trans_type()',
								'checked'     => $check
                              ); 
                echo form_radio($data6);
               ?> <strong>Other Transport</strong>
               </span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Transport name:</label>
            <div class="col-lg-8">             
              <?php 
                 foreach($transport_name->result() as $trans){
					 $option_trans[''] = "Select Transport name";
					 $option_trans[$trans->Transport_dtl_id] = $trans->Transport_dtl_name;
				 }
				 echo form_dropdown('trans_name',$option_trans,$row->Vehicle_dtl_transport_name,'class="form-control" id="trans_name"');
              ?>
            </div>
          </div>
                    
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='vehicle_details_list'" >
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

<?php include('include/footer.php');
include('validation/edit_vehicle_details.php');
?>
<script type="text/javascript">
if(document.getElementById('other_transport').checked){
		
		document.getElementById('vehicle_make').disabled=true;
		document.getElementById('vehicle_permit').disabled=true;
		document.getElementById('trans_name').disabled=false;
	}
	else if(document.getElementById('thiru_transport').checked){
		
		document.getElementById('vehicle_make').disabled=false;
		document.getElementById('vehicle_permit').disabled=false;
		document.getElementById('trans_name').disabled=true;
	}
function check_trans_type(){
	
	if(document.getElementById('other_transport').checked){
		
		document.getElementById('vehicle_make').disabled=true;
		document.getElementById('vehicle_permit').disabled=true;
		document.getElementById('trans_name').disabled=false;
	}
	else if(document.getElementById('thiru_transport').checked){
		
		document.getElementById('vehicle_make').disabled=false;
		document.getElementById('vehicle_permit').disabled=false;
		document.getElementById('trans_name').disabled=true;
	}

}
</script>

        