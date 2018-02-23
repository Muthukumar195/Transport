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
                                <h1 class="title">Add Transport Expences</h1>                            
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
        <?php echo form_open_multipart('daily_movement/validate_add_transport_expenses', array('class'=>'form-horizontal')); 
        foreach ($read_daily_movement_details->result() as $row) {
          # code...
        }
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span> 
          <div class="form-group">
            <label class="col-lg-3 control-label">Daily Movement Date:</label>
            <div class="col-lg-8">              
             <?php  
                $data1 = array(
                        'name'        => 'daily_movement_date',
                        'id'          => 'daily_movement_date',
                        'value'       => date("d M Y", strtotime($row->Daily_mvnt_dtl_date)),
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
                        'data-format' => 'dd MM yyyy',
                        'placeholder' => 'Select a Date',
						'readonly'    => 'readonly'
                      ); 
                echo form_input($data1);?>
              <input type="hidden" id="id" name="id" value="<?php echo $row->Daily_mvnt_dtl_id; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Transport Name:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'trans_name',
                        'id'          => 'trans_name',
                        'value'       => $row->Transport_dtl_name,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'placeholder' => 'Transport Name',
						'readonly'    => 'readonly'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
         
          <div class="form-group">
            <label class="col-lg-3 control-label">Transport Advance:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'trans_advance',
                        'id'          => 'trans_advance',
                        'value'       => $row->Daily_mvnt_dtl_trp_adv,
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
            <label class="col-lg-3 control-label">Transport Expences Remark:</label>
            <div class="col-lg-8">
            <span id="sum" class="" >              
             <?php
			 if($row->Daily_mvnt_dtl_trp_sum=="A"){ $chk = "checked"; }else{ $chk = ""; }
			 $data = array(
			 'name' => 'sum',
			 'id'   => 'sum',
			 'value'=> 'A',
			 'checked' => $chk
			 );
			 echo form_radio($data);
			  ?>
              <strong>Add</strong>
              <?php 
			   if($row->Daily_mvnt_dtl_trp_sum=="S"){ $chk = "checked"; }else{ $chk = ""; }
			  $data = array(
			  'name' => 'sum',
			  'id'   => 'sum',
			  'value'=> 'S',
			 'checked' => $chk
			  );
			  echo form_radio($data);
			  ?>
              <strong>Sub</strong>
               </span>
            </div>
          </div>
         <div class="form-group">
            <label class="col-lg-3 control-label">Transport Expences:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'trans_expences',
                        'id'          => 'trans_expences',
                        'value'       => $row->Daily_mvnt_dtl_trp_expences,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
						'data-format' => 'dd MM yyyy',
						'onkeyup'     => 'checkInt(this)',
                        'placeholder' => 'Other Expences',
						
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Transport Expences Remark:</label>
            <div class="col-lg-8">
             <?php  
                $data = array(
				  'name'        => 'trans_ex_remark',
				  'id'          => 'trans_ex_remark',
				  'value'       => $row->Daily_mvnt_dtl_trp_exp_remark,
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
              <?php 
                  $data2 = array(
                        'name'        => 'trans_total',
                        'id'          => 'trans_total',
                        'value'       => $row->Daily_mvnt_dtl_trp_rent,
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
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='daily_movement_details_list'" >
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

<?php include('include/footer.php');


?>
        