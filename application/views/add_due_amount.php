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
                                <h1 class="title">Add Due Amount</h1>                            
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
        <?php //$id = $this->input->get('id'); echo $; ?>
        <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('Due_details/validate_add_due_amount', array('class'=>'form-horizontal')); 
        foreach ($paid_date_list->result() as $row) {
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>
          <div class="form-group">
            <label class="col-lg-3 control-label">Vehicle Number:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'driver_name',
                        'id'          => 'driver_name',
                        'value'       => $row->Vehicle_dtl_number,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
                        'placeholder' => 'Driver Name',
						'readonly'    => 'readonly'
                      ); 
                  echo form_input($data2);
              ?>
               <input type="hidden" id="id" name="id" value="<?php echo $row->Vehicle_due_dtl_id; ?>">
            </div>
          </div> 
          <div class="form-group">
            <label class="col-lg-3 control-label">Due Date:</label>
            <div class="col-lg-8">              
             <?php  
                $data1 = array(
                        'name'        => 'date',
                        'id'          => 'date',
                        'value'       => date("d M Y", strtotime($row->Vehicle_due_dtl_due_date)),
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
                        'data-format' => 'dd MM yyyy',
                        'placeholder' => 'Select a Date',
						'readonly'    => 'readonly'
                      ); 
                echo form_input($data1);?>
             
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Mutual Date:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'mut_date',
                        'id'          => 'mut_date',
                        'value'       => date("d M Y", strtotime($row->Vehicle_due_dtl_mutual_date)),
                        'maxlength'   => '10',
                        'class'       => 'form-control datepicker',
						'data-format' => 'dd MM yyyy',
						'onkeyup'     => 'checkInt(this)',
                        'placeholder' => 'Select Other Expences Date',
						'readonly'    => 'readonly'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Due Amount:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'amount',
                        'id'          => 'amount',
                        'value'       => $row->Vehicle_due_dtl_amount,
                        'maxlength'   => '10',
                        'class'       => 'form-control',
						'onkeyup'     => 'checkInt(this)',
                        'placeholder' => 'Select Due Amount',
						'readonly'    => 'readonly'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Paid Status:</label>
            <div class="col-lg-8">
                <span id="due_paid_status" class="">
              <?php   
                $data6 = array(
                                'name'        => 'paid_status',
                                'id'          => 'paid_status',
                                'value'       => 'U'
                              ); 
                echo form_radio($data6);
               ?> <strong>Unpaid</strong> &nbsp;&nbsp; 
			   <?php   
                $data6 = array(
                                'name'        => 'paid_status',
                                'id'          => 'paid_status',
                                'value'       => 'P'
                              ); 
                echo form_radio($data6);
               ?> <strong>Paid</strong><br>
               </span> 
            </div>
          </div>
          <div class="form-group">
          <div class="form-group">
            <label class="col-lg-3 control-label">Paid Date:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'paid_date',
                        'id'          => 'paid_date',
                        'value'       => '',
                        'maxlength'   => '10',
                        'class'       => 'form-control datepicker',
						'data-format' => 'dd MM yyyy',
						'onkeyup'     => 'checkInt(this)',
                        'placeholder' => 'Select Paid Date',
						
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
include('validation/add_due_amount.php');
?>
        