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
                                <h1 class="title">Add Driver Payment</h1>                            
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
        <?php echo form_open_multipart('iso_movement_details/validate_iso_driver_payment', array('class'=>'form-horizontal')); 
        foreach ($iso_movement_details->result() as $row) {
          # code...
        }
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span> 
           <div class="form-group">
		    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->Iso_mvnt_id; ?>"/>
            <label class="col-lg-3 control-label">Driver Name:</label>
            <div class="col-lg-8"> 
			   <?php                
                $options_driver_nme['']='Select Driver ';
                foreach($driver_list->result() as $driver_nme)
                {                  
                  $options_driver_nme[$driver_nme->Driver_dtl_id] = $driver_nme->Driver_dtl_name;                   
                } 
                echo form_dropdown('driver_name', $options_driver_nme, $row->Iso_mvnt_driver_name, 'class="form-control" id="driver_name" disabled="disabled"');
              ?> 
            </div>
          </div> 
          <div class="form-group">
            <label class="col-lg-3 control-label">D/N Padi:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'driver_amount',
                        'id'          => 'driver_amount',
                        'value'       => $row->Iso_mvnt_driver_amount,
                        'maxlength'   => '10',
                        'class'       => 'form-control driverCalc',					 
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'D/N Padi	'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
		   <div class="form-group">
            <label class="col-lg-3 control-label">Trip Padi:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'driver_trip_amount',
                        'id'          => 'driver_trip_amount',
                        'value'       => $row->Iso_mvnt_driver_trip_amount,
                        'maxlength'   => '10',
                        'class'       => 'form-control driverCalc',					 
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Driver Trip Padi'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
		   <div class="form-group">
            <label class="col-lg-3 control-label">Driver Mamul:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'driver_mamul',
                        'id'          => 'driver_mamul',
                        'value'       => $row->Iso_mvnt_driver_mamul,
                        'maxlength'   => '10',
                        'class'       => 'form-control driverCalc',					 
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Driver Mamul'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
		   <div class="form-group">
            <label class="col-lg-3 control-label">Driver Other Expense:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'driver_other_ex',
                        'id'          => 'driver_other_ex',
                        'value'       => $row->Iso_mvnt_driver_other_ex,
                        'maxlength'   => '10',
                        'class'       => 'form-control driverCalc',					 
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Other Expense'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
		   <div class="form-group">
            <label class="col-lg-3 control-label">PO Expense:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'po_expense',
                        'id'          => 'po_expense',
                        'value'       => $row->Iso_mvnt_driver_po_ex,
                        'maxlength'   => '10',
                        'class'       => 'form-control driverCalc',					 
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'PO Expense'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
		   <div class="form-group">
            <label class="col-lg-3 control-label">PC Expenses:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'pc_expense',
                        'id'          => 'pc_expense',
                        'value'       => $row->Iso_mvnt_driver_pc_ex,
                        'maxlength'   => '10',
                        'class'       => 'form-control driverCalc',					 
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Driver PC Expenses'
                      ); 
                  echo form_input($data2);
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
                        'value'       => $row->Iso_mvnt_driver_adv,
                        'maxlength'   => '10',
                        'class'       => 'form-control driverCalc',					 
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Driver Advance'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
		   <div class="form-group">
            <label class="col-lg-3 control-label">Other Expences Remark:</label>
            <div class="col-lg-8">
             <?php  
                $data = array(
				  'name'        => 'o_ex_remark',
				  'id'          => 'o_ex_remark',
				  'value'       =>  $row->Iso_mvnt_driver_remark,
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
            <label class="col-lg-3 control-label">Total:</label>
            <div class="col-lg-8">
            <input type="text" name="total" id="total" class="form-control" disabled="true"/>
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
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
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
<script type="text/javascript">
/*List*/
$(document).ready(function() {
	driver_calc();
});
$(document).on('change', '.driverCalc', function(){
	driver_calc();	 
});
function driver_calc(){
	var driver_amt = ($('#driver_amount').val() != "")? $('#driver_amount').val() : 0;
	var driver_trip_amt = ($('#driver_trip_amount').val() != "")? $('#driver_trip_amount').val() : 0;
	var driver_mamul = ($('#driver_mamul').val() != "")? $('#driver_mamul').val() : 0;
	var driver_other_ex = ($('#driver_other_ex').val() != "")? $('#driver_other_ex').val() : 0;
	var po_expense = ($('#po_expense').val() != "")? $('#po_expense').val() : 0;
	var pc_expense = ($('#pc_expense').val() != "")? $('#pc_expense').val() : 0;
	var driver_advance = ($('#driver_advance').val() != "")? $('#driver_advance').val() : 0;
	
	var driver_total = (parseInt(driver_amt) + parseInt(driver_trip_amt) + parseInt(driver_mamul) + parseInt(driver_other_ex) + parseInt(po_expense) + parseInt(pc_expense) - parseInt(driver_advance))
 
	$('#total').val(driver_total);
}
</script>
        