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
                                <h1 class="title">Edit Due Details</h1> 
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
        <?php echo form_open_multipart('due_details/validate_edit_due_details', array('class'=>'form-horizontal'));
        foreach ($due_details_data->result() as $row)
        {
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>          
          <div class="form-group">
            <label class="col-lg-3 control-label">Vehicle Number:</label>
            <div class="col-lg-8">              
              <?php
                $options_driver['']='Select Vehicle Number';
                foreach($vehicle_number_list->result() as $driver)
                {                  
                  $options_driver[$driver->Vehicle_dtl_id] = $driver->Vehicle_dtl_number;
                          
                } 
                echo form_dropdown('vehicle_number', $options_driver, $row->Vehicle_due_dtl_vehicle_no, 'class="form-control" id="vehicle_number"');
              ?>
              <input type="hidden" id="id" name="id" value="<?php echo $row->Vehicle_due_dtl_id; ?>">
            </div>
          </div>  
          <div class="form-group">
            <label class="col-lg-3 control-label">Due Date:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'due_date',
                        'id'          => 'due_date',
                        'value'       => date("d M Y", strtotime($row->Vehicle_due_dtl_due_date)),
                        'maxlength'   => '60',
                        'class'       => 'form-control datepicker',
                        'placeholder' => 'Select Due Date'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Mutual Date:</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'mutual_date',
                        'id'          => 'mutual_date',
                        'value'       => date("d M Y", strtotime($row->Vehicle_due_dtl_mutual_date)),
                        'maxlength'   => '60',
						'data-format' => 'dd MM yyyy',
                        'class'       => 'form-control datepicker',
                        'placeholder' => 'Select Mutual Date'
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
                        'name'        => 'due_amount',
                        'id'          => 'due_amount',
                        'value'       => $row->Vehicle_due_dtl_amount,
                        'maxlength'   => '120',
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Due Amount'
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
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='due_details_list'" >
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
include('validation/add_due_details.php');
?>
        